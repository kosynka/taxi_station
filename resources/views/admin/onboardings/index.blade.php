@extends('main')

@section('content')
    <a href="{{ route('onboarding.create') }}" class="btn btn-sm btn-success">
        New
    </a>

    </br></br>

    <table class="table table-hover table-bordered table-sm fs-6">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Sequence</th>
                <th scope="col">Created at</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
                <tr>
                    <th scope="row">{{ $item->id }}</th>
                    <th>{{ $item->title_en }}</th>
                    <th>{{ $item->description_en }}</th>
                    <th>{{ $item->sequence }}</th>
                    <th>{{ $item->created_at }}</th>
                    <th>
                        <a href="{{ route('onboarding.show', ['id' => $item->id ]) }}" class="btn btn-sm btn-primary">
                            Edit
                            <i class="metismenu-icon pe-7s-right-arrow"></i>
                        </a>
                        <a href="{{ route('onboarding.delete', ['id' => $item->id]) }}" class="btn btn-sm btn-danger" onclick="clicked(event)">
                            Delete
                        </a>
                    </th>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
