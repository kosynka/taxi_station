<a class="link-{{ $rent->end_at === null ? 'success fw-bold' : 'dark fw-lighter' }}" data-bs-toggle="modal"
    data-bs-target="#updateTodayRentModal{{ $car->state_number }}{{ $rent->id }}">
    {{ $rent->driver->name }} (@convert($rent->amount) {{ $rent->end_at !== null ? ' - ' . $rent->end_at : ''}})
    <span class="badge rounded-pill bg-{{ $rent->is_paid ? 'success' : 'danger' }}">
        {{ $rent->is_paid ? 'оплачено' : 'не оплачено' }}
    </span>
</a>

@include('icons.trash', ['name' => 'rents', 'id' => $rent->id])

<div class="modal fade" id="updateTodayRentModal{{ $car->state_number }}{{ $rent->id }}" tabindex="-1"
    aria-labelledby="updateTodayRentModal{{ $car->state_number }}{{ $rent->id }}Label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="statusModalForm" class="demo-form" method="POST" data-parsley-validate=""
                class="form-horizontal form-label-left" novalidate="" enctype="multipart/form-data"
                action="{{ route('rents.update', ['id' => $rent->id]) }}">
                {{ csrf_field() }}
                <div class="modal-header">
                    <h5 class="modal-title" id="updateTodayRentModal{{ $car->state_number }}{{ $rent->id }}Label">
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
                        <select name="driver_id" class="form-select">
                            @foreach($drivers as $driver)
                                <option value="{{ $driver->id }}" {{ $rent->driver_id === $driver->id ? 'selected' : '' }}>
                                    {{ $driver->name }}
                                    {{ $driver->phone }} |
                                    Баланс @convert($driver->balance)
                                </option>
                            @endforeach
                        </select>
                        <label for="status" class="form-label">Водитель <i style="color: red;">*</i></label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="datetime-local" class="form-control" name="start_at" id="start_at" value="{{ $rent->start_at }}">
                        <label for="start_at" class="form-label">Время получения машины</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="datetime-local" class="form-control" name="end_at" id="end_at" value="{{ $rent->end_at }}">
                        <label for="end_at" class="form-label">Время сдачи машины</label>
                    </div>

                    @if(auth()->user()->roleIs('admin') || auth()->user()->roleIs('accountant'))
                        <div class="form-check mb-3">
                            <label class="form-check-label" for="is_paid">
                                Оплатил
                            </label>
                            <input name="is_paid" class="form-check-input" type="checkbox" value="1" id="is_paid" {{ $rent->is_paid ? 'checked' : '' }}>
                        </div>
                    @endif

                    </br>

                    <!-- <h5>
                        <a class="link-primary" href="{{ route('contract.rent', ['rent_id' => $rent->id]) }}">
                            Договор аренды
                        </a>
                    </h5> -->
                    <h5>
                        <a class="link-primary" href="{{ route('contract.rent.with.buy', ['rent_id' => $rent->id]) }}">
                            Договор аренды с выкупом
                        </a>
                    </h5>
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
