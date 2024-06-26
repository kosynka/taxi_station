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
        <button class="nav-link" id="debt-tab" data-bs-toggle="tab" data-bs-target="#debt" type="button" role="tab"
            aria-controls="debt" aria-selected="false">Долги</button>
    </li>
</ul>

<div class="tab-content" id="myTabContent">
    </br>

    <div class="tab-pane fade show active" id="user_profile" role="tabpanel" aria-labelledby="user_profile-tab">
        <form class="demo-form" method="POST" data-parsley-validate="" class="form-horizontal form-label-left"
            novalidate="" enctype="multipart/form-data" action="{{ route('users.update', ['id' => $data->id]) }}">
            {{ csrf_field() }}

            <div class="row row-cols-3">
                <div class="col">
                    <div class="form-floating mb-3">
                        <input value="{{ $data->name != null ? $data->name : old('name') }}" type="text"
                            class="form-control" name="name" id="name" required>
                        <label for="name" class="form-label">ФИО</label>
                    </div>
                </div>

                <div class="col">
                    <div class="form-floating mb-3">
                        <input value="{{ $data->email != null ? $data->email : old('email') }}" type="email"
                            class="form-control" name="email" id="email">
                        <label for="email" class="form-label">Почта (формат primer.taxidriver@mail.ru)</label>
                    </div>
                </div>

                @if (auth()->user()->roleIs('admin'))
                    <div class="col">
                        <div class="form-floating mb-3">
                            <input value="{{ $data->phone != null ? $data->phone : old('phone') }}" type="text"
                                class="form-control" name="phone" id="phone">
                            <label for="phone" class="form-label">Телефон (формат 87001112233)</label>
                        </div>
                    </div>
                @endif

                <div class="col">
                    <div class="form-floating mb-3">
                        <input value="{{ $data->balance != null ? $data->balance : old('balance') }}" type="number"
                            class="form-control" name="balance" id="balance">
                        <label for="balance" class="form-label">Баланс, тг</label>
                    </div>
                </div>

                @if (auth()->user()->roleIs('admin'))
                    <!-- <div class="col">
                        <div class="form-floating mb-3">
                            <input value="{{ $data->debt != null ? $data->debt : old('debt') }}" type="number" class="form-control"
                                name="debt" id="debt">
                            <label for="debt" class="form-label">Долг, тг</label>
                        </div>
                    </div> -->
                @endif

                <div class="col">
                    <div class="form-floating mb-3">
                        <input value="{{ $data->iin != null ? $data->iin : old('iin') }}" type="text"
                            class="form-control" name="iin" id="iin" required>
                        <label for="iin" class="form-label">ИИН</label>
                    </div>
                </div>

                <div class="col">
                    <div class="form-floating mb-3">
                        <input value="{{ $data->id_doc_number != null ? $data->id_doc_number : old('id_doc_number') }}" type="text"
                            class="form-control" name="id_doc_number" id="id_doc_number" required>
                        <label for="id_doc_number" class="form-label">Номер удостоверения личности</label>
                    </div>
                </div>

                <div class="col">
                    <div class="form-floating mb-3">
                        <input value="{{ $data->id_doc_date != null ? $data->id_doc_date : old('id_doc_date') }}" type="date"
                            class="form-control" name="id_doc_date" id="id_doc_date" required>
                        <label for="id_doc_date" class="form-label">Дата выдачи удостоверения личности</label>
                    </div>
                </div>

                <div class="col">
                    <div class="form-floating mb-3">
                        <input value="{{ $data->id_doc_until_date != null ? $data->id_doc_until_date : old('id_doc_until_date') }}" type="date"
                            class="form-control" name="id_doc_until_date" id="id_doc_until_date" required>
                        <label for="id_doc_until_date" class="form-label">Срок действия удостоверения личности</label>
                    </div>
                </div>

                <div class="col">
                    <div class="form-floating mb-3">
                        <input value="{{ $data->registration_address != null ? $data->registration_address : old('registration_address') }}"
                            type="text" class="form-control" name="registration_address" id="registration_address" required>
                        <label for="registration_address" class="form-label">Адрес прописки</label>
                    </div>
                </div>

                <div class="col">
                    <div class="form-floating mb-3">
                        <input value="{{ $data->residence_address != null ? $data->residence_address : old('residence_address') }}" type="text"
                            class="form-control" name="residence_address" id="residence_address" required>
                        <label for="residence_address" class="form-label">Адрес проживания</label>
                    </div>
                </div>

                <div class="col">
                    <div class="form-floating mb-3">
                        <input value="{{ $data->driver_license_number != null ? $data->driver_license_number : old('driver_license_number') }}"
                            type="text" class="form-control" name="driver_license_number" id="driver_license_number" required>
                        <label for="driver_license_number" class="form-label">Номер водительского удостоверения</label>
                    </div>
                </div>

                <div class="col">
                    <div class="form-floating mb-3">
                        <input value="{{ $data->driver_license_date != null ? $data->driver_license_date : old('driver_license_date') }}"
                            type="date" class="form-control" name="driver_license_date" id="driver_license_date" required>
                        <label for="driver_license_date" class="form-label">Дата выдачи водительских пра</label>
                    </div>
                </div>

                <div class="col">
                    <div class="form-floating mb-3">
                        <input value="{{ $data->driver_license_categories != null ? $data->driver_license_categories : old('driver_license_categories') }}"
                            type="text" class="form-control" name="driver_license_categories" id="driver_license_categories" required>
                        <label for="driver_license_categories" class="form-label">Категории водительских прав</label>
                    </div>
                </div>

                <div class="col">
                    <div class="form-floating mb-3">
                        <textarea class="form-control" name="comment" id="comment"></textarea>
                        <label for="comment" class="form-label">Коммент</label>
                    </div>
                </div>

                @include('admin.parts.comment', ['item' => $data])
            </div>

            <div class="row row-cols-1">
                <div class="vstack gap-3">
                    <div class="col">
                        <div class="form bg-light border mb-3">
                            <label for="id_doc_photo_1" class="form-label">Фото удостоверения личности - лицевая сторона</label>
                            <input type="file" class="form-control" name="id_doc_photo_1" id="id_doc_photo_1">

                            @if($data->id_doc_photo_1 != null)
                                <img src="{{ url($data->id_doc_photo_1) }}" style="max-width: 600px; max-height: 600px;">
                            @endif
                        </div>
                    </div>

                    <div class="col">
                        <div class="form bg-light border mb-3">
                            <label for="id_doc_photo_2" class="form-label">Фото удостоверения личности - лицевая сторон</label>
                            <input type="file" class="form-control" name="id_doc_photo_2" id="id_doc_photo_2">

                            @if($data->id_doc_photo_2 != null)
                                <img src="{{ url($data->id_doc_photo_2) }}" style="max-width: 600px; max-height: 600px;">
                            @endif
                        </div>
                    </div>

                    <div class="col">
                        <div class="form bg-light border mb-3">
                            <label for="driver_license_photo_1" class="form-label">Фото водительских прав - лицевая сторон</label>
                            <input type="file" class="form-control" name="driver_license_photo_1" id="driver_license_photo_1">

                            @if($data->driver_license_photo_1 != null)
                                <img src="{{ url($data->driver_license_photo_1) }}" style="max-width: 600px; max-height: 600px;">
                            @endif
                        </div>
                    </div>

                    <div class="col">
                        <div class="form bg-light border mb-3">
                            <label for="driver_license_photo_2" class="form-label">Фото водительских прав - лицевая сторон</label>
                            <input type="file" class="form-control" name="driver_license_photo_2" id="driver_license_photo_2">

                            @if($data->driver_license_photo_2 != null)
                                <img src="{{ url($data->driver_license_photo_2) }}" style="max-width: 600px; max-height: 600px;">
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-auto">
                <button type="submit" class="btn btn-primary mb-3">Сохранить</button>
            </div>
        </form>
    </div>

    <div class="tab-pane fade" id="penalty" role="tabpanel" aria-labelledby="penalty-tab">
        </br>

        <a class="btn btn-primary mb-3" href="#"
            onclick="download_table_as_csv('user_penalties_table', ',', 'История штрафов и ДТП {{ $data->name }}');">
            Выгрузить таблицу
        </a>

        <input class="form-control" id="penalty-search-input" type="text" placeholder="Поиск">

        <div class="table-responsive">
            <table class="table table-sm table-bordered table-hover border border-dark" id="user_penalties_table">
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col">№ протокола</th>
                        <th scope="col">Дата оплаты</th>
                        <th scope="col">Сумма</th>
                        <th scope="col">Статус</th>
                        <th scope="col">Машина</th>
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
                                {{ $penalty->protocol_number }}
                            </td>
                            <td scope="col">
                                @if($penalty->paid)
                                    {{ $penalty->paid?->format('d.m.Y H:i:s') }}
                                @endif
                            </td>
                            <td scope="col">@convert($penalty->amount)</td>
                            <td scope="col">
                                <span class="badge rounded-pill bg-{{ $penalty->getStatus()[0] }}">
                                    {{ $penalty->getStatus()[1] }}
                                </span>
                            </td>
                            <td scope="col">
                                @if(isset($penalty->rent) && isset($penalty->rent->car))
                                    <a class="link-primary" href="{{ route('cars.show', ['id' => $penalty->rent?->car?->id]) }}">
                                        {{ $penalty->rent?->car?->brand }}
                                        {{ $penalty->rent?->car?->model }}
                                        {{ $penalty->rent?->car?->state_number }}
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="tab-pane fade" id="rent" role="tabpanel" aria-labelledby="rent-tab">
        </br>

        <a class="btn btn-primary mb-3" href="#"
            onclick="download_table_as_csv('user_rents_table', ',', 'История аренд {{ $data->name }}');">
            Выгрузить таблицу
        </a>

        <input class="form-control" id="rent-search-input" type="text" placeholder="Поиск">

        <div class="table-responsive">
            <table class="table table-sm table-bordered table-hover border border-dark" id="user_rents_table">
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Дата</th>
                        <!-- <th scope="col">Время конца</th> -->
                        <th scope="col">Сумма</th>
                        <th scope="col">Машина</th>
                    </tr>
                </thead>

                <tbody id="rent-search-table">
                    @foreach($data->rents as $rent)
                        <tr>
                            <td scope="col">{{ $rent->id }}</td>
                            <td scope="col">{{ $rent->start_at }}</td>
                            <!-- <td scope="col">{{ $rent->end_at }}</td> -->
                            <td scope="col">@convert($rent->amount)</td>
                            <td scope="col">
                                @if(isset($rent->car))
                                    <a class="link-primary" href="{{ route('cars.show', ['id' => $rent->car?->id]) }}">
                                        {{ $rent->car?->brand }}
                                        {{ $rent->car?->model }}
                                        {{ $rent->car?->state_number }}
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="tab-pane fade" id="debt" role="tabpanel" aria-labelledby="debt-tab">
        <h2>
            Долги
            <a class="link-success" href="{{ route('debts.create', ['user_id' => $data->id]) }}">
                @include('icons.plus')
            </a>
        </h2>

        <a class="btn btn-primary mb-3" href="#"
            onclick="download_table_as_csv('user_debts_table', ',', 'История аренд {{ $data->name }}');">
            Выгрузить таблицу
        </a>

        <input class="form-control" id="debt-search-input" type="text" placeholder="Поиск">

        <div class="table-responsive">
            <table class="table table-sm table-bordered table-hover border border-dark" id="user_debts_table">
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Сумма</th>
                        <!-- <th scope="col">Статус</th> -->
                        <th scope="col">Коммент</th>
                        <th scope="col">Дата</th>
                        <th scope="col"></th>
                    </tr>
                </thead>

                <tbody id="debt-search-table">
                    @foreach($data->debts as $debt)
                        <tr>
                            <td scope="col">
                                @include('icons.pen', ['name' => 'debts', 'id' => $debt->id])
                            </td>
                            <td scope="col">@convert($debt->amount)</td>
                            <!-- <td scope="col">{{ $debt->getStatus() }}</td> -->
                            <td scope="col">{{ $debt->comment }}</td>
                            <td scope="col">{{ $debt->created_at }}</td>
                            <td scope="col">
                                @include('icons.trash', ['name' => 'debts', 'id' => $debt->id])
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
