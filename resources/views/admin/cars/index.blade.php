@extends('main')

@section('content')
    </br><h2>
        Машины
        <a class="link-success" href="{{ route('cars.create') }}">
            @include('icons.plus')
        </a>
    </h2>

    <input class="form-control" id="myInput" type="text" placeholder="Поиск">

    <div class="table-responsive">
        <table class="table table-striped">
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
                </tr>
            </thead>
            <tbody id="myTable">
                @foreach($data as $item)
                    <tr>
                        <td>
                            <a class="link-primary" href="{{ route('cars.show', ['id' => $item->id]) }}">
                                @include('icons.pen')
                            </a>
                        </td>
                        <td>{{ $item->state_number }}</td>
                        <td>{{ $item->brand }}</td>
                        <td>{{ $item->model }}</td>
                        <td>{{ $item->year }}</td>
                        <td>{{ $item->mileage }} км</td>
                        <td>@convert($item->amount)</td>
                        <td>
                            <span class="badge rounded-pill bg-{{ $item->getStatus()[0] }}">{{ $item->getStatus()[1] }}</span>
                        </td>
                        <td>
                            {{ $item->todayRent()?->driver->name }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
