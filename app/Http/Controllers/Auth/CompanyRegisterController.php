<?php

namespace Illuminate\Foundation\Auth;
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
/* Company Registration */
use App\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class CompanyRegisterController extends Controller {

    protected $redirectTo = '/company';

    public function __construct() 
    {
        $this->middleware('guest:company');
    }

    /* Company Registration Form */
    public function showCompanyRegisterForm()
    {
        return view('auth.company-register');
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('company');
    }
    /**
     * Create a new company instance after a valid registration.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @return \App\Company
     */
    protected function createCompany(Request $request)
    {
        $this->validate($request, array(
            'name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:companies'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ));

        $company = new Company;

        $company->name = $request->name;
        $company->first_name = $request->first_name;
        $company->last_name = $request->last_name;
        $company->email = $request->email;
        $company->password = Hash::make($request->password);
        $company->save();

        $this->guard()->login($company);

        return redirect()->route('company.dashboard');
    }
}