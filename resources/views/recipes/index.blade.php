@extends('app')

@section('title', '記事一覧')

@section('content')
    @include('layout.header')
    <div class="container">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-secondary mb-3" data-bs-toggle="modal" data-bs-target="#createRecipeModal">
            レシピを共有しますか？
        </button>

        <!-- Modal -->
        <div class="modal fade" id="createRecipeModal" tabindex="-1" aria-labelledby="createRecipeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="createRecipeModalLabel">レシピ作成</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @include('error_card_list')
                        <form method="POST" action="{{ route('recipes.store') }}">
                            @include('recipes.form')
                            <button type="submit" class="btn btn-primary float-end mt-3">投稿する</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @foreach ($recipes as $recipe)
            @include('recipes.card')
        @endforeach

    </div>
@endsection
