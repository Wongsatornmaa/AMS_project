<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable =[
        'member_id','number_room','mitor_cable','mitor_wifi',
        'status','rent','transaction_log','deposit','building_id'
    ];
}
