<?php

namespace App\Http\Controllers\BackOffice;
use Illuminate\Support\Facades\Hash;


use Illuminate\Http\Request;
use App\Models\UserMember;
use App\Models\Room;
use Illuminate\Validation\Rule;

class UserMemberController extends BackOfficeController
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
        $data['userMemberAll'] = UserMember::all();
        return view('create-account.index', $data);
    }

    public function addAccount()
    {

        return view('create-account.add-account');
    }

    public function editAccount()
    {
        return view('create-account.edit-account');
    }


    public function createPage()
    {
        return view('usermember.create');
    }

    public function create(Request $request)
    {

        $request->validate([
            'first_name' => 'nullable',
            'last_name' => 'nullable',
            'phone' => 'nullable',
            'citizen' => 'nullable',
            'line' => 'nullable',
            'facebook' => 'nullable',
            'email' => 'nullable',
            'image' => 'nullable',
            'password' => 'nullable',
            'date_of_birth' => 'nullable',
            'emergency_name' => 'nullable',
            'relationship' => 'nullable',
            'phone_relationship' => 'nullable',
            'description' => 'nullable',
            'status' => 'nullable',
        ]);

        Usermember::create($request->all());

        return redirect()->route('create-account.add-account', ['message' => 'CreateSuccess']);
    }

    public function editPage($id)
    {
        $data['usermemberDetail'] = Usermember::find($id);

        //dd($data);
        return view('create-account.edit-account', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => ['required',Rule::unique('user_members')->ignore($id)],
            'email' => ['nullable','email:rfc,dns',Rule::unique('user_members')->ignore($id)],
            'password' => 'required|confirmed|min:6',
        ]);

        $request->merge([
            'password' => Hash::make($request->password),
        ]);
        // dd($request);
        $data = Usermember::find($id)->update($request->all());
        return redirect()->route('accountIndex');
    }

    public function delete($id)
    {
        Usermember::find($id)->delete();
        return  redirect()->route('usermember.view', ['message' => 'DeleteSuccess']);
    }

    public function createInfoMember(Request $request)
    {
        $request->validate([
            'building' => 'required',
            'number_room' => 'required',
            'day_in' => 'required|date|after:yesterday',
            'day_out' => 'required|date|after:day_in',
            'amount_people' => 'required',
            'period' => 'required',
            'deposit' => 'required',
            'first_name' => 'required',
            'rent' => 'required',
            'last_name' => 'required',
            'phone' => 'required|unique:user_members',
            'citizen' => 'required|min:13|unique:user_members',
            'email' => 'nullable|email:rfc,dns|unique:user_members',
            'facebook' => 'nullable',
            'line' => 'nullable',
            'emergency_name' => 'nullable',
            'relationship' => 'nullable',
            'phone_relationship' => 'nullable',
            'description' => 'nullable',
            'date_of_birth' => 'nullable|before:now',
        ]);

        $request->merge([
            'status' => 1,
        ]);

        $user = Usermember::create($request->all());

        $roomNum = Room::where('number_room', $request->number_room)->update([
            'member_id' => $user->id,
            'status' => 1,
            'rent' =>  $request->rent,
        ]);

        return redirect()->route('viewAms');
    }

    public function addAccountMember(Request $request)
    {

        // $password = Hash::make($request->password);

        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required|unique:user_members',
            'email' => 'nullable|email:rfc,dns|unique:user_members',
            'password' => 'required|confirmed|min:6',
            // 'confirm_password' => 'required|same:password'
        ]);

        $request->merge([
            'password' => Hash::make($request->password),
        ]);

        Usermember::create(
            $request->all()
        );
        // Usermember::insert([
        //     'first_name' => $request->first_name,
        //     'last_name' => $request->first_name,
        //     'phone' => $request->phone,
        //     'email' => $request->email,
        //     'password' => $password
        // ]);

        return redirect()->route('accountIndex', ['message' => 'CreateSuccess']);
    }

    public function viewEdit($id)
    {
        $data['userMemberDetail'] = UserMember::find($id);
        return view('view-apartment.edit-ams', $data);
    }

    public function updateAms(Request $request, $id)
    {
        
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => ['required','min:10', Rule::unique('user_members')->ignore($id)],
            'citizen' => ['required','min:13',Rule::unique('user_members')->ignore($id)],
            'line' => 'nullable',
            'facebook' => 'nullable',
            'email' => ['nullable','email:rfc,dns',Rule::unique('user_members')->ignore($id)],
            'date_of_birth' => 'nullable|before:now',
            'emergency_name' => 'nullable',
            'relationship' => 'nullable',
            'phone_relationship' => 'nullable|min:10',
            'description' => 'nullable',
            'amount_people' => 'required',
        ]);

        UserMember::find($id)->update($request->all());
        return redirect()->route('viewAms', ['message', 'UpdateSuccess']);
    }
}
