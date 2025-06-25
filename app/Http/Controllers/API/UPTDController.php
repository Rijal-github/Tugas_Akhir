<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Uptd;


class UPTDController extends Controller
{
    public function getAllUptd()
    {
        $data = Uptd::select('id_uptd', 'nama_uptd')->get();

        return response()->json([
            'code' => 200,
            'status' => true,
            'message' => 'Vehicle by UPTD',
            'data' => $data
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_uptd' => 'required|string|max:255',
        ]);

        $uptd = Uptd::create([
            'nama_uptd' => $validated['nama_uptd'],
        ]);

        return response()->json([
            'code' => 200,
            'status' => true,
            'message' => 'UPTD Created Successfully',
            'data' => [
                'id_uptd' => $uptd->id_uptd,
                'nama_uptd' => $uptd->nama_uptd,
                'CREATED_AT' => $uptd->created_at->toIso8601String(),
                'UPDATED_AT' => $uptd->updated_at->toIso8601String(),
            ]
        ]);
    }


}
