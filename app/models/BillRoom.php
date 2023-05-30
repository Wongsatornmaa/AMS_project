<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BillRoom extends Model
{
    protected $fillable =[
        'room_id','mitor_water','mitor_electric','status','date_bill','qrcode','bank','summary','summary_water','summary_electric','other','amount_water','amount_electric'
    ];
}
