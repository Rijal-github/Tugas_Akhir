<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = ['akses', 'id_role'];
    
    public function role()
    {
        return $this->belongsTo(Role::class, 'id_role');
    }
}
