<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ManagerController extends Controller
{
    public function user()
    {
        $users = User::all();

        return view('manager.users', compact('users'));
    }

    public function blockUser(int $userId)
    {
        if ($userId != Auth()->user()->id) {

            $user = User::findOrFail($userId);

            try {
                $status = $user->status;
                $user->update(['status' => !$status]);
            } catch (\Throwable $th) {
                throw $th;
            }
        }
        return redirect()->back();
    }

    public function deleteUser(int $userId)
    {
        if ($userId != Auth()->user()->id) {
            $user = User::with(['recipes'])->findOrFail($userId);
            DB::beginTransaction();
            try {
                DB::table('follows')->where('user_id', $user->id)
                    ->orWhere('follower_id', $user->id)
                    ->delete();

                $recipes = $user->recipes;
                foreach ($recipes as $recipe) {
                    DB::table('recipe_tag')->where('recipe_id', $recipe->id)->delete();

                    DB::table('comments')->where('user_id', $user->id)
                        ->orWhere('recipe_id', $recipe->id)
                        ->delete();

                    DB::table('saves')->where('user_id', $user->id)
                        ->orWhere('recipe_id', $recipe->id)
                        ->delete();
                }

                DB::table('recipes')->where('user_id', $user->id)->delete();

                $user->delete();
                DB::commit();
            } catch (\Throwable $th) {
                DB::rollback();
                throw $th;
            }
        }

        return redirect()->back();
    }

    public function becomeAdmin(Request $request, int $userId)
    {
        if ($request->filled('token') && $request->token == 'admin' && $userId == Auth()->user()->id) {
            $user = User::findOrFail($userId);

            try {
                $user->update(['is_admin' => 1]);
            } catch (\Throwable $th) {
                throw $th;
            }

            return response()->json(['message' => 'success']);
        }

        return response()->json(['message' => 'false']);
    }
}
