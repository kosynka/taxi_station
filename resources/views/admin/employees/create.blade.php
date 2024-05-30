@extends('main')

@section('content')
</br>
<form class="demo-form" method="POST" data-parsley-validate="" class="form-horizontal form-label-left" novalidate=""
    enctype="multipart/form-data" action="{{ route('employees.store') }}">
    {{ csrf_field() }}

    <div class="row row-cols-3">
        <div class="col">
            <div class="form-floating mb-3">
                <select name="role" class="form-select" required>
                    @foreach($roles as $key => $text)
                        <option value="{{ $key }}">{{ $text }}</option>
                    @endforeach
                </select>
                <label for="role" class="form-label">Роль <i style="color: red;">*</i></label>
            </div>
        </div>

        <div class="col">
            <div class="form-floating mb-3">
                <input value="{{ old('name') }}" type="text" class="form-control" name="name" id="name" required>
                <label for="name" class="form-label">ФИО <i style="color: red;">*</i></label>
            </div>
        </div>

        <div class="col">
            <div class="form-floating mb-3">
                <input value="{{ old('email') }}" type="email" class="form-control" name="email" id="email">
                <label for="email" class="form-label">Почта (формат primer.employee@mail.ru)</label>
            </div>
        </div>

        <div class="col">
            <div class="form-floating mb-3">
                <input value="{{ old('password') }}" type="text" class="form-control" name="password" id="password" required>
                <label for="password" class="form-label">Пароль <i style="color: red;">*</i></label>
            </div>
        </div>
    </div>

    <div class="row row-cols-3">
        @foreach($permissions as $key => $value)
            <div class="col">
                <input class="form-check-input" type="checkbox" value="1" name="permissions[{{ $key }}]">
                <label class="form-check-label" for="defaultCheck1">
                    {{ $value }}
                </label>
            </div>
        @endforeach
    </div>

    </br>

    <div class="col-auto">
        <button type="submit" class="btn btn-success mb-3">Создать работника</button>
    </div>
</form>
@endsection
