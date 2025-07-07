<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tps extends Model
{
    use HasFactory;

    
    protected $fillable = ['created_by', 'id_uptd', 'jenis_tps', 'nama', 'tahun', 'lokasi', 'latitude', 'longitude', 'keterangan', 'foto_tps'];

    public function laporanPembersihans()
    {
        return $this->hasMany(LaporanPembersihan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function uptd()
    {
        return $this->belongsTo(Uptd::class, 'id_uptd');
    }
}
