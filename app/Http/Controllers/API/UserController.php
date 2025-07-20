<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function getAllUsers()
{
    $users = User::with('role')->get();

    $data = $users->map(function ($user) {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'role' => $user->role ? $user->role->name : null,
            'email' => $user->email,
            'username' => $user->username,
            'addres' => $user->addres,
            'no_hp' => $user->no_hp,
        ];
    });

    return response()->json([
        'code' => 200,
        'status' => true,
        'message' => 'Get All Users',
        'data' => $data
    ]);
}

public function getUserById($id)
{
    // $user = User::with('role')->where('id', $id)->first();
    $user = User::with('role')->find($id);



    if (!$user) {
        return response()->json([
            'code' => 404,
            'status' => false,
            'message' => 'User not found',
            'data' => null
        ]);
    }

    $data = [
        'id' => $user->id,
        'name' => $user->name,
        'email' => $user->email,
        'username' => $user->username,
        'id_role' => $user->id_role,
        'role' => $user->role ? $user->role->name : null,
        'addres' => $user->addres,
        'no_hp' => $user->no_hp,
    ];

    return response()->json([
        'code' => 200,
        'status' => true,
        'message' => 'Get User By Id',
        'data' => [$data]
    ]);
}

public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string',
        'id_role' => 'required|integer',
        'email' => 'required|email|unique:users,email',
        'username' => 'required|string',
        'addres' => 'required|string',
        'no_hp' => 'required|string',
        'password' => 'required|min:8'
    ]);

    $user = User::create([
        'name' => $validated['name'],
        'id_role' => $validated['id_role'],
        'email' => $validated['email'],
        'username' => $validated['username'],
        'addres' => $validated['addres'],
        'no_hp' => $validated['no_hp'],
        'password' => bcrypt($validated['password']),
    ]);

    return response()->json([
        'code' => 200,
        'status' => true,
        'message' => 'User Created Successfully',
        'data' => $user
    ]);
}

public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    $validated = $request->validate([
        'name' => 'required|string',
        'id_role' => 'required|integer',
        'email' => 'required|email|unique:users,email,'.$id,
        'username' => 'required|string',
        'no_hp' => 'required|string',
        'addres' => 'required|string',
    ]);

    $user->update($validated);

    return response()->json([
        'code' => 200,
        'status' => true,
        'message' => 'User Updated Successfully',
        'data' => $user->load('role')
    ]);
}

public function updateAvatar(Request $request, $id)
{
    $request->validate([
        'avatar' => 'required|image|mimes:jpg,jpeg,png',
    ]);

    $user = User::find($id);

    if (!$user) {
        return response()->json(['error' => 'User tidak ditemukan.'], 404);
    }

    if ($request->hasFile('avatar')) {
        // Simpan file langsung ke disk 'public' ke folder 'avatar'
        $path = $request->file('avatar')->store('avatar', 'public');

        // Hapus avatar lama jika ada
        if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
            Storage::disk('public')->delete($user->avatar);
        }

        // Simpan path tanpa 'public/' karena kita pakai disk 'public'
        $user->avatar = $path;
        $user->save();

        return response()->json([
            'message' => 'Avatar berhasil diperbarui.',
            'avatar_url' => asset('storage/' . $path),
        ]);
    }

    return response()->json(['error' => 'File tidak ditemukan.'], 400);
}

public function delete($id)
{
    $user = User::findOrFail($id);
    $user->delete();

    return response()->json([
        'code' => 200,
        'status' => true,
        'message' => 'User deleted successfully',
        'data' => $user
    ]);
}




}
