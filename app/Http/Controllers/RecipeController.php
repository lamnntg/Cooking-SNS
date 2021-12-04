<?php

namespace App\Http\Controllers;

use App\Follow;
use App\Recipe;
use App\User;
use App\Tag;
use App\Http\Requests\RecipeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class RecipeController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Recipe::class, 'recipe');
    }

    public function index(Request $request)
    {
        $userId = Auth::user()->id;

        $recipesQuery = Recipe::query();

        if ($request->has('search')) {
            $recipesQuery->where('title', 'like', '%' . $request->get('search') . '%');
        }
        $recipes = $recipesQuery->orderBy('created_at', 'desc')->take(20)->get()
            ->load(['user', 'likes', 'tags']);

        //folow
        $followedUserId = Follow::where('follower_id', $userId)->pluck('user_id');

        $users = User::where('id', '!=', $userId)
            ->WhereNotIn('id', $followedUserId)
            ->take(8)->get();

        return view('recipes.index', [
            'recipes' => $recipes, 'suggest_users' => $users, 'search' => $request->get('search')
        ]);
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

    public function store(RecipeRequest $request)
    {
        $userId = Auth::user()->id;

        // DB::beginTransaction();
        // try {
            $hash = str_replace("/", "", \Hash::make(now()));

            $path = sprintf('%s/%s', Recipe::IMAGE_FOLDER, $userId);
            $imagePath = Storage::disk('public')->putFileAs($path, $request->image, $hash . '.png');

            $recipe = Recipe::create([
                'user_id' => $userId,
                'title' => $request->title,
                'description' => $request->body,
                'image' => $imagePath ? asset('storage/' . $imagePath) : null,
            ]);
        // } catch (\Exception $e) {
        //     DB::rollback();
        // }

        if ($request->has('tags')) {
            $request->tags->each(function ($tagName) use ($recipe) {
                $tag = Tag::firstOrCreate(['name' => $tagName]);
                $recipe->tags()->attach($tag);
            });
        }

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
        //TODO: check if update fail
        $recipe->update([
            'title' => $request->title,
            'description' => $request->body,
        ]);

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

    public function save(Request $request, Recipe $recipe)
    {
        $recipe->saves()->detach($request->user()->id);
        $recipe->saves()->attach($request->user()->id);

        return [
            'id' => $recipe->id
        ];
    }

    public function unSave(Request $request, Recipe $recipe)
    {
        $recipe->saves()->detach($request->user()->id);

        return [
            'id' => $recipe->id,
        ];
    }

    public function comment(Request $request, Recipe $recipe)
    {
        DB::table('comments')->create([
            'recipe_id' => $recipe->id,
            'user_id' => $request->user()->id,
            'content' => $request->content,
        ]);

        return [
            'id' => $recipe->id,
        ];
    }
}
