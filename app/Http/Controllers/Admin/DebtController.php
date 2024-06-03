<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserDebt;
use Illuminate\Http\Request;

class DebtController extends Controller
{
    private string $key = 'debts';
    private array $metaData;
    private array $relations = ['user'];

    public function __construct(
        private UserDebt $model,
    )
    {
        $this->metaData = [
            'active' => $this->key,
        ];
    }

    public function index()
    {
        $data = $this->model->with('user')->get();

        return view("admin.$this->key.index", compact('data') + $this->metaData);
    }

    public function show(int $id)
    {
        $data = $this->model->with($this->relations)->findOrFail($id);

        return view("admin.$this->key.show", compact('data') + $this->metaData);
    }

    public function create(Request $request)
    {
        $data = $request->validate([
            'user_id' => ['required', 'integer', 'exists:users,id'],
        ]);

        return view("admin.$this->key.create", compact('data') + $this->metaData);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'amount' => ['required', 'integer', 'min:1'],
            'comment' => ['nullable', 'string'],
            // 'status' => ['required', 'string', 'in:repaid,not_repaid'],
        ]);

        $item = $this->model->create($data);

        return redirect()->route('users.show', ['id' => $item->user_id])->with(['success' => 'Успешно создан']);
    }

    public function update(int $id, Request $request)
    {
        $item = $this->model->findOrFail($id);

        $data = $request->validate([
            'user_id' => ['nullable', 'integer', 'exists:users,id'],
            'amount' => ['required', 'integer', 'min:1'],
            'comment' => ['nullable', 'string'],
            // 'status' => ['required', 'string', 'in:repaid,not_repaid'],
        ]);

        $item->update($data);
        $item->save();

        return redirect()->route('users.show', ['id' => $item->user_id])->with(['success' => 'Успешно изменен']);
    }

    public function delete(int $id)
    {
        $item = $this->model->find($id);

        $item->delete();

        return redirect()->back()->with(['success' => 'Успешно удален']);
    }
}
