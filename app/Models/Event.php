<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'date',
        'price',
        'category',
        'adresse',
        'drink',
        'is_food_on_site',
        'registered_limit',
        'team_style',
        'status',
    ];

    public function category()
    {
        return $this->hasOne(Category::class);
    }

    public function drink()
    {
        return $this->belongsToMany(Drink::class);
    }

    public function user()
    {
        return $this->belongsToMany(User::class);
    }
}
