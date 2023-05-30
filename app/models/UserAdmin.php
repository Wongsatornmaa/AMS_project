<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAdmin extends Model
{
    protected $fillable =[
        'user_name',
    ];

    protected $hidden = [
        'password'
    ];
}
