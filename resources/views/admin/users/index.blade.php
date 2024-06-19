@extends('main')

@section('content')
    </br><h2>
        Водители
        <a class="link-success" href="{{ route('users.create') }}">
            @include('icons.plus')
        </a>
    </h2>

    <a class="btn btn-primary mb-3" href="#" onclick="download_table_as_csv('drivers_table', ',', 'Водители');">
        Выгрузить таблицу
    </a>

    <input class="form-control" id="myInput" type="text" placeholder="Поиск">

    <div class="table-responsive">
        <table class="table table-sm table-bordered table-hover border border-dark" id="drivers_table">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">ФИО</th>
                    @if (auth()->user()->roleIs('admin'))
                        <th scope="col">Телефон</th>
                    @endif
                    <th scope="col">ИИН</th>
                    <th scope="col">Баланс</th>
                    @if (auth()->user()->roleIs('admin'))
                        <th scope="col">Долг</th>
                    @endif
                    <th scope="col"></th>
                </tr>
            </thead>

            <tbody id="myTable">
                @foreach($data as $item)
                    <tr>
                        <td>
                            @include('icons.pen', ['name' => 'users', 'id' => $item->id])
                        </td>
                        <td>{{ $item->name }}</td>
                        @if (auth()->user()->roleIs('admin'))
                            <td>{{ $item->phone }}</td>
                        @endif
                        <td>{{ $item->iin }}</td>
                        <td>@convert($item->balance)</td>
                        @if (auth()->user()->roleIs('admin'))
                            <td>@convert($item->debts_sum_amount)</td>
                        @endif
                        <td>
                            @include('icons.trash', ['name' => 'users', 'id' => $item->id])
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
