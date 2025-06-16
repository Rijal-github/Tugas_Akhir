<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tps;
use App\Models\Lokasi;

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

    public function store(Request $request)
{
    $request->validate([
        'jenis_tps' => 'required|string',
        'jumlah' => 'required|integer',
        'tahun' => 'required|integer',
        'lokasi.nama_lokasi' => 'required|string',
        'lokasi.unit' => 'required|integer',
        'lokasi.latitude' => 'required|numeric',
        'lokasi.longitude' => 'required|numeric'
    ]);

    // Simpan TPS terlebih dahulu
    $tps = Tps::create([
        'jenis_tps' => $request->jenis_tps,
        'jumlah' => $request->jumlah,
        'tahun' => $request->tahun,
    ]);

    // Simpan lokasi dengan relasi tps_id
    $lokasi = new Lokasi([
        'nama_lokasi' => $request->lokasi['nama_lokasi'],
        'unit' => $request->lokasi['unit'],
        'latitude' => $request->lokasi['latitude'],
        'longitude' => $request->lokasi['longitude'],
    ]);

    $tps->lokasi()->save($lokasi);

    // Load lokasi agar ikut dalam response
    $tps->load('lokasi');

    return response()->json([
        'code' => 200,
        'status' => true,
        'message' => 'TPS & Lokasi berhasil dibuat',
        'data' => $tps
    ]);
}

public function update(Request $request, $id)
{
    $request->validate([
        'jenis_tps' => 'required|string',
        'jumlah' => 'required|integer',
        'tahun' => 'required|integer',
        'lokasi.nama_lokasi' => 'required|string',
        'lokasi.unit' => 'required|integer',
        'lokasi.latitude' => 'required|numeric',
        'lokasi.longitude' => 'required|numeric'
    ]);

    $tps = Tps::findOrFail($id);

    // Update TPS
    $tps->update([
        'jenis_tps' => $request->jenis_tps,
        'jumlah' => $request->jumlah,
        'tahun' => $request->tahun,
    ]);

    // Update Lokasi
    if ($tps->lokasi) {
        $tps->lokasi->update([
            'nama_lokasi' => $request->lokasi['nama_lokasi'],
            'unit' => $request->lokasi['unit'],
            'latitude' => $request->lokasi['latitude'],
            'longitude' => $request->lokasi['longitude'],
        ]);
    } else {
        // Jika belum ada lokasi, buat baru
        $tps->lokasi()->create([
            'nama_lokasi' => $request->lokasi['nama_lokasi'],
            'unit' => $request->lokasi['unit'],
            'latitude' => $request->lokasi['latitude'],
            'longitude' => $request->lokasi['longitude'],
        ]);
    }

    $tps->load('lokasi');

    return response()->json([
        'code' => 200,
        'status' => true,
        'message' => 'TPS & Lokasi berhasil diperbarui',
        'data' => $tps
    ]);
}

public function delete($id)
{
    $tps = Tps::findOrFail($id);
    $tps->delete();

    return response()->json([
        'code' => 200,
        'status' => true,
        'message' => 'TPS deleted successfully',
        'data' => $tps
    ]);
}

}
