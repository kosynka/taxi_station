@extends('main')

@section('content')
</br>

<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="user_profile-tab" data-bs-toggle="tab" data-bs-target="#user_profile"
            type="button" role="tab" aria-controls="user_profile" aria-selected="true">Профиль</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="penalty-tab" data-bs-toggle="tab" data-bs-target="#penalty" type="button"
            role="tab" aria-controls="penalty" aria-selected="false">История штрафов и ДТП</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="rent-tab" data-bs-toggle="tab" data-bs-target="#rent" type="button" role="tab"
            aria-controls="rent" aria-selected="false">История аренд</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="oilchange-tab" data-bs-toggle="tab" data-bs-target="#oilchange" type="button" role="tab"
            aria-controls="oilchange" aria-selected="false">История замен масла</button>
    </li>
</ul>

<div class="tab-content" id="myTabContent">
    </br>

    <div class="tab-pane fade show active" id="user_profile" role="tabpanel" aria-labelledby="user_profile-tab">
        <form class="demo-form" method="POST" data-parsley-validate="" class="form-horizontal form-label-left" novalidate=""
            enctype="multipart/form-data" action="{{ route('cars.update', ['id' => $data->id]) }}">
            {{ csrf_field() }}

            <div class="row row-cols-3">
                <div class="col">
                    <div class="form-floating mb-3">
                        <input value="{{ $data->state_number !== null ? $data->state_number : old('state_number') }}" type="text"
                            class="form-control" name="state_number" id="state_number" required>
                        <label for="state_number" class="form-label">Гос.номер машины <i style="color: red;">*</i></label>
                    </div>
                </div>

                <div class="col">
                    <div class="form-floating mb-3">
                        <input value="{{ $data->vin !== null ? $data->vin : old('vin') }}" type="text" class="form-control" name="vin"
                            id="vin" required>
                        <label for="vin" class="form-label">VIN <i style="color: red;">*</i></label>
                    </div>
                </div>

                <div class="col">
                    <div class="form-floating mb-3">
                        <input value="{{ $data->carcass !== null ? $data->carcass : old('carcass') }}" type="text" class="form-control" name="carcass"
                            id="carcass">
                        <label for="carcass" class="form-label">№ кузова</label>
                    </div>
                </div>

                <div class="col">
                    <div class="form-floating mb-3">
                        <input value="{{ $data->brand !== null ? $data->brand : old('brand') }}" type="text" class="form-control"
                            name="brand" id="brand" required>
                        <label for="brand" class="form-label">Марка <i style="color: red;">*</i></label>
                    </div>
                </div>

                <div class="col">
                    <div class="form-floating mb-3">
                        <input value="{{ $data->model !== null ? $data->model : old('model') }}" type="text" class="form-control"
                            name="model" id="model" required>
                        <label for="model" class="form-label">Модель <i style="color: red;">*</i></label>
                    </div>
                </div>

                <div class="col">
                    <div class="form-floating mb-3">
                        <input value="{{ $data->engine_capacity !== null ? $data->engine_capacity : old('engine_capacity') }}" type="text"
                            class="form-control" name="engine_capacity" id="engine_capacity">
                        <label for="engine_capacity" class="form-label">Объём двигателя</label>
                    </div>
                </div>

                <div class="col">
                    <div class="form-floating mb-3">
                        <input value="{{ $data->year !== null ? $data->year : old('year') }}" type="number" class="form-control"
                            name="year" id="year" min="1900">
                        <label for="year" class="form-label">Год</label>
                    </div>
                </div>

                <div class="col">
                    <div class="form-floating mb-3">
                        <input value="{{ $data->color !== null ? $data->color : old('color') }}" type="text" class="form-control" name="color"
                            id="color">
                        <label for="color" class="form-label">Цвет</label>
                    </div>
                </div>

                <div class="col">
                    <div class="form-floating mb-3">
                        <select name="status" class="form-select">
                            @foreach($statuses as $status => $text)
                                <option value="{{ $status }}" @if ($data->status == $status) selected @endif>
                                    {{ $text }}
                                </option>
                            @endforeach
                        </select>
                        <label for="status" class="form-label">Статус</label>
                    </div>
                </div>

                <div class="col">
                    <div class="form-floating mb-3">
                        <input value="{{ $data->mileage !== null ? $data->mileage : old('mileage') }}" type="number"
                            class="form-control" name="mileage" id="mileage" min="0">
                        <label for="mileage" class="form-label">Пробег, км</label>
                    </div>
                </div>

                <div class="col">
                    <div class="form-floating mb-3">
                        <input value="{{ $data->amount !== null ? $data->amount : old('amount') }}" type="text"
                            class="form-control" name="amount" id="amount" required>
                        <label for="amount" class="form-label">Сумма аренды <i style="color: red;">*</i></label>
                    </div>
                </div>
            </div>

            </br>

            <div class="row row-cols-1">
                <div class="vstack gap-3">
                @for($i = 1; $i <= 10; $i++)
                    <div class="col">
                        <div class="form bg-light border mb-3">
                            <label for="amount" class="form-label">Фото {{ $i }}</label>
                            <input type="file" class="form-control" name="photo_{{ $i }}" id="photo_{{ $i }}">

                            @if($data->{'photo_' . $i} != null)
                                <img src="{{ url($data->{'photo_' . $i}) }}" style="max-width: 600px; max-height: 600px;">
                            @endif
                        </div>
                    </div>
                @endfor
                </div>
            </div>

            <div class="col-auto">
                <button type="submit" class="btn btn-primary mb-3">Сохранить</button>
            </div>
        </form>
    </div>

    <div class="tab-pane fade" id="penalty" role="tabpanel" aria-labelledby="penalty-tab">
        </br>

        <input class="form-control" id="penalty-search-input" type="text" placeholder="Поиск">

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col">Дата происшествия</th>
                        <th scope="col">Дата оплаты</th>
                        <th scope="col">Сумма</th>
                        <th scope="col">Статус</th>
                        <th scope="col">Водитель</th>
                    </tr>
                </thead>

                <tbody id="penalty-search-table">
                    @foreach($data->penalties as $penalty)
                        <tr>
                            <td scope="col">{{ $penalty->id }}</td>
                            <td scope="col">
                                <span class="badge rounded-pill bg-{{ $penalty->getType()[0] }}">
                                    {{ $penalty->getType()[1] }}
                                </span>
                            </td>
                            <td scope="col">
                                @if($penalty->protocol_file_path !== null)
                                    <a href="{{ url($penalty->protocol_file_path) }}">
                                        PDF
                                    </a>
                                @else
                                    Файл не прикреплен
                                @endif
                            </td>
                            <td scope="col">
                                {{ $penalty->received->format('Y.m.d') }}
                                ({{ $penalty->received->diffForHumans() }})
                            </td>
                            <td scope="col">
                                {{ $penalty->paid->format('Y.m.d') }}
                                ({{ $penalty->paid->diffForHumans() }})
                            </td>
                            <td scope="col">@convert($penalty->amount)</td>
                            <td scope="col">
                                <span class="badge rounded-pill bg-{{ $penalty->getStatus()[0] }}">
                                    {{ $penalty->getStatus()[1] }}
                                </span>
                            </td>
                            <td scope="col">
                                <a class="link-primary" href="{{ route('users.show', ['id' => $penalty->rent->driver->id]) }}">
                                    {{ $penalty->rent->driver->name }}
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="tab-pane fade" id="rent" role="tabpanel" aria-labelledby="rent-tab">
        </br>

        <input class="form-control" id="rent-search-input" type="text" placeholder="Поиск">

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Дата</th>
                        <!-- <th scope="col">Время конца</th> -->
                        <th scope="col">Сумма</th>
                        <th scope="col">Водитель</th>
                    </tr>
                </thead>

                <tbody id="rent-search-table">
                    @foreach($data->rents as $rent)
                        <tr>
                            <td scope="col">{{ $rent->id }}</td>
                            <td scope="col">
                                {{ $rent->start_at->format('Y.m.d') }}
                                ({{ $rent->start_at->diffForHumans() }})
                            </td>
                            <!-- <td scope="col"> -->
                                <!-- {{ $rent->end_at ? $rent->end_at->format('Y.m.d') : '' }} -->
                                <!-- {{ $rent->end_at ? "(" . $rent->end_at->diffForHumans() . ")" : '' }} -->
                            <!-- </td> -->
                            <td scope="col">@convert($rent->amount)</td>
                            <td scope="col">
                                <a class="link-primary" href="{{ route('users.show', ['id' => $rent->driver->id]) }}">
                                    {{ $rent->driver->name }}
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="tab-pane fade" id="oilchange" role="tabpanel" aria-labelledby="oilchange-tab">
        </br>

        <input class="form-control" id="oilchange-search-input" type="text" placeholder="Поиск">

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Пробег</th>
                        <th scope="col">Дата</th>
                    </tr>
                </thead>

                <tbody id="oilchange-search-table">
                    @foreach($data->oilChanges as $oilChange)
                        <tr>
                            <td scope="col">{{ $oilChange->id }}</td>
                            <td scope="col">{{ $oilChange->mileage }}</td>
                            <td scope="col">
                                {{ $oilChange->changed_at->format('Y.m.d') }}
                                ({{ $oilChange->changed_at->diffForHumans() }})
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
