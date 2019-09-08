<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movies extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'movie_name', 'duration', 'release_year', 'movie_image', 'movie_description'
    ];
}
