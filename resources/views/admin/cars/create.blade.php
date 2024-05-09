@extends('main')

@section('content')
    <form class="demo-form" method="POST" data-parsley-validate="" class="form-horizontal form-label-left" novalidate=""
        enctype="multipart/form-data" action="{{ route('playlist.store') }}">
        {{ csrf_field() }}

        <div class="mb-3">
            <label for="title_en" class="form-label">Title (english) <i style="color: red;">*</i></label>
            <input type="text" class="form-control" name="title_en" id="title_en" placeholder="example title" required>
        </div>

        <div class="mb-3">
            <label for="title_es" class="form-label">Title (spanish)</label>
            <input type="text" class="form-control" name="title_es" id="title_es" placeholder="example title">
        </div>

        <div class="mb-3">
            <label for="title_pt" class="form-label">Title (portuguese)</label>
            <input type="text" class="form-control" name="title_pt" id="title_pt" placeholder="example title">
        </div>

        <div class="mb-3">
            <label for="description_en" class="form-label">Description (english) <i style="color: red;">*</i></label>
            <textarea class="form-control" name="description_en" id="description_en" rows="3" required>example description</textarea>
        </div>

        <div class="mb-3">
            <label for="description_es" class="form-label">Description (spanish)</label>
            <textarea class="form-control" name="description_es" id="description_es" rows="3">example description</textarea>
        </div>

        <div class="mb-3">
            <label for="description_pt" class="form-label">Description (portuguese)</label>
            <textarea class="form-control" name="description_pt" id="description_pt" rows="3">example description</textarea>
        </div>

        <div class="mb-3">
            Is donation required? <input type="checkbox" class="m-1 form-check-input" name="donation_required"
                id="donation_required" value="1">
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control" name="image" id="image">
        </div>

        <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-3">Save</button>
        </div>
    </form>
@endsection
