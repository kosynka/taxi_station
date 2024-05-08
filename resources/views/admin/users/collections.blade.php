<div class="row">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-header">Collections
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
                            <th>title</th>
                            <th>image</th>
                            <th>sense & level</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $item)
                            <tr>
                                <td class="text-muted">{{ $item->id }}</td>
                                <td class="text-muted">{{ $item->title }}</td>
                                <td class="text-muted">
                                    <img src="{{ url($item->image) }}" style="max-width: 150px; max-height: 150px;">
                                </td>
                                <td>
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left flex2">
                                                <div class="widget-heading">
                                                    {{ $item->sense->title }}
                                                </div>
                                                <div class="widget-subheading opacity-7">
                                                    {{ $item->level->description }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
