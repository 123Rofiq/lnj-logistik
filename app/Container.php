<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Container extends Model
{
    protected $fillable = [
        'janis',
        'dimensi_internal',
        'door_opening',
        'weight',
        'status'
       ];
   
}
