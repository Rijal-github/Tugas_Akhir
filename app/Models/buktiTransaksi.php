<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class buktiTransaksi extends Model
{
    protected $table = 'bukti_transaksis';

    protected $fillable = [
        'id_driver',
        'nota',
        'keterangan',
    ];


     // Relasi ke user yang membuat transaksi
     public function user()
     {
         return $this->belongsTo(User::class, 'user_id');
     }
 
     // Relasi ke driver
     public function driver()
     {
         return $this->belongsTo(User::class, 'id_driver');
     }

}
