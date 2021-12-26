<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
                $user->update(['status' => 0]);
            } catch (\Throwable $th) {
                throw $th;
            }
        }
        return redirect()->back();
    }

    public function deleteUser(int $userId)
    {
        if ($userId != Auth()->user()->id) {
            $user = User::findOrFail($userId);

            return redirect()->back();

            try {
                $user->delete();
            } catch (\Throwable $th) {
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
