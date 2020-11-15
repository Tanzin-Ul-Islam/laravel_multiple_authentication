<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Ui\Presets\React;

class AdminLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin');
    }
    public function ShowLoginForm(){
        return view('auth.admin-login');
    }

    public function Login(Request $request){
        //validate form data
        $this->validate($request, [
            'email'=> 'required|email',
            'password'=>'required|min:6',
        ]);

        //attempt to log the user in
        if(Auth::guard('admin')->attempt(['email'=>$request->email, 'password'=>$request->password], $request->remember)){
            //if successful, return to their intendent location
            return redirect()->intended(route('admin.dashboard'));
        }
        //if unsuccessful
        return redirect()->back()->withInput($request->only('email', 'remember'));
    }
}
