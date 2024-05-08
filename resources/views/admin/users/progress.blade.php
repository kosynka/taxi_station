<div class="row">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-header">Game Progress</div>
            <div class="table-responsive">
                <table class="align-middle mb-0 table table-borderless table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>portal</th>
                            <th>
                                <span class="text-muted">
                                    click to collapse
                                </span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $item)
                            <tr>
                                <td>{{ $item->portal->id }}</td>
                                <td class="text-muted">
                                    {{ $item->portal->title }}
                                    @if($item->state == 0)
                                        <div class="badge badge-danger">In progress</div>
                                    @else
                                        <div class="badge badge-success">Passed</div>
                                    @endif
                                </td>
                                <td class="text-muted">
                                    @include('admin.users.senses', ['data' => $item->senses])
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
