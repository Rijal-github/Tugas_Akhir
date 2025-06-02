<?php

namespace App\Models;
use App\Models\Permission;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    protected $primaryKey = 'id_role';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = ['name'];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_role', 'id_role', 'permission_id');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'id_role');
    }

}
