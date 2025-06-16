<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Uptd extends Model
{
    use HasFactory;

    protected $table = 'uptd';
    protected $primaryKey = 'id_uptd';

    protected $fillable = [
        'id_uptd',
        'nama_uptd',
    ];
    
   public function vehicle()
    {
        return $this->hasMany(Vehicle::class, 'id_uptd');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_uptd', 'id_uptd', 'user_id');
    }
}
