<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\LaporanPembersihan;
use App\Models\Tps;
use Illuminate\Http\Request;

class LaporanPembersihanController extends Controller
{
    /**
     * Menampilkan daftar laporan berdasarkan tps_id.
     *
     * @param  int  $tps_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $laporan = LaporanPembersihan::with('tps')
                ->orderBy('created_at', 'desc')
                ->get()
                ->map(function ($item) {
                    return [
                        'laporan_id' => $item->id,
                        'foto_sebelum' => $item->foto_sebelum ? asset('storage/' . $item->foto_sebelum) : null,
                        'foto_sesudah' => $item->foto_sesudah ? asset('storage/' . $item->foto_sesudah) : null,
                        'deskripsi' => $item->deskripsi ?? '-',
                        'created_at' => $item->created_at?->toIso8601String(),
                        'nama_tps' => $item->tps->nama ?? '-',
                        'lokasi' => $item->tps->lokasi ?? '-',
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
                'message' => 'Gagal memuat data laporan.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}