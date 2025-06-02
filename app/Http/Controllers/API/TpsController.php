<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tps;

class TpsController extends Controller
{
    public function index()
    {
        // return response()->json(Tps::all(), 200);
        return response()->json([
            'code' => 200,
            'status' => true,
            'message' => 'Get All TPS',
            'data' => Tps::all()
        ]);
    }

    // Ambil data TPS berdasarkan ID
    public function show($id)
    {
        $tps = Tps::find($id);
        if (!$tps) {
            return response()->json(['message' => 'Data TPS tidak ditemukan'], 404);
        }
        return response()->json($tps, 200);
    }
}
