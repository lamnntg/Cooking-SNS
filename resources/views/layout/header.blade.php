<header class="header">
    <nav class="header__content">
        <div class="header__buttons">
            <a href="/" class="header__home">
                <img src="{{ asset('images/logo.png') }}" style="height: 60px;"  alt="">
            </a>
        </div>

        <div class="header__search" style="width: 300px">
            <input type="text" placeholder="レシピ検索" id="searchInput" value="{{ $search ?? null }}">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M21.669 21.6543C21.8625 21.4622 21.863 21.1494 21.6703 20.9566L17.3049 16.5913C18.7912 14.9327 19.7017 12.7525 19.7017 10.3508C19.7017 5.18819 15.5135 1 10.3508 1C5.18819 1 1 5.18819 1 10.3508C1 15.5135 5.18819 19.7017 10.3508 19.7017C12.7624 19.7017 14.9475 18.7813 16.606 17.2852L20.9739 21.653C21.1657 21.8449 21.4765 21.8454 21.669 21.6543ZM1.9843 10.3508C1.9843 5.7394 5.7394 1.9843 10.3508 1.9843C14.9623 1.9843 18.7174 5.7394 18.7174 10.3508C18.7174 14.9623 14.9623 18.7174 10.3508 18.7174C5.7394 18.7174 1.9843 14.9623 1.9843 10.3508Z"
                    fill="#A5A5A5" stroke="#A5A5A5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </div>
        <div>
            <a class="header-button-text" href="{{ route('users.show', ['name' => Auth::user()->name]) }}">個人ページ</a></button>
        </div>
        <div>
            <a class="header-button-text "href="{{ route('users.saves', ['name' => Auth::user()->name]) }}">保存したレシピ</a>
        </div>

        <div class="header__buttons header__buttons--desktop">
            <div class="dropdown">
                <button id="dropdownMenuNoti" data-bs-toggle="dropdown" aria-expanded="false" style="border: none; background-color: transparent;">
                    <i class="fas fa-bell"></i>
                </button>     
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuNoti">
                    <li><a class="dropdown-item "href="/">お知らせ１</a></li>
                    <li><a class="dropdown-item "href="/">お知ら２</a></li>
                    <li><a class="dropdown-item "href="/">お知ら３</a></li>
                </ul>
            </div>
        </div>

        <div class="header__buttons header__buttons--desktop">
            <div class="dropdown">
                <button class="profile-button" id="dropdownMenuUser" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="profile-button__border"></div>
                    <div class="profile-button__picture">
                        <img src="{{ Auth::user()->avatar ?? asset('images/default-user.png') }}" alt="User Picture">
                    </div>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuUser">
                    <li><a class="dropdown-item" href="{{ route('profile.index', ['name' => Auth::user()->name]) }}">プロフィール</a></li>
                    @if (Auth::user()->is_admin)
                        <li><a class="dropdown-item" href="{{ route('manager.index') }}">管理ページ</a></li>
                    @endif
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
    </nav>
</header>
