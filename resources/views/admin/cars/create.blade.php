@extends('main')

@section('content')
</br>
<form class="demo-form" method="POST" data-parsley-validate="" class="form-horizontal form-label-left" novalidate=""
    enctype="multipart/form-data" action="{{ route('cars.store') }}">
    {{ csrf_field() }}

    <div class="mb-3">
        <label for="state_number" class="form-label">Гос.номер машины <i style="color: red;">*</i></label>
        <input type="text" class="form-control" name="state_number" id="state_number" required>
    </div>

    <div class="mb-3">
        <label for="brand" class="form-label">Марка <i style="color: red;">*</i></label>
        <input type="text" class="form-control" name="brand" id="brand" required>
    </div>

    <div class="mb-3">
        <label for="model" class="form-label">Модель <i style="color: red;">*</i></label>
        <input type="text" class="form-control" name="model" id="model" required>
    </div>

    <div class="mb-3">
        <label for="year" class="form-label">Год</label>
        <input type="number" class="form-control" name="year" id="year" min="1900">
    </div>

    <div class="mb-3">
        <label for="status" class="form-label">Статус</label>
        <select name="status" class="form-select">
            @foreach($statuses as $status)
                <option value="{{ $status['name'] }}">{{ $status['text'] }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="mileage" class="form-label">Пробег, км</label>
        <input type="number" class="form-control" name="mileage" id="mileage" min="0">
    </div>

    <div class="mb-3">
        <label for="rent_sum" class="form-label">Сумма аренды, тг <i style="color: red;">*</i></label>
        <input type="text" class="form-control" name="rent_sum" id="rent_sum" required>
    </div>

    <div class="col-auto">
        <button type="submit" class="btn btn-primary mb-3">Сохранить</button>
    </div>
</form>
@endsection
