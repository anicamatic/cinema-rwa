<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectionSeats extends Model
{
    protected $table = 'projection_seats';

    public $timestamps = false;

    protected $fillable = [
        'seat_number', 'avaliable', 'projection_id'
    ];
}
