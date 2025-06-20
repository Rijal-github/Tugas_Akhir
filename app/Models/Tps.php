<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tps extends Model
{
    use HasFactory;

    protected $fillable = ['jenis_tps', 'tahun', 'jumlah'];
    public function lokasi()
    {
        return $this->hasMany(Lokasi::class);
        // return $this->hasOne(Lokasi::class, 'tps_id');
    }

    public function laporanPembersihans()
    {
        return $this->hasMany(LaporanPembersihan::class);
    }

}
