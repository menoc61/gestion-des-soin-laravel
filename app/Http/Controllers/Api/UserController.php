<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register(Request $request)
    {
    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response([
                'message' => 'données non correctes',
            ]);
        }
        $user = Auth::user();

        return response([
            $user = Auth::user(),
        ]);
    }

    public function all()
    {
        try {
            return response()->json([
                'data' => User::all(),
            ]);
        } catch (\Exception $e) {
            return response()->json($e);
        }
    }
}
