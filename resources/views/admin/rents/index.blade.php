@extends('main')

@section('content')
</br>
<h2>Аренда</h2>

<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="today-tab" data-bs-toggle="tab" data-bs-target="#today"
            type="button" role="tab" aria-controls="today" aria-selected="true">Сегодня ({{ now()->format('d.m.Y') }})</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="history-tab" data-bs-toggle="tab" data-bs-target="#history" type="button"
            role="tab" aria-controls="history" aria-selected="false">
            История ({{ $dates[0] }}{{ last($dates) != $dates[0] ? ' - ' . last($dates) : '' }})
        </button>
    </li>
</ul>

<!-- TODAY -->
<div class="tab-content" id="myTabContent">
    </br>
    <!-- TODAY STATS -->
    <div class="tab-pane fade show active" id="today" role="tabpanel" aria-labelledby="today-tab">
        <b>Количество машин на аренде:</b> {{ $todayCarsCount }} / {{ count($today) }}
        </br>
        <b>Сумма машин на аренде:</b> @convert($todayAmount) / @convert($today->sum('amount'))
        </br></br>

        <input class="form-control" id="myInput" type="text" placeholder="Поиск">

        <!-- TODAY TABLE -->
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Гос.номер</th>
                        <th scope="col">Марка</th>
                        <th scope="col">Модель</th>
                        <th scope="col">Пробег</th>
                        <th scope="col">Стоимость аренды</th>
                        <th scope="col">Статус</th>
                        <th scope="col">Коммент</th>
                        <th scope="col">Водитель</th>
                    </tr>
                </thead>

                <tbody id="myTable">
                    @foreach($today as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->state_number }}</td>
                            <td>{{ $item->brand }}</td>
                            <td>{{ $item->model }}</td>
                            <td>{{ $item->mileage }} км</td>
                            <td>@convert($item->amount)</td>
                            <td>
                                @include('admin.rents.status', [
                                    'car' => $item,
                                    'rent' => $item->todayRent(),
                                ])
                            </td>
                            <td>
                                @if($item->getLastComment())
                                    <small>
                                        @php
                                            $commentUser = \App\Models\User::find($item->getLastComment()['user_id']);
                                        @endphp
                                        <blockquote class="blockquote">
                                            <p class="mb-3">{{ $item->getLastComment()['text'] }}</p>
                                            <small>
                                                <footer class="blockquote-footer">
                                                    {{ $item->getLastComment()['created_at'] }}
                                                    <cite>{{ $commentUser->name }}({{ $commentUser->role }})</cite>
                                                </footer>
                                            </small>
                                        </blockquote>
                                    </small>
                                @endif
                            </td>
                            <td>
                                @if($item->todayRent() !== null)
                                    @include('admin.rents.update-modal', [
                                        'car' => $item,
                                        'drivers' => $drivers,
                                        'rent' => $item->todayRent(),
                                    ])
                                @else
                                    @include('admin.rents.create-modal', [
                                        'car' => $item,
                                        'drivers' => $drivers,
                                    ])
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- HISTORY -->
    <div class="tab-pane fade" id="history" role="tabpanel" aria-labelledby="history-tab">
        <!-- HISTORY FILTER -->
        <!-- <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
            <div class="row row-cols-3">
                <div class="col-2">
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" name="date_from" id="date_from"
                            value="@if(request()->date_from){{ request()->date_from }}@endif">
                        <label for="date_from" class="form-label">Дата от</label>
                    </div>
                </div>

                <div class="col-2">
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" name="date_to" id="date_to"
                            value="@if(request()->date_to){{ request()->date_to }}@endif">
                        <label for="date_to" class="form-label">Дата до</label>
                    </div>
                </div>

                <div class="col-2">
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary form-control">Фильтрация</button>
                    </div>
                </div>
            </div>
        </form> -->

        <input class="form-control mb-2" id="history-search-input" type="text" placeholder="Поиск">

        <!-- HISTORY TABLE -->
        <div style="width: 100%; overflow-x: auto;">
            <div class="table-responsive" style="overflow: auto; overflow-x: scroll;">
                <table class="table table-lg table-bordered mb-4">
                    <thead>
                        <tr>
                            <th>Сумма</th>
                        
                            <th scope="col"></th>
                            <th scope="col"></th>

                            @foreach($dates as $date)
                            <th>@convert($amountByDays[$date])</th>
                            @endforeach
                        </tr>
                        <tr>
                            <th scope="col">Гос.номер</th>
                            <th scope="col">Марка</th>
                            <th scope="col">Модель</th>

                            @foreach($dates as $date)
                                <th>{{ $date }}</th>
                            @endforeach
                        </tr>
                    </thead>

                    <tbody id="history-search-table">
                        @foreach($historyByDays as $key => $item)
                            <tr>
                                <td>{{ $item['car']->brand }}</td>
                                <td>{{ $item['car']->model }}</td>
                                <td>{{ $item['car']->state_number }}</td>
                                @foreach ($item['dates'] as $date => $rent)
                                    <td>
                                    @if($rent)
                                        {{ $rent->driver->name }}
                                        </br>
                                        @convert($rent->amount)

                                        @if($rent->getLastComment())
                                            </br>
                                            <small>
                                                {{ $rent->getLastComment()['text'] }} -
                                                {{ \App\Models\User::find($rent->getLastComment()['user_id'])->name }}
                                                </br>
                                                {{ $rent->getLastComment()['created_at'] }}
                                            </small>
                                        @endif
                                    @endif
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach

                        <tr>
                            <td><b>Машина</b></td>

                            @foreach($dates as $date)
                                <td><b>{{ $date }}</b></td>
                            @endforeach
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
