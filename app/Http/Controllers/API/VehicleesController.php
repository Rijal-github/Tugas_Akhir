<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehicle;

class VehicleesController extends Controller
{
    public function vehicleByUptd($id_uptd)
    {
        $vehicles = Vehicle::with(['driver', 'uptd'])
            ->where('id_uptd', $id_uptd)
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'name' => $item->driver->name ?? '',
                    'nama_uptd' => $item->uptd->nama_uptd ?? '',
                    'no_polisi' => $item->no_polisi,
                    'jenis_kendaraan' => $item->jenis_kendaraan
                ];
            });

        return response()->json([
            'code' => 200,
            'status' => true,
            'message' => 'Vehicle by UPTD',
            'data' => $vehicles
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_driver' => 'required|exists:users,id',
            'id_uptd' => 'required|exists:uptd,id_uptd',
            'no_polisi' => 'required|string|max:255',
            'Jenis_Kendaraan' => 'required|string|max:255',
            'kapasitas_angkutan' => 'required|numeric',
        ]);

        $vehicle = Vehicle::create([
            'id_driver' => $validated['id_driver'],
            'id_uptd' => $validated['id_uptd'],
            'no_polisi' => $validated['no_polisi'],
            'jenis_kendaraan' => $validated['Jenis_Kendaraan'],
            'kapasitas_angkutan' => $validated['kapasitas_angkutan'],
        ]);

        return response()->json([
            'code' => 200,
            'status' => true,
            'message' => 'Vehicle Created Successfully',
            'data' => [
                'id' => $vehicle->id,
                'id_driver' => $vehicle->id_driver,
                'id_uptd' => $vehicle->id_uptd,
                'no_polisi' => $vehicle->no_polisi,
                'kapasitas_angkutan' => $vehicle->kapasitas_angkutan,
                'CREATED_AT' => $vehicle->created_at?->toIso8601String(),
                'UPDATED_AT' => $vehicle->updated_at?->toIso8601String(),
            ]
        ]);
    }

}
