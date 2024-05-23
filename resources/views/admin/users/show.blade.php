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

                <div class="col">
                    <div class="form-floating mb-3">
                        <input value="{{ $data->phone != null ? $data->phone : old('phone') }}" type="text"
                            class="form-control" name="phone" id="phone">
                        <label for="phone" class="form-label">Телефон (формат 87001112233)</label>
                    </div>
                </div>

                <div class="col">
                    <div class="form-floating mb-3">
                        <input value="{{ $data->balance != null ? $data->balance : old('balance') }}" type="number"
                            class="form-control" name="balance" id="balance">
                        <label for="balance" class="form-label">Баланс, тг</label>
                    </div>
                </div>

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
                        <label for="driver_license_categories" class="form-label">Категории водительских пра</label>
                    </div>
                </div>

                <div class="col">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="password" id="password" required>
                        <label for="password" class="form-label">Пароль</label>
                    </div>
                </div>
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
                                <a class="link-primary" href="{{ route('cars.show', ['id' => $penalty->rent->car->id]) }}">
                                    {{ $penalty->rent->car->brand }}
                                    {{ $penalty->rent->car->model }}
                                    {{ $penalty->rent->car->state_number }}
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
                                <a class="link-primary" href="{{ route('cars.show', ['id' => $rent->car->id]) }}">
                                    {{ $rent->car->brand }}
                                    {{ $rent->car->model }}
                                    {{ $rent->car->state_number }}
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
