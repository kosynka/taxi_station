<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    private string $key = 'employees';
    private array $metaData = ['active' => 'employees'];

    public function __construct(
        private User $model,
    ) {}

    public function index()
    {
        $data = $this->model
            ->where('role', '!=', 'taxi_driver')
            ->get();

        return view("admin.$this->key.index", compact('data') + $this->metaData);
    }

    public function show(int $id)
    {
        $data = $this->model->findOrFail($id);

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
            'email' => ['required', 'email:rfc,dns', 'unique:users,email'],
            'password' => ['required', 'string', 'min:5'],
        ]);

        $data['role'] = 'manager';
        $data['password'] = Hash::make($data['password']);

        $this->model->create($data);

        return redirect()->route("$this->key.index")->with(['success' => 'Успешно создан']);
    }

    public function update(int $id, Request $request)
    {
        $item = $this->model->findOrFail($id);

        $data = $request->validate([
            'name' => ['required', 'string'],
            'email' => ['nullable', 'email:rfc,dns', "unique:users,email,$id"],
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

    public function permissions()
    {
        $data = Permission::all();
        $active = 'permissions';

        return view("admin.permissions.index", compact('data', 'active'));
    }

    public function updatePermissions(Request $request)
    {
        $data = $request->validate([
            'all' => ['required', 'array'],
            'all.*' => ['nullable', 'boolean'],
        ]);

        $permissions = Permission::all();
        $changed = $data['all'];

        foreach ($permissions as $permission) {
            if (isset($changed[$permission->name]) && $changed[$permission->name] === '1') {
                $permission->is_active = true;
            } else {
                $permission->is_active = false;
            }

            $permission->save();
        }

        return redirect()->back()->with(['success' => 'Успешно обновлены разрешения']);
    }
}
