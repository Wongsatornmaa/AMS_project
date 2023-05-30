<?php

namespace App\Http\Controllers;
use App\Models\BillRoom;
use App\Models\Room;
use App\Models\UserMember;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_id = Auth::guard('member')->user()->id;
        $Bill = BillRoom::find($user_id);
        $last_month = date("m", strtotime("-1 months"));
        $now_day = date("d");

        $billInfo['showInfo'] = UserMember::select(
            'user_members.phone as phone',
            DB::raw("DATE_FORMAT(date_add(user_members.day_in,INTERVAL 543 YEAR), '%d-%m-%Y') as day_in"),
            DB::raw("DATE_FORMAT(date_add(user_members.day_out,INTERVAL 543 YEAR), '%d-%m-%Y') as day_out"),
            'user_members.amount_people as amount_people','user_members.period',
            'rooms.number_room as number_room',
            'rooms.rent as rent',
            'rooms.deposit as deposit',
            'buildings.price_water as price_water',
            'buildings.price_electric as price_electric'
        )
        ->leftjoin('rooms', 'rooms.member_id', '=', 'user_members.id')
        ->leftjoin('buildings', 'rooms.member_id', '=', 'user_members.id')
        ->where('user_members.id', $user_id)
        ->first(); 
        // dd($billInfo['showInfo']);
        if($now_day >= 28){
            $billInfo['bill'] = BillRoom::select(
                'bill_rooms.id as bill_id',
                //'date_bill',
                //DB::raw("DAY(date_bill) as day"),DB::raw("MONTH(date_bill) as month"),
                DB::raw("DATE_FORMAT(date_add(bill_rooms.date_bill,INTERVAL 543 YEAR), '%d %m %Y') as date_bill"),
                'mitor_water','mitor_electric','summary_water','summary_electric','summary',
                'rooms.status','rooms.mitor_cable','rooms.mitor_wifi','rooms.rent','rooms.number_room',
                'buildings.price_water','buildings.price_electric'
            )
            ->leftjoin('rooms','bill_rooms.room_id','=','rooms.id')
            ->leftjoin('user_members', 'user_members.id', '=', 'rooms.member_id')
            ->leftjoin('buildings', 'buildings.id', '=', 'rooms.building_id')
            ->where('rooms.member_id',$user_id)
            ->whereYear('date_bill',date("Y"))
            ->whereMonth('date_bill',date("m"))
            ->get();
            //dd($billInfo['showInfo']);
            $billInfo['otherService'] = json_decode(BillRoom::select('bill_rooms.other')
                ->leftjoin('rooms','bill_rooms.room_id','=','rooms.id')
                ->leftjoin('user_members', 'user_members.id', '=', 'rooms.member_id')
                ->leftjoin('buildings', 'buildings.id', '=', 'rooms.building_id')
                ->where('rooms.member_id',$user_id)
                ->whereYear('date_bill',date("Y"))
                ->whereMonth('date_bill',date("m"))
                ->first());
                if($billInfo['otherService'] != null){
                    $billInfo['otherService'] = json_decode($billInfo['otherService']->other);
               }
            //dd($billInfo['showInfo']);
            return view('payment-channel/home')->with(compact('billInfo'));
        }else{
            $billInfo['bill'] = BillRoom::select(
                'bill_rooms.id as bill_id',
                DB::raw("DATE_FORMAT(date_add(bill_rooms.date_bill,INTERVAL 543 YEAR), '%d %m %Y') as date_bill"),
                'mitor_water','mitor_electric','summary_water','summary_electric','summary',
                'rooms.status','rooms.mitor_cable','rooms.mitor_wifi','rooms.rent','rooms.number_room',
                'buildings.price_water','buildings.price_electric'
            )
            ->leftjoin('rooms','bill_rooms.room_id','=','rooms.id')
            ->leftjoin('user_members', 'user_members.id', '=', 'rooms.member_id')
            ->leftjoin('buildings', 'buildings.id', '=', 'rooms.building_id')
            ->where('rooms.member_id',$user_id)
            ->whereYear('date_bill',date("Y"))
            ->whereMonth('date_bill',$last_month)
            ->get();

            $billInfo['otherService'] = json_decode(BillRoom::select('bill_rooms.other')
                ->leftjoin('rooms','bill_rooms.room_id','=','rooms.id')
                ->leftjoin('user_members', 'user_members.id', '=', 'rooms.member_id')
                ->leftjoin('buildings', 'buildings.id', '=', 'rooms.building_id')
                ->where('rooms.member_id',$user_id)
                ->whereYear('date_bill',date("Y"))
                ->whereMonth('date_bill',$last_month)
                ->first());
                if($billInfo['otherService'] != null){
                     $billInfo['otherService'] = json_decode($billInfo['otherService']->other);
                }
            //dd($billInfo['otherService']);
            return view('payment-channel/home')->with(compact('billInfo'));
        }
    }
}
