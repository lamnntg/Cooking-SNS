@extends('app')

@section('title', $user->name . 'の保存されたレシピ')

@section('content')
    @include('layout.header')
    <div class="container">
        @if (count($recipes) == 0)
            <div class="fs-4 text-center">まだレシピを保存していません。</div>
        @endif
        @foreach ($recipes as $recipe)
            @include('recipes.card')
        @endforeach
    </div>
@endsection
