<div class="comment-list ms-3">
    <div class="comment-item d-flex align-items-start">
        <a href="{{ route('users.show', ['name' => $comment->user->name]) }}" class="text-dark">
            <i class="fas fa-user-circle fa-2x"></i>
        </a>
        <div class="ms-2 flex-fill">
            <a href="{{ route('users.show', ['name' => $comment->user->name]) }}"
                class="text-dark fw-bold text-decoration-none">
                {{ $comment->user->name }}
            </a>
            <span class="ms-2">
                {{ $comment->content }}
            </span>
        </div>
    </div>
</div>
