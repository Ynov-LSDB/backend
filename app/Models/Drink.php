<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drink extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'degree',
        'imageURL',
        'is_cuite_possible',
        'nbr_ice_max',
    ];

    public function user()
    {
        return $this->belongsToMany(User::class);
    }

    public function event()
    {
        return $this->belongsToMany(Event::class);
    }
}
