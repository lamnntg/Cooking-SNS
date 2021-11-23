@extends('app')

@section('title', $user->name . 'のいいねした記事')

@section('content')
  @include('nav')
  <div class="container">
    @include('users.user')
    @include('users.tabs', ['hasRecipes' => false, 'hasLikes' => true])
    @foreach($recipes as $recipe)
      @include('recipes.card')
    @endforeach
  </div>
@endsection
