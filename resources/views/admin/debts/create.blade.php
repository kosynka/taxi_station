@extends('main')

@section('content')
</br>
<form class="demo-form" method="POST" data-parsley-validate="" class="form-horizontal form-label-left" novalidate=""
    enctype="multipart/form-data" action="{{ route('debts.store') }}">
    {{ csrf_field() }}

    <input name="user_id" value="{{ $data['user_id'] }}" hidden>

    <div class="form-floating mb-3">
        <input type="number" class="form-control" name="amount" id="amount" min="1" required>
        <label for="amount" class="form-label">Сумма <i style="color: red;">*</i></label>
    </div>

    <div class="form-floating mb-3">
        <input type="text" class="form-control" name="comment" id="comment" required>
        <label for="comment" class="form-label">Коммент</label>
    </div>

    <!-- <div class="form-floating mb-3">
        <select name="status" class="form-select">
            <option value="not_repaid">Не вернул</option>
            <option value="repaid">Вернул</option>
        </select>
        <label for="status" class="form-label">Статус</label>
    </div> -->

    <div class="col-auto">
        <button type="submit" class="btn btn-primary mb-3">Сохранить</button>
    </div>
</form>
@endsection
