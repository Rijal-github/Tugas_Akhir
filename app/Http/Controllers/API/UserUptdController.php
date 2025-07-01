<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserUptd;

class UserUptdController extends Controller
{
    public function show($id)
    {
        $userUptdList = UserUptd::with(['user.role', 'uptd'])
            ->where('id_uptd', $id)
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->user->id,
                    'name' => $item->user->name,
                    'email' => $item->user->email,
                    'addres' => $item->user->addres,
                    'role' => $item->user->role->name ?? '-', // jika ada relasi role
                    'nama_uptd' => $item->uptd->nama_uptd ?? '-',
                ];
            });

        return response()->json([
            'code' => 200,
            'status' => true,
            'message' => 'Users by UPTD',
            'data' => $userUptdList
        ]);
    }

    public function driversByUptd($id)
    {
        $drivers = \App\Models\UserUptd::with(['user.role', 'uptd'])
            ->where('id_uptd', $id)
            ->whereHas('user.role', function ($query) {
                $query->where('name', 'driver'); // 'driver' berdasarkan isi kolom role.name
            })
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->user->id,
                    'name' => $item->user->name,
                    'email' => $item->user->email,
                    'addres' => $item->user->addres,
                    'role' => $item->user->role->name ?? '-',
                    'nama_uptd' => $item->uptd->nama_uptd ?? '-',
                ];
            });

        return response()->json([
            'code' => 200,
            'status' => true,
            'message' => 'Driver by UPTD',
            'data' => $drivers
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'id_uptd' => 'required|exists:uptd,id_uptd',
        ]);

        $userUptd = UserUptd::create([
            'user_id' => $validated['user_id'],
            'id_uptd' => $validated['id_uptd']
        ]);

        $user = $userUptd->user;
        $uptd = $userUptd->uptd;

        return response()->json([
            'code' => 200,
            'status' => true,
            'message' => 'user created successfully',
            'data' => [
                'id_uptd' => $uptd->id_uptd,
                'name' => $user->name,
                'email' => $user->email,
                'id_role' => $user->id_role,
                'addres' => $user->addres,
                'nama_uptd' => $uptd->nama_uptd ?? '-',
                'CREATED_AT' => $userUptd->created_at?->toIso8601String(),
                'UPDATED_AT' => $userUptd->updated_at?->toIso8601String(),
            ]
        ]);
    }


}
