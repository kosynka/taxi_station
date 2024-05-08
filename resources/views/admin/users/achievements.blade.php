<div class="row">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-header">Achievements
                <div class="btn-actions-pane-right">
                    <div role="group" class="btn-group-sm btn-group">
                        <button class="btn btn-focus">Total count:</button>
                        <button class="btn btn-focus">{{ count($data) }}</button>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>status</th>
                            <th>title</th>
                            <th>description</th>
                            <th>image</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $item)
                            <tr>
                                <td class="text-muted">{{ $item->achievement->id }}</td>
                                <td class="">
                                    @if($item->status == 0)
                                        <div class="badge badge-danger">In progress</div>
                                    @else
                                        <div class="badge badge-success">Passed</div>
                                    @endif
                                </td>
                                <td class="text-muted">{{ $item->achievement->title }}</td>
                                <td class="text-muted">{{ $item->achievement->description }}</td>
                                <td class="text-muted">
                                    <img src="{{ url($item->achievement->image) }}" style="max-width: 150px; max-height: 150px;">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
