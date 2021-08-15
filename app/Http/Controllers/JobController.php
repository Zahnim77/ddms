<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator; // Added for laravel 8
use App\Job;
use App\Category;
use App\Tag;
use App\Company;
use Session;
use Auth;
use Purifier; // secure WYSIWYG Input


class JobController extends Controller
{
    public function __construct() {

        $this->middleware('auth:admin');
        
        /* if (Auth::guard('admin')->check()) {
            $this->middleware('auth:admin');
        } else if (Auth::guard('company')->check()) {
            $this->middleware('auth:company');
        } */

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Paginator::useBootstrap(); // Added for laravel 8
        $jobs = Job::orderBy('id', 'desc')->paginate(10);
        return view('jobs.index')->withJobs($jobs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('jobs.create')->withCategories($categories)->withTags($tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        //validation
        $this->validate($request, array(
            'company_name' => 'required|max:100',
            'job_title' => 'required|max:255',
            'vacancy' => 'integer|nullable',
            'slug' => 'required|alpha_dash|min:5|max:255|unique:jobs,slug',
            'category_id' => 'required|integer',
            'job_description' => 'required',
            'salary' => 'string|nullable',
            'location' => 'required|string'
        ));
        //store in database
        $job = new Job;

        $job->company_name = $request->company_name;
        $job->job_title = $request->job_title;
        $job->vacancy = $request->vacancy;
        $job->slug = $request->slug;
        /* if (Auth::guard('company')->check()) {
            $job->company_id = Auth::guard('company')->user()->id;
        } */
        $job->category_id = $request->category_id;
        $job->job_description = Purifier::clean($request->job_description);
        $job->salary = $request->salary;
        $job->location = $request->location;

        $job->save();

        $job->tags()->sync($request->tags, false);

        Session::flash('success', 'The Job post is successfully saved!');
        //redirect to homepage
        return redirect()->route('jobs.show', $job->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $job = Job::find($id);
        return view('jobs.show')->withJob($job);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $job = Job::find($id);

        $categories = Category::all();
        $tags = Tag::all();

        $cat_array = [];
        $tag_array = [];
        /*
        $company = [];
        if (Auth::guard('company')->check()) {
           $company = Company::find(Auth::guard('company')->user()->id);
        }
        */
        foreach ($categories as $category) {
            $cat_array[$category->id] = $category->name;
        }
        foreach ($tags as $tag) {
            $tag_array[$tag->id] = $tag->name;
        }

        return view('jobs.edit')->withJob($job)->withCategories($cat_array)->withTags($tag_array);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Find job with sub-sequent id & store in database
        $job = Job::find($id);
        // Check whether the 'slug' is changed or not
        if ($request->input('slug') == $job->slug) {

            $this->validate($request, array(
                'company_name' => 'required|max:100',
                'job_title' => 'required|max:255',
                'vacancy' => 'integer|nullable',
                'category_id' => 'required|integer',
                'job_description' => 'required',
                'salary' => 'string|nullable',
                'location' => 'required|string'
            ));
        } else {
            $this->validate($request, array(
                'company_name' => 'required|max:100',
                'job_title' => 'required|max:255',
                'vacancy' => 'integer|nullable',
                'category_id' => 'required|integer',
                'slug' => 'required|alpha_dash|min:5|max:255|unique:jobs,slug',
                'job_description' => 'required',
                'salary' => 'string|nullable',
                'location' => 'required|string'
            ));
        }

        $job->company_name = $request->input('company_name');
        $job->job_title = $request->input('job_title');
        $job->vacancy = $request->input('vacancy');
        $job->category_id = $request->input('category_id');
        $job->slug = $request->slug;
        //$job->company_id = $request->input('company_id');// Hidden in Edit form
        $job->job_description = Purifier::clean($request->input('job_description'));
        $job->salary = $request->input('salary');
        $job->location = $request->input('location');

        $job->save();
        /* Thinking about job_user pivot
        $tag = Tag::find(5);
        $job->tags()->sync($tag);
        */
        // Check to see if Tags are associated with Jobs or Not 
        if ( isset($request->tags) ) {
            $job->tags()->sync($request->tags);
        } else {
            $job->tags()->sync([]);
        }
        //Set flash data with success message
        Session::flash('success', 'The Job post is successfully updated!');
        //redirect to show
        return redirect()->route('jobs.show', $job->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $job = Job::find($id);

        //Delete reference from foreign relative 'job_tag' table
        $job->tags()->detach();
        
        $job->delete();

        Session::flash('delete', 'The Job post is deleted.');
        return redirect()->route('jobs.index');
    }
}
