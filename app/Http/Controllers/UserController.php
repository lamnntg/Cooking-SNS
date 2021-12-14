<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function show(string $name)
    {
        $user = User::where('name', $name)->first()
            ->load(['recipes.user', 'recipes.likes', 'recipes.tags']);

        $recipes = $user->recipes->sortByDesc('created_at');

        return view('users.show', [
            'user' => $user,
            'recipes' => $recipes,
        ]);
    }

    public function likes(string $name)
    {
        $user = User::where('name', $name)->first()
            ->load(['likes.user', 'likes.likes', 'likes.tags']);

        $recipes = $user->likes->sortByDesc('created_at');

        return view('users.likes', [
            'user' => $user,
            'recipes' => $recipes,
        ]);
    }

    public function saves(string $name)
    {
        $user = User::where('name', $name)->first()
            ->load(['saves.user', 'saves.saves', 'saves.tags']);

        $recipes = $user->saves->sortByDesc('created_at');

        return view('users.saves', [
            'user' => $user,
            'recipes' => $recipes,
        ]);
    }

    public function followings(string $name)
    {
        $user = User::where('name', $name)->first()
            ->load('followings.followers');

        $followings = $user->followings->sortByDesc('created_at');

        return view('users.followings', [
            'user' => $user,
            'followings' => $followings,
        ]);
    }

    public function followers(string $name)
    {
        $user = User::where('name', $name)->first()
            ->load('followers.followers');

        $followers = $user->followers->sortByDesc('created_at');

        return view('users.followers', [
            'user' => $user,
            'followers' => $followers,
        ]);
    }

    public function follow(Request $request, string $name)
    {
        $user = User::where('name', $name)->first();

        if ($user->id === $request->user()->id)
        {
            return abort('404', 'Cannot follow yourself.');
        }

        $request->user()->followings()->detach($user);
        $request->user()->followings()->attach($user);

        return ['name' => $name];
    }

    public function unfollow(Request $request, string $name)
    {
        $user = User::where('name', $name)->first();

        if ($user->id === $request->user()->id)
        {
            return abort('404', 'Cannot follow yourself.');
        }

        $request->user()->followings()->detach($user);

        return ['name' => $name];
    }

    /**
     * profile function
     *
     * @return void
     */
    public function profile()
    {
        $userId = Auth::user()->id;
        $user = User::where('id', $userId)->first();
        return view('pages.profile.index', ['user' => $user]);
    }

    /**
     * updateProfile function
     *
     * @return void
     */
    public function updateProfile(Request $request)
    {
        //TODO: Validation
        $userId = Auth::user()->id;
        $user = User::findOrFail($userId);

        if ($request->hasFile('image')) {
            $image = base64_encode(file_get_contents($request->image));
            $imagePath = 'data:image/png;base64, ' . ' ' . $image;
            // $hash = str_replace("/", "", Hash::make(now()));
            // $path = sprintf('%s/%s', User::IMAGE_FOLDER, $userId);
            // $imagePath = Storage::disk('public')->putFileAs($path, $request->image, $hash . '.png');
        }

        $newUser = [
            'name' => $request->name ?? $user->name,
            'password' => $request->newPassword == null ? $user->password : Hash::make($request->newPassword),
            'avatar' => isset($imagePath) ? $imagePath : $user->avatar,
        ];
        //TODO Try catch
        $result = $user->update($newUser);

        return back();
    }
}
