<a class="link-success" data-bs-toggle="modal" data-bs-target="#createRentModal{{ $car->state_number }}">
    @include('icons.plus')
</a>

<div class="modal fade" id="createRentModal{{ $car->state_number }}" tabindex="-1"
    aria-labelledby="createRentModal{{ $car->state_number }}Label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form class="demo-form" method="POST" data-parsley-validate="" class="form-horizontal form-label-left" novalidate=""
            enctype="multipart/form-data" action="{{ route('rents.store') }}">
            {{ csrf_field() }}

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createRentModal{{ $car->state_number }}Label">
                        {{ $car->state_number }} - {{ $car->brand }} {{ $car->model }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <h5>
                        Статус поменяется:
                        <span class="badge rounded-pill bg-{{ $car->getStatus()[0] }}">{{ $car->getStatus()[1] }}</span>
                        ->
                        <span class="badge rounded-pill bg-success">На линии</span>
                    </h5>

                    </br>

                    <input name="car_id" value="{{ $car->id }}" hidden>

                    <input name="amount" value="{{ $car->amount }}" hidden>

                    <div class="form-floating mb-3">
                        <select name="driver_id" class="form-select">
                            <option></option>
                            @foreach($drivers as $driver)
                                <option value="{{ $driver->id }}">
                                    {{ $driver->name }}
                                    {{ $driver->phone }} |
                                    Баланс @convert($driver->balance)
                                </option>
                            @endforeach
                        </select>
                        <label for="status" class="form-label">Водитель <i style="color: red;">*</i></label>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Сохранить</button>
                </div>
            </div>
        </form>
    </div>
</div>
