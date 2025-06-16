<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;

class RolesController extends Controller
{
    public function getAllRole()
    {
        $roles = Role::select('id_role', 'name')->get();

        return response()->json([
            'code' => 200,
            'status' => true,
            'message' => 'Get All Roles',
            'data' => $roles
        ]);
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Simpan role baru
        $role = Role::create([
            'name' => $request->name,
        ]);

        return response()->json([
            'code' => 200,
            'status' => true,
            'message' => 'Role created successfully',
            'data' => $role,
        ]);
    }
}
