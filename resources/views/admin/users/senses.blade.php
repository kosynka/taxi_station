<table class="align-middle mb-0 table table-borderless table-striped table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>sense</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $item)
            <tr data-bs-toggle="collapse" data-bs-target="#collapseChapter{{ $item->id }}{{ $item->sense->id }}" aria-controls="collapseChapter{{ $item->id }}{{ $item->sense->id }}">
                <td>{{ $item->sense->id }}</td>
                <td class="text-muted">
                    {{ $item->sense->title }}
                    @if($item->state == 0)
                        <div class="badge badge-danger">In progress</div>
                    @else
                        <div class="badge badge-success">Passed</div>
                    @endif
                </td>
                <td class="text-muted">
                    <div id="collapseChapter{{ $item->id }}{{ $item->sense->id }}" class="collapse">
                        <div class="card-body">
                            @include('admin.users.chapters', ['data' => $item->chapters])
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
