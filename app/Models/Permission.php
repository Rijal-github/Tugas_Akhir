<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = ['name'];
    
    public function role()
    {
        return $this->belongsTo(Role::class, 'id_role');
    }
}
