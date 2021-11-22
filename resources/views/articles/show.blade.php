@extends('app')

@section('title', '記事詳細')

@section('content')
    @include('layout.header')
    <div class="container">
        {{-- @include('articles.card') --}}
        <div class="card mt-3">
            <div class="card-header d-flex">
                <h3 class="card-title text-capitalize">
                    {{ $article->title }}
                </h3>
                @if (Auth::id() === $article->user_id)
                    <!-- dropdown -->
                    <div class="ms-auto card-text">
                        <div class="dropdown">
                            <a data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <button type="button" class="btn btn-link text-muted m-0 p-2">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="{{ route('articles.edit', ['article' => $article]) }}">
                                    <i class="fas fa-pen mr-1"></i>記事を更新する
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" data-bs-toggle="modal"
                                    data-bs-target="#modal-delete-{{ $article->id }}">
                                    <i class="fas fa-trash-alt mr-1"></i>記事を削除する
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- dropdown -->

                    <!-- modal -->
                    <div id="modal-delete-{{ $article->id }}" class="modal fade" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title fw-bold">削除確認</h6>
                                    <button type="button" class="btn close ms-auto" data-bs-dismiss="modal"
                                        aria-label="閉じる">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="POST" action="{{ route('articles.destroy', ['article' => $article]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-body">
                                        {{ $article->title }}を削除します。よろしいですか？
                                    </div>
                                    <div class="modal-footer flex-end">
                                        <a class="btn btn-outline-secondary" data-bs-dismiss="modal">キャンセル</a>
                                        <button type="submit" class="btn btn-danger">削除する</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- modal -->
                @else
                    <article-save class="ms-auto" :authorized='@json(Auth::check())'>
                    </article-save>
                @endif
            </div>
            <div class="card-body">
                <div class="d-flex">
                    <a href="{{ route('users.show', ['name' => $article->user->name]) }}" class="text-dark">
                        <i class="fas fa-user-circle fa-3x mr-1"></i>
                    </a>
                    <div class="ms-3">
                        <div class="fw-bold">
                            <a href="{{ route('users.show', ['name' => $article->user->name]) }}" class="text-dark">
                                {{ $article->user->name }}
                            </a>
                        </div>
                        <div class="fw-lighter">
                            {{ $article->created_at->format('Y/m/d H:i') }}
                        </div>
                    </div>

                    @if (Auth::id() !== $article->user_id)
                        <follow-button class="ms-auto"
                            :initial-is-followed-by='@json($article->user->isFollowedBy(Auth::user()))'
                            :authorized='@json(Auth::check())'
                            endpoint="{{ route('users.follow', ['name' => $article->user->name]) }}">
                        </follow-button>
                    @endif
                </div>
            </div>
            <img src="https://www.cscassets.com/recipes/wide_cknew/wide_24738.jpg" class="card-img mt-3"
                alt="recipe image">
            <div class="card-body">
                <p class="card-text mt-3">
                    {!! nl2br(e($article->body)) !!}
                </p>
                @if (count($article->tags) > 0)
                    <label for="">タグ：</label>
                    @foreach ($article->tags as $tag)
                        {{-- @if ($loop->first) --}}
                        <a href="{{ route('tags.show', ['name' => $tag->name]) }}"
                            class="border p-1 me-1 mt-1 text-muted">
                            {{ $tag->hashtag }}
                        </a>
                        {{-- @endif
              @if ($loop->last)
              @endif --}}
                    @endforeach
                @endif
            </div>
            <div class="card-footer">
                <article-like :initial-is-liked-by='@json($article->isLikedBy(Auth::user()))'
                    :initial-count-likes='@json($article->count_likes)' :authorized='@json(Auth::check())'
                    endpoint="{{ route('articles.like', ['article' => $article]) }}">
                </article-like>

            </div>
            <div class="card-body">
                {{-- comment list --}}
                <div class="d-flex my-2 align-items-start">
                    <a href="{{ route('users.show', ['name' => $article->user->name]) }}" class="text-dark">
                        <i class="fas fa-user-circle fa-2x"></i>
                    </a>
                    <div class="ms-2 flex-fill">
                        <a href="{{ route('users.show', ['name' => $article->user->name]) }}" class="text-dark fw-bold">
                            {{ $article->user->name }}
                        </a>
                        <span class="ms-2">ii desune</span>
                    </div>
                </div>
                {{-- comment list --}}
                <form>
                    <div class="mb-3 d-flex">
                        <input type="text" class="form-control" id="userComment" placeholder="コメントをする">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
