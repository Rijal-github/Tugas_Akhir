<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Tps;
use App\Models\LaporanPembersihan;
use App\Helpers\ApiResponse;

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
        try {
            // Validasi manual agar bisa ditangkap dan dikustom responsenya
            $validator = Validator::make($request->all(), [
                'nama' => 'required|string',
                'jenis_tps' => 'required|string',
                'tahun' => 'required|integer',
                'lokasi' => 'required|string',
                'latitude' => 'required|numeric',
                'longitude' => 'required|numeric',
                'keterangan' => 'nullable|string',
                'deskripsi' => 'nullable|string',
                'user_id' => 'required|string',
                'foto_sebelum' => 'required|image|mimes:jpg,jpeg,png',
                'foto_sesudah' => 'required|image|mimes:jpg,jpeg,png',
            ]);

            if ($validator->fails()) {
                return ApiResponse::error('Validasi gagal', $validator->errors(), 422);
            }

            $tps = Tps::create([
                'nama' => $request->nama,
                'created_by' => $request->user_id,
                'jenis_tps' => $request->jenis_tps,
                'unit' => $request->unit,
                'tahun' => $request->tahun,
                'lokasi' => $request->lokasi,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'keterangan' => $request->keterangan,
            ]);

            // Upload foto laporan pembersihan
            $fotoSebelumPath = null;
            $fotoSesudahPath = null;

            if ($request->hasFile('foto_sebelum')) {
                $fotoSebelumPath = $request->file('foto_sebelum')->store('laporan/foto_sebelum', 'public');
            }

            if ($request->hasFile('foto_sesudah')) {
                $fotoSesudahPath = $request->file('foto_sesudah')->store('laporan/foto_sesudah', 'public');
            }

            // Simpan laporan pembersihan
            $laporan = LaporanPembersihan::create([
                'user_id' => $request->user_id,
                'tps_id' => $tps->id,
                'foto_sebelum' => $fotoSebelumPath,
                'foto_sesudah' => $fotoSesudahPath,
                'deskripsi' => $request->deskripsi,
            ]);

            return ApiResponse::success('Data TPS dan laporan berhasil disimpan.', [
                'tps' => $tps,
                'laporan' => $laporan,
            ]);

        } catch (\Exception $e) {
            // Catat error ke log Laravel
            Log::error('Gagal menyimpan data TPS dan laporan', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return ApiResponse::error('Terjadi kesalahan server.', $e->getMessage(), 500);
        }
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
