<?php

namespace App\Http\Controllers;

use App\Recipe;
use App\Tag;
use App\Http\Requests\RecipeRequest;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Recipe::class, 'recipe');
    }

    public function index()
    {
        $recipes = Recipe::all()->sortByDesc('created_at')
            ->load(['user', 'likes', 'tags']);

        return view('recipes.index', ['recipes' => $recipes]);
    }

    public function create()
    {
        $allTagNames = Tag::all()->map(function ($tag) {
            return ['text' => $tag->name];
        });

        return view('recipes.create', [
            'allTagNames' => $allTagNames,
        ]);
    }

    public function store(RecipeRequest $request, Recipe $recipe)
    {
        $recipe->fill($request->all());
        $recipe->user_id = $request->user()->id;
        $recipe->save();

        $request->tags->each(function ($tagName) use ($recipe) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $recipe->tags()->attach($tag);
        });

        return redirect()->route('recipes.index');
    }

    public function edit(Recipe $recipe)
    {
        $tagNames = $recipe->tags->map(function ($tag) {
            return ['text' => $tag->name];
        });

        $allTagNames = Tag::all()->map(function ($tag) {
            return ['text' => $tag->name];
        });

        return view('recipes.edit', [
            'recipe' => $recipe,
            'tagNames' => $tagNames,
            'allTagNames' => $allTagNames,
        ]);
    }

    public function update(RecipeRequest $request, Recipe $recipe)
    {
        $recipe->fill($request->all())->save();

        $recipe->tags()->detach();
        $request->tags->each(function ($tagName) use ($recipe) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $recipe->tags()->attach($tag);
        });

        return redirect()->route('recipes.index');
    }

    public function destroy(Recipe $recipe)
    {
        $recipe->delete();
        return redirect()->route('recipes.index');
    }

    public function show(Recipe $recipe)
    {
        return view('recipes.show', ['recipe' => $recipe]);
    }

    public function like(Request $request, Recipe $recipe)
    {
        $recipe->likes()->detach($request->user()->id);
        $recipe->likes()->attach($request->user()->id);

        return [
            'id' => $recipe->id,
            'countLikes' => $recipe->count_likes,
        ];
    }

    public function unlike(Request $request, Recipe $recipe)
    {
        $recipe->likes()->detach($request->user()->id);

        return [
            'id' => $recipe->id,
            'countLikes' => $recipe->count_likes,
        ];
    }
}
