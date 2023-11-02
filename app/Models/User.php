<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'password',
        'imageURL_fav_balls',
        'fav_balls_name',
        'rank_id',
        'birth_date',
        'fav_drink',
        'doublette_user_id',
        'status',
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

    public function rank()
    {
        return $this->hasOne(Rank::class);
    }

    public function role()
    {
        return $this->hasOne(Role::class);
    }

    public function drink()
    {
        return $this->hasOne(Drink::class);
    }

    public function event()
    {
        return $this->belongsToMany(Event::class);
    }
}
