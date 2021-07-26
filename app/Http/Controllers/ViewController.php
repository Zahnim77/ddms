<?php

namespace App\Http\Controllers;
use Illuminate\Pagination\Paginator; // Added for laravel 8
use Illuminate\Http\Request;
use App\Job;

class ViewController extends Controller
{
    public function getIndex() {
        Paginator::useBootstrap(); // Added for laravel 8
        $jobs = Job::orderBy('created_at', 'desc')->paginate(5);
        return view('view.index')->withJobs($jobs);
    }

    public function getSingle($slug) {
        //fetch from the DB based on slug
        $job = Job::where('slug', '=', $slug)->first();
        //return public view for the job_post object
        return view('view.single')->withJob($job);
    }
}
