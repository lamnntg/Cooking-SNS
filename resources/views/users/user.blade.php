<div class="card mt-5">
    <div class="d-flex justify-content-around mt-3">
        <div class="card-body ">
            <div class="d-flex flex-column" style="align-items: center">
                <div>
                    <a href="{{ route('users.show', ['name' => $user->name]) }}" class="text-dark">
                        <div class="profile-button-in-recipe-card">
                            <div class="profile-button-in-recipe-card__border"></div>
                            <div class="profile-button-in-recipe-card__picture">
                                <img src="{{ $user->avatar ?? asset('images/default-user.png') }}" alt="User Picture">
                            </div>
                        </div>
                    </a>
                </div>
                <div class="mt-3">
                    @if (Auth::id() !== $user->id)
                        <follow-button class="ml-auto"
                            :initial-is-followed-by='@json($user->isFollowedBy(Auth::user()))'
                            :authorized='@json(Auth::check())'
                            endpoint="{{ route('users.follow', ['name' => $user->name]) }}">
                        </follow-button>
                    @endif
                </div>
                <div class="mt-3">
                    <h2 class="h5 card-title">
                        <a href="{{ route('users.show', ['name' => $user->name]) }}" class="text-dark"
                            style="text-decoration: none;">
                            <b>{{ $user->name }}</b>
                        </a>
                    </h2>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="card-text">
                {{ $user->count_recipes }} レシピ
            </div>
        </div>
        <div class="card-body">
            <div class="card-text d-flex flex-column">
                <div>
                    {{ $user->count_followings }} フォロー
                </div>
                <div class="mt-3">
                    {{ $user->count_followers }} フォロワー
                </div>
            </div>
        </div>
    </div>

</div>
