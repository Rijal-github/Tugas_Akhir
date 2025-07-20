<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\BuktiTransaksi;
use App\Models\User;
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
                'id_vehicle' => $vehicle->id, // ambil dari relasi vehicle
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

    public function index(Request $request)
{
    try {
        $userId = $request->user_id;

        if (!$userId) {
            return response()->json([
                'status' => false,
                'message' => 'User ID tidak ditemukan.',
            ], 400);
        }

        $user = User::find($userId);

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'User tidak ditemukan.',
            ], 404);
        }

        // Tentukan kolom dan nilai berdasarkan role
        $column = null;

        if ($user->id_role == 5) { // Driver
            $vehicle = Vehicle::where('id_driver', $userId)->first();

            if (!$vehicle) {
                return response()->json([
                    'status' => false,
                    'message' => 'Driver belum memiliki kendaraan.',
                ], 404);
            }

            $column = 'id_vehicle';
            $userId = $vehicle->id;
        } elseif ($user->id_role == 6) { // Operator SPBU
            $column = 'id_operator';
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Role tidak diizinkan untuk melihat laporan.',
            ], 403);
        }

        // Query laporan dengan relasi vehicle dan driver
        $query = BuktiTransaksi::with(['vehicle.driver'])
            ->where($column, $userId);

        $filter = $request->query('filter');
        if ($filter === 'daily') {
            $query->whereDate('created_at', now()->toDateString());
        } elseif ($filter === 'weekly') {
            $query->where('created_at', '>=', now()->subWeek());
        } elseif ($filter === 'monthly') {
            $query->where('created_at', '>=', now()->subMonth());
        } elseif ($filter === 'yearly') {
            $query->whereYear('created_at', now()->year);
        }

        $laporan = $query->orderBy('created_at', 'desc')->get()
            ->map(function ($item) {
                return [
                    'laporan_transaksi_id' => $item->id,
                    'foto_nota' => $item->foto_nota ? asset('storage/' . $item->foto_nota) : null,
                    'created_at' => optional($item->created_at)->toIso8601String(),
                    'nama_produk' => $item->nama_produk ?? '-',
                    'volume' => $item->volume ?? '-',
                    'nomor_polisi' => $item->vehicle->no_polisi ?? '-',
                    'nama_driver' => $item->vehicle->driver->name ?? '-', // akses driver melalui relasi vehicle
                ];
            });

        return response()->json([
            'status' => true,
            'message' => 'Daftar laporan berhasil dimuat.',
            'data' => $laporan
        ], 200);
    } catch (\Exception $e) {
        return response()->json([
            'status' => false,
            'message' => 'Gagal memuat data laporan transaksi BBM.',
            'error' => $e->getMessage()
        ], 500);
    }
}
}
