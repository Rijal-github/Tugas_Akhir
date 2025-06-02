<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;

class AuthControllerphp extends Controller
{
    public function login(Request $request)
    {

        $credentials = $request->only('email', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json([
                'code' => 401,
                'status' => false,
                'message' => 'Login failed, invalid credentials',
            ], 401);
        }

        // $token = JWTAuth::fromUser($user);

        return response()->json([
            'code' => 200,
            'status' => true,
            'message' => 'Login successful',
            'data' => [
                'token' => $token,
                'user' => Auth::user(),
            ]
        ]);
    }
}
