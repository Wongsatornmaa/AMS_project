<?php

namespace App\Http\Controllers;
use App\Models\BillRoom;
use App\Models\Room;
use App\Models\UserMember;
//use App\Lib\qrlib;
//use App\Lib\PromptPayQR;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PaymentController extends Controller
{
    public function view_qr_code(){
        // $payment['qr'] = new PromptPayQR(); // new object
        // $payment['qr']->size = 6; // Set QR code size to 8
        // $payment['qr']->id = '0930278109'; // PromptPay ID
        
        $last_month = date("m", strtotime("-1 months"));
        $now_day = date("d");

        if($now_day >= 28){
            $user_id = Auth::guard('member')->user()->id;
            $payment['qrcode'] = BillRoom::select(
                'bill_rooms.id as bill_id','summary'
            )
            ->leftjoin('rooms','bill_rooms.room_id','=','rooms.id')
            ->where('rooms.member_id',$user_id)
            ->whereYear('date_bill',date("Y"))
            ->whereMonth('date_bill',date("m"))
            ->get();
            $payment['otherService'] = json_decode(BillRoom::select('bill_rooms.other')
                ->leftjoin('rooms','bill_rooms.room_id','=','rooms.id')
                ->where('rooms.member_id',$user_id)
                ->whereYear('date_bill',date("Y"))
                ->whereMonth('date_bill',date("m"))
                ->first());
                if($payment['otherService'] != null){
                    $payment['otherService'] = json_decode($payment['otherService']->other);
                }
            //dd($payment['otherService']);
            return view('payment-channel/qrCode')->with(compact('payment'));
        }else{
            $user_id = Auth::guard('member')->user()->id;
            $payment['qrcode'] = BillRoom::select(
                'bill_rooms.id as bill_id','summary'
            )
            ->leftjoin('rooms','bill_rooms.room_id','=','rooms.id')
            ->where('rooms.member_id',$user_id)
            ->whereYear('date_bill',date("Y"))
            ->whereMonth('date_bill',$last_month)
            ->get();
            $payment['otherService'] = json_decode(BillRoom::select('bill_rooms.other')
                ->leftjoin('rooms','bill_rooms.room_id','=','rooms.id')
                ->where('rooms.member_id',$user_id)
                ->whereYear('date_bill',date("Y"))
                ->whereMonth('date_bill',$last_month)
                ->first());
                if($payment['otherService'] != null){
                    $payment['otherService'] = json_decode($payment['otherService']->other);
                }
            //dd($payment['qrcode']);
            return view('payment-channel/qrCode')->with(compact('payment'));
        } 
    }

    public function view_bank(){
        $user_id = Auth::guard('member')->user()->id;

        $last_month = date("m", strtotime("-1 months"));
        $now_day = date("d");

        if($now_day >= 28){
            $payment['bank'] = BillRoom::select(
                'bill_rooms.id as bill_id','summary'
            )
            ->leftjoin('rooms','bill_rooms.room_id','=','rooms.id')
            ->where('rooms.member_id',$user_id)
            ->whereYear('date_bill',date("Y"))
            ->whereMonth('date_bill',date("m"))
            ->get();
            $payment['otherService'] = json_decode(BillRoom::select('bill_rooms.other')
                ->leftjoin('rooms','bill_rooms.room_id','=','rooms.id')
                ->where('rooms.member_id',$user_id)
                ->whereYear('date_bill',date("Y"))
                ->whereMonth('date_bill',date("m"))
                ->first());
                if($payment['otherService'] != null){
                    $payment['otherService'] = json_decode($payment['otherService']->other);
                }
            //dd($payment['qrcode']);
            return view('payment-channel/bank')->with(compact('payment'));  
        }else{
            $payment['bank'] = BillRoom::select(
                'bill_rooms.id as bill_id','summary'
            )
            ->leftjoin('rooms','bill_rooms.room_id','=','rooms.id')
            ->where('rooms.member_id',$user_id)
            ->whereYear('date_bill',date("Y"))
            ->whereMonth('date_bill',$last_month)
            ->get();
            $payment['otherService'] = json_decode(BillRoom::select('bill_rooms.other')
                ->leftjoin('rooms','bill_rooms.room_id','=','rooms.id')
                ->where('rooms.member_id',$user_id)
                ->whereYear('date_bill',date("Y"))
                ->whereMonth('date_bill',$last_month)
                ->first());
                if($payment['otherService'] != null){
                    $payment['otherService'] = json_decode($payment['otherService']->other);
                }
            //dd($payment['qrcode']);
            return view('payment-channel/bank')->with(compact('payment')); 
        }
    }

    public function view_line(){
        return view('payment-channel/line-bot');  
    }
}
