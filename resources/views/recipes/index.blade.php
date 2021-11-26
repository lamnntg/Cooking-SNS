@extends('app')

@section('title', 'ホームページ')

@section('content')
    @include('layout.header')
    <div class="container home-container">
        <div class="d-flex">
            <div class="p-4 w-100 home-content">
                <!-- Button trigger modal -->

                <div class="card recipe-card">
                    <div class="card-body d-flex p-2">
                        <div class="profile-button-in-create-btn p-3">
                            <div class="profile-button-in-create-btn__border"></div>
                            <div class="profile-button-in-create-btn__picture">
                                <img src="{{ asset('images/default-user.png') }}" alt="User Picture">
                            </div>
                        </div>
                        <div class="w-100 p-2 mt-3">
                            <button type="button" class="btn create-button mb-3 text-left" data-bs-toggle="modal"
                                data-bs-target="#createRecipeModal">
                                <span>レシピを共有しますか？ {{ Auth::user()->name }}</span>
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
                                <form method="POST" action="{{ route('recipes.store') }}">
                                    @include('recipes.form')
                                    <button type="submit" class="btn create-submit-btn float-end mt-3">投稿する</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Create Modal -->

                @foreach ($recipes as $recipe)
                    @include('recipes.card')
                @endforeach

            </div>
            <div class="p-4 flex-shrink-1">
                <div class="side-menu__suggestions-section">
                    <div class="side-menu__suggestions-header">
                        <h2>Suggestions for You</h2>
                        {{-- <button>See All</button> --}}
                    </div>
                    @foreach ($suggest_users as $suggest_user)
                        <div class="side-menu__suggestions-content">
                            <div class="side-menu__suggestion">
                                <a href="#" class="side-menu__suggestion-avatar">
                                    <img src="{{ asset('images/default-user.png') }}" alt="User Picture">
                                </a>
                                <div class="side-menu__suggestion-info">
                                    <a href="#">{{ $suggest_user->name }}</a>
                                </div>
                                <button class="side-menu__suggestion-button">Follow</button>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{-- {{dd($suggest_users)}} --}}
                <div class="side-menu__footer">
                    <div class="side-menu__footer-links">
                        <ul class="side-menu__footer-list">
                            <li class="side-menu__footer-item">
                                <a class="side-menu__footer-link" href="#">About</a>
                            </li>
                            <li class="side-menu__footer-item">
                                <a class="side-menu__footer-link" href="#">Help</a>
                            </li>
                        </ul>
                    </div>

                    <span class="side-menu__footer-copyright">&copy; 2021 Recipes SNS from TorikoCookTeam</span>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/app/home.js') }}"></script>
@endpush
