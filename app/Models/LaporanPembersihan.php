<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanPembersihan extends Model
{
    protected $table = 'laporan_pembersihans';

    protected $fillable = [
        'id_driver',
        'tps_id',
        'foto_sebelum',
        'foto_sesudah',
        'deskripsi',
    ];


    public function driver()
    {
        return $this->belongsTo(User::class, 'id_driver');
    }
    // Relasi ke model Tps (setiap laporan terkait 1 TPS)
    public function tps()
    {
        return $this->belongsTo(Tps::class, 'tps_id');
    }
    
}
