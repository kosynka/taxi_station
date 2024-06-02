@extends('main')

@section('content')
</br>
<form class="demo-form" method="POST" data-parsley-validate="" class="form-horizontal form-label-left" novalidate=""
    enctype="multipart/form-data" action="{{ route('penalties.store') }}">
    {{ csrf_field() }}

    <div class="form-floating mb-3">
        <select name="type" class="form-select" required>
            @foreach($types as $type => $text)
                <option value="{{ $type }}">{{ $text }}</option>
            @endforeach
        </select>
        <label for="type" class="form-label">Тип <i style="color: red;">*</i></label>
    </div>

    <div class="mb-3">
        <input class="form-control" name="rent_id" list="datalistOptions" placeholder="Выберите аренду" required>
        <datalist id="datalistOptions">
            @foreach($rents as $rent)
                <option style="width: 300px !important;" value="{{ $rent->id }}">
                    {{ \Carbon\Carbon::parse($rent->start_at)->format('d.m.Y H:i:s') }} |
                    {{ $rent->car->state_number }}
                    {{ $rent->car->brand }}
                    {{ $rent->car->model }} |
                    {{ $rent->driver?->name }}
                </option>
            @endforeach
        </datalist>
    </div>

    <div class="form-floating mb-3">
        <input type="text" class="form-control" name="protocol_number" id="protocol_number" required>
        <label for="protocol_number" class="form-label">№ протокола <i style="color: red;">*</i></label>
    </div>

    <div class="form-floating mb-3">
        <input type="datetime-local" class="form-control" name="paid_at" id="paid_at" required>
        <label for="paid_at" class="form-label">Дата оплаты</label>
    </div>

    <div class="form-floating mb-3">
        <input type="number" class="form-control" name="amount" id="amount" required>
        <label for="amount" class="form-label">Сумма <i style="color: red;">*</i></label>
    </div>

    <div class="form-floating mb-3">
        <select name="status" class="form-select" required>
            @foreach($statuses as $status => $text)
                <option value="{{ $status }}">{{ $text }}</option>
            @endforeach
        </select>
        <label for="status" class="form-label">Статус <i style="color: red;">*</i></label>
    </div>

    <div class="form-floating mb-3">
        <input type="text" class="form-control" name="comment" id="comment">
        <label for="comment" class="form-label">Коммент</label>
    </div>

    <div class="form bg-light border mb-3">
        <label for="protocol_file_path" class="form-label">Протокол</label>
        <input type="file" class="form-control" name="protocol_file_path" id="protocol_file_path">
    </div>

    <div class="col-auto">
        <button type="submit" class="btn btn-primary mb-3">Сохранить</button>
    </div>
</form>
@endsection
