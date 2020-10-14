<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    //
    protected $table = 'destinations';
    protected $fillable = ['destination', 'price', 'photo'];
}
