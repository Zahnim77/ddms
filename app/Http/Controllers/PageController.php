<?php

namespace App\Http\Controllers;

//use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\Paginator; // Added for laravel 8
use App\Job;
use Mail;
use Session;
use App\Category;
use App\Company;
use App\User;

class PageController extends Controller {
    
    public function getIndex () {
        Paginator::useBootstrap(); // Added for laravel 8
        $jobTotal = Job::all();
        $jobs =Job::orderBy('created_at', 'desc')->paginate(4);
        $categories = Category::all();
        $companies = Company::all();
        $users = User::all();
        return view ('pages.welcome')->withJobs($jobs)->withJobTotal($jobTotal)->withCategories($categories)->withCompanies($companies)->withUsers($users);
    }
    
    public function getLogin() {
        return view ('pages.login');
    }
    
    public function getContact () {
        return view ('pages.contact');
    }

    public function postContact (Request $request) {
        
        $this->validate($request, [
            'email' => 'required|email:rfc,dns',
            'subject' => 'max:255',
            'message' => 'min:10'
        ]);
        
        $data = array(
            'email' => $request->email,
            'subject' => $request->subject,
            'bodyMsg' => $request->message
        );

        Mail::send('emails.contact', $data, 
            function ($msg) use ($data) {
                $msg->to('minhaz.060@gmail.com');
                $msg->from($data['email']);
                $msg->subject($data['subject']);
            }
        );

        Session::flash('success', 'Your Email is successfully sent!');
        return redirect('/');

    }
}