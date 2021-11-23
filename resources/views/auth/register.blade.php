@extends('app')

@section('title', 'ユーザー登録')

@section('content')
    <div class="container">
        <div class="row">
            <div class="mx-auto col col-12">
                <h1 class="text-center"><a class="text-dark" href="/" style="text-decoration: none;">レシピSNS</a></h1>
                <h6 class="text-center">レシピ・調理方法を共有ウェブサイト</h6>
                <div class="d-flex justify-content-center">
                  <div class="mx-auto" style="width: 30%; height:30%">
                    <img src="{{ asset('images/login.png') }}" 
                        alt="">
                    </div>
                    <div class="mx-auto card mt-5 " style="width: 50%;">
                        <div class="card-body">
                            <h2 class="h3 text-center mt-4">ユーザー登録</h2>
                            @include('error_card_list')
                            <div class="card-text">
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <div class="md-form row mt-4">
                                        <label class="col-sm-2 col-form-label " for="name">ユーザー名</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" id="name" name="name" required
                                                value="{{ old('name') }}">
                                        </div>
                                        <div class="col-sm-10 mt-1 text-center"><small>英数字3〜16文字(登録後の変更はできません)</small></div>
                                    </div>
                                    <div class="md-form row mt-3">
                                        <label class="col-sm-2 col-form-label" for="email">メール</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" id="email" name="email" required
                                                value="{{ old('email') }}">
                                        </div>
                                    </div>
                                    <div class="md-form row mt-3">
                                        <label class="col-sm-2 col-form-label" for="password">パスワード</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="password" id="password" name="password"
                                                required>
                                        </div>
                                    </div>
                                    <div class="md-form row mt-3 mb-3">
                                        <label class="col-sm-2 col-form-label" for="password_confirmation">パスワード(確認)</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="password" id="password_confirmation"
                                                name="password_confirmation" required>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                    <button class="btn btn-block btn-secondary mb-2" type="submit">ユーザー登録</button>
                                    </div>
                                </form>
                                <div class="mt-2 mb-5 text-center">
                                    アカウントをお持ち。ログインは<a href="{{ route('login') }}" class="card-text">こちら</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
