@extends('main')

@section('content')
</br>
<form class="demo-form" method="POST" data-parsley-validate="" class="form-horizontal form-label-left" novalidate=""
    enctype="multipart/form-data" action="{{ route('cars.store') }}">
    {{ csrf_field() }}

    <div class="form-floating mb-3">
        <input type="text" class="form-control" name="state_number" id="state_number" required>
        <label for="state_number" class="form-label">Гос.номер машины <i style="color: red;">*</i></label>
    </div>

    <div class="form-floating mb-3">
        <input type="text" class="form-control" name="vin" id="vin" required>
        <label for="vin" class="form-label">VIN <i style="color: red;">*</i></label>
    </div>

    <div class="form-floating mb-3">
        <input type="text" class="form-control" name="vin" id="vin">
        <label for="vin" class="form-label">№ кузова</label>
    </div>

    <div class="form-floating mb-3">
        <input type="text" class="form-control" name="brand" id="brand" required>
        <label for="brand" class="form-label">Марка <i style="color: red;">*</i></label>
    </div>

    <div class="form-floating mb-3">
        <input type="text" class="form-control" name="model" id="model" required>
        <label for="model" class="form-label">Модель <i style="color: red;">*</i></label>
    </div>

    <div class="form-floating mb-3">
        <input type="text" class="form-control" name="engine_capacity" id="engine_capacity" required>
        <label for="engine_capacity" class="form-label">Объём двигателя <i style="color: red;">*</i></label>
    </div>

    <div class="form-floating mb-3">
        <input type="number" class="form-control" name="year" id="year" min="1900" required>
        <label for="year" class="form-label">Год <i style="color: red;">*</i></label>
    </div>

    <div class="form-floating mb-3">
        <input type="text" class="form-control" name="color" id="color">
        <label for="color" class="form-label">Цвет</label>
    </div>

    <div class="form-floating mb-3">
        <select name="status" class="form-select">
            @foreach($statuses as $status => $text)
                <option value="{{ $status }}">{{ $text }}</option>
            @endforeach
        </select>
        <label for="status" class="form-label">Статус</label>
    </div>

    <div class="form-floating mb-3">
        <input type="number" class="form-control" name="mileage" id="mileage" min="0">
        <label for="mileage" class="form-label">Пробег, км</label>
    </div>

    <div class="form-floating mb-3">
        <input type="text" class="form-control" name="amount" id="amount" required>
        <label for="amount" class="form-label">Сумма аренды, тг <i style="color: red;">*</i></label>
    </div>

    <div class="row row-cols-1">
        <div class="vstack gap-3">
        @for($i = 1; $i <= 10; $i++)
            <div class="col">
                <div class="form bg-light border mb-3">
                    <label for="amount" class="form-label">Фото {{ $i }}</label>
                    <input type="file" class="form-control" name="photo_{{ $i }}" id="photo_{{ $i }}">
                </div>
            </div>
        @endfor
        </div>
    </div>

    <div class="col-auto">
        <button type="submit" class="btn btn-primary mb-3">Сохранить</button>
    </div>
</form>
@endsection
