<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class userUptd extends Pivot
{
    protected $table = 'users_uptd';

    protected $fillable = [
        'user_id',
        'id_uptd'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function uptd()
    {
        return $this->belongsTo(UPTD::class, 'id_uptd');
    }
}
