<a class="link-dark" data-bs-toggle="modal" data-bs-target="#updateYesterdayRentModal{{ $car->state_number }}">
    {{ $rent->driver->name }} (@convert($rent->amount))
</a>

<div class="modal fade" id="updateYesterdayRentModal{{ $car->state_number }}" tabindex="-1"
    aria-labelledby="updateYesterdayRentModal{{ $car->state_number }}Label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="statusModalForm" class="demo-form" method="POST" data-parsley-validate=""
                class="form-horizontal form-label-left" novalidate="" enctype="multipart/form-data"
                action="{{ route('rents.update', ['id' => $rent->id]) }}">
                {{ csrf_field() }}

                <div class="modal-header">
                    <h5 class="modal-title" id="updateYesterdayRentModal{{ $car->state_number }}Label">
                        Машина: {{ $car->state_number }} - {{ $car->brand }} {{ $car->model }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <h5>
                        Водитель: {{ $rent->driver?->name }}
                        {{ $rent->driver?->phone }} |
                        Баланс @convert($rent->driver?->balance)
                    </h5>
                    <h5>
                        Сумма: @convert($rent->amount)
                    </h5>
                    </br>
                    <div class="form-floating mb-3">
                        <input type="datetime-local" class="form-control" name="end_at" id="end_at">
                        <label for="end_at" class="form-label">Время сдачи машины</label>
                    </div>
                </div>

                <div class="modal-footer">
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary">
                            Сохранить
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
