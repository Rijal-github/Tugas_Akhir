<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

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
            'addres' => $user->addres,
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
        'id_role' => $user->id_role,
        'role' => $user->role ? $user->role->name : null,
        'addres' => $user->addres,
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
        'addres' => 'required|string',
        'password' => 'required|min:8'
    ]);

    $user = User::create([
        'name' => $validated['name'],
        'id_role' => $validated['id_role'],
        'email' => $validated['email'],
        'addres' => $validated['addres'],
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
