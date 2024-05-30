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
                    <th scope="col"></th>
                    <th scope="col">ФИО</th>
                    <th scope="col">Почта</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody id="myTable">
                @foreach($data as $item)
                    <tr>
                        <td>
                            @include('icons.pen', ['name' => 'employees', 'id' => $item->id])
                        </td>
                        <td>{{ $item->getRole() }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>
                            @include('icons.trash', ['name' => 'employees', 'id' => $item->id])
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
