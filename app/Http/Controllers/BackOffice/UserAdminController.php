<?php

namespace App\Http\Controllers\BackOffice;


use Illuminate\Http\Request;
use App\Models\UserAdmin;

class UserAdminController extends BackOfficeController
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
        $data['useradminAll'] = Useradmin::all();
        return view('useradmin.index', $data);
    }

    public function createPage()
    {
        return view('useradmin.create');
    }

    public function create(Request $request)
    {

        $request->validate([
            'user_name' => 'nullable',
            'password' => 'nullable',
        ]);

        Useradmin::create($request->all());

        return redirect()->route('useradmin.view', ['message' => 'CreateSuccess']);
    }

    public function editPage($id)
    {
        $data['useradminDetail'] = Useradmin::find($id);
        return view('useradmin.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_name' => 'nullable',
            'password' => 'nullable',
        ]);

        Useradmin::find($id)->update($request->all());
        return redirect()->route('useradmin.view', ['message' => 'UpdateSuccess']);
    }

    public function delete($id)
    {
        Useradmin::find($id)->delete();
        return  redirect()->route('useradmin.view', ['message' => 'DeleteSuccess']);
    }
}
