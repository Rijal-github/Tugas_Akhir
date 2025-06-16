<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lokasi extends Model
{
    use HasFactory;

    protected $table = 'lokasi';

    protected $fillable = ['tps_id', 'nama_lokasi', 'unit', 'latitude', 'longitude'];
    public function tps()
{
    // return $this->belongsTo(Tps::class);
    return $this->belongsTo(Tps::class);
}
}
