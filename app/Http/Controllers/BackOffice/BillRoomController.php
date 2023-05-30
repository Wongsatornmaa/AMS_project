<?php

namespace App\Http\Controllers\BackOffice;

use Illuminate\Http\Request;
use App\Models\BillRoom;
use App\Models\Building;
use App\Models\Room;
use Laravel\Ui\Presets\React;

class BillRoomController extends BackOfficeController
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
        $data['buildingAll'] = Building::all();
        $data['yearBill'] = BillRoom::selectRaw('YEAR(date_bill) as year')
            ->groupBy('year')
            ->get();
        return view('bill-manage.bill')
            ->with(compact('data'));
    }

    public function getBill(Request $request)
    {
        $data['billRoom'] = BillRoom::select('bill_rooms.id', 'rooms.number_room', 'bill_rooms.mitor_water', 'bill_rooms.mitor_electric')
            ->leftjoin('rooms', 'rooms.id', '=', 'bill_rooms.room_id')
            ->leftjoin('buildings', 'buildings.id', '=', 'rooms.building_id')
            ->whereYear('date_bill', '=', $request->year)
            ->whereMonth('date_bill', '=', $request->month)
            ->where('building_name', '=', $request->building_name)
            ->get();
        return response($data, 200);
    }

    public function updateBill(Request $request)
    {

        Billroom::find($request->id)->update($request->all());
        $data['billroomDetail'] = Billroom::select('rooms.id', 'rooms.number_room', 'bill_rooms.date_bill', 'bill_rooms.mitor_water', 'bill_rooms.mitor_electric', 'buildings.price_electric', 'buildings.price_water', 'bill_rooms.summary_water', 'bill_rooms.summary_electric')
            ->leftjoin('rooms', 'rooms.id', '=', 'bill_rooms.room_id')
            ->leftjoin('buildings', 'buildings.id', '=', 'rooms.building_id')
            ->where('bill_rooms.id', $request->id)
            ->first();
        $data['billroomDetail']->beforeDateBill = date("Y-m-d", strtotime("-1 months", strtotime(date($data['billroomDetail']->date_bill))));

        $data['beforeDateBill'] = BillRoom::leftjoin('rooms', 'rooms.id', '=', 'bill_rooms.room_id')
            ->where('date_bill', '=', $data['billroomDetail']->beforeDateBill)
            ->where('rooms.number_room', $data['billroomDetail']->number_room)
            ->first();
        $data['billroomDetail']->summary_water =  $data['billroomDetail']->mitor_water  * $data['billroomDetail']->price_water;
        $data['billroomDetail']->summary_electric = $data['billroomDetail']->mitor_electric * $data['billroomDetail']->price_electric;

        if (!empty($data['beforeDateBill'])) { //ถ้าเดือนก่อนหน้ามีทำงานตรงนี้
            $data['billroomDetail']->summary_water = ($data['billroomDetail']->mitor_water - $data['beforeDateBill']->mitor_water) * $data['billroomDetail']->price_water;
            $data['billroomDetail']->summary_electric = ($data['billroomDetail']->mitor_electric - $data['beforeDateBill']->mitor_electric) * $data['billroomDetail']->price_electric;
        }
        $Bill = Billroom::find($request->id)->update([
            'summary_water' => $data['billroomDetail']->summary_water,
            'summary_electric' => $data['billroomDetail']->summary_electric,
        ]);

        return response("updateSuccess", 200);
    }

    public function editPage($id)
    {
        $data['billroomDetail'] = Billroom::find($id)
            ->select('bill_rooms.id', 'rooms.number_room', 'bill_rooms.date_bill', 'bill_rooms.mitor_water', 'bill_rooms.mitor_electric', 'buildings.price_electric', 'buildings.price_water', 'bill_rooms.summary_water', 'bill_rooms.summary_electric','bill_rooms.other')
            ->leftjoin('rooms', 'rooms.id', '=', 'bill_rooms.room_id')
            ->leftjoin('buildings', 'buildings.id', '=', 'rooms.building_id')
            ->where('bill_rooms.id', $id)
            ->first();
        $data['billroomDetail']->beforeDateBill = date("Y-m-d", strtotime("-1 months", strtotime(date($data['billroomDetail']->date_bill))));

        $data['beforeDateBill'] = BillRoom::leftjoin('rooms', 'rooms.id', '=', 'bill_rooms.room_id')
            ->where('date_bill', '=', $data['billroomDetail']->beforeDateBill)
            ->where('rooms.number_room', $data['billroomDetail']->number_room)
            ->first();
        // dd($data['billroomDetail']);

        $data['billroomDetail']->other = json_decode($data['billroomDetail']->other);

        return view('Bill-manage.edit-bill', $data);
    }
    public function update(Request $request, $id)
    {
        Billroom::find($id)->update([
            'other' => json_encode($request->otherService),
        ]);
        return redirect()->route('bill', ['message' => 'UpdateSuccess']);
    }

    public function delete($id)
    {
        Billroom::find($id)->delete();
        return  redirect()->route('bill-manage.bill', ['message' => 'DeleteSuccess']);
    }

    public function viewBill(Request $request )
    {
        Billroom::find($request->id);
        $data['billroomDetail'] = Billroom::select('rooms.id', 'rooms.number_room', 'bill_rooms.date_bill', 'bill_rooms.mitor_water', 'bill_rooms.mitor_electric', 'buildings.price_electric', 'buildings.price_water', 'bill_rooms.summary_water', 'bill_rooms.summary_electric','bill_rooms.other')
            ->leftjoin('rooms', 'rooms.id', '=', 'bill_rooms.room_id')
            ->leftjoin('buildings', 'buildings.id', '=', 'rooms.building_id')
            ->where('bill_rooms.id', $request->id)
            ->first();
        $data['billroomDetail']->beforeDateBill = date("Y-m-d", strtotime("-1 months", strtotime(date($data['billroomDetail']->date_bill))));

        $data['beforeDateBill'] = BillRoom::leftjoin('rooms', 'rooms.id', '=', 'bill_rooms.room_id')
            ->where('date_bill', '=', $data['billroomDetail']->beforeDateBill)
            ->where('rooms.number_room', $data['billroomDetail']->number_room)
            ->first();
        $data['billroomDetail']->summary_water =  $data['billroomDetail']->mitor_water  * $data['billroomDetail']->price_water;
        $data['billroomDetail']->summary_electric = $data['billroomDetail']->mitor_electric * $data['billroomDetail']->price_electric;

        if (!empty($data['beforeDateBill'])) { //ถ้าเดือนก่อนหน้ามีทำงานตรงนี้
            $data['billroomDetail']->summary_water = ($data['billroomDetail']->mitor_water - $data['beforeDateBill']->mitor_water) * $data['billroomDetail']->price_water;
            $data['billroomDetail']->summary_electric = ($data['billroomDetail']->mitor_electric - $data['beforeDateBill']->mitor_electric) * $data['billroomDetail']->price_electric;
        }
        $data['otherService'] = json_decode( BillRoom::select('bill_rooms.other')
        ->leftjoin('rooms', 'rooms.id', '=', 'bill_rooms.room_id')
        ->leftjoin('buildings', 'buildings.id', '=', 'rooms.building_id')
        ->where('bill_rooms.id', $request->id)
        ->first());
        // dd($data['otherService']);
        $data['otherService'] = json_decode($data['otherService']->other);
        // dd($data['otherService']);
        return view('bill-manage.view-bill',$data);
    }
}
