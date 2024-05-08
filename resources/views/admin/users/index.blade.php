@extends('main')

@section('content')
    <table class="table table-hover table-bordered table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Google</th>
                <th scope="col">Apple</th>
                <th scope="col">Firebase</th>
                <th scope="col">Registrated at</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
                <tr>
                    <th scope="row">{{ $item->id }}</th>
                    <th>{{ $item->name }}</th>
                    <th>{{ $item->email }}</th>
                    <th>{{ $item->google_id != null ? 'yes' : 'no' }}</th>
                    <th>{{ $item->apple_id != null ? 'yes' :'no' }}</th>
                    <th>{{ $item->firebase_id != null ? 'yes' : 'no' }}</th>
                    <th>{{ $item->created_at }}</th>
                    <th>
                        <a href="{{ route('users.show', ['id' => $item->id ]) }}" class="btn btn-sm btn-primary">
                            Details
                            <i class="metismenu-icon pe-7s-right-arrow"></i>
                        </a>
                    </th>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
