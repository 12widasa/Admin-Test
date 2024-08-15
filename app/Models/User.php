<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const ROLE_SUPERADMIN = 'superadmin';
    const ROLE_ADMIN_CREATE = 'admin_create';
    const ROLE_ADMIN_VIEW = 'admin_view';
    const ROLE_SALES = 'sales';

    protected $fillable = [
        'name', 'email', 'password', 'tanggal_lahir', 'kota_asal', 'foto', 'role'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
        'tanggal_lahir' => 'date',
    ];

    public function city()
    {
        return $this->belongsTo(City::class, 'kota_asal');
    }

    public function formSales()
    {
        return $this->hasMany(FormSales::class);
    }
}
