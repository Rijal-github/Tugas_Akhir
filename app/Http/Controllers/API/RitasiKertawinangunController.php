<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RitasiKertawinangun;

class RitasiKertawinangunController extends Controller
{
     public function kertawinangun()
    {
        $data = RitasiKertawinangun::select('id', 'bruto', 'netto')->get();

        $formatted = $data->map(function ($item) {
            return [
                'id' => $item->id,
                'bruto' => (string) $item->bruto,
                'netto' => (int) $item->netto
            ];
        });

        return response()->json([
            'code' => 200,
            'status' => true,
            'message' => 'Ritasi Kertawinangun summary retrieved successfully',
            'data' => $formatted
        ]);
    }
}
