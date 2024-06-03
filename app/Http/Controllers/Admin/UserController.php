<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private string $key = 'users';
    private array $metaData = ['active' => 'users'];
    private array $relations = ['rents', 'penalties', 'debts'];

    public function __construct(
        private User $model,
    ) {}

    public function index()
    {
        $data = $this->model
            ->with($this->relations)
            ->withSum('debts', 'amount')
            ->where('role', 'taxi_driver')
            ->get();

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
            'name' => ['required', 'string'],
            'phone' => ['required', 'string', 'regex:/^87\d{9}$/'],
            'email' => ['nullable', 'email:rfc,dns', 'unique:users,email'],
            'balance' => ['nullable', 'integer'],
            'debt' => ['nullable', 'integer'],

            'iin' => ['required', 'string', 'regex:/^\d{12}$/', 'unique:users,iin'],
            'id_doc_number' => ['required', 'string'],
            'id_doc_date' => ['required', 'string'],
            'id_doc_until_date' => ['required', 'date'],
            'registration_address' => ['required', 'string'],
            'residence_address' => ['required', 'string'],
            'driver_license_number' => ['required', 'string'],
            'driver_license_date' => ['required', 'date'],
            'driver_license_categories' => ['required', 'string'],
            // 'password' => ['required', 'string', 'min:5'],
            'comment' => ['nullable', 'string'],

            'id_doc_photo_1' => ['nullable', 'mimes:jpeg,jpg,png', 'max:10240'],
            'id_doc_photo_2' => ['nullable', 'mimes:jpeg,jpg,png', 'max:10240'],
            'driver_license_photo_1' => ['nullable', 'mimes:jpeg,jpg,png', 'max:10240'],
            'driver_license_photo_2' => ['nullable', 'mimes:jpeg,jpg,png', 'max:10240'],
        ]);

        if (auth()->user()->roleIs('admin') === false) {
            unset($data['phone']);
            unset($data['debt']);
        }

        $fileNames = ['id_doc_photo_1', 'id_doc_photo_2', 'driver_license_photo_1', 'driver_license_photo_2'];

        foreach ($fileNames as $name) {
            if (request()->file($name) != null) {
                $data[$name] = $this->storeFile($name);

                if (isset($data[$name])) {
                    $data[$name] = $this->storeFile($name);
                }
            }
        }

        $data['role'] = 'taxi_driver';
        // $data['password'] = Hash::make($data['password']);

        $driver = $this->model->create($data);

        if (!isset($data['comment'])) {
            $driver->addComment(['text' => $data['comment']]);
            $driver->save();
        }

        return redirect()->route("$this->key.index")->with(['success' => 'Успешно создан']);
    }

    public function update(int $id, Request $request)
    {
        $item = $this->model->findOrFail($id);

        $data = $request->validate([
            'name' => ['required', 'string'],
            'phone' => ['required', 'string', 'regex:/^87\d{9}$/'],
            'email' => ['nullable', 'email:rfc,dns', "unique:users,email,$id"],
            'balance' => ['nullable', 'integer'],
            'debt' => ['nullable', 'integer'],

            'iin' => ['required', 'string', 'regex:/^\d{12}$/', "unique:users,iin,$id"],
            'id_doc_number' => ['required', 'string'],
            'id_doc_date' => ['required', 'string'],
            'id_doc_until_date' => ['required', 'date'],
            'registration_address' => ['required', 'string'],
            'residence_address' => ['required', 'string'],
            'driver_license_number' => ['required', 'string'],
            'driver_license_date' => ['required', 'date'],
            'driver_license_categories' => ['required', 'string'],
            // 'password' => ['nullable', 'string', 'min:5'],
            'comment' => ['nullable', 'string'],

            'id_doc_photo_1' => ['nullable', 'mimes:jpeg,jpg,png', 'max:10240'],
            'id_doc_photo_2' => ['nullable', 'mimes:jpeg,jpg,png', 'max:10240'],
            'driver_license_photo_1' => ['nullable', 'mimes:jpeg,jpg,png', 'max:10240'],
            'driver_license_photo_2' => ['nullable', 'mimes:jpeg,jpg,png', 'max:10240'],
        ]);

        if (auth()->user()->roleIs('admin') === false) {
            unset($data['phone']);
            unset($data['debt']);
        }

        if (isset($data['password']) && $data['password'] !== null) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $fileNames = ['id_doc_photo_1', 'id_doc_photo_2', 'driver_license_photo_1', 'driver_license_photo_2'];

        foreach ($fileNames as $name) {
            if (request()->file($name) != null) {
                $data[$name] = $this->storeFile($name);

                if ($item->{$name} !== null) {
                    $currentFiles[] = $item->{$name};
                }
            }

            if (!empty($currentFiles)) {
                File::delete($currentFiles);
            }
        }

        $item->update($data);

        if (isset($data['comment'])) {
            $item->addComment(['text' => $data['comment']]);
        }

        $item->save();

        return redirect()->route("$this->key.index")->with(['success' => 'Успешно изменен']);
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
