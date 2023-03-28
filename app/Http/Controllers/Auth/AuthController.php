<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //

    protected $redirectTo = '/';

    protected $guard = 'misadmin';

    public function __construct()
    {
        $this->middleware('guest:misadmin')->except('logout');
    }

    public function cgwbpnmlogin()
    {
        return view('auth.login');
    }

    public function refreshCaptcha()
    {
        echo captcha_img('default');
        exit;
    }

    public function login(Request $request)
    {
        $this->validate($request,
            [
                'email' => 'required',
                'password' => 'required',                 
            ] 
        );

        try {
            //////// check password for security purpose ///////////

            $user = User::where('admin_email', $request->input('email'))
			->where('password', $request->input('password'))
            ->where('is_active', '=', 1)
            ->where('status', 1)
            ->where('is_deleted', 0)
            ->first();
		 
            if ($user) {                 
                if ($user->password != $request->password) {
                    return redirect()->back()->with('error', 'Invalid Username or Password!!');
                } else {
                    Auth::guard('misadmin')->loginUsingId($user->id);

                    return redirect()->route('admin.dashboard');
                }
            } else {
                return redirect()->back()->with('error', 'Invalid Username or Password!!');
            }

            return redirect()->back()->with('error', 'Invalid Username or Password!!');
        } catch (Exception $e) {
            Log::error($e);

            return redirect()->back()->with('error', 'Invalid Username or Password!!');
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('misadmin')->logout();
        $request->session()->flush();

        return redirect()->route('cgwbpnm');
    }
}
