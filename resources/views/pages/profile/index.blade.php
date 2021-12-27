@extends('app')

@section('title', 'プロフィル')

@section('content')
    @include('layout.header')
    <div class="container">
        <div class="card mt-5">
            <div class="d-flex justify-content-around mt-3">
                <div class="card-body ">
                    <div class="d-flex flex-column" style="align-items: center">
                        <div>
                            <a href="{{ route('users.show', ['name' => $user->name]) }}" class="text-dark">
                                <div class="profile-button-in-recipe-card">
                                    <div class="profile-button-in-recipe-card__border"></div>
                                    <div class="profile-button-in-recipe-card__picture">
                                        <img src="{{ $user->avatar ?? asset('images/default-user.png') }}"
                                            alt="User Picture">
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
                            <a href="#"
                                class="text-dark text-decoration-none {{ count($followings) == 0 ? 'disabled' : '' }}"
                                data-bs-toggle="modal" data-bs-target="#followingModal">
                                {{ $user->count_followings }} フォロー
                            </a>
                            {{-- Follwings Modal --}}
                            <div class="modal fade" id="followingModal" tabindex="-1"
                                aria-labelledby="followingModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title " id="followingModalLabel">フォロー</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            @foreach ($followings as $person)
                                                @include('users.person')
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="mt-3">
                            <a href="#"
                                class="text-dark text-decoration-none {{ count($followers) == 0 ? 'disabled' : '' }}"
                                disabled data-bs-toggle="modal" data-bs-target="#followerModal">
                                {{ $user->count_followers }} フォロワー
                            </a>
                            {{-- Followers Modal --}}
                            <div class="modal fade" id="followerModal" tabindex="-1"
                                aria-labelledby="followerModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title " id="followerModalLabel">フォロワー</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            @foreach ($followers as $person)
                                                @include('users.person')
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <ul class="nav nav-tabs nav-justified mt-3">
                <li class="nav-item">
                    <a style="text-decoration: none;" class="text-dark" href="/">
                        個人情報
                    </a>
                </li>
            </ul>
        </div>

        <div class="d-flex justify-content-center row mt-5">
            <div class="col-4" style="text-align:center">
                <img style="width: 200px; height: 200px; object-fit: cover;"
                    src="{{ $user->avatar ?? asset('images/default-user.png') }}" alt="User Picture">
            </div>
            <div class="col-8">
                <form>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">ニックネーム</label>
                        <div class="col-10">
                            <input type="text" readonly class="form-control-plaintext" value={{ $user->name }}>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">メール</label>
                        <div class="col-10">
                            <input type="text" readonly class="form-control-plaintext" value={{ $user->email }}>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">パスワード</label>
                        <div class="col-10">
                            <input type="password" readonly class="form-control-plaintext" value="********">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <button class="btn btn-outline-secondary mx-auto mt-3" style="width: 200px;" data-bs-toggle="modal"
                data-bs-target="#editProfileModal"> プロファイル編集 </button>
        </div>
        <!-- Edit Profile Modal -->
        <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="editProfileModalLabel">プロファイル編集</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @include('error_card_list')

                        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row d-flex justify-content-center">
                                <div class="profile-button-in-recipe-card" style="width: 75px">
                                    <div class="profile-button-in-recipe-card__border"></div>
                                    <div class="profile-button-in-recipe-card__picture">
                                        <img id="avatar" type="image"
                                            src="{{ $user->avatar ?? asset('images/default-user.png') }}"
                                            alt="User Picture" width="50px">
                                        <input id="avatar-input" type="file" name="image"
                                            accept="image/png, image/gif, image/jpeg" style="display: none;">
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center mt-3">
                                アバター編集
                            </div>

                            <div class="form-group row mt-3">
                                <label class="col-2 col-form-label">ニックネーム</label>
                                <div class="col-10">
                                    <input name="name" type="text" class="form-control" value={{ $user->name }}>
                                </div>
                            </div>

                            <div class="form-group row mt-3">
                                <label class="col-2 col-form-label">メール</label>
                                <div class="col-10">
                                    <input type="text" readonly class="form-control" value={{ $user->email }}>
                                </div>
                            </div>
                            <div class="form-group row mt-3">
                                <label class="col-2 col-form-label">パスワード</label>
                                <div class="col-10">
                                    <input name="newPassword" type="password" class="form-control" value="">
                                </div>
                            </div>

                            <button type="submit" class="btn float-end mt-3 btn-outline-secondary">投稿する</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <!-- End Edit Profile Modal -->
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/app/edit.js') }}"></script>
@endpush
