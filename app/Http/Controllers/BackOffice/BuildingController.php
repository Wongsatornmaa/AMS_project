<?php

namespace App\Http\Controllers\BackOffice;


use Illuminate\Http\Request;
use App\Models\Building;
use App\Models\Room;
use App\Models\BillRoom;

class BuildingController extends BackOfficeController
{
    public function index()
    {
        $buildingAll = Building::all();
        return view('admin-home.home', $buildingAll);
    }

    public function createPage()
    {
        return view('building.create');
    }

    public function create(Request $request)
    {
        $request->validate([
            'floor_count' => 'required',
            'room_count' => 'required',
            'building_name' => 'required|unique:buildings',
            'phone' => 'required',
            'price_water' => 'required',
            'price_electric' => 'required',
            'deposit' => 'required'
        ]);

        // $building = Building::create($request->all());

        $building = Building::create([
            'floor_count' => $request->floor_count,
            'room_count' => $request->room_count,
            'building_name' => $request->building_name,
            'phone' => $request->phone,
            'price_water' => $request->price_water,
            'price_electric' => $request->price_electric
        ]);
        $allRoom = $request->floor_count * $request->room_count;
        for ($floor = 1; $floor <= $request->floor_count; $floor++) {
            for ($room = 1; $room <= $request->room_count; $room++) {
                $number_room = "";
                $number_room .= $request->building_name . strval($floor);
                if ($room < 10) {
                    $number_room .= "0" . strval($room);
                } else {
                    $number_room .= strval($room);
                }
                $newRoom = Room::create([
                    'number_room' => $number_room,
                    'status' => "0",
                    'building_id' => $building->id,
                    'deposit' => $request->deposit,
                ]);

                $monthNow = date("m");
                $yearNow = date("Y");
                
                for ($i = $monthNow; $i <= 12; $i++) {
                    $time = $yearNow . '/' . $i . '/28';
                    // dd($time);
                    BillRoom::create([
                        'room_id' => $newRoom->id,
                        'status' => "0",
                        'date_bill' => date('Y-m-d', strtotime($time)),
                    ]);
                }
            }
        }
        return redirect()->route('home')->with('message', 'CreateSuccess');
    }

    public function editPage($id)
    {
        $data['buildingDetail'] = Building::find($id);
        return view('ams-manage.edit-info', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'floor_count' => 'nullable',
            'room_count' => 'nullable',
            'building_name' => 'nullable',
            'phone' => 'nullable',
            'price_water' => 'nullable',
            'price_electric' => 'nullable',
        ]);

        Building::find($id)->update($request->all());
        return redirect()->route('home', ['message' => 'UpdateSuccess']);
    }

    public function delete($id)
    {
        Building::find($id)->delete();
        return  redirect()->route('ams-manage.add-info', ['message' => 'DeleteSuccess']);
    }

    public function saveInfo()
    {
    }
}
