<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Uptd extends Model
{
    use HasFactory;

    protected $table = 'uptd';
    protected $primaryKey = 'id_kendaraan';

    protected $fillable = [
        'id_supir',
        'no_polisi',
        'jenis_kendaraan',
        'kapasitas_angkutan',
        'wilayah',
        'keterangan',
    ];
    
    public function supir()
    {
        return $this->belongsTo(Supir::class, 'id_supir');
    }
}
