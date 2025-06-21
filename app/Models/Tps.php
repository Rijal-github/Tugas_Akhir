<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tps extends Model
{
    use HasFactory;

    protected $fillable = ['jenis_tps', 'tahun', 'unit', 'lokasi', 'latitude', 'longitude', 'keterangan'];

    public function laporanPembersihans()
    {
        return $this->hasMany(LaporanPembersihan::class);
    }

}
