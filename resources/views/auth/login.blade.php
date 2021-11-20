@extends('app')

@section('title', 'ログイン')

@section('content')
    <div class="container">
        <div class="row">
            <div class="mx-auto col col-12">
                <h1 class="text-center"><a class="text-dark" 　style="text-decoration: none;" href="/">レシピSNS</a></h1>
                <h6 class="text-center">レシピ・調理方法を共有ウェブサイト</h6>
                <div class="d-flex justify-content-center">
                    <div class="mx-auto" style="width: 30%; height:30%">
                        <img src="{{ asset('images/login.png') }}" alt="">
                    </div>
                    <div class="mx-auto card mt-5" style="width: 50%;">
                        <div class="card-body">
                            <h2 class="h3 card-title text-center mt-4">ログイン</h2>
                            @include('error_card_list')
                            <div class="card-text ">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="md-form row mt-4 ">
                                        <label class="col-sm-2 col-form-label " for="email">メール</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" id="email" name="email" required>
                                        </div>
                                    </div>
                                    <div class="md-form row mt-3 mb-3">
                                        <label class="col-sm-2 col-form-label" for="password">パスワード</label>
                                        <div class="col-sm-10">

                                            <input class="form-control" type="password" id="password" name="password"
                                                required>
                                        </div>
                                    </div>
                                    <input type="hidden" name="remember" id="remember" value="on">
                                    {{-- <div class="text-left">
                                        <a href="{{ route('password.request') }}" class="card-text">パスワードを忘れた方</a>
                                    </div> --}}
                                    <div class="text-center">
                                        <button class="btn btn-block btn-secondary mb-2 " type="submit">ログイン</button>
                                    </div>
                                </form>
                                <div class="mt-2 mb-5 text-center">
                                    アカウントをお持ちでない。ユーザー登録は<a href="{{ route('register') }}" class="card-text">こちら</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
