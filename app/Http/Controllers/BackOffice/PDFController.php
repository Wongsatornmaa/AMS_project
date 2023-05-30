<?php

namespace App\Http\Controllers\BackOffice;

use App\Models\Building;
use App\Models\Room;
use App\Models\BillRoom;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PDFController extends BackOfficeController
{

    public function showBill()
    {
        $bill = Billroom::select('rooms.id', 'rooms.number_room', 'bill_rooms.date_bill', 'bill_rooms.mitor_water', 'bill_rooms.mitor_electric', 'buildings.price_electric', 'buildings.price_water', 'bill_rooms.summary_water', 'bill_rooms.summary_electric')
            ->leftjoin('rooms', 'rooms.id', '=', 'bill_rooms.room_id')
            ->leftjoin('buildings', 'buildings.id', '=', 'rooms.building_id')
            ->get();
        return view('pdf', compact('bill'));
    }

    public function ExportPdf(Request $request)
    {
        Billroom::find($request->id)->update($request->all());
        $data['billAll'] = Billroom::select('rooms.id', 'rooms.number_room', 'bill_rooms.date_bill', 'bill_rooms.mitor_water', 'bill_rooms.mitor_electric', 'buildings.price_electric', 'buildings.price_water', 'bill_rooms.summary_water', 'bill_rooms.summary_electric', 'rooms.rent')
            ->leftjoin('rooms', 'rooms.id', '=', 'bill_rooms.room_id')
            ->leftjoin('buildings', 'buildings.id', '=', 'rooms.building_id')
            ->where('bill_rooms.id', $request->id)
            ->first();
        $data['billAll']->beforeDateBill = date("Y-m-d", strtotime("-1 months", strtotime(date($data['billAll']->date_bill))));

        // dd($data['billAll']);
        $data['beforeDateBill'] = BillRoom::leftjoin('rooms', 'rooms.id', '=', 'bill_rooms.room_id')
            ->where('date_bill', '=', $data['billAll']->beforeDateBill)
            ->where('rooms.number_room', '=', $data['billAll']->number_room)
            ->first();
        // dd($data['beforeDateBill']);
        $data['billAll']->summary_water =  $data['billAll']->mitor_water  * $data['billAll']->price_water;
        $data['billAll']->summary_electric = $data['billAll']->mitor_electric * $data['billAll']->price_electric;
        $data['billAll']->amount_water = $data['billAll']->mitor_water;
        $data['billAll']->amount_electric = $data['billAll']->mitor_electric;

        if (!empty($data['beforeDateBill'])) { //ถ้าเดือนก่อนหน้ามีทำงานตรงนี้
            $data['billAll']->amount_water = $data['billAll']->mitor_water - $data['beforeDateBill']->mitor_water;
            $data['billAll']->amount_electric = $data['billAll']->mitor_electric - $data['beforeDateBill']->mitor_electric;
            $data['billAll']->summary_water = ($data['billAll']->mitor_water - $data['beforeDateBill']->mitor_water) * $data['billAll']->price_water;
            $data['billAll']->summary_electric = ($data['billAll']->mitor_electric - $data['beforeDateBill']->mitor_electric) * $data['billAll']->price_electric;
        }

        $data['otherService'] = json_decode(BillRoom::select('bill_rooms.other')
            ->leftjoin('rooms', 'rooms.id', '=', 'bill_rooms.room_id')
            ->leftjoin('buildings', 'buildings.id', '=', 'rooms.building_id')
            ->where('bill_rooms.id', $request->id)
            ->first());
        $data['otherService'] = json_decode($data['otherService']->other);
        
        $pdf = PDF::loadView('Bill-manage.bill-pdf', ['data' => $data]);
        // return view('Bill-manage.bill-pdf',['data' => $data]);
        return @$pdf->stream('bill.pdf');
    }
}
