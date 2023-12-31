<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'date',
        'imageURL',
        'price',
        'category',
        'adresse',
        'drink',
        'is_food_on_site',
        'registered_limit',
        'team_style',
        'is_closed',
        'status'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function drinks(): HasManyThrough
    {
        return $this->hasManyThrough(Drink::class, DrinkEvent::class, 'event_id', 'id', 'id', 'drink_id');
    }

    public function users() : HasManyThrough
    {
        return $this->hasManyThrough(User::class, UserEvent::class, 'event_id', 'id', 'id', 'user_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }


}
