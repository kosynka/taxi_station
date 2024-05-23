@extends('main')

@section('content')
</br>
<h2>
    {{ $data->rent->car->state_number }}
    {{ $data->rent->car->brand }}
    {{ $data->rent->car->model }}
    {{ $data->rent->driver->name }}
</h2>

<form class="demo-form" method="POST" data-parsley-validate="" class="form-horizontal form-label-left" novalidate=""
    enctype="multipart/form-data" action="{{ route('penalties.store') }}">
    {{ csrf_field() }}

    <div class="form-floating mb-3">
        <input type="date" class="form-control" name="received_date" id="received_date"
            value="{{ $data->received_date !== null ? $data->received_date : old('received_date') }}" required>
        <label for="received_date" class="form-label">Дата получения <i style="color: red;">*</i></label>
    </div>

    <div class="form-floating mb-3">
        <input type="date" class="form-control" name="paid_date" id="paid_date"
            value="{{ $data->paid_date !== null ? $data->paid_date : old('paid_date') }}" required>
        <label for="paid_date" class="form-label">Дата оплаты</label>
    </div>

    <div class="form-floating mb-3">
        <input type="number" class="form-control" name="amount" id="amount"
            value="{{ $data->amount !== null ? $data->amount : old('amount') }}" required>
        <label for="amount" class="form-label">Сумма <i style="color: red;">*</i></label>
    </div>

    <div class="form-floating mb-3">
        <select name="status" class="form-select" required>
            @foreach($statuses as $status => $text)
                <option value="{{ $status }}" {{ $data->status == $status ? 'selected' : '' }} > }}>{{ $text }}</option>
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

            @if($data->protocol_file_path !== null)
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
