@extends('main')

@section('content')
    <form class="demo-form" method="POST" data-parsley-validate="" class="form-horizontal form-label-left" novalidate=""
        enctype="multipart/form-data" action="{{ route('music.store') }}">
        {{ csrf_field() }}

        <div class="mb-3">
            <label for="title" class="form-label">Title<i style="color: red;">*</i></label>
            <input type="text" class="form-control" name="title" id="title" placeholder="example title" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description<i style="color: red;">*</i></label>
            <textarea class="form-control" name="description" id="description" rows="3" required>example description</textarea>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Cover (image)</label>
            <input type="file" class="form-control" name="image" id="image">
        </div>

        <div class="mb-3">
            <label for="file" class="form-label">Music (file)</label>
            <input type="file" class="form-control" name="file" id="file">
        </div>

        <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-3">Save</button>
        </div>
    </form>
@endsection
