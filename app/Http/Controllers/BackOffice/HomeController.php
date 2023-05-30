<?php

namespace App\Http\Controllers\BackOffice;


use Illuminate\Http\Request;
use App\Models\Building;
use App\Models\Room;

class HomeController extends BackOfficeController
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
        $buildingAll = Building::all();
        return view('admin-home.home')->with(compact('buildingAll'));
    }

    public function form()
    {
        $building = Building::all();
        return view('form-apartment.form')->with(compact('building'));
    }

    public function addInfo()
    {
        return view('ams-manage.add-info');
    }

    public function editInfo($id)
    {
        $data['buildingDetail'] = Building::find($id);
        return view('ams-manage.edit-info', $data);
    }

    public function saveInfoById(Request $request)
    {
    
        return view('admin-home.home');
    }

  

}
