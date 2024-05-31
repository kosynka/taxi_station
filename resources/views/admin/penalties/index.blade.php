@extends('main')

@section('content')
</br>
<h2>
    Штрафы
    <a class="link-success" href="{{ route('penalties.create') }}">
        @include('icons.plus')
    </a>
</h2>
</br>

<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
    <div class="row row-cols-3">
        <div class="col">
            <div class="mb-3">
                <label for="per_page" class="form-label">Показать количество</label>
                <input type="number" class="form-control" name="per_page" id="per_page" min="10"
                    value="@if(request()->per_page){{ request()->per_page }}@endif">
            </div>
        </div>

        <div class="col">
            <div class="mb-3">
                <label for="date_from" class="form-label">Дата время происшествия от</label>
                <input type="datetime-local" class="form-control" name="date_from" id="date_from"
                    value="@if(request()->date_from){{ request()->date_from }}@endif">
            </div>
        </div>

        <div class="col">
            <div class="mb-3">
                <label for="date_to" class="form-label">Дата время происшествия до</label>
                <input type="datetime-local" class="form-control" name="date_to" id="date_to"
                    value="@if(request()->date_to){{ request()->date_to }}@endif">
            </div>
        </div>

        <div class="col">
            <div class="mb-3">
                <label for="type" class="form-label">Тип</label>
                <select name="type" class="form-select">
                    <option></option>
                    @foreach($types as $type => $text)
                        <option value="{{ $type }}" @if (request()->type === $type) selected @endif>
                            {{ $text }}
                        </option>
                    @endforeach
                </select>
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
        <button type="submit" class="btn btn-primary m-3">Фильтрация</button>

        <a class="btn btn-primary m-3" href="#" onclick="download_table_as_csv('penalties_table', ',', 'Штрафы');">
            Выгрузить таблицу
        </a>
    </div>
</form>

<div class="table-responsive">
    <table class="table table-striped" id="penalties_table">
        <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col">Тип</th>
                <th scope="col">Протокол</th>
                <th scope="col">Дата происшествия</th>
                <th scope="col">Дата оплаты</th>
                <th scope="col">Сумма</th>
                <th scope="col">Статус</th>
                <th scope="col">Коммент</th>
                <th scope="col">Машина</th>
                <th scope="col">Водитель</th>
                <th scope="col"></th>
            </tr>
        </thead>

        <tbody>
            @foreach($data as $item)
                <tr>
                    <td scope="col">
                        @include('icons.pen', ['name' => 'penalties', 'id' => $item->id])
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
                        {{ $item->received->format('d.m.Y H:i:s') }}
                    </td>
                    <td scope="col">
                        @if($item->paid)
                            {{ $item->paid->format('d.m.Y H:i:s') }}
                        @endif
                    </td>
                    <td scope="col">@convert($item->amount)</td>
                    <td scope="col">
                        <span class="badge rounded-pill bg-{{ $item->getStatus()[0] }}">
                            {{ $item->getStatus()[1] }}
                        </span>
                    </td>
                    <td scope="col">
                        @include('admin.parts.comment', ['item' => $item])
                    </td>
                    <td scope="col">
                        <a class="link-primary" href="{{ route('cars.show', ['id' => $item->rent->car_id]) }}">
                            {{ $item->rent->car->shortDescription() }}
                        </a>
                    </td>
                    <td scope="col">
                        <a class="link-primary" href="{{ route('users.show', ['id' => $item->rent->driver_id]) }}">
                            {{ $item->rent->driver->name }}
                        </a>
                    </td>
                    <td>
                        @include('icons.trash', ['name' => 'oilchanges', 'id' => $item->id])
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $data->withQueryString()->links('pagination::bootstrap-5') }}
</div>
@endsection
