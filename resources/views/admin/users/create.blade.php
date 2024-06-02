@extends('main')

@section('content')
</br>
<form class="demo-form" method="POST" data-parsley-validate="" class="form-horizontal form-label-left" novalidate=""
    enctype="multipart/form-data" action="{{ route('users.store') }}">
    {{ csrf_field() }}

    <div class="row row-cols-3">
        <div class="col">
            <div class="form-floating mb-3">
                <input value="{{ old('name') }}" type="text" class="form-control" name="name" id="name" required>
                <label for="name" class="form-label">ФИО <i style="color: red;">*</i></label>
            </div>
        </div>

        <div class="col">
            <div class="form-floating mb-3">
                <input value="{{ old('email') }}" type="email" class="form-control" name="email" id="email">
                <label for="email" class="form-label">Почта (формат primer.taxidriver@mail.ru)</label>
            </div>
        </div>

        @if (auth()->user()->roleIs('admin'))
            <div class="col">
                <div class="form-floating mb-3">
                    <input value="{{ old('phone') }}" type="text" class="form-control" name="phone" id="phone" required>
                    <label for="phone" class="form-label">Телефон (формат 87001112233) <i style="color: red;">*</i></label>
                </div>
            </div>
        @endif

        <div class="col">
            <div class="form-floating mb-3">
                <input value="{{ old('balance') }}" type="number" class="form-control" name="balance" id="balance">
                <label for="balance" class="form-label">Баланс, тг</label>
            </div>
        </div>

        @if (auth()->user()->roleIs('admin'))
            <div class="col">
                <div class="form-floating mb-3">
                    <input value="{{ old('debt') }}" type="number" class="form-control" name="debt" id="debt">
                    <label for="debt" class="form-label">Долг, тг</label>
                </div>
            </div>
        @endif

        <div class="col">
            <div class="form-floating mb-3">
                <input value="{{ old('iin') }}" type="text" class="form-control" name="iin" id="iin" required>
                <label for="iin" class="form-label">ИИН <i style="color: red;">*</i></label>
            </div>
        </div>

        <div class="col">
            <div class="form-floating mb-3">
                <input value="{{ old('id_doc_number') }}" type="text" class="form-control" name="id_doc_number" id="id_doc_number"
                    required>
                <label for="id_doc_number" class="form-label">Номер удостоверения личности <i style="color: red;">*</i></label>
            </div>
        </div>

        <div class="col">
            <div class="form-floating mb-3">
                <input value="{{ old('id_doc_date') }}" type="date" class="form-control" name="id_doc_date"
                    id="id_doc_date" required>
                <label for="id_doc_date" class="form-label">Дата выдачи удостоверения личности <i style="color: red;">*</i></label>
            </div>
        </div>

        <div class="col">
            <div class="form-floating mb-3">
                <input value="{{ old('id_doc_until_date') }}" type="date" class="form-control" name="id_doc_until_date"
                    id="id_doc_until_date" required>
                <label for="id_doc_until_date" class="form-label">Срок действия удостоверения личности <i style="color: red;">*</i></label>
            </div>
        </div>

        <div class="col">
            <div class="form-floating mb-3">
                <input value="{{ old('registration_address') }}" type="text" class="form-control" name="registration_address"
                    id="registration_address" required>
                <label for="registration_address" class="form-label">Адрес прописки <i style="color: red;">*</i></label>
            </div>
        </div>

        <div class="col">
            <div class="form-floating mb-3">
                <input value="{{ old('residence_address') }}" type="text" class="form-control" name="residence_address"
                    id="residence_address" required>
                <label for="residence_address" class="form-label">Адрес проживания <i style="color: red;">*</i></label>
            </div>
        </div>

        <div class="col">
            <div class="form-floating mb-3">
                <input value="{{ old('driver_license_number') }}" type="text" class="form-control" name="driver_license_number"
                    id="driver_license_number" required>
                <label for="driver_license_number" class="form-label">Номер водительских прав <i style="color: red;">*</i></label>
            </div>
        </div>

        <div class="col">
            <div class="form-floating mb-3">
                <input value="{{ old('driver_license_date') }}" type="date" class="form-control" name="driver_license_date"
                    id="driver_license_date" required>
                <label for="driver_license_date" class="form-label">Дата выдачи водительских прав <i style="color: red;">*</i></label>
            </div>
        </div>

        <div class="col">
            <div class="form-floating mb-3">
                <input value="{{ old('driver_license_categories') }}" type="text" class="form-control"
                    name="driver_license_categories" id="driver_license_categories" required>
                <label for="driver_license_categories" class="form-label">Категории водительских прав <i style="color: red;">*</i></label>
            </div>
        </div>

        <div class="col">
            <div class="form-floating mb-3">
                <textarea class="form-control" name="comment" id="comment">{{ old('comment') }}</textarea>
                <label for="comment" class="form-label">Коммент</label>
            </div>
        </div>
    </div>

    <div class="row row-cols-1">
        <div class="vstack gap-3">
            <div class="col">
                <div class="form bg-light border mb-3">
                    <label for="id_doc_photo_1" class="form-label">Фото удостоверения личности - лицевая сторона</label>
                    <input type="file" class="form-control" name="id_doc_photo_1" id="id_doc_photo_1">
                </div>
            </div>

            <div class="col">
                <div class="form bg-light border mb-3">
                    <label for="id_doc_photo_2" class="form-label">Фото удостоверения личности - лицевая сторон</label>
                    <input type="file" class="form-control" name="id_doc_photo_2" id="id_doc_photo_2">
                </div>
            </div>

            <div class="col">
                <div class="form bg-light border mb-3">
                    <label for="driver_license_photo_1" class="form-label">Фото водительских прав - лицевая сторон</label>
                    <input type="file" class="form-control" name="driver_license_photo_1" id="driver_license_photo_1">
                </div>
            </div>

            <div class="col">
                <div class="form bg-light border mb-3">
                    <label for="driver_license_photo_2" class="form-label">Фото водительских прав - лицевая сторон</label>
                    <input type="file" class="form-control" name="driver_license_photo_2" id="driver_license_photo_2">
                </div>
            </div>
        </div>
    </div>

    <div class="col-auto">
        <button type="submit" class="btn btn-success mb-3">Создать пользователя</button>
    </div>
</form>
@endsection
