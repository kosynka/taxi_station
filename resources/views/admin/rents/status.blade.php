<a data-bs-toggle="modal" data-bs-target="#commentRentModal{{ $car->state_number }}">
    <span class="badge rounded-pill bg-{{ $car->getStatus()[0] }}">{{ $car->getStatus()[1] }}</span>
</a>

<div class="modal fade" id="commentRentModal{{ $car->state_number }}" tabindex="-1"
    aria-labelledby="commentRentModal{{ $car->state_number }}Label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form class="demo-form" method="POST" data-parsley-validate="" class="form-horizontal form-label-left" novalidate=""
                enctype="multipart/form-data" action="{{ route('cars.status', ['id' => $car->id]) }}">
                {{ csrf_field() }}

                <input value="{{ $rent !== null ? $rent->id : 0 }}" name="rent_id" type="number" hidden>

                <div class="modal-header">
                    <h5 class="modal-title" id="commentRentModal{{ $car->state_number }}Label">
                        Машина: {{ $car->state_number }} - {{ $car->brand }} {{ $car->model }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <select name="status" id="status" class="form-select mb-3" size="7">
                        @foreach($statuses as $status => $text)
                            <option value="{{ $status }}" @if ($car->status == $status) selected @endif>
                                {{ $text }}
                            </option>
                        @endforeach
                    </select>

                    <div class="form-floating mb-3">
                        <textarea rows="5" class="form-control" name="comment" id="comment"></textarea>
                        <label for="comment" class="form-label">Коммент</label>
                    </div>
                </div>

                <div class="modal-footer">
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary mb-3">
                            Сохранить
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
