@extends('main')

@section('content')
    </br><h2>
        Права доступа
    </h2></br>

    <form class="demo-form" method="POST" data-parsley-validate="" class="form-horizontal form-label-left" novalidate=""
        enctype="multipart/form-data" action="{{ route('employees.permissions.update') }}">
        {{ csrf_field() }}

        @foreach($data as $item)
            <div class="form-check">
                <input class="form-check-input" name="all[{{ $item->name }}]" type="checkbox" value="1" id="defaultCheck"
                    {{ $item->is_active ? 'checked' : '' }}>
                <label class="form-check-label" for="defaultCheck">
                    {{ $item->title }}
                </label>
            </div>
        @endforeach

        </br>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-3">Сохранить</button>
        </div>
    </form>
@endsection
