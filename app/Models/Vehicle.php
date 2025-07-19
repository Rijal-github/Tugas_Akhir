<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Uptd;

class Vehicle extends Model
{
    protected $table = 'vehicle';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_driver',
        'id_uptd',
        'no_polisi',
        'jenis_kendaraan',
        'kapasitas_angkutan',
    ];

    public function driver()
    {
        return $this->belongsTo(User::class, 'id_driver')->where('id_role', 5);
    }

    public function uptd()
    {
        return $this->belongsTo(Uptd::class, 'id_uptd', 'id_uptd');
    }

    public function ritasiTpaPecuk()
    {
        return $this->hasMany(Ritasi::class, 'id_vehicle');
    }

}

// public function users()
// {
//     return $this->belongsToMany(User::class, 'user_driver', 'id_kendaraan', 'user_id');
// }