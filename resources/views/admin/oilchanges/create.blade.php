@extends('main')

@section('content')
</br>
<form class="demo-form" method="POST" data-parsley-validate="" class="form-horizontal form-label-left" novalidate=""
    enctype="multipart/form-data" action="{{ route('oilchanges.store') }}">
    {{ csrf_field() }}

    <div class="form-floating mb-3">
        <select name="car_id" class="form-select">
            <option></option>
            @foreach($cars as $car)
                <option value="{{ $car->id }}">
                    {{ $car->state_number }}
                    {{ $car->brand }}
                    {{ $car->model }} |
                    {{ $car->mileage }} км
                </option>
            @endforeach
        </select>
        <label for="status" class="form-label">Машина <i style="color: red;">*</i></label>
    </div>

    <div class="form-floating mb-3">
        <input type="number" class="form-control" name="mileage" id="mileage" min="0" required>
        <label for="mileage" class="form-label">Пробег <i style="color: red;">*</i></label>
    </div>

    <div class="form-floating mb-3">
        <input type="date" class="form-control" name="changed_at" id="changed_at" required>
        <label for="changed_at" class="form-label">Дата замены <i style="color: red;">*</i></label>
    </div>

    <div class="col-auto">
        <button type="submit" class="btn btn-primary mb-3">Сохранить</button>
    </div>
</form>
@endsection
