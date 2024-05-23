@extends('main')

@section('content')
    </br><h2>
        Работники
        <a class="link-success" href="{{ route('employees.create') }}">
            @include('icons.plus')
        </a>
    </h2>

    <input class="form-control" id="myInput" type="text" placeholder="Поиск">

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">ФИО</th>
                    <th scope="col">Почта</th>
                </tr>
            </thead>
            <tbody id="myTable">
                @foreach($data as $item)
                    <tr>
                        <td>
                            <a class="link-primary" href="{{ route('employees.show', ['id' => $item->id]) }}">
                                @include('icons.pen')
                            </a>
                        </td>
                        <td>
                            {{ $item->name }}
                            ({{ $item->role }})
                        </td>
                        <td>{{ $item->email }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
