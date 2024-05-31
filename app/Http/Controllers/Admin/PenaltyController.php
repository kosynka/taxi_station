<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penalty;
use App\Models\Rent;
use Illuminate\Http\Request;

class PenaltyController extends Controller
{
    private string $key = 'penalties';
    private array $metaData;
    private array $relations = ['rent.car', 'rent.driver'];

    public function __construct(private Penalty $model)
    {
        $this->metaData = [
            'active' => $this->key,
            'statuses' => Penalty::getStatuses(),
            'types' => Penalty::getTypes(),
            'rents' => Rent::with(['driver', 'car'])
                ->whereDoesntHave('penalty')
                // ->whereDate('start_at', '=', now()->toDateString())
                ->get(),
        ];
    }

    public function index(Request $request)
    {
        $query = $this->model->with($this->relations);

        if (isset($request->date_from)) {
            $query->whereDate('received_at', '>=', $request->date_from);
        }

        if (isset($request->date_to)) {
            $query->whereDate('received_at', '<=', $request->date_to);
        }

        if (isset($request->type)) {
            $query->where('type', $request->type);
        }

        if (isset($request->status)) {
            $query->where('status', $request->status);
        }

        $data = $query->orderBy('received_at', 'desc')
            ->orderBy('paid_at', 'desc')
            ->paginate($request->per_page ?? 100);

        return view("admin.$this->key.index", compact('data') + $this->metaData);
    }

    public function create()
    {
        return view("admin.$this->key.create", $this->metaData);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'type' => ['required', 'in:fine,accident'],
            'rent_id' => ['required', 'integer', 'exists:rents,id'],
            'received_at' => ['required', 'date'],
            'paid_at' => [
                'nullable',
                'date',
                'required_if:status,paid_with_discount',
                'required_if:status,paid_without_discount',
            ],
            'amount' => ['required', 'integer', 'min:0'],
            'status' => ['required', 'in:unpaid,paid_with_discount,paid_without_discount'],
            'comment' => ['nullable', 'string'],
            'protocol_file_path' => [
                'nullable',
                'mimes:pdf,jpeg,jpg,png',
                'max:10240',
            ],
        ]);

        if (request()->file('protocol_file_path') != null) {
            $data['protocol_file_path'] = $this->storeFile('protocol_file_path');
        }

        $item = $this->model->create($data);

        $item->addComment([
            'text' => $data['comment'],
            'status' => $data['status'] ?? $item->status,
        ]);

        $item->save();

        return redirect()->route("$this->key.index")->with(['success' => 'Успешно создан']);
    }

    public function show(int $id)
    {
        $data = $this->model->with($this->relations)->findOrFail($id);

        return view("admin.$this->key.show", compact('data') + $this->metaData);
    }

    public function update(int $id, Request $request)
    {
        $item = $this->model->findOrFail($id);

        $data = $request->validate([
            'type' => ['required', 'in:fine,accident'],
            'received_at' => ['required', 'date'],
            'paid_at' => [
                'nullable',
                'date',
                'required_if:status,paid_with_discount',
                'required_if:status,paid_without_discount',
            ],
            'amount' => ['required', 'integer', 'min:0'],
            'status' => ['required', 'in:unpaid,paid_with_discount,paid_without_discount'],
            'comment' => ['nullable', 'string'],
            'protocol_file_path' => [
                'nullable',
                'mimes:pdf,jpeg,jpg,png',
                'max:10240',
            ],
        ]);

        if (request()->file('protocol_file_path') != null) {
            $data['protocol_file_path'] = $this->storeFile('protocol_file_path');
        }

        $item->addComment([
            'text' => $data['comment'],
            'status' => $data['status'] ?? $item->status,
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

    private function storeFile(string $name): string
    {
        $file = request()->file($name);
        $filePath = uniqid('image_') . '_' . now()->format('Y_m_d_h_i_s') . '.' . $file->getClientOriginalExtension();
        $file->storeAs('images', $filePath, ['disk' => 'public']);

        return "storage/images/$filePath";
    }
}
