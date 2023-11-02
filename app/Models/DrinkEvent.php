<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DrinkEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'drink_id',
        'event_id',
    ];

    public function drink()
    {
        return $this->belongsTo(Drink::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

}
