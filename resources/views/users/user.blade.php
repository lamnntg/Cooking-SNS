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
<div>
    <!-- Button trigger modal -->
    @if (Auth::id() == $user->id)
        <div class="card recipe-card mt-3">
            <div class=" d-flex">
                <div class="w-100">
                    <button type="button" class="btn create-button" data-bs-toggle="modal"
                        data-bs-target="#createRecipeModal">
                        <div class="d-flex justify-content-center align-items-center">
                            <i class="fas fa-plus" style="font-size: 25px;"></i>
                            <span style="margin-left: 10px; margin-top: 4px;">レシピを共有しますか？ {{ Auth::user()->name }}</span>
                        </div>
                    </button>
                </div>
            </div>
        </div>

        <!-- Create Modal -->
        <div class="modal fade" id="createRecipeModal" tabindex="-1" aria-labelledby="createRecipeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="createRecipeModalLabel">レシピ作成</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @include('error_card_list')
                        <form method="POST" action="{{ route('recipes.store') }}" enctype="multipart/form-data">
                            @include('recipes.form')
                            <button type="submit" class="btn create-submit-btn float-end mt-3">投稿する</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Create Modal -->
    @endif

</div>
