<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Models\Role;

class User extends Authenticatable implements JWTSubject
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'no_hp',
        'addres',
        'password',
        'id_role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'id_role', 'id_role');
    }  
    
    public function uptds()
    {
        return $this->belongsToMany(Uptd::class, 'users_uptd', 'user_id', 'id_uptd');
        // return $this->belongsTo(Uptd::class, 'id_uptd', 'id_uptd');
    }

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class, 'id_driver');
    }

    public function ritasiTpaPecuk()
    {
        return $this->hasMany(Ritasi::class, 'id_driver');
    }

    public function laporanPembersihans()
    {
        return $this->hasMany(LaporanPembersihan::class);
    }

    // Transaksi yang dibuat oleh user
    public function buktiTransaksis()
    {
        return $this->hasMany(BuktiTransaksi::class, 'user_id');
    }

    // Transaksi sebagai driver
    public function transaksiSebagaiDriver()
    {
        return $this->hasMany(BuktiTransaksi::class, 'id_driver');
    }
    
}
