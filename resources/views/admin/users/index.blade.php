@extends('main')

@section('content')
    </br><h2>
        Водители
        <a class="link-success" href="{{ route('users.create') }}">
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
                    <th scope="col">ИИН</th>
                    <th scope="col">Баланс</th>
                </tr>
            </thead>
            <tbody id="myTable">
                @foreach($data as $item)
                    <tr>
                        <td>
                            <a class="link-primary" href="{{ route('users.show', ['id' => $item->id]) }}">
                                @include('icons.pen')
                            </a>
                        </td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->iin }}</td>
                        <td>@convert($item->balance)</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
