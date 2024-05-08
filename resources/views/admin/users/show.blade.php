@extends('main')

@section('content')
    <div class="mb-3">
        <label for="name" class="form-label"># {{ $data->id }}</label>
    </div>

    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" name="name" id="name" value="{{ $data->name }}" readonly>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="text" class="form-control" name="email" id="email" value="{{ $data->email }}" readonly>
    </div>

    @include('admin.users.progress', ['data' => $data->portals])

    @include('admin.users.purchases', ['data' => $data->purchases])

    @include('admin.users.achievements', ['data' => $data->achievements])

    @include('admin.users.collections', ['data' => $data->collections])
@endsection
