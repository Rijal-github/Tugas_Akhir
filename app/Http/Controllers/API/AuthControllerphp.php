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
        $credentials = $request->only('username', 'password');

        $user = User::where('username', $credentials['username'])->first();

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json([
                'code' => 401,
                'status' => false,
                'message' => 'Login failed, invalid credentials',
            ], 401);
        }

        // $user = Auth::user();
        // $user->load('uptds');
        $user = User::with('uptds')->find(Auth::id());


        // Struktur respons tergantung role (non-UPTD vs UPTD)
        $userData = [
            'id' => $user->id,
            'nama' => $user->name,
            'email' => $user->email,
            'username' => $user->username,
            'id_role' => $user->id_role,
            'role' => $user->role->name ?? 'Unknown', // pastikan relasi role tersedia
            'addres' => $user->addres ?? '-',
            'created_at' => $user->created_at,
            'updated_at' => $user->updated_at,
        ];

        // Jika user adalah UPTD (misal role_id = 2), tambahkan info uptd
        if ($user->role_id == 3 || $user->id_role == 7) { // jika peran uptd / kepala uptd
            $uptd = $user->uptds()->first(); // ambil satu saja
        
            if ($uptd) {
                $userData['id_uptd'] = $uptd->id_uptd;
                $userData['nama_uptd'] = $uptd->nama_uptd;
            }
        }
        // if ($user->role_id == 3 && $user->id_uptd) {
        //     $userData['id_uptd'] = $user->id_uptd;
        //     $userData['nama_uptd'] = $user->uptd->name ?? 'Unknown'; // pastikan relasi uptd tersedia
        // }

        return response()->json([
            'code' => 200,
            'status' => true,
            'message' => 'Login successful',
            'data' => [
                'token' => $token,
                'user' => $userData,
            ]
        ]);
    }
}

// $credentials = $request->only('name', 'password');

// if (!$token = JWTAuth::attempt($credentials)) {
//     return response()->json([
//         'code' => 401,
//         'status' => false,
//         'message' => 'Login failed, invalid credentials',
//     ], 401);
// }

// // $token = JWTAuth::fromUser($user);

// return response()->json([
//     'code' => 200,
//     'status' => true,
//     'message' => 'Login successful',
//     'data' => [
//         'token' => $token,
//         'user' => Auth::user(),
//     ]
// ]);