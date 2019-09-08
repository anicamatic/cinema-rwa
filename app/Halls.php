<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Halls extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'hall_number', 'hall_description'
    ];

    public function seats()
    {
        return $this->hasMany('App\Seats', 'hall_id');
    }
}
