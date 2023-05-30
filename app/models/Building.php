<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    protected $fillable =[
        'floor_count','room_count','building_name','phone','price_water','price_electric','status'
    ];
}
