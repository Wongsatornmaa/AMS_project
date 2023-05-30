<?php

namespace App\Http\Controllers;

use App\Models\UserMember;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserController extends Controller
{
    public function view_user(){
        $user_id = Auth::guard('member')->user()->phone;
        
        $userInfo['showInfo'] = UserMember::select(
            'user_members.id as id',
            'user_members.first_name as first_name',
            'user_members.last_name as last_name',
            'user_members.date_of_birth as date_of_birth',
            'user_members.phone as phone',
            'user_members.line as line',
            'user_members.facebook as facebook',
            'user_members.email as email'
        )
        ->where('user_members.phone',$user_id)
        ->get();

        return view('user-member/user')->with(compact('userInfo'));
    }

    public function update(Request $request)
    {
        $user_id = Auth::guard('member')->user()->id;

        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required|min:10|max:10',
            'date_of_birth' => 'nullable|date|date_format:Y-m-d|before:'.now()->subYears(18)->toDateString(),
            'facebook' => 'nullable',
            'line' => 'nullable',
            'email' => 'nullable'
        ]);
        Usermember::find($user_id)->update($request->all());
        return redirect()->route('user');
    }


}
