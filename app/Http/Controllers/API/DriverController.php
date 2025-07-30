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
        ->where('users.id_role', $DRIVER_ROLE_ID)
        ->where('users_uptd.id_uptd', $id_uptd)
        ->select('users.id', 'users.name as nama', 'users.email', 'users.alamat_user', 'users.id_role', 'users_uptd.id_uptd')
        ->get()
        ->map(function ($driver) {
            return [
                'id' => $driver->id,
                'nama' => $driver->name,
                'email' => $driver->email,
                'alamat' => $driver->alamat,
                'id_role' => $driver->id_role,
                'nama_uptd' => $driver->uptd->first()->nama_uptd ?? null,
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
