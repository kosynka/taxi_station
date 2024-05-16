@extends('main')

@section('content')
    </br><h2>Машины</h2>
    <h3>{{ now()->format('Y-m-d H:i') }}</h3>

    <!-- <a href="{{ route('cars.create') }}" class="btn btn-sm btn-success">
        Добавить новый автомобиль
    </a> -->

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Гос.номер</th>
                    <th scope="col">Марка</th>
                    <th scope="col">Модель</th>
                    <th scope="col">год</th>
                    <th scope="col">пробег</th>
                    <th scope="col">сумма аренды</th>
                    <th scope="col">Статус</th>
                    <th scope="col">Водитель</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->state_number }}</td>
                        <td>{{ $item->brand }}</td>
                        <td>{{ $item->model }}</td>
                        <td>{{ $item->year }}</td>
                        <td>{{ $item->mileage }} км</td>
                        <td>{{ $item->amount }} тг</td>
                        <td>
                            <span class="badge rounded-pill bg-{{ $item->getStatus()[0] }}">{{ $item->getStatus()[1] }}</span>
                        </td>
                        <td>
                            {{ $item->today()?->driver->name }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
