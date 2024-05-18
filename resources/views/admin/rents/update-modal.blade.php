<a class="link-primary" data-bs-toggle="modal" data-bs-target="#updateRentModal{{ $car->state_number }}">
    {{ $item->todayRent()->driver->name }} (@convert($item->todayRent()->amount))
</a>&nbsp;

<div class="modal fade" id="updateRentModal{{ $car->state_number }}" tabindex="-1"
    aria-labelledby="updateRentModal{{ $car->state_number }}Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form class="demo-form" method="POST" data-parsley-validate="" class="form-horizontal form-label-left" novalidate=""
            enctype="multipart/form-data" action="{{ route('rents.update', ['id' => $rent->id]) }}">
            {{ csrf_field() }}

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateRentModal{{ $car->state_number }}Label">
                        Машина: {{ $car->state_number }} - {{ $car->brand }} {{ $car->model }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <h5>
                        Водитель: {{ $item->todayRent()->driver->name }}
                    </h5>
                    <h5>
                        Телефон: {{ $item->todayRent()->driver->phone }}
                    </h5>
                    <h5>
                        Баланс: @convert($item->todayRent()->driver->balance)
                    </h5>

                    <h4>
                        <span class="badge rounded-pill bg-{{ $car->getStatus()[0] }}">{{ $car->getStatus()[1] }}</span>
                        за @convert($item->todayRent()->amount)
                    </h4>

                    <!-- <input class="form-control" name="driver_id" list="datalistOptions" placeholder="Водитель..." style="width: 200px;"> -->
                    <!-- <datalist id="datalistOptions">
                        @foreach($drivers as $driver)
                            <option value="{{ $driver->id }}" {{ $rent->driver_id === $driver->id ? 'selected' : '' }}>
                                {{ $driver->name }}
                            </option>
                        @endforeach
                    </datalist> -->
                </div>

                <!-- <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Изменить</button>
                </div> -->
            </div>
        </form>
    </div>
</div>
