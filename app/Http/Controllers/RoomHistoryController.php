<?php

namespace App\Http\Controllers;
use App\Models\BillRoom;
use App\Models\Room;
use App\Models\UserMember;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RoomHistoryController extends Controller
{
    public function view_history(){
        $user_id = Auth::guard('member')->user()->id;
        $billInfo['showAllBill'] = BillRoom::select(
            'bill_rooms.id as bill_id','rooms.id as rm_id','user_members.id as us_id',
            'date_bill','summary_water','summary_electric','summary',
            'rooms.status','rooms.mitor_cable','rooms.mitor_wifi','rooms.rent','rooms.number_room',
        )
        ->leftjoin('rooms','bill_rooms.room_id','=','rooms.id')
        ->leftjoin('user_members', 'user_members.id', '=', 'rooms.member_id')
        ->leftjoin('buildings', 'buildings.id', '=', 'rooms.building_id')
        ->where('rooms.member_id',$user_id)   
        ->get();

        
        $billInfo['yearBill'] = BillRoom::selectRaw('YEAR(date_bill) as year')
        ->groupBy('year')
        ->get();
        //dd($billInfo['']);    
        return view('room-history/roomHistory')->with(compact('billInfo'));
    }

    public function get_history(Request $request){
        $user_id = Auth::guard('member')->user()->id;
        $data['showAllBill'] = BillRoom::select(
            'bill_rooms.id as bill_id','rooms.id as rm_id','user_members.id as us_id',
            'date_bill','summary_water','summary_electric','summary',
            'rooms.status','rooms.mitor_cable','rooms.mitor_wifi','rooms.rent','rooms.number_room',
        )
        ->leftjoin('rooms','bill_rooms.room_id','=','rooms.id')
        ->leftjoin('user_members', 'user_members.id', '=', 'rooms.member_id')
        ->where('rooms.member_id',$user_id)
        ->whereYear('date_bill', '=', $request->year)   
        ->get();

        $data['otherService'] = json_decode(BillRoom::select('bill_rooms.other')
            ->leftjoin('rooms','bill_rooms.room_id','=','rooms.id')
            ->where('rooms.member_id', $user_id)
            ->get());
        //$data['otherService'] = json_decode($data['otherService']->other);
        return response($data, 200);
    }

    public function view_detail_history($bill_id){
        $Bill = BillRoom::find($bill_id);
        $last_month = date("m", strtotime("-1 months", strtotime($Bill->date_bill)));

        $billInfo['detailBill'] = BillRoom::select(
            'bill_rooms.id as bill_id','room_id',
            DB::raw("DATE_FORMAT(date_add(bill_rooms.date_bill,INTERVAL 543 YEAR), '%d %m %Y') as date_bill"),
            'mitor_water','mitor_electric','summary_water','summary_electric','summary','other',
            'rooms.status','rooms.mitor_cable','rooms.mitor_wifi','rooms.rent','rooms.number_room',
            'buildings.price_water','buildings.price_electric'
        )
        ->leftjoin('rooms','bill_rooms.room_id','=','rooms.id')
        ->leftjoin('user_members', 'user_members.id', '=', 'rooms.member_id')
        ->leftjoin('buildings', 'buildings.id', '=', 'rooms.building_id')
        ->Where('bill_rooms.id',$bill_id)
        ->orwhereMonth('date_bill',$last_month)
        ->where('room_id',$Bill->room_id)
        ->get();
       
        $billInfo['otherService'] = json_decode(BillRoom::select('bill_rooms.other')
            ->where('bill_rooms.id', $bill_id)
            ->first());
        $billInfo['otherService'] = json_decode($billInfo['otherService']->other);

        //dd($billInfo['otherService']);
        return view('room-history/detailHistory')->with(compact('billInfo'));
    }
}
