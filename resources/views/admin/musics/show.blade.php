@extends('main')

@section('content')
    <form class="demo-form" method="POST" data-parsley-validate="" class="form-horizontal form-label-left" novalidate=""
        enctype="multipart/form-data" action="{{ route('music.update', ['id' => $data->id]) }}">
        {{ csrf_field() }}

        <div class="mb-3">
            @if($data->image != null)
                <img src="{{ url($data->image) }}" style="max-width: 500px; max-height: 500px;">
            @endif
            </br>
            <label for="image" class="form-label">Cover (image)</label>
            <input type="file" class="form-control" name="image" id="image">
        </div>

        <div class="mb-3">
            <label for="title" class="form-label">Title<i style="color: red;">*</i></label>
            <input type="text" class="form-control" name="title" id="title" value="{{ $data->title }}">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description<i style="color: red;">*</i></label>
            <textarea class="form-control" name="description" id="description" rows="3">{{ $data->description }}</textarea>
        </div>

        <div class="mb-3">
            @if($data->file != null)
                <figure>
                    <audio controls src="{{ url($data->file) }}"></audio>
                </figure>
            @endif
            </br>
            <label for="file" class="form-label">Music (file)</label>
            <input type="file" class="form-control" name="file" id="file">
        </div>

        <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-3">Save</button>
        </div>
    </form>
@endsection
