<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class supir extends Model
{
    use HasFactory;

    protected $table = 'supirs';
    protected $primaryKey = 'id_supir';
    public $incrementing = true; // kalau primary key pakai auto-increment
    protected $keyType = 'int';

    protected $fillable = [
        'nama_supir',
        'email',
        'password',
        'no_hp',
    ];


    public function kendaraan()
    {
        return $this->hasMany(Kendaraan::class, 'id_supir');
    }
}
