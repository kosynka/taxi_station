@if($item->getLastComment())
    <small>
        @php
            $commentUser = \App\Models\User::find($item->getLastComment()['user_id']);
        @endphp
        <blockquote class="blockquote">
            <p class="mb-3">{{ $item->getLastComment()['text'] }}</p>
            <small>
                <footer class="blockquote-footer">
                    {{ \Carbon\Carbon::parse($item->getLastComment()['created_at'])->format('d.m.Y h:i:s') }}
                    <cite>{{ $commentUser->name }}</cite>
                </footer>
            </small>
        </blockquote>
    </small>
@endif
