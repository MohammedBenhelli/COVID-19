<div class="media">
    <div style="border: 1px solid #1b4b72" class="media-body">
        <h5 class="media-heading">{{ $message->user->name }}</h5>
        <hr>
        <div style="background-color: lightblue">
        <p>{{ $message->body }}</p>
        <div class="text-muted">
            <small>Posted {{ $message->created_at->diffForHumans() }}</small>
        </div>
        </div>
    </div>
</div>
