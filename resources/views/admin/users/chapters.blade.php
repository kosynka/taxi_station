@foreach($data as $item)
    <table class="align-middle mb-0 table table-borderless table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>chapter</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
                <tr>
                    <td>{{ $item->chapter->id }}</td>
                    <td class="text-muted">
                        {{ $item->chapter->title }}
                        @if($item->state == 0)
                            <div class="badge badge-danger">In progress</div>
                        @else
                            <div class="badge badge-success">Passed</div>
                        @endif
                    </td>
                    <td class="text-muted">
                        @include('admin.users.levels', ['data' => $item->levels])
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endforeach
