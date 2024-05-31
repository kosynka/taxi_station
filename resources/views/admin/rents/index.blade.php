@extends('main')

@section('content')
</br>
<h2>Аренда</h2>

<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link {{ $activeBar == 'today' ? 'active' : '' }}" id="today-tab" data-bs-toggle="tab" data-bs-target="#today"
            type="button" role="tab" aria-controls="today" aria-selected="true">Сегодня ({{ now()->format('d.m.Y') }})</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link {{ $activeBar == 'history' ? 'active' : '' }}" id="history-tab" data-bs-toggle="tab" data-bs-target="#history" type="button"
            role="tab" aria-controls="history" aria-selected="false">
            История (
                @if(empty($dates))
                    нет данных
                @else
                    {{ $dates[0] }}{{ last($dates) != $dates[0] ? ' - ' . last($dates) : '' }}
                @endif
                )
        </button>
    </li>
</ul>

<!-- TODAY -->
<div class="tab-content" id="myTabContent">
    </br>
    <!-- TODAY STATS -->
    <div class="tab-pane fade {{ $activeBar == 'today' ? 'show active' : '' }}" id="today" role="tabpanel" aria-labelledby="today-tab">
        <b>Количество машин на аренде:</b> {{ $todayCarsCount }} / {{ count($today) }}
        </br>
        <b>Сумма машин на аренде:</b> @convert($todayAmount) / @convert($today->sum('amount'))
        </br></br>

        <a class="btn btn-primary mb-3" href="#" onclick="download_table_as_csv('today_rents_table', ',', 'Сегодняшние аренды');">
            Выгрузить таблицу
        </a>

        <input class="form-control" id="myInput" type="text" placeholder="Поиск">

        <!-- TODAY TABLE -->
        <div class="table-responsive">
            <table class="table table-striped" id="today_rents_table">
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
                        <th scope="col">Вчерашняя аренда</th>
                    </tr>
                </thead>

                <tbody id="myTable">
                    @foreach($today as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>
                                <a class="link-primary" href="{{ route('cars.show', ['id' => $item->id]) }}">
                                    {{ $item->state_number }}
                                </a>
                            </td>
                            <td>{{ $item->brand }}</td>
                            <td>{{ $item->model }}</td>
                            <td>{{ $item->mileage }} км</td>
                            <td>@convert($item->amount)</td>
                            <td>
                                @include('admin.rents.status-modal', [
                                    'car' => $item,
                                    'rents' => $item->todayRent(),
                                ])
                            </td>
                            <td>
                                @include('admin.parts.comment', ['item' => $item])
                            </td>
                            <td>
                                @if($item->todayRent()->isNotEmpty())
                                    @foreach($item->todayRent() as $rent)
                                        @include('admin.rents.today-modal', [
                                            'car' => $item,
                                            'drivers' => $drivers,
                                            'rent' => $rent,
                                        ])
                                        </br>
                                    @endforeach
                                @endif
                                @if($item->todayRent()->count() < 2)
                                    @include('admin.rents.create-modal', [
                                        'car' => $item,
                                        'drivers' => $drivers,
                                    ])
                                @endif
                            </td>
                            <td class="table-info">
                                @foreach($item->yesterdayRent() as $yesterdayRent)
                                    @if($yesterdayRent->end_at === null)
                                        @include('admin.rents.yesterday-modal', [
                                            'car' => $item,
                                            'rent' => $yesterdayRent,
                                        ])
                                    @endif
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- HISTORY -->
    <div class="tab-pane fade {{ $activeBar == 'history' ? 'show active' : '' }}" id="history" role="tabpanel" aria-labelledby="history-tab">
        <!-- HISTORY FILTER -->
        <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
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

                <div class="col-2">
                    <div class="mb-3">
                        <a class="btn btn-primary mb-3" href="#"
                            onclick="download_table_as_csv('history_rents_table', ',', 'История аренды');">
                            Выгрузить таблицу
                        </a>
                    </div>
                </div>
            </div>
        </form>

        <input class="form-control mb-2" id="history-search-input" type="text" placeholder="Поиск">

        <!-- HISTORY TABLE -->
        <div style="width: 100%; overflow-x: auto;">
            <div class="table-responsive" style="overflow: auto; overflow-x: scroll;">
                <table class="table table-lg table-bordered mb-4" id="history_rents_table">
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
                                @foreach ($item['dates'] as $date => $rents)
                                    <td>
                                        @foreach($rents as $rent)
                                            {{ $rent->driver->name }}
                                            @convert($rent->amount) |

                                            {{ $rent->start_at->format('h:i:s') }} - {{ $rent->end_at?->format('h:i:s') ?? 'не сдал' }}

                                            @if(isset($rent->penalty))
                                                |
                                                <a class="link-{{ $rent->penalty->getType()[0] }}" href="{{ route('penalties.show', ['id' => $rent->penalty]) }}">
                                                    {{ $rent->penalty->getType()[1] }} (@convert($rent->penalty->amount))
                                                </a>
                                            @endif

                                            @if($rent->getLastComment())
                                                </br>
                                                <small>
                                                    {{ $rent->getLastComment()['text'] }} -
                                                    {{ \App\Models\User::find($rent->getLastComment()['user_id'])->name }}
                                                    {{ \Carbon\Carbon::parse($rent->getLastComment()['created_at'])->format('h:i:s') }}
                                                </small>
                                            @endif
                                            </br>
                                            </br>
                                        @endforeach
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
