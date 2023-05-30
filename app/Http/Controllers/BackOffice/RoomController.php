<?php

namespace App\Http\Controllers\BackOffice;


use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\UserMember;
use App\Models\Building;

class RoomController extends BackOfficeController
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


    public function viewAms()
    {
        $roomInfo['showAllRoom'] = Room::select('*', 'rooms.status as roomStatus', 'user_members.status as userStatus', 'user_members.id as userId')
            ->leftjoin('user_members', 'user_members.id', '=', 'rooms.member_id')
            ->get();
        $roomInfo['countEmptyRoom'] = Room::selectRaw('count(rooms.id) as emptyRoom')
            ->where('status', '=', '0')
            ->first();
        // dd($roomInfo['countEmptyRoom']->emptyRoom);
        $roomInfo['countRoom'] = Room::selectRaw('count(rooms.id) as numRoom')
            ->where('status', '=', '1')
            ->first();
        return view('view-apartment.view-ams')->with(compact('roomInfo'));
    }
    public function index()
    {
        $data['roomAll'] = Room::all();
        return view('view-apartment.view-ams', $data);
    }

    public function createPage()
    {
        return view('view-apartment.view-ams');
    }

    public function create(Request $request)
    {

        $request->validate([
            'member_id' => 'nullable',
            'number_room' => 'nullable',
            'mitor_water' => 'nullable',
            'mitor_electric' => 'nullable',
            'mitor_cable' => 'nullable',
            'mitor_wifi' => 'nullable',
            'status' => 'nullable',
            'summary' => 'nullable',
            'qrcode' => 'nullable',
            'bank' => 'nullable',
            'transaction_log' => 'nullable',
        ]);

        Room::create($request->all());

        return redirect()->route('view-apartment.view-ams', ['message' => 'CreateSuccess']);
    }

    public function editPage($id)
    {
        $data['roomDetail'] = Room::find($id);
        return view('view-apartment.view-ams', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'member_id' => 'nullable',
            'number_room' => 'nullable',
            'mitor_water' => 'nullable',
            'mitor_electric' => 'nullable',
            'mitor_cable' => 'nullable',
            'mitor_wifi' => 'nullable',
            'status' => 'nullable',
            'summary' => 'nullable',
            'qrcode' => 'nullable',
            'bank' => 'nullable',
            'transaction_log' => 'nullable',
        ]);

        Room::find($id)->update($request->all());
        return redirect()->route('view-apartment.view-ams', ['message' => 'UpdateSuccess']);
    }

    public function delete($id)
    {
        Room::find($id)->delete();
        return  redirect()->route('view-apartment.view-ams', ['message' => 'DeleteSuccess']);
    }

    public function getRoom(Request $request)
    {
        $room = Room::where('building_id', '=', $request->building_id)->get();
        $mitor = Building::find($request->building_id);
        $detail["room"] = $room;
        $detail["mitor"] = $mitor;
        return response($detail, 200);
    }

    public function getDeposit(Request $request)
    {
        $roomdetail = Room::where('number_room', '=', $request->room_number)->first();
        // dd($roomdetail);
        return response($roomdetail, 200);
    }

    public function SeeDetail($id)
    {
        $room = Room::where('number_room', '=', $id)->first();
        // dd($room);
        if ($room->member_id != NULL) {
        $member = UserMember::find($room->member_id);
        $detail["room"] = $room;
        $detail["member"] = $member;
        return view('view-apartment.see-room-detail')->with(compact('detail'));
        } else {
            return view('view-apartment.see-room')->with(compact('room'));
        }
    }

    public function DetailRoomEmpty($id)
    {
        $room = Room::where('','=',$id)->first();
        return redirect()->route('seeEmptyRoom')->with(compact('room'));
    }
}
