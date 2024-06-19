@extends('main')

@section('content')
    </br><h2>
        Замена масла

        <a class="link-success" href="{{ route('oilchanges.create') }}">
            @include('icons.plus')
        </a>
    </h2>

    <a class="btn btn-primary mb-3" href="#" onclick="download_table_as_csv('oilchanges_table', ',', 'Замена масла');">
        Выгрузить таблицу
    </a>

    <input class="form-control" id="myInput" type="text" placeholder="Поиск">

    <div class="table-responsive">
        <table class="table table-sm table-bordered table-hover border border-dark" id="oilchanges_table">
            <thead>
                <tr>
                    <th scope="col">Гос.номер</th>
                    <th scope="col">Марка</th>
                    <th scope="col">Модель</th>
                    <th scope="col">год</th>
                    <th scope="col">пробег</th>
                    <th scope="col">Последняя замена</th>
                    <th scope="col">Следующая замена</th>
                    <th scope="col">История замен</th>
                </tr>
            </thead>
            <tbody id="myTable">
                @foreach($data as $item)
                    @php
                        $rowColor = $item->mileage - $item->getLastOilChangeMileage() >= 9000 ? 'bg-warning' : '';
                        $lastOilChange = $item->lastOilChange();
                        $nextOilChange = $item->mileage - $item->getLastOilChangeMileage();

                        if ($nextOilChange < 0) {
                            $nextOilChange = 'просрочена на ' . abs($nextOilChange + 10000) . 'км';
                            $rowColor = 'bg-danger';
                        } else {
                            $nextOilChange = 'через ' . (10000 - $nextOilChange) . 'км';
                        }
                    @endphp
                    <tr>
                        <td>
                            <a class="link-primary" href="{{ route('cars.show', ['id' => $item->id]) }}">
                                {{ $item->state_number }}
                            </a>
                        </td>
                        <td>{{ $item->brand }}</td>
                        <td>{{ $item->model }}</td>
                        <td>{{ $item->year }}</td>
                        <td>{{ $item->mileage }} км</td>
                        <td>
                            @if (isset($lastOilChange))
                                <h6>
                                    <span class="badge bg-{{ $item->getLastOilChangeStatus()}}">
                                        {{ $lastOilChange->changed_at->diffForHumans() }}
                                    </span>
                                    на {{ $lastOilChange->mileage }}км
                                </h6>
                            @endif
                        </td>
                        <td class="{{ $rowColor }}">
                            @if ($nextOilChange < 0)
                                <span class="badge bg-danger">
                                    {{ $nextOilChange }}
                                </span>
                            @else
                                {{ $nextOilChange }}
                            @endif
                        </td>
                        <td>
                            @foreach($item->oilChanges as $oilChange)
                                </br>
                                @include('icons.pen', ['name' => 'oilchanges', 'id' => $item->id])

                                {{ $oilChange->changed_at->format('d.m.Y H:i:s') }} на {{ $oilChange->mileage }}км

                                @include('icons.trash', ['name' => 'oilchanges', 'id' => $item->id])
                                </br>
                            @endforeach
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
