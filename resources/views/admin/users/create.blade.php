@extends('main')

@section('content')
    </br>
    <form class="demo-form" method="POST" data-parsley-validate="" class="form-horizontal form-label-left" novalidate=""
        enctype="multipart/form-data" action="{{ route('users.store') }}">
        {{ csrf_field() }}

        <div class="mb-3">
            <label for="name" class="form-label">Имя <i style="color: red;">*</i></label>
            <input type="text" class="form-control" name="name" id="name" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Почта (формат primer.taxidriver@mail.ru)</label>
            <input type="email" class="form-control" name="email" id="email">
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Телефон (формат 87001112233)</label>
            <input type="text" class="form-control" name="phone" id="phone">
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Пароль <i style="color: red;">*</i></label>
            <input type="text" class="form-control" name="password" id="password" required>
        </div>

        <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-3">Сохранить</button>
        </div>
    </form>
@endsection
