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
    public function index(Request $request)
    {
        try {
            $query = LaporanPembersihan::with('tps');

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
                        'laporan_id' => $item->id,
                        'foto_sebelum' => $item->foto_sebelum ? asset('storage/' . $item->foto_sebelum) : null,
                        'foto_sesudah' => $item->foto_sesudah ? asset('storage/' . $item->foto_sesudah) : null,
                        'deskripsi' => $item->deskripsi ?? '-',
                        'created_at' => optional($item->created_at)->toIso8601String(),
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

    public function indexBySupir(Request $request)
    {
        try {
            $userId = $request->user_id; // Ambil user_id dari request (pastikan dikirim dari frontend)

            if (!$userId) {
                return response()->json([
                    'status' => false,
                    'message' => 'User ID tidak ditemukan.',
                ], 400);
            }

            $query = LaporanPembersihan::with('tps')
                ->where('user_id', $userId); // Hanya laporan milik user

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
                        'laporan_id' => $item->id,
                        'foto_sebelum' => $item->foto_sebelum ? asset('storage/' . $item->foto_sebelum) : null,
                        'foto_sesudah' => $item->foto_sesudah ? asset('storage/' . $item->foto_sesudah) : null,
                        'deskripsi' => $item->deskripsi ?? '-',
                        'created_at' => optional($item->created_at)->toIso8601String(),
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