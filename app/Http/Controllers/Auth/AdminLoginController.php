<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class AdminLoginController extends Controller
{
    public function __construct () 
    {
        $this->middleware('guest:admin', ['except' => ['logout']]);
    }

    public function showLoginForm () 
    {
        return view('auth.admin-login');
    }

    public function login (Request $request)
    {
        //validate the form data
        $this->validate($request, [
            'name' => 'required|string',
            'password' => 'required|min:6'
        ]);

        //if attempt to log user in successful :-
        if (Auth::guard('admin')->attempt([ 'name' => $request->name, 'password' => $request->password], $request->remember)) {
            return redirect()->intended(route('admin.dashboard'));
        }
        //if attempt to log user in failed :-
        return redirect()->back()->withInput($request->only('name','remember'));
    }

    public function logout ()
    {
        Auth::guard('admin')->logout();
        return redirect('/');
    }

}
