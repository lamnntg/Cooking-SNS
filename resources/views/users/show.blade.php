@extends('app')

@section('title', $user->name)

@section('content')
  @include('layout.header')
  <div class="container">
    @include('users.user')
    @include('users.tabs', ['hasRecipes' => true, 'hasLikes' => false])
    @foreach($recipes as $recipe)
      @include('recipes.card')
    @endforeach
  </div>
@endsection
@push('scripts')
    <script src="{{ asset('js/app/form.js') }}"></script>
@endpush
