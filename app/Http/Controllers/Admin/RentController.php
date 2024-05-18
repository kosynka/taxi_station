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
    private array $metaData = ['active' => 'rents'];
    private array $relations = ['car', 'driver', 'penalty'];
    private array $rules = [
        'car_id' => ['required', 'integer', 'exists:cars,id'],
        'driver_id' => ['required', 'integer', 'exists:drivers,id'],
        'start_date' => ['nullable', 'date'],
        'amount' => ['sometimes', 'integer', 'min:0'],
    ];

    public function __construct(
        private Rent $model,
    ) {
    }

    public function index()
    {
        $drivers = User::where('role', 'taxi_driver')->get();
        $historyStartDate = $this->model->min('start_date');

        $today = Car::with(['rents' => function ($query) use ($historyStartDate) {
                $query->whereDate('start_date', '=', $historyStartDate);
            }])
            ->get();

        $todayAmount = 0;
        $todayCarsCount = 0;

        foreach ($today as $car) {
            if ($car->todayRent()) {
                $todayAmount += $car->todayRent()->amount;
                $todayCarsCount += 1;
            }
        }

        $notToday = $this->model
            ->with($this->relations)
            ->whereDate('start_date', '!=', $historyStartDate)
            ->orderBy('start_date')
            ->get()
            ->groupBy(function ($date) {
                return \Carbon\Carbon::parse($date->start_date)->format('d.m.Y');
            });

        $historyByDays = [];
        $amountByDays = [];

        foreach ($today as $car) {
            $historyByDays[$car->id] = [];
            $historyByDays[$car->id]['car'] = $car;

            foreach ($notToday as $date => $rentGroup) {
                $rent = $rentGroup->where('car_id', $car->id)->first();

                $historyByDays[$car->id]['dates'][$date] = $rent ?? null;

                if (!isset($amountByDays[$date])) {
                    $amountByDays[$date] = 0;
                }
                $amountByDays[$date] += (isset($rent) ? $rent->amount : 0);
            }
        }

        $dates = array_keys($historyByDays[1]['dates']);
        $dates = array_map(function ($date) {
            return \Carbon\Carbon::parse($date)->format('d.m.Y');
        }, $dates);

        return view("admin.$this->key.index",
            compact(
                'today',
                'amountByDays',
                'historyByDays',
                'drivers',
                'dates',
                'todayAmount',
                'todayCarsCount',
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
            'start_date' => ['nullable', 'date'],
        ]);

        $car = Car::find($data['car_id']);

        if (!isset($data['start_date'])) {
            $data['start_date'] = now()->toDateString();
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

        $data = $request->validate($this->rules);

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
