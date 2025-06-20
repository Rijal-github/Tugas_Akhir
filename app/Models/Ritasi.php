<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ritasi extends Model
{
    use HasFactory;

    protected $table = 'ritasi_tpa_pecuk';

    protected $fillable = [
        'id_driver',
        'banyak_ritasi',
        'netto_pre',
        'netto_post',
        'keterangan',
    ];

    public function driver()
    {
        return $this->belongsTo(User::class, 'id_driver');
    }

    public function vehicle()
    {
        return $this->hasOne(Vehicle::class, 'id_driver', 'id_driver');
    }
}
