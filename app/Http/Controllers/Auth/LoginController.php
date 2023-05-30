<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Svg\Tag\Rect;
use App\models\UserMember;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */


    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'phone' => 'required',
            'password' => 'required'
        ]);

        $userLogin = array(
            'phone' => $request->get("phone"),
            'password' => $request->get("password"),
            'status' => 1
        );

        if (Auth::guard('member')->attempt($userLogin)) {
            $return = [
                'status' => true,
                'massage' => "เข้าสู่ระบบสำเร็จ",
                'redirect' => url('/home')

            ];
            return redirect()->route('homeUser');;
        } else {
            $userDetail = UserMember::where('phone','=',$request->phone)->first();
            if (!empty($userDetail)) {
                if ($userDetail->status == '0') {
                    return redirect()->route('login')->with('message', 'Your account is disabled.');
                }
            }
            
            // dd('unmatch');
            // return back()->with('massage', 'userName or password incorrect');
            return redirect()->route('login')->with('message', 'Username or password incorrect.');
        }
    }

    public function logout()
    {
        $this->guard()->logout();
        return redirect('/login');
    }

    protected function guard()
    {
        return Auth::guard('member');
    }

    public function redirectTo()
    {
        return '/login';
    }
}
