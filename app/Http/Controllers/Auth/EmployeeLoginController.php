<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:employee');
    }
    public function ShowLoginForm(){
        return view('auth.employee-login');
    }

    public function Login(Request $request){
        //validate form data
        $this->validate($request, [
            'email'=> 'required|email',
            'password'=>'required|min:6',
        ]);

        //attempt to log the user in
        if(Auth::guard('employee')->attempt(['email'=>$request->email, 'password'=>$request->password], $request->remember)){
            //if successful, return to their intendent location
            return redirect()->intended(route('employee.dashboard'));
        }
        //if unsuccessful
        return redirect()->back()->withInput($request->only('email', 'remember'));
    }
}
