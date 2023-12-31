<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'role_id',
        'about',
        'photo',
        'phone',
        'website',
        'linkedin',
        'facebook',
        'twitter',
        'youtube',
        'nid',
        'passport',
        'github',
        'profession',
        'address',
        'sid'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }

    public function isAdmin()
    {
        // Assuming you have a 'role_id' column in your users table
        // Check if the 'role_id' is set to the value that represents admin users
        return $this->role_id === 1; // Adjust this condition as per your role setup
    }
}