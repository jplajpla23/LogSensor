<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    
    protected $fillable = [
        'name', 'mac', 'min', 'max', 'min','threshold'
    ];
   
}
