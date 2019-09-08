<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Projections extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'start_date', 'movie_id', 'hall_id'
    ];
}
