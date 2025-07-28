<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ritasi;

class RitasiController extends Controller
{
    public function index()
    {
        $ritasi = Ritasi::select('id', 'bruto', 'netto')->get();

        $formattedData = $ritasi->map(function ($item) {
            return [
                'id' => $item->id,
                'bruto' => (int) $item->bruto, 
                'netto' => (int) $item->netto   
            ];
        });

        return response()->json([
            'code' => 200,
            'status' => true,
            'message' => 'Ritasi TPA Pecuk summary retrieved successfully',
            'data' => $formattedData
        ]);
    }
}
