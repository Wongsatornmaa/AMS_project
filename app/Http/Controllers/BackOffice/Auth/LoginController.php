<?php

namespace App\Http\Controllers\BackOffice\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    protected $redirectTo = '/backoffice/home';

    public function showLoginForm()
    {
        return view('auth.login-admin');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);

        $userLogin = array(
            'user_name' => $request->get("email"),
            'password' => $request->get("password")
        );

        if (auth::guard('admin')->attempt($userLogin)) {
            $return = [
                'status' => true,
                'massage' => "เข้าสู่ระบบสำเร็จ",
                'redirect' => url('/backoffice/home')

            ];

                return redirect()->route('home');
        } else {
            return redirect()->back()->with('message', 'E-mail or password is wrong');
        }
    }

    public function logout()
    {
        $this->guard()->logout();
        return redirect('backoffice/login');
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }
}
