<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rent;
use Illuminate\Http\Request;

class RentController extends Controller
{
    private string $key = 'rents';
    private array $metaData = ['active' => 'rents'];
    private array $relations = ['car', 'driver', 'penalty'];
    private array $rules = [
        'car_id' => ['required', 'integer', 'exists:cars,id'],
        'driver_id' => ['required', 'integer', 'exists:drivers,id'],
        'start_at' => ['required', 'date'],
        'end_at' => ['sometimes', 'date', 'after:start_at'],
        'deposit' => ['sometimes', 'integer', 'min:0'],
    ];

    public function __construct(
        private Rent $model,
    ) {}

    public function index()
    {
        $data = $this->model->with($this->relations)->all();

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
