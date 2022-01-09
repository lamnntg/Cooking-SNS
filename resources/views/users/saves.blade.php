@extends('app')

@section('title', $user->name . 'の保存されたレシピ')

@section('content')
    @include('layout.header')
    <div class="container saves-content">
        @if (count($recipes) == 0)
            <div class="fs-4 text-center">まだレシピを保存していません。</div>
        @endif
        @foreach ($recipes as $recipe)
            <div class="card mt-3 recipe-card">
                <div class="card-header d-flex recipe-header">
                    <h4 class="card-title text-capitalize recipe-title">
                        {{ $recipe->title }}
                    </h4>
                    @if (Auth::id() !== $recipe->user_id)
                        <recipe-save class="ms-auto" :initial-is-saved='@json($recipe->isSavedBy(Auth::user()))'
                            :authorized='@json(Auth::check())'
                            endpoint="{{ route('recipes.save', ['recipe' => $recipe]) }}">
                        </recipe-save>
                    @endif

                </div>
                <div class="card-body">
                    <div class="d-flex">
                        <a href="{{ route('users.show', ['name' => $recipe->user->name]) }}" class="text-dark">
                            <div class="profile-button-in-recipe-card">
                                <div class="profile-button-in-recipe-card__border"></div>
                                <div class="profile-button-in-recipe-card__picture">
                                    <img src="{{ $recipe->user->avatar ?? asset('images/default-user.png') }}" alt="User Picture">
                                </div>
                            </div>
                        </a>
                        <div class="ms-3 p-2">
                            <div class="fw-bold">
                                <a style="text-decoration: none"
                                    href="{{ route('users.show', ['name' => $recipe->user->name]) }}"
                                    class="text-dark">
                                    {{ $recipe->user->name }}
                                </a>
                            </div>
                            <div class="fw-lighter">
                                {{ $recipe->created_at->format('Y/m/d H:i') }}
                            </div>
                        </div>
                    </div>
                </div>
                @if ($recipe->image)
                    <img src="{{ $recipe->image }}"
                        class="card-img mt-3" alt="recipe image">
                @endif
                <div class="card-body">
                    <p class="card-text mt-3 recipe-content">
                        {!! nl2br(e($recipe->description)) !!}
                    </p>
                </div>
                <div class="card-footer">
                    <a style="text-decoration: none; color:#000" class="float-end mt-3 mb-3 mr-3"
                        href="{{ route('recipes.show', ['recipe' => $recipe]) }}">
                        続きを読む
                        <i class="fas fa-angle-double-right"></i>
                    </a>
                </div>
            </div>

        @endforeach
    </div>
@endsection
