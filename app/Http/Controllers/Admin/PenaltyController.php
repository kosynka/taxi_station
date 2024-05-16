<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penalty;
use Illuminate\Http\Request;

class PenaltyController extends Controller
{
    private string $key = 'penalties';
    private array $metaData;
    private array $relations = ['rent.car', 'rent.driver'];
    private array $rules = [
        'rent_id' => ['required', 'integer', 'exists:rents,id'],
        'received_date' => ['required', 'date'],
        'paid_date' => ['sometimes', 'date', 'after:received_date'],
        'amount' => ['required', 'integer', 'min:0'],
        'status' => ['required', 'in:unpaid,paid_with_discount,paid_without_discount'],
    ];

    public function __construct(
        private Penalty $model,
    )
    {
        $this->metaData = [
            'active' => $this->key,
            'statuses' => Penalty::getStatuses(),
        ];
    }

    public function index(Request $request)
    {
        $query = $this->model->with($this->relations);

        if (isset($request->date_from)) {
            $query->whereDate('received_date', '>=', $request->date_from);
        }

        if (isset($request->date_to)) {
            $query->whereDate('received_date', '<=', $request->date_to);
        }

        if (isset($request->status)) {
            $query->where('status', $request->status);
        }

        $data = $query->orderBy('received_date')
            ->orderBy('paid_date')
            ->paginate(50);

        return view("admin.$this->key.index", compact('data') + $this->metaData);
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
        $data = $request->validate($this->rules);

        $this->model->create($data);

        return redirect()->route("$this->key.index")->with(['success' => 'Успешно создан']);
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
