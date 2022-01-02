<div class="card mt-3 recipe-card">
    <div class="card-header d-flex recipe-header">
        <h4 class="card-title text-capitalize recipe-title">
            {{ $recipe->title }}
        </h4>
        @if (Auth::id() === $recipe->user_id)
            {{-- <!-- dropdown -->
            <div class="ms-auto card-text">
                <div class="dropdown">
                    <a data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <button type="button" class="btn btn-link text-muted m-0 p-2">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editRecipeModal">
                            <i class="fas fa-pen mr-1"></i>記事を更新する
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-danger" data-bs-toggle="modal"
                            data-bs-target="#modal-delete-{{ $recipe->id }}">
                            <i class="fas fa-trash-alt mr-1"></i>記事を削除する
                        </a>
                    </div>
                </div>
            </div>
            <!-- dropdown -->

            <!-- edit modal -->
            <div class="modal fade" id="editRecipeModal" tabindex="-1" aria-labelledby="editRecipeModal"
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
                            <form method="POST" action="{{ route('recipes.update', ['recipe' => $recipe]) }}" enctype="multipart/form-data">
                                @method('PATCH')
                                @include('recipes.form', ['is_edit' => true])
                                <button type="submit" class="btn create-submit-btn float-end mt-3">更新する</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end edit modal -->

            <!-- delete modal -->
            <div id="modal-delete-{{ $recipe->id }}" class="modal fade" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title fw-bold">削除確認</h6>
                            <button type="button" class="btn close ms-auto" data-bs-dismiss="modal" aria-label="閉じる">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="POST" action="{{ route('recipes.destroy', ['recipe' => $recipe]) }}">
                            @csrf
                            @method('DELETE')
                            <div class="modal-body">
                                {{ $recipe->title }}を削除します。よろしいですか？
                            </div>
                            <div class="modal-footer flex-end">
                                <a class="btn btn-outline-secondary" data-bs-dismiss="modal">キャンセル</a>
                                <button type="submit" class="btn btn-danger">削除する</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- delete modal --> --}}
        @endif
    </div>
    <div class="card-body">
        <div class="d-flex">
            <a href="{{ route('users.show', ['name' => $recipe->user->name ?? '']) }}" class="text-dark">
                <div class="profile-button-in-recipe-card">
                    <div class="profile-button-in-recipe-card__border"></div>
                    <div class="profile-button-in-recipe-card__picture">
                        <img src="{{ $recipe->user->avatar ?? asset('images/default-user.png') }}" alt="User Picture">
                    </div>
                </div>
            </a>
            <div class="ms-3 p-2">
                <div class="fw-bold">
                    <a style="text-decoration: none" href="{{ route('users.show', ['name' => $recipe->user->name ?? '']) }}"
                        class="text-dark">
                        {{ $recipe->user->name ?? '' }}
                    </a>
                </div>
                <div class="fw-lighter">
                    {{ $recipe->created_at->format('Y/m/d H:i') }}
                </div>
            </div>

            {{-- @if (Auth::id() !== $recipe->user_id)
                <follow-button class="ms-auto"
                    :initial-is-followed-by='@json($recipe->user->isFollowedBy(Auth::user()))'
                    :authorized='@json(Auth::check())'
                    endpoint="{{ route('users.follow', ['name' => $recipe->user->name]) }}">
                </follow-button>
            @endif --}}
        </div>
    </div>
    <div class="d-flex justify-content-center">
        @if ($recipe->image !== null)
            <img src="{{ $recipe->image }}" class="card-img mt-3 recipe-image" alt="recipe image">
        @endif

    </div>
    <div class="card-body">
        <p class="card-text mt-3 recipe-content">
            {!! nl2br(e($recipe->description)) !!}
        </p>
        {{-- tags --}}
        @if (count($recipe->tags) > 0)
            <span>
                <label for="">タグ：</label>
                @foreach ($recipe->tags as $tag)
                    <a href="{{ route('tags.show', ['name' => $tag->name ?? '']) }}"
                        class="badge badge-light badge-pill text-muted" style="font-size: 100%">
                        {{ $tag->hashtag ?? null }}
                    </a>
                @endforeach
            </span>
        @endif
    </div>
    <div class="card-footer">
        {{-- <recipe-like :initial-is-liked-by='@json($recipe->isLikedBy(Auth::user()))'
            :initial-count-likes='@json($recipe->count_likes)' :authorized='@json(Auth::check())'
            endpoint="{{ route('recipes.like', ['recipe' => $recipe]) }}">
        </recipe-like> --}}
        <a style="text-decoration: none; color:#000" class="float-end mt-3 mb-3 mr-3"
            href="{{ route('recipes.show', ['recipe' => $recipe]) }}">
            続きを読む
            <i class="fas fa-angle-double-right"></i>
        </a>
    </div>
</div>
