<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    private string $key = 'cars';
    private array $metaData = [];
    private array $relations = ['rents', 'oilChanges'];

    public function __construct(
        private Car $model,
    ) {
        $this->metaData = [
            'active' => 'cars',
            'statuses' => Car::getStatuses(),
        ];
    }

    public function index()
    {
        $data = $this->model->with($this->relations)->get();

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
        $data = $request->validate([
            'state_number' => ['required', 'string'],
            'brand' => ['required', 'string'],
            'model' => ['required', 'string'],
            'year' => ['nullable', 'integer', 'min:0'],
            'status' => ['required', 'string', 'in:on_rent,in_parking,at_service,investor'],
            'mileage' => ['nullable', 'integer', 'min:0'],
            'rent_sum' => ['nullable', 'integer', 'min:0'],
        ]);

        $this->model->create($data);

        return redirect()->route("$this->key.index")->with(['success' => 'Успешно создан']);
    }

    public function update(int $id, Request $request)
    {
        $item = $this->model->findOrFail($id);

        $data = $request->validate([
            'state_number' => ['required', 'string'],
            'brand' => ['required', 'string'],
            'model' => ['required', 'string'],
            'year' => ['nullable', 'integer', 'min:0'],
            'status' => ['required', 'string', 'in:on_rent,in_parking,at_service,parking_fine'],
            'mileage' => ['nullable ', 'integer', 'min:0'],
            'rent_sum' => ['nullable', 'integer', 'min:0'],
        ]);

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
