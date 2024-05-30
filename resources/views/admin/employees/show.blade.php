@extends('main')

@section('content')
</br>
<form class="demo-form" method="POST" data-parsley-validate="" class="form-horizontal form-label-left" novalidate=""
    enctype="multipart/form-data" action="{{ route('employees.update', ['id' => $data->id]) }}">
    {{ csrf_field() }}

    <div class="row row-cols-3">
        <div class="col">
            <div class="form-floating mb-3">
                <input value="{{ $data->name !== null ? $data->name : old('name') }}" type="text" class="form-control" name="name" id="name" required>
                <label for="name" class="form-label">ФИО <i style="color: red;">*</i></label>
            </div>
        </div>

        <div class="col">
            <div class="form-floating mb-3">
                <input value="{{ $data->email !== null ? $data->email : old('email') }}" type="email" class="form-control" name="email" id="email">
                <label for="email" class="form-label">Почта (формат primer.employee@mail.ru)</label>
            </div>
        </div>

        <div class="col">
            <div class="form-floating mb-3">
                <input value="{{ old('password') }}" type="text" class="form-control" name="password" id="password"
                    required>
                <label for="password" class="form-label">Пароль <i style="color: red;">*</i></label>
            </div>
        </div>
    </div>

    @if($data->roleIs('manager'))
        <label class="mb-1 mt-3">
            <b>Доступы:</b>
        </label>

        <div class="row row-cols-3 mb-3">
            @foreach($permissions as $key => $value)
                <div class="col">
                    <input class="form-check-input" type="checkbox" name="permissions[{{ $key }}]" {{ $data->permissions[$key] === true ?
                    'checked' : '' }}>
                    <label class="form-check-label" for="defaultCheck1">
                        {{ $value }}
                    </label>
                </div>
            @endforeach
        </div>
    @else
        Есть все права
    @endif

    <div class="col-auto">
        <button type="submit" class="btn btn-success mb-3">Создать работника</button>
    </div>
</form>
@endsection
