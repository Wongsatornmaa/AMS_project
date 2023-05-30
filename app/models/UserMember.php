<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserMember extends Model
{
    protected $fillable =[
        'first_name','last_name','phone','citizen','line','facebook','email',
        'image','date_of_birth','emergency_name','relationship','period',
        'phone_relationship','description','day_in','day_out','amount_people','status','password'
    ];

    protected $hidden =[
        'password'
    ];
}
