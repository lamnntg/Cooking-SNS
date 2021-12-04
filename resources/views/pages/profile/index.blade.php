@extends('app')

@section('title', 'プロフィル')

@section('content')
    @include('layout.header')
    <div class="container">
        @include('users.user')
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
                <img style="width: 200px; height: 200px; object-fit: cover;" src="{{ $user->avatar ?? asset('images/default-user.png') }}"
                    alt="User Picture">
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

                        <form method="POST" action="{{ route("profile.update") }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row d-flex justify-content-center">
                                <div class="profile-button-in-recipe-card" style="width: 75px">
                                    <div class="profile-button-in-recipe-card__border"></div>
                                    <div class="profile-button-in-recipe-card__picture">
                                        <img id="avatar" type="image" src="{{ asset('images/default-user.png') }}"
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
