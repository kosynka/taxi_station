@extends('main')

@section('content')
    <form class="demo-form" method="POST" data-parsley-validate="" class="form-horizontal form-label-left" novalidate=""
        enctype="multipart/form-data" action="{{ route('playlist.update', ['id' => $data->id]) }}">
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
            <textarea class="form-control" name="description_en" id="description_en"
                rows="3">{{ $data->description_en }}</textarea>
        </div>

        <div class="mb-3">
            <label for="description_es" class="form-label">Description (spanish)</label>
            <textarea class="form-control" name="description_es" id="description_es"
                rows="3">{{ $data->description_es }}</textarea>
        </div>

        <div class="mb-3">
            <label for="description_pt" class="form-label">Description (portuguese)</label>
            <textarea class="form-control" name="description_pt" id="description_pt"
                rows="3">{{ $data->description_pt }}</textarea>
        </div>

        <div class="mb-3">
            Is donation required? <input type="checkbox" class="m-1 form-check-input" name="donation_required"
                id="donation_required" value="1" {{ $data->donation_required == false ? '' : 'checked' }}>
        </div>

        <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-3">Save</button>
        </div>
    </form>

    <form class="demo-form" method="POST" data-parsley-validate="" class="form-horizontal form-label-left" novalidate=""
        enctype="multipart/form-data" action="{{ route('playlist.reorder', ['id' => $data->id]) }}">
        {{ csrf_field() }}

        <div class="main-card mb-3 card">
            <div class="card-header">Musics</div>
            <div class="table-responsive">
                <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Sequence</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data->playlistMusics as $item)
                            <tr>
                                <th scope="row">{{ $item->music_id }}</th>
                                <th>
                                    <a href="{{ route('music.show', ['id' => $item->music_id ]) }}">
                                        {{ $item->music->title }}
                                    </a>
                                </th>
                                <th>
                                    <input type="number" min="1" step="1" class="form-control" name="sequences[{{ $item->music_id }}]"
                                        value="{{ $item->sequence }}">
                                </th>
                                <th>
                                    <a href="{{ route('playlist.delete.music', ['id' => $data->id, 'music_id' => $item->music_id]) }}" class="btn btn-sm btn-danger" onclick="clicked(event)">
                                        delete
                                    </a>
                                </th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-3">Reorder sequences</button>
        </div>
    </form>

    <form class="demo-form" method="POST" data-parsley-validate="" class="form-horizontal form-label-left" novalidate=""
        enctype="multipart/form-data" action="{{ route('playlist.add.music', ['id' => $data->id]) }}">
        {{ csrf_field() }}

        <div class="mb-3">
            <datalist id="suggestions">
                @foreach($musics as $music)
                    <option value="{{ $music->id }}">{{ $music->title }}</option>
                @endforeach
            </datalist>
            <input autoComplete="on" list="suggestions" type="text" name="music_id" id="music_id">
        </div>

        <div class="col-auto">
            <button type="submit" class="btn btn-success mb-3">Add</button>
        </div>
    </form>
@endsection
