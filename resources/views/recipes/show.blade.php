@extends('app')

@section('title', '記事詳細')

@section('content')
    @include('layout.header')
    <div class="container">
        {{-- @include('recipes.card') --}}
        <div class="card mt-3">
            <div class="card-body border-bottom">
                <div class="d-flex">
                    <a href="{{ route('users.show', ['name' => $recipe->user->name]) }}" class="text-dark">
                        <i class="fas fa-user-circle fa-3x mr-1"></i>
                    </a>
                    <div class="ms-3">
                        <div class="fw-bold">
                            <a href="{{ route('users.show', ['name' => $recipe->user->name]) }}"
                                class="text-dark text-decoration-none">
                                {{ $recipe->user->name }}
                            </a>
                        </div>
                        <div class="fw-lighter">
                            {{ $recipe->created_at->format('Y/m/d H:i') }}
                        </div>
                    </div>

                    @if (Auth::id() !== $recipe->user_id)
                        <follow-button class="ms-auto"
                            :initial-is-followed-by='@json($recipe->user->isFollowedBy(Auth::user()))'
                            :authorized='@json(Auth::check())'
                            endpoint="{{ route('users.follow', ['name' => $recipe->user->name]) }}">
                        </follow-button>
                    @else
                        <!-- dropdown -->
                        <div class="card-text ms-auto">
                            <div class="dropdown">
                                <a data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <button type="button" class="btn btn-link text-muted m-0 p-2">
                                        <i class="fas fa-ellipsis-h"></i>
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
                                        <form method="POST" action="{{ route('recipes.update', ['recipe' => $recipe]) }}">
                                            @method('PATCH')
                                            @include('recipes.form')
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
                                        <button type="button" class="btn close ms-auto" data-bs-dismiss="modal"
                                            aria-label="閉じる">
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
                        <!-- end delete modal -->
                    @endif
                </div>
            </div>
            <img src="https://static.salekit.vn/image/site/2120/blogs/nha-hang-the-pizza.jpg" class="card-img recipe-img"
                alt="recipe image">
            <div class="card-body recipe-card-content">
                <h2 class="card-title font-monospace fs-2 fw-bold text-uppercase">
                    {{ $recipe->title }}
                </h2>
                <h3>料理レシピ:</h3>
                <p class="card-text mt-3">
                    {!! nl2br(e($recipe->description)) !!}
                </p>
            </div>
            <div class="card-footer border-bottom d-flex">
                <recipe-like :initial-is-liked-by='@json($recipe->isLikedBy(Auth::user()))'
                    :initial-count-likes='@json($recipe->count_likes)' :authorized='@json(Auth::check())'
                    endpoint="{{ route('recipes.like', ['recipe' => $recipe]) }}">
                </recipe-like>
                <recipe-comment :initial-is-liked-by='@json($recipe->isLikedBy(Auth::user()))'
                    :initial-count-likes='@json($recipe->count_likes)' :authorized='@json(Auth::check())'
                    endpoint="{{ route('recipes.like', ['recipe' => $recipe]) }}">
                </recipe-comment>
                <recipe-save class="ms-auto" :initial-is-saved='@json($recipe->isSavedBy(Auth::user()))'
                    :authorized='@json(Auth::check())' endpoint="{{ route('recipes.save', ['recipe' => $recipe]) }}">
                </recipe-save>
            </div>
            {{-- comment list --}}
            @foreach ($recipe->comments as $comment)
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
            @endforeach
            {{-- end comment list --}}
            {{-- <form>
                <div class="comment-box d-flex mt-3">
                    <input class="recipe-comment" type="text" class="form-control" ref="userComment" id="userComment"
                        placeholder="コメントをする">
                    <button type="submit" class="comment-btn btn btn-primary btn-lg"><i
                            class="fas fa-paper-plane"></i></button>
                </div>
            </form> --}}
            <comment-box :authorized='@json(Auth::check())' endpoint="{{ route('recipes.comment', ['recipe' => $recipe]) }}"
            ></comment-box>
        </div>
    </div>
@endsection
