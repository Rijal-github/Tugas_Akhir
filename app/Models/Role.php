<?php

namespace App\Models;
use App\Models\Permission;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    protected $table = 'roles';
    protected $primaryKey = 'id_role';
    public $incrementing = true;
    public $timestamps = true;
    protected $keyType = 'int';

    protected $fillable = ['name'];

    public function permissions()
    {
        return $this->hasMany(Permission::class, 'id_role');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'id_role');
    }

}
