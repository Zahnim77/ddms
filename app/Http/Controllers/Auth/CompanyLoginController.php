<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

use Auth;

class CompanyLoginController extends Controller 
{

    public function __construct () 
    {
        $this->middleware('guest:company', ['except' => ['logout']]);
    }

    public function showCompanyLoginForm()
    {
        return view('auth.login', ['url' => 'company']);
    }
    /** 
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function login(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:8'
        ]);

        if (Auth::guard('company')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
            //return $this->sendLoginResponse($request);
            return redirect()->route('company.dashboard');
        }
        return back()->withInput($request->only('email', 'remember'));
    }
    
    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /* protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        return $this->authenticated($request, $this->guard()->user())
                ?: redirect()->route('company.dashboard');
    } */
    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    /*
    protected function guard()
    {
        return Auth::guard('company');
    }

    protected function authenticated(Request $request, $user)
    {
        //
    }
    */
    public function logout ()
    {
        Auth::guard('company')->logout();
        return redirect('/');
    }

}