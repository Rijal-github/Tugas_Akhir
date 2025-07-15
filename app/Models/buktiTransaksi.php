<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class buktiTransaksi extends Model
{
    protected $table = 'bukti_transaksis';

    protected $fillable = [
        'id_vehicle',
        'id_operator',
        'foto_nota',
        'nama_produk',
        'volume',
    ];


     // relasi ke operator spbu yang melaporkan bukti transaksi
     public function operator()
     {
         return $this->belongsTo(User::class, 'id_operator');
     }
 
     // Relasi ke vehicle
     public function vehicle()
     {
         return $this->belongsTo(Vehicle::class, 'id_vehicle');
     }

}
