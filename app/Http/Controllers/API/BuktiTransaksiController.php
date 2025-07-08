<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\BuktiTransaksi;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class BuktiTransaksiController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama_produk' => 'required|string',
            'volume' => 'required|numeric|min:0',
            'no_polisi' => 'required|string',
            'id_operator' => 'required|integer',
            'foto_nota' => 'nullable|image|mimes:jpg,jpeg,png',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            // Ambil id_driver berdasarkan no_polisi dari tabel vehicles
            $vehicle = Vehicle::where('no_polisi', $request->no_polisi)->first();

            if (!$vehicle) {
                return response()->json([
                    'status' => false,
                    'message' => 'Kendaraan dengan nomor polisi tersebut tidak ditemukan.',
                ], 404);
            }

            $fotoNotaPath = null;

            if ($request->hasFile('foto_nota')) {
                $fotoNotaPath = $request->file('foto_nota')->store('laporan/bukti_transaksi/foto_nota', 'public');
            }

            $bukti = BuktiTransaksi::create([
                'nama_produk' => $request->nama_produk,
                'volume' => $request->volume,
                'no_polisi' => $request->no_polisi,
                'id_operator' => $request->id_operator,
                'id_driver' => $vehicle->id_driver, // ambil dari relasi vehicle
                'foto_nota' => $fotoNotaPath,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Bukti transaksi berhasil disimpan.',
                'data' => $bukti
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan server.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
