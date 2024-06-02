@extends('main')

@section('content')
</br>
<h2>
    {{ $data->rent->car->state_number }}
    {{ $data->rent->car->brand }}
    {{ $data->rent->car->model }} </br>
    {{ $data->rent->driver?->name }}
</h2>

<form class="demo-form" method="POST" data-parsley-validate="" class="form-horizontal form-label-left" novalidate=""
    enctype="multipart/form-data" action="{{ route('penalties.update', ['id' => $data->id]) }}">
    {{ csrf_field() }}

    <div class="form-floating mb-3">
        <select name="type" class="form-select" required>
            @foreach($types as $type => $text)
                <option value="{{ $type }}" {{ $data->type == $type ? 'selected' : '' }}>{{ $text }}</option>
            @endforeach
        </select>
        <label for="type" class="form-label">Тип <i style="color: red;">*</i></label>
    </div>

    <div class="form-floating mb-3">
        <input type="text" class="form-control" name="protocol_number" id="protocol_number" value="{{ $data->protocol_number }}"
            required>
        <label for="protocol_number" class="form-label">№ протокола <i style="color: red;">*</i></label>
    </div>

    <div class="form-floating mb-3">
        <input type="datetime-local" class="form-control" name="paid_at" id="paid_at"
            value="{{ $data->paid_at ? $data->paid_at : old('paid_at') }}" required>
        <label for="paid_at" class="form-label">Дата оплаты</label>
    </div>

    <div class="form-floating mb-3">
        <input type="number" class="form-control" name="amount" id="amount"
            value="{{ $data->amount ? $data->amount : old('amount') }}" required>
        <label for="amount" class="form-label">Сумма <i style="color: red;">*</i></label>
    </div>

    <div class="form-floating mb-3">
        <select name="status" class="form-select" required>
            @foreach($statuses as $status => $text)
                <option value="{{ $status }}" {{ $data->status == $status ? 'selected' : '' }}>{{ $text }}</option>
            @endforeach
        </select>
        <label for="status" class="form-label">Статус <i style="color: red;">*</i></label>
    </div>

    @if($data->comment)
        @foreach($data->comments as $comment)
            <small>
                {{ $comment['text'] }} -
                {{ \App\Models\User::find($comment['user_id'])->name }}
                </br>
                {{ $comment['created_at'] }}
            </small>
        @endforeach
    @endif

    <div class="form-floating mb-3">
        <input type="text" class="form-control" name="comment" id="comment">
        <label for="comment" class="form-label">Коммент</label>
    </div>

    <div class="form bg-light border mb-3">
        <label for="protocol_file_path" class="form-label">
            Протокол

            @if($data->protocol_file_path)
                <a target="_blank" href="{{ url($data->protocol_file_path) }}">
                    посмотреть
                </a>
            @else
                не прикреплен
            @endif
        </label>
        <input type="file" class="form-control" name="protocol_file_path" id="protocol_file_path">
    </div>

    <div class="col-auto">
        <button type="submit" class="btn btn-primary mb-3">Сохранить</button>
    </div>
</form>
@endsection
