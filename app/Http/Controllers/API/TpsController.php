<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Tps;
use App\Models\LaporanPembersihan;
use App\Models\User;
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

            $latitude = $request->latitude;
            $longitude = $request->longitude;

            // Cek apakah ada TPS lain dalam radius 50 meter
            $tpsTerdekat = DB::table('tps')
                ->selectRaw("id, (
                6371000 * acos(
                    cos(radians(?)) *
                    cos(radians(latitude)) *
                    cos(radians(longitude) - radians(?)) +
                    sin(radians(?)) *
                    sin(radians(latitude))
                )
            ) AS distance", [$latitude, $longitude, $latitude])
                ->having("distance", "<=", 50)
                ->orderBy('distance')
                ->first();

            // Upload foto
            $fotoSebelumPath = $request->file('foto_sebelum')->store('laporan/foto_sebelum', 'public');
            $fotoSesudahPath = $request->file('foto_sesudah')->store('laporan/foto_sesudah', 'public');

            // Gunakan TPS lama atau buat TPS baru
            if ($tpsTerdekat) {
                $tpsId = $tpsTerdekat->id;
                $tps = Tps::find($tpsId);
            } else {
                // Ambil nama dasar
                $baseNama = $request->nama;

                // Hitung jumlah TPS yang memiliki nama diawali dengan nama dasar
                $jumlahSama = Tps::where('nama', 'LIKE', "$baseNama%")->count();

                // Jika belum ada, gunakan nama aslinya
                $namaUnik = $jumlahSama === 0 ? $baseNama : $baseNama . ' ' . $jumlahSama;

                // cari id_uptd dari user
                $user = User::find($request->user_id);

                $idUptd = $user->uptds->first()?->id_uptd; // Pakai optional chaining agar aman

                if (!$idUptd) {
                    return ApiResponse::error('User belum terhubung dengan UPTD manapun', null, 400);
                }

                $tps = Tps::create([
                    'nama' => $namaUnik,
                    'id_uptd' => $idUptd,
                    'created_by' => $request->user_id,
                    'jenis_tps' => $request->jenis_tps,
                    'tahun' => $request->tahun,
                    'lokasi' => $request->lokasi,
                    'latitude' => $latitude,
                    'longitude' => $longitude,
                    'keterangan' => $request->keterangan,
                    'foto_tps' => $fotoSesudahPath,
                ]);
            }

            // Simpan laporan
            $laporan = LaporanPembersihan::create([
                'id_driver' => $request->user_id,
                'tps_id' => $tps->id,
                'foto_sebelum' => $fotoSebelumPath,
                'foto_sesudah' => $fotoSesudahPath,
                'deskripsi' => $request->deskripsi,
            ]);

            return ApiResponse::success('Data berhasil disimpan.', [
                'tps' => $tps,
                'laporan' => $laporan,
            ]);

        } catch (\Exception $e) {
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
