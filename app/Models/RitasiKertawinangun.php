<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RitasiKertawinangun extends Model
{
    use HasFactory;

    protected $table = 'ritasi_tpa_kertawinangun';

    protected $fillable = [
        'id_driver',
        'id_vehicle',
        'banyak_ritasi',
        'bruto',
        'netto',
        'keterangan',
    ];

    public function driver()
    {
        return $this->belongsTo(User::class, 'id_driver');
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'id_vehicle', 'id');
    }
}
