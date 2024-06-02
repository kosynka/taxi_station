<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Rent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CarController extends Controller
{
    private string $key = 'cars';
    private array $metaData = [];
    private array $relations = ['rents.driver', 'penalties', 'oilChanges'];

    public function __construct(
        private Car $model,
    ) {
        $this->metaData = [
            'active' => 'cars',
            'statuses' => Car::getStatusesForUpdate(),
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
            'state_number' => ['required', 'string', 'unique:cars,state_number'],
            'vin' => ['required', 'string', 'unique:cars,vin'],
            'carcass' => ['nullable', 'string'],
            'brand' => ['required', 'string'],
            'model' => ['required', 'string'],
            'year' => ['nullable', 'integer', 'min:0'],
            'engine_capacity' => ['nullable', 'string'],
            'color' => ['nullable', 'string'],
            'mileage' => ['required', 'integer', 'min:0'],
            'amount' => ['nullable', 'integer', 'min:0'],

            'photo_1' => ['nullable', 'mimes:jpeg,jpg,png', 'max:10240'],
            'photo_2' => ['nullable', 'mimes:jpeg,jpg,png', 'max:10240'],
            'photo_3' => ['nullable', 'mimes:jpeg,jpg,png', 'max:10240'],
            'photo_4' => ['nullable', 'mimes:jpeg,jpg,png', 'max:10240'],
            'photo_5' => ['nullable', 'mimes:jpeg,jpg,png', 'max:10240'],
            'photo_6' => ['nullable', 'mimes:jpeg,jpg,png', 'max:10240'],
            'photo_7' => ['nullable', 'mimes:jpeg,jpg,png', 'max:10240'],
            'photo_8' => ['nullable', 'mimes:jpeg,jpg,png', 'max:10240'],
            'photo_9' => ['nullable', 'mimes:jpeg,jpg,png', 'max:10240'],
            'photo_10' => ['nullable', 'mimes:jpeg,jpg,png', 'max:10240'],
        ]);

        $data['status'] = 'empty';

        for ($i = 1; $i <= 10; $i++) {
            $name = "photo_$i";

            if (isset($data[$name])) {
                $data[$name] = $this->storeFile($name);
            }
        }

        $this->model->create($data);

        return redirect()->route("$this->key.index")->with(['success' => 'Успешно создан']);
    }

    public function update(int $id, Request $request)
    {
        $item = $this->model->findOrFail($id);

        $data = $request->validate([
            'state_number' => ['required', 'string', 'unique:cars,state_number,' . $id],
            'vin' => ['required', 'string', 'unique:cars,vin,' . $id],
            'carcass' => ['nullable', 'string'],
            'brand' => ['required', 'string'],
            'model' => ['required', 'string'],
            'year' => ['nullable', 'integer', 'min:0'],
            'engine_capacity' => ['nullable', 'string'],
            'color' => ['nullable', 'string'],
            'status' => [
                'required',
                'string',
                'in:on_rent,in_parking,at_service,parking_fine,at_owner,weekend,accident',
            ],
            'mileage' => ['nullable ', 'integer', 'min:0'],
            'amount' => ['nullable', 'integer', 'min:0'],

            'photo1' => ['nullable', 'mimes:jpeg,jpg,png', 'max:10240'],
            'photo2' => ['nullable', 'mimes:jpeg,jpg,png', 'max:10240'],
            'photo3' => ['nullable', 'mimes:jpeg,jpg,png', 'max:10240'],
            'photo4' => ['nullable', 'mimes:jpeg,jpg,png', 'max:10240'],
            'photo5' => ['nullable', 'mimes:jpeg,jpg,png', 'max:10240'],
            'photo6' => ['nullable', 'mimes:jpeg,jpg,png', 'max:10240'],
            'photo7' => ['nullable', 'mimes:jpeg,jpg,png', 'max:10240'],
            'photo8' => ['nullable', 'mimes:jpeg,jpg,png', 'max:10240'],
            'photo9' => ['nullable', 'mimes:jpeg,jpg,png', 'max:10240'],
            'photo10' => ['nullable', 'mimes:jpeg,jpg,png', 'max:10240'],
        ]);

        $currentFiles = [];

        for ($i = 1; $i <= 10; $i++) {
            $name = "photo_$i";

            if (request()->file($name) != null) {
                $data[$name] = $this->storeFile($name);

                if ($item->{$name} !== null) {
                    $currentFiles[] = $item->{$name};
                }
            }
        }

        if (!empty($currentFiles)) {
            File::delete($currentFiles);
        }

        $item->update($data);
        $item->save();

        return redirect()->route("$this->key.index")->with(['success' => 'Успешно изменен']);
    }

    public function status(int $id, Request $request)
    {
        $data = $request->validate([
            'rent_ids' => ['nullable'],
            'rent_ids.*' => ['nullable', 'integer', 'exists:rents,id'],
            'comment' => ['nullable', 'string'],
            'status' => [
                'required',
                'string',
                'in:on_rent,in_parking,at_service,parking_fine,at_owner,weekend,accident',
            ],
        ]);

        $item = $this->model->find($id);

        $item->status = $data['status'];
        $item->addComment([
            'text' => $data['comment'],
            'status' => $data['status'] ?? $item->status,
        ]);

        $item->save();

        if (isset($data['rent_ids'])) {
            foreach ($data['rent_ids'] as $rentId) {
                $rent = Rent::find($rentId);
                $rent->addComment([
                    'text' => $data['comment'],
                    'status' => $data['status'] ?? $item->status,
                ]);
                $rent->save();
            }
        }

        return redirect()->back()->with(['success' => 'Успешно изменен']);
    }

    public function delete(int $id)
    {
        $item = $this->model->find($id);

        $item->delete();

        return redirect()->route("$this->key.index")->with(['success' => 'Успешно удален']);
    }

    private function storeFile(string $name): string
    {
        $file = request()->file($name);
        $filePath = uniqid('image_') . '_' . now()->format('Y_m_d_h_i_s') . '.' . $file->getClientOriginalExtension();
        $file->storeAs('images', $filePath, ['disk' => 'public']);

        return "storage/images/$filePath";
    }
}
