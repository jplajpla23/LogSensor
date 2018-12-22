<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    
    protected $fillable = [
        'sensors_id', 'Description', 'Message', 'min', 'max'
    ];
   
}
