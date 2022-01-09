<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Admin</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/manager.css') }}">

</head>

<body>
    <header class="p-3 border-bottom bg-light">
        <div class="container-fluid">
            <div class="d-flex align-items-center justify-content-center justify-content-lg-start">
                <a href="/" class="header__home">
                    <img src="{{ asset('images/logo.png') }}" style="height: 60px;" alt="">
                </a>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                </ul>

                <div class="dropdown text-end">
                    <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ Auth::user()->avatar ?? asset('images/default-user.png') }}" alt="mdo" width="32"
                            height="32" class="rounded-circle">
                    </a>
                    <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
                        <li><a class="dropdown-item"
                                href="{{ route('profile.index', ['name' => Auth::user()->name]) }}">プロフィール</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        @if (Auth::check())
                            <form method="POST" id="form-logout" action="{{ route('logout') }}">
                                @csrf
                                <li><a class="dropdown-item logout-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                            this.closest('form').submit();">ログアウト</a></li>
                            </form>
                        @endif
                    </ul>
                </div>
            </div>

    </header>
    {{-- Sidebar --}}
    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-dark text-light vh-100 sidebar collapse"
                style="height: auto !important;">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column" style="font-size: 14px;">
                        <li class="nav-item">
                            <a class="nav-link text-light" aria-current="page" href="#">
                                <span data-feather="home"></span>
                                ユーザー管理
                            </a>
                        </li>
                        <hr>
                        <li class="nav-item">
                            <a class="nav-link text-light" href="/">
                                <span data-feather="file"></span>
                                ユーザー向けのサイトへ
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            @yield('content')
            
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>
