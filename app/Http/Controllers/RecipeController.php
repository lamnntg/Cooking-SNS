<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Follow;
use App\Recipe;
use App\User;
use App\Tag;
use App\Http\Requests\RecipeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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

        $recipesQuery = Recipe::with(['user', 'tags', 'comments'])
            ->where('user_id', '!=', $userId)
            ->orderBy('created_at', 'desc');

        if ($request->has('search')) {
            $recipesQuery->where('title', 'like', '%' . $request->get('search') . '%');
        }
        $recipes = $recipesQuery->paginate(5);

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
        if ($request->hasFile('image')) {
            $image = base64_encode(file_get_contents($request->image));
            $imagePath = 'data:image/png;base64, ' . ' ' . $image;
            // dd($imageCode);
            // $hash = str_replace("/", "", \Hash::make(now()));
            // $path = sprintf('%s/%s', Recipe::IMAGE_FOLDER, $userId);
            // $imagePath = Storage::disk('public')->putFileAs($path, $request->image, $hash . '.png');
        }

        $recipe = Recipe::create([
            'user_id' => $userId,
            'title' => $request->title,
            'description' => $request->body,
            'image' => $imagePath ?? null,
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
        if ($request->hasFile('image')) {
            $image = base64_encode(file_get_contents($request->image));
            $imagePath = 'data:image/png;base64, ' . ' ' . $image;
            // $hash = str_replace("/", "", Hash::make(now()));
            // $path = sprintf('%s/%s', Recipe::IMAGE_FOLDER, Auth::user()->id);
            // $imagePath = Storage::disk('public')->putFileAs($path, $request->image, $hash . '.png');
        }

        $recipe->update([
            'title' => $request->title,
            'description' => $request->body,
            'image' => isset($imagePath) ? $imagePath : $recipe->image,
        ]);

        $recipe->tags()->detach();
        $request->tags->each(function ($tagName) use ($recipe) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $recipe->tags()->attach($tag);
        });

        return redirect()->back();
    }

    public function destroy(Recipe $recipe)
    {
        $recipe->delete();
        return redirect()->route('recipes.index');
    }

    public function show(Recipe $recipe)
    {
        $comments = Comment::with('user')->where('recipe_id', $recipe->id)->orderBy('created_at', 'desc')->get();

        return view('recipes.show', ['recipe' => $recipe, 'comments' => $comments]);
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

    public function comment(Request $request, int $recipeId)
    {
        if ($request->ajax()) {
            $comment = Comment::create([
                'recipe_id' => $recipeId,
                'user_id' => Auth::user()->id,
                'content' => $request->content,
            ]);

            if ($comment) {
                $commentView = view('recipes.comment-render', compact('comment'))->render();
                return response()->json(['result' => $commentView], 200);
            }

            return response()->json(['result' => false], 500);
        }
    }
}
