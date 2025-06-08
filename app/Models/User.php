<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use 
    // HasApiTokens,
     HasFactory, Notifiable;

    const ROLE_ADMIN = 'Admin' ;
    const ROLE_USER = 'User' ;

    protected $fillable = ['name', 'email', 'password', 'phone', 'address', 'role'];


    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Tắt mã hóa mật khẩu
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = $value;
    }
}
