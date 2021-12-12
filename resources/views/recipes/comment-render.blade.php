<div class="comment-list ms-3">
    <div class="comment-item d-flex align-items-start">
        <a href="{{ route('users.show', ['name' => $comment->user->name]) }}" class="text-dark">
            <div class="profile-button-in-comment-card">
                <div class="profile-button-in-comment-card__picture">
                    <img src="{{ $comment->user->avatar ?? asset('images/default-user.png') }}" alt="User Picture">
                </div>
            </div>
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
