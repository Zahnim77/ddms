<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Job;
use App\Category;
use App\Tag;
use App\Company;
use Session;
use Auth;

class CompanyController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:company');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        //$company = Company::find(Auth::guard('company')->user()->id);
        $jobs = Job::orderBy('id', 'desc')->where('company_id', '=', Auth::guard('company')->user()->id)->get();
        return view('company.index')->withJobs($jobs);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function applicants($companyId, $jobId)
    {   
        $job = Job::find($jobId);
        //dd($job->company_id);
        $company = Company::find($companyId);
        //$job = Job::where('company_id', '=', Auth::guard('company')->user()->id)->get();
        if (isset($job->company_id) && $job->company_id == $company->id) {
            return view('company.applicants')->withCompany($company)->withJob($job);
        } else {
            //abort(404);
            abort(403, 'Unauthorized action.');
        }
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
        return view('company.create')->withCategories($categories)->withTags($tags);
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
        $company = Company::find(Auth::guard('company')->user()->id);
        //store in database
        $job = new Job;

        $job->company_name = $request->company_name;
        $job->job_title = $request->job_title;
        $job->vacancy = $request->vacancy;
        $job->slug = $request->slug;
        
        $job->company()->associate($company->id);
        //$job->company_id = Auth::guard('company')->user()->id;

        $job->category_id = $request->category_id;
        $job->job_description = $request->job_description;
        $job->salary = $request->salary;
        $job->location = $request->location;

        $job->save();

        $job->tags()->sync($request->tags, false);

        Session::flash('success', 'The Job post is successfully saved!');
        //redirect to homepage
        return redirect()->route('company.show', ['company'=>$company->id, 'job'=>$job->id]);
        
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($companyId, $jobId)
    {
        $job = Job::find($jobId);
        //dd($job->company_id);
        $company = Company::find($companyId);
        //$job = Job::where('company_id', '=', Auth::guard('company')->user()->id)->get();
        if (isset($job->company_id) && $job->company_id == Auth::guard('company')->user()->id) {
            return view('company.show')->withCompany($company)->withJob($job);
        } else {
            //abort(404);
            abort(403, 'Unauthorized action.');
        }
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($companyId, $jobId)
    {
        $job = Job::find($jobId);
        $company = Company::find($companyId);
        //echo $company->id;
        if (isset($job->company_id) && $job->company_id == Auth::guard('company')->user()->id) {

            $categories = Category::all();
            $tags = Tag::all();

            $cat_array = [];
            $tag_array = [];

            foreach ($categories as $category) {
                $cat_array[$category->id] = $category->name;
            }
            foreach ($tags as $tag) {
                $tag_array[$tag->id] = $tag->name;
            }
            
            return view('company.edit')->withJob($job)->withCategories($cat_array)->withTags($tag_array)->withCompany($company);
        } else {
            //abort(404);
            abort(403, 'Unauthorized action.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $companyId, $jobId)
    {
        //Find job with sub-sequent id & store in database
        $job = Job::find($jobId);
        $company = Company::find($companyId);
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
        $job->job_description = $request->input('job_description');
        $job->salary = $request->input('salary');
        $job->location = $request->input('location');

        $job->save();

        // Check to see if Tags are associated with Jobs or Not 
        if ( isset($request->tags) ) {
            $job->tags()->sync($request->tags);
        } else {
            $job->tags()->sync([]);
        }

        //Set flash data with success message
        Session::flash('success', 'The Job post is successfully updated!');
        //redirect to show
        return redirect()->route('company.show', ['company'=>$company->id, 'job'=>$job->id]);
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
        return redirect()->route('company.dashboard');
    }
}
