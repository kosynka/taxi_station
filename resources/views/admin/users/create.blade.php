@extends('main')

@section('content')
</br>
<form class="demo-form" method="POST" data-parsley-validate="" class="form-horizontal form-label-left" novalidate=""
    enctype="multipart/form-data" action="{{ route('users.store') }}">
    {{ csrf_field() }}

    <div class="row row-cols-3">
        <div class="col">
            <div class="form-floating mb-3">
                <input value="{{ old('name') }}" type="text" class="form-control" name="name" id="name" required>
                <label for="name" class="form-label">ФИО <i style="color: red;">*</i></label>
            </div>
        </div>
    
        <div class="col">
            <div class="form-floating mb-3">
                <input value="{{ old('email') }}" type="email" class="form-control" name="email" id="email">
                <label for="email" class="form-label">Почта (формат primer.taxidriver@mail.ru)</label>
            </div>
        </div>
    
        <div class="col">
            <div class="form-floating mb-3">
                <input value="{{ old('phone') }}" type="text" class="form-control" name="phone" id="phone">
                <label for="phone" class="form-label">Телефон (формат 87001112233)</label>
            </div>
        </div>
    
        <div class="col">
            <div class="form-floating mb-3">
                <input value="{{ old('balance') }}" type="number" class="form-control" name="balance" id="balance">
                <label for="balance" class="form-label">Баланс, тг</label>
            </div>
        </div>
    
        <div class="col">
            <div class="form-floating mb-3">
                <input value="{{ old('iin') }}" type="text" class="form-control" name="iin" id="iin">
                <label for="iin" class="form-label">ИИН</label>
            </div>
        </div>
    
        <div class="col">
            <div class="form-floating mb-3">
                <input value="{{ old('driver_license_number') }}" type="text" class="form-control" name="driver_license_number"
                    id="driver_license_number">
                <label for="driver_license_number" class="form-label">Номер водительского удостоверения</label>
            </div>
        </div>
    
        <div class="col">
            <div class="form-floating mb-3">
                <input value="{{ old('driver_license_date') }}" type="date" class="form-control" name="driver_license_date"
                    id="driver_license_date">
                <label for="driver_license_date" class="form-label">Дата выдачи водительского удостоверения</label>
            </div>
        </div>
    
        <div class="col">
            <div class="form-floating mb-3">
                <input value="{{ old('driver_license_categories') }}" type="text" class="form-control"
                    name="driver_license_categories" id="driver_license_categories">
                <label for="driver_license_categories" class="form-label">Категории водительского удостоверения</label>
            </div>
        </div>
    
        <div class="col">
            <div class="form-floating mb-3">
                <input value="{{ old('password') }}" type="text" class="form-control" name="password" id="password" required>
                <label for="password" class="form-label">Пароль <i style="color: red;">*</i></label>
            </div>
        </div>
    </div>

    <div class="col-auto">
        <button type="submit" class="btn btn-success mb-3">Создать пользователя</button>
    </div>
</form>
@endsection
