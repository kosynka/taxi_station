<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private string $key = 'users';
    private array $metaData = ['active' => 'users'];
    private array $relations = ['rents', 'penalties'];

    public function __construct(
        private User $model,
    ) {}

    public function index()
    {
        $data = $this->model
            ->with($this->relations)
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
            'phone' => ['nullable', 'string', 'regex:/^87\d{9}$/'],
            'email' => ['nullable', 'email:rfc,dns', 'unique:users,email'],
            'balance' => ['nullable', 'integer'],
            'iin' => ['nullable', 'string', 'regex:/^\d{12}$/', 'unique:users,iin'],
            'driver_license_number' => ['nullable', 'string'],
            'driver_license_date' => ['nullable', 'date'],
            'driver_license_categories' => ['nullable', 'string'],
            'password' => ['required', 'string', 'min:5'],
        ]);

        $data['role'] = 'taxi_driver';
        $data['password'] = Hash::make($data['password']);

        $this->model->create($data);

        return redirect()->route("$this->key.index")->with(['success' => 'Успешно создан']);
    }

    public function update(int $id, Request $request)
    {
        $item = $this->model->findOrFail($id);

        $data = $request->validate([
            'name' => ['nullable', 'string'],
            'phone' => ['nullable', 'string', 'regex:/^87\d{9}$/'],
            'email' => ['nullable', 'email:rfc,dns', "unique:users,email,$id"],
            'balance' => ['nullable', 'integer'],
            'iin' => ['nullable', 'string', 'regex:/^\d{12}$/', "unique:users,iin,$id"],
            'driver_license_number' => ['nullable', 'string'],
            'driver_license_date' => ['nullable', 'date'],
            'driver_license_categories' => ['nullable', 'string'],
            'password' => ['nullable', 'string', 'min:5'],
        ]);

        if (!isset($data['name']) || $data['name'] === null) {
            unset($data['name']);
        }

        if (!isset($data['phone']) || $data['phone'] === null) {
            unset($data['phone']);
        }

        if (!isset($data['email']) || $data['email'] === null) {
            unset($data['email']);
        }

        if (isset($data['password']) && $data['password'] !== null) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
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
