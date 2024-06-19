@extends('main')

@section('content')
    </br><h2>
        Машины
        <a class="link-success" href="{{ route('cars.create') }}">
            @include('icons.plus')
        </a>
    </h2>

    <a class="btn btn-primary mb-3" href="#" onclick="download_table_as_csv('cars_table', ',', 'Машины');">
        Выгрузить таблицу
    </a>

    <input class="form-control" id="myInput" type="text" placeholder="Поиск">

    <div class="table-responsive">
        <table class="table table-sm table-bordered table-hover border border-dark" id="cars_table">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Гос.номер</th>
                    <th scope="col">Марка</th>
                    <th scope="col">Модель</th>
                    <th scope="col">год</th>
                    <th scope="col">пробег</th>
                    <th scope="col">стоимость аренды</th>
                    <th scope="col">Статус</th>
                    <th scope="col">Водитель</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody id="myTable">
                @foreach($data as $item)
                    <tr>
                        <td>
                            @include('icons.pen', ['name' => 'cars', 'id' => $item->id])
                        </td>
                        <td>{{ $item->state_number }}</td>
                        <td>{{ $item->brand }}</td>
                        <td>{{ $item->model }}</td>
                        <td>{{ $item->year }}</td>
                        <td>{{ $item->mileage }} км</td>
                        <td>@convert($item->amount)</td>
                        <td>
                            @include('admin.rents.status-modal', [
                                'car' => $item,
                                'rents' => $item->todayRent(),
                            ])
                        </td>
                        <td>
                            @if($item->todayRent()->isNotEmpty())
                                @foreach($item->todayRent() as $rent)
                                    <a class="link-primary" href="{{ route('users.show', ['id' => $item->id]) }}">
                                        {{ $rent->driver?->name }}
                                        {{ $rent->driver?->phone }}
                                    </a>
                                    </br>
                                @endforeach
                            @endif
                        </td>
                        <td>
                            @include('icons.trash', ['name' => 'cars', 'id' => $item->id])
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
