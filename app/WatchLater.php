<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WatchLater extends Model
{
    protected $fillable = [
        'user_id',
        'movie_id',
    ];
}
