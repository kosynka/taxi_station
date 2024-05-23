@extends('main')

@section('content')
</br>
    <h2>
        Штрафы
        <a class="link-success" href="{{ route('penalties.create') }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-circle"
                aria-hidden="true">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="12" y1="8" x2="12" y2="16"></line>
                <line x1="8" y1="12" x2="16" y2="12"></line>
            </svg>
        </a>
    </h2>
</br>

<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
    <div class="row row-cols-3">
        <div class="col">
            <div class="mb-3">
                <label for="date_from" class="form-label">Дата от</label>
                <input type="date" class="form-control" name="date_from" id="date_from"
                    value="@if(request()->date_from){{ request()->date_from }}@endif">
            </div>
        </div>

        <div class="col">
            <div class="mb-3">
                <label for="date_to" class="form-label">Дата до</label>
                <input type="date" class="form-control" name="date_to" id="date_to"
                    value="@if(request()->date_to){{ request()->date_to }}@endif">
            </div>
        </div>

        <div class="col">
            <div class="mb-3">
                <label for="status" class="form-label">Статус</label>
                <select name="status" class="form-select">
                    <option></option>
                    @foreach($statuses as $status => $text)
                        <option value="{{ $status }}" @if (request()->status === $status) selected @endif>
                            {{ $text }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center">
        <button type="submit" class="btn btn-primary mb-3">Фильтрация</button>
    </div>
</form>

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col">Тип</th>
                <th scope="col">Протокол</th>
                <th scope="col">Дата происшествия</th>
                <th scope="col">Дата оплаты</th>
                <th scope="col">Сумма</th>
                <th scope="col">Статус</th>
                <th scope="col">Машина</th>
                <th scope="col">Водитель</th>
            </tr>
        </thead>

        <tbody>
            @foreach($data as $item)
                <tr>
                    <td scope="col">
                        <a class="link-primary" href="{{ route('penalties.show', ['id' => $item->id]) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity">
                                <path d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34"></path>
                                <polygon points="18 2 22 6 12 16 8 16 8 12 18 2"></polygon>
                            </svg>
                        </a>
                    </td>
                    <td scope="col">
                        <span class="badge rounded-pill bg-{{ $item->getType()[0] }}">
                            {{ $item->getType()[1] }}
                        </span>
                    </td>
                    <td scope="col">
                        @if($item->protocol_file_path !== null)
                            <a target="_blank" href="{{ url($item->protocol_file_path) }}">
                                посмотреть
                            </a>
                        @else
                            не прикреплен
                        @endif
                    </td>
                    <td scope="col">
                        {{ $item->received_date->format('Y.m.d') }}
                        ({{ $item->received_date->diffForHumans() }})
                    </td>
                    <td scope="col">
                        @if($item->paid_date)
                            {{ $item->paid_date->format('Y.m.d') }}
                            ({{ $item->paid_date->diffForHumans() }})
                        @endif
                    </td>
                    <td scope="col">@convert($item->amount)</td>
                    <td scope="col">
                        <span class="badge rounded-pill bg-{{ $item->getStatus()[0] }}">
                            {{ $item->getStatus()[1] }}
                        </span>
                    </td>
                    <td scope="col">
                        <a class="link-primary" href="{{ route('cars.show', ['id' => $item->rent->car_id]) }}">
                            {{ $item->rent->car->brand }}
                            {{ $item->rent->car->model }}
                            {{ $item->rent->car->state_number }}
                        </a>
                    </td>
                    <td scope="col">
                        <a class="link-primary" href="{{ route('users.show', ['id' => $item->rent->driver_id]) }}">
                            {{ $item->rent->driver->name }}
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $data->withQueryString()->links('pagination::bootstrap-5') }}
</div>
@endsection
