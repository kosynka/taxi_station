@foreach($data as $item)
    Level - {{ $item->level->title }}:
    @if($item->state == 0)
        <div class="badge badge-danger">In progress</div>
    @else
        <div class="badge badge-success">Passed</div>
    @endif
    </br>
@endforeach
