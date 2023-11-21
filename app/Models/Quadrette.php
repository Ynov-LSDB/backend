<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quadrette extends Model
{
    use HasFactory;

    protected $fillable = [
        'creator_user_id_1',
        'user_id_2',
        'user_id_3',
        'user_id_4',
    ];

    public function creatorUserId1()
    {
        return $this->belongsTo(User::class, 'creator_user_id_1');
    }

    public function userId2()
    {
        return $this->belongsTo(User::class, 'user_id_2');
    }

    public function userId3()
    {
        return $this->belongsTo(User::class, 'user_id_3');
    }

    public function userId4()
    {
        return $this->belongsTo(User::class, 'user_id_4');
    }
}
