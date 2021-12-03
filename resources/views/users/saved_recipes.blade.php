@extends('app')

@section('title', $user->name . 'の保存されたレシピ')

@section('content')
    @include('layout.header')
    <div class="container">
        @foreach ($recipes as $recipe)
            @include('recipes.card')
        @endforeach
    </div>
@endsection
