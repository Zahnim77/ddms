<?php

namespace App\Http\Controllers;

//use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Job;
use Mail;
use Session;

class PageController extends Controller {
    
    public function getIndex () {
        $jobs =Job::orderBy('created_at', 'desc')->limit(5)->get();
        return view ('pages.welcome')->withJobs($jobs);
    }
    
    public function getLogin() {
        return view ('pages.login');
    }
    
    public function getContact () {
        return view ('pages.contact');
    }

    public function postContact (Request $request) {
        
        $this->validate($request, [
            'email' => 'required|email',
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