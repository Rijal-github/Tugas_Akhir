<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tps extends Model
{
    use HasFactory;

 mobile_dede/dev
    protected $fillable = ['user_id', 'jenis_tps', 'nama', 'tahun', 'unit', 'lokasi', 'latitude', 'longitude', 'keterangan', 'foto_tps',];

//     protected $fillable = ['jenis_tps', 'tahun', 'jumlah'];
//     public function lokasi()
//     {
//         return $this->hasMany(Lokasi::class);
//         // return $this->hasOne(Lokasi::class, 'tps_id');
//     }
main

    public function laporanPembersihans()
    {
        return $this->hasMany(LaporanPembersihan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
