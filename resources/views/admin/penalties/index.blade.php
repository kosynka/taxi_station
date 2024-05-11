@extends('main')

@section('content')
    </br><h2>Штрафы</h2>

    <!-- <a href="{{ route('cars.create') }}" class="btn btn-sm btn-success">
        Добавить новый штраф
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
                    <th scope="col">Последняя замена</th>
                    <th scope="col">История замен</th>
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
                        <td>
                            @php
                                $lastOilChange = $item->lastOilChange();
                            @endphp

                            @if (isset($lastOilChange))
                                <h6>
                                    <span class="badge bg-{{ $item->getLastOilChangeStatus()}}">
                                        {{ $lastOilChange->changed_at->diffForHumans() }}
                                    </span>
                                    на {{ $lastOilChange->mileage }}км
                                </h6>
                            @endif
                        </td>
                        <td>
                            @foreach($item->oilChanges as $oilChange)
                                {{ $oilChange->changed_at->format('Y.m.d') }} на {{ $oilChange->mileage }}км
                                </br>
                            @endforeach
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
