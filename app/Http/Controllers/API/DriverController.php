<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;

class DriverController extends Controller
{
    public function driversByUptd($id_uptd)
    {
        $DRIVER_ROLE_ID = 5;

        $drivers = DB::table('users')
            ->join('users_uptd', 'users.id', '=', 'users_uptd.user_id')
            ->join('uptd', 'users_uptd.id_uptd', '=', 'uptd.id_uptd') // Join uptd untuk dapat nama_uptd
            ->where('users.id_role', $DRIVER_ROLE_ID)
            ->where('users_uptd.id_uptd', $id_uptd)
            ->select(
                'users.id',
                'users.name as name',
                'users.email',
                'users.alamat_user as alamat_user',
                'users.id_role',
                'users_uptd.id_uptd',
                'uptd.nama_uptd'
            )
            ->get()
            ->map(function ($driver) {
                return [
                    'id' => $driver->id,
                    'name' => $driver->name,
                    'email' => $driver->email,
                    'alamat_user' => $driver->alamat_user,
                    'id_role' => $driver->id_role,
                    'nama_uptd' => $driver->nama_uptd,
                ];
            });

        return response()->json([
            'code' => 200,
            'status' => true,
            'message' => 'Driver by UPTD',
            'data' => $drivers
        ]);
    }
}
