<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class buktiTransaksi extends Model
{
    protected $table = 'bukti_transaksis';

    protected $fillable = [
        'driver_id',
        'operator_id',
        'foto_nota',
        'nama_produk',
        'volume',
    ];


     // relasi ke operator spbu yang melaporkan bukti transaksi
     public function operator()
     {
         return $this->belongsTo(User::class, 'operator_id');
     }
 
     // Relasi ke driver
     public function driver()
     {
         return $this->belongsTo(User::class, 'driver_id');
     }

}
