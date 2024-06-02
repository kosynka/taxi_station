<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Rent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RentController extends Controller
{
    private string $key = 'rents';
    private array $metaData = [];
    private array $relations = ['car', 'driver'];

    public function __construct(
        private Rent $model,
    ) {
        $this->metaData = [
            'active' => 'rents',
            'statuses' => Car::getStatusesForUpdate(),
        ];
    }

    public function index(Request $request)
    {
        $params = $request->validate([
            'date_from' => ['nullable', 'date', 'before_or_equal:date_to'],
            'date_to' => ['nullable', 'date', 'after_or_equal:date_from'],
        ]);

        $activeBar = 'today';

        $drivers = User::where('role', 'taxi_driver')->get();
        $historyStartDate = \Carbon\Carbon::parse($this->model->min('start_at'))->format('Y-m-d');

        $today = Car::with(['rents' => function ($query) use ($historyStartDate) {
                $query->whereDate('start_at', '=', $historyStartDate);
            }, 'rents.driver', 'rents.penalty'])
            ->get();

        // $todayAmount = 0;
        // $todayCarsCount = 0;

        // foreach ($today as $car) {
        //     if ($car->todayRent()->isNotEmpty()) {
        //         $todayAmount += $car->todayRent()->sum('amount');
        //         $todayCarsCount += 1;
        //     }
        // }

        $notTodayQuery = $this->model
            ->with($this->relations)
            ->whereDate('start_at', '!=', $historyStartDate);

        if (!empty($params)) {
            $activeBar = 'history';

            if (isset($params['date_from'])) {
                $notTodayQuery->whereDate('start_at', '>=', $params['date_from']);
            }

            if (isset($params['date_to'])) {
                $notTodayQuery->whereDate('start_at', '<=', $params['date_to']);
            }
        }

        $notToday = $notTodayQuery->orderBy('start_at')
            ->get()
            ->groupBy(function ($date) {
                return \Carbon\Carbon::parse($date->start_at)->format('d.m.Y');
            });

        $historyByDays = [];
        // $amountByDays = [];

        foreach ($today as $car) {
            $historyByDays[$car->id] = [];
            $historyByDays[$car->id]['car'] = $car;

            foreach ($notToday as $date => $rentGroup) {
                $rents = $rentGroup->where('car_id', $car->id)->all();

                $historyByDays[$car->id]['dates'][$date] = $rents;

                // if (!isset($amountByDays[$date])) {
                //     $amountByDays[$date] = 0;
                // }

                // $amountByDays[$date] += (
                //     ! empty($rents)
                //     ? array_reduce($rents, function ($sum, $rent) { return $sum + $rent->amount; })
                //     : 0
                // );
            }
        }

        if (empty($historyByDays) || !array_key_exists('dates', $historyByDays[1])) {
            $dates = [];
            $historyByDays = [];
        } else {
            $dates = array_keys($historyByDays[1]['dates']);
            $dates = array_map(function ($date) {
                return \Carbon\Carbon::parse($date)->format('d.m.Y');
            }, $dates);
        }

        return view("admin.$this->key.index",
            compact(
                'activeBar',
                'today',
                // 'amountByDays',
                'historyByDays',
                'drivers',
                'dates',
                // 'todayAmount',
                // 'todayCarsCount',
            ) + $this->metaData
        );
    }

    public function show(int $id)
    {
        $data = $this->model->with($this->relations)->findOrFail($id);

        return view("admin.$this->key.show", compact('data') + $this->metaData);
    }

    public function create()
    {
        return view("admin.$this->key.create", $this->metaData);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'car_id' => ['required', 'integer', 'exists:cars,id'],
            'driver_id' => ['required', 'integer', 'exists:users,id'],
            'start_at' => ['nullable', 'date'],
        ]);

        $car = Car::find($data['car_id']);

        if (!isset($data['start_at'])) {
            $data['start_at'] = now()->toDateTimeString();
        }

        if (!isset($data['amount'])) {
            $data['amount'] = $car->amount;
        }

        DB::beginTransaction();
        try {
            $rent = $this->model->create($data);
            $car->status = Car::ON_RENT;
            $car->save();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error($e->getMessage(), $e->getTrace());

            return redirect()->route("$this->key.index")->with([
                'error' => $e->getMessage(),
            ]);
        }

        return redirect()->route("$this->key.index")->with([
            'success' => $rent->car->state_number . ' ' .
                $rent->car->brand . ' ' .
                $rent->car->model . ' ' .
                ' успешно арендован водителем ' .
                $rent->driver->name,
        ]);
    }

    public function update(int $id, Request $request)
    {
        $item = $this->model->findOrFail($id);

        $data = $request->validate([
            'car_id' => ['nullable', 'integer', 'exists:cars,id'],
            'driver_id' => ['nullable', 'integer', 'exists:users,id'],
            'end_at' => ['nullable', 'date'],
            'amount' => ['nullable', 'integer', 'min:0'],
            'comment' => ['nullable', 'string'],
            'is_paid' => ['nullable', 'boolean'],
        ]);

        if ($item->start_at === now()->toDateString() && isset($data['end_at'])) {
            $item->car->status = Car::EMPTY;
            $item->car->save();
        }

        if (auth()->user()->roleIs('admin') || auth()->user()->roleIs('accountant')) {
            if (isset($data['is_paid']) && $data['is_paid'] === '1') {
                $data['is_paid'] = true;
            } else {
                $data['is_paid'] = false;
            }
        }

        if (isset($data['end_at'])) {
            $data['end_at'] = now()->toDateTimeString();
            $item->car->status = Car::PASSED;
            $item->car->save();
        }

        $item->update($data);
        $item->save();

        return redirect()->route("$this->key.index")->with(['success' => 'Успешно изменен']);
    }

    public function delete(int $id)
    {
        $item = $this->model->find($id);

        $item->delete();

        return redirect()->route("$this->key.index")->with(['success' => 'Успешно удален']);
    }
}
