<a class="link-success" data-bs-toggle="modal" data-bs-target="#createRentModal{{ $car->state_number }}">
    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor"
        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-circle"
        aria-hidden="true">
        <circle cx="12" cy="12" r="10"></circle>
        <line x1="12" y1="8" x2="12" y2="16"></line>
        <line x1="8" y1="12" x2="16" y2="12"></line>
    </svg>
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
                    <h4>
                        <span class="badge rounded-pill bg-{{ $car->getStatus()[0] }}">{{ $car->getStatus()[1] }}</span>
                    </h4>

                    <input name="car_id" value="{{ $car->id }}" hidden>

                    <input name="amount" value="{{ $car->amount }}" hidden>

                    <input class="form-control" name="driver_id" list="datalistOptions" placeholder="Водитель...">
                    <datalist id="datalistOptions">
                        @foreach($drivers as $driver)
                            <option value="{{ $driver->id }}">
                                {{ $driver->name }}
                            </option>
                        @endforeach
                    </datalist>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Сохранить</button>
                </div>
            </div>
        </form>
    </div>
</div>
