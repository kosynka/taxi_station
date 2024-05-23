<a class="link-primary" data-bs-toggle="modal" data-bs-target="#updateRentModal{{ $car->state_number }}">
    {{ $item->todayRent()->driver->name }} (@convert($item->todayRent()->amount))
</a>

<div class="modal fade" id="updateRentModal{{ $car->state_number }}" tabindex="-1"
    aria-labelledby="updateRentModal{{ $car->state_number }}Label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateRentModal{{ $car->state_number }}Label">
                    Машина: {{ $car->state_number }} - {{ $car->brand }} {{ $car->model }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <h5>
                    Водитель: {{ $item->todayRent()->driver->name }},
                    {{ $item->todayRent()->driver->phone }},
                    Баланс - @convert($item->todayRent()->driver->balance)
                </h5>

                </br>
                <h5>
                    {{ $car->getStatus()[1] }}
                    за @convert($item->todayRent()->amount)
                </h5>

                <h5>
                    <a class="link-primary" href="{{ route('contract.rent', ['rent_id' => $item->todayRent()->id]) }}">
                        Договор аренды
                    </a>
                </h5>

                <h5>
                    <a class="link-primary" href="{{ route('contract.rent.with.buy', ['rent_id' => $item->todayRent()->id]) }}">
                        Договор аренды с выкупом
                    </a>
                </h5>
            </div>
        </div>
    </div>
</div>
