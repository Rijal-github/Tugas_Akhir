<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanPembersihan extends Model
{
    protected $table = 'laporan_pembersihans';

    protected $fillable = [
        'user_id',
        'tps_id',
        'foto_sebelum',
        'foto_sesudah',
        'deskripsi',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke model Tps (setiap laporan terkait 1 TPS)
    public function tps()
    {
        return $this->belongsTo(Tps::class);
    }
    
}
