@extends('main')

@section('content')
    </br><h2>
        Замена масла

        <a class="link-success" href="{{ route('oilchanges.create') }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-circle"
                aria-hidden="true">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="12" y1="8" x2="12" y2="16"></line>
                <line x1="8" y1="12" x2="16" y2="12"></line>
            </svg>
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
                    <th scope="col">Последняя замена</th>
                    <th scope="col">История замен</th>
                </tr>
            </thead>
            <tbody id="myTable">
                @foreach($data as $item)
                    <tr>
                        <td>
                            <a class="link-primary" href="{{ route('oilchanges.show', ['id' => $item->id]) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity">
                                    <path d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34"></path>
                                    <polygon points="18 2 22 6 12 16 8 16 8 12 18 2"></polygon>
                                </svg>
                            </a>
                        </td>
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
