<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    private string $key = 'users';
    private array $metaData = ['active' => 'users'];
    private array $relations = ['rents', 'penalties'];
    private array $rules = [
        'name' => ['required', 'string'],
        'phone' => ['sometimes', 'string', 'regex:/^87\d{8}$/'],
        'email' => ['required', 'email:rfc,dns', 'unique:users,email'],
        'password' => ['required', 'string', 'min:5', 'confirmed'],
    ];

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
        $data = $request->validate($this->rules);

        $data['role'] = 'driver';

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
