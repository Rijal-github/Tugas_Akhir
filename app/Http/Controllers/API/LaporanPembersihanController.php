<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\LaporanPembersihan;
use Illuminate\Http\Request;

class LaporanPembersihanController extends Controller
{
    /**
     * Menampilkan daftar laporan berdasarkan tps_id.
     *
     * @param  int  $tps_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($tps_id)
    {
        try {
                $laporan = LaporanPembersihan::with('tps')
                ->where('tps_id', $tps_id)
                ->orderBy('created_at', 'desc')
                ->get()
                ->map(function ($item) {
                    return [
                        'deskripsi' => $item->deskripsi,
                        'created_at' => $item->created_at,
                        'foto_sebelum' => $item->foto_sebelum ? asset('storage/' . $item->foto_sebelum) : null,
                        'foto_sesudah' => $item->foto_sesudah ? asset('storage/' . $item->foto_sesudah) : null,
                        'tps' => [
                            'nama' => $item->tps->nama ?? '-'
                        ]
                    ];
                });

            return response()->json([
                'status' => true,
                'message' => 'Daftar laporan ditemukan',
                'data' => $laporan // ← dibungkus dalam key 'data'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal memuat laporan',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}