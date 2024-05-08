@extends('main')

@section('content')
    <form class="demo-form" method="POST" data-parsley-validate="" class="form-horizontal form-label-left" novalidate=""
        enctype="multipart/form-data" action="{{ route('onboarding.update', ['id' => $data->id]) }}">
        {{ csrf_field() }}

        <div class="mb-3">
            @if($data->image != null)
                <img src="{{ url($data->image) }}" style="max-width: 500px; max-height: 500px;">
            @endif
            </br>
            <label for="title_en" class="form-label">Image</label>
            <input type="file" class="form-control" name="image" id="image">
        </div>

        <div class="mb-3">
            <label for="title_en" class="form-label">Title (english) <i style="color: red;">*</i></label>
            <input type="text" class="form-control" name="title_en" id="title_en" value="{{ $data->title_en }}">
        </div>

        <div class="mb-3">
            <label for="title_es" class="form-label">Title (spanish)</label>
            <input type="text" class="form-control" name="title_es" id="title_es" value="{{ $data->title_es }}">
        </div>

        <div class="mb-3">
            <label for="title_pt" class="form-label">Title (portuguese)</label>
            <input type="text" class="form-control" name="title_pt" id="title_pt" value="{{ $data->title_pt }}">
        </div>

        <div class="mb-3">
            <label for="description_en" class="form-label">Description (english) <i style="color: red;">*</i></label>
            <textarea class="form-control" name="description_en" id="description_en" rows="3">{{ $data->description_en }}</textarea>
        </div>

        <div class="mb-3">
            <label for="description_es" class="form-label">Description (spanish)</label>
            <textarea class="form-control" name="description_es" id="description_es" rows="3">{{ $data->description_es }}</textarea>
        </div>

        <div class="mb-3">
            <label for="description_pt" class="form-label">Description (portuguese)</label>
            <textarea class="form-control" name="description_pt" id="description_pt" rows="3">{{ $data->description_pt }}</textarea>
        </div>

        <div class="mb-3">
            <label for="sequence" class="form-label">Sequence <i style="color: red;">*</i></label>
            <input type="number" min="1" step="1" class="form-control" name="sequence" id="sequence" value="{{ $data->sequence }}">
        </div>

        <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-3">Save</button>
        </div>
    </form>
@endsection
