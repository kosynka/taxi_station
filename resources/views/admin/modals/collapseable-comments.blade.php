@foreach($comments as $comment)
    <small>
        @php
            $commentUser = \App\Models\User::find($comment['user_id']);
        @endphp
        <blockquote class="blockquote">
            <p class="mb-3">{{ $comment['text'] }}</p>
            <small>
                <footer class="blockquote-footer">
                    {{ $comment['created_at'] }}
                    <cite>{{ $commentUser->name }}</cite>
                </footer>
            </small>
        </blockquote>
    </small>
@endforeach
