<?php

namespace App\Http\Controllers;
use App\Models\Room;
use App\Models\UserMember;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RoomContractController extends Controller
{
    public function view_contract(){
        $user_id = Auth::guard('member')->user()->phone;

        $userInfo['showInfo'] = UserMember::select(
        'user_members.phone as phone',
        'user_members.day_in as day_in',
        'user_members.day_out as day_out',
        'user_members.amount_people as amount_people',
        'rooms.number_room as number_room',
        'rooms.rent as rent',
        'rooms.deposit as deposit',
        'buildings.price_water as price_water',
        'buildings.price_electric as price_electric')
        ->leftjoin('rooms', 'rooms.member_id', '=', 'user_members.id')
        ->leftjoin('buildings', 'rooms.member_id', '=', 'user_members.id')
        ->where('user_members.phone', $user_id)
        ->get(); 

        return view('room-contract/roomContract')->with(compact('userInfo'));
    }

}
