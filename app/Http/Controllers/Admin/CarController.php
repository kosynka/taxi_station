<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    private string $key = 'cars';
    private array $metaData = ['active' => 'cars'];
    private array $relations = ['rents', 'oilChanges'];
    private array $rules = [
        'state_number' => ['required', 'string'],
        'brand' => ['required', 'string'],
        'model' => ['required', 'string'],
        'year' => ['required', 'integer', 'min:0'],
        'status' => ['required', 'string', 'in:on_rent,in_parking,at_service,investor'],
        'mileage' => ['required', 'integer', 'min:0'],
        'deposit' => ['required', 'integer', 'min:0'],
        'rent_sum' => ['required', 'integer', 'min:0'],
    ];

    public function __construct(
        private Car $model,
    ) {}

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
