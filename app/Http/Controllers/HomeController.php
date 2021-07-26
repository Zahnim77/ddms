<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Image;
use Auth;
use Storage;
use Session;
use App\Job;
use App\Tag;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = User::find(Auth::guard('web')->user()->id);

        if (!isset($user->cv))
            Session::flash('caution', 'Please Upload Your CV to apply for Jobs!');

        return view('home')->withUser($user);
    }

    public function application ($slug, $userID)
    {
        $user = User::find($userID);
        $job = Job::where('slug', '=', $slug)->first();

        //dd($user->name.' & '.$job->job_title);
        $job->users()->sync($user); // Create an Application

        return redirect()->route('home');
    }

    public function profile($id)
    {
        $user = User::find($id);
        //dd($user);
        //dd($user);
        $tags = Tag::all();
        $tag_array = [];

        if ($user->id == Auth::guard('web')->user()->id) {

            foreach ($tags as $tag) {
                $tag_array[$tag->id] = $tag->name;
            }

            return view('profile')->withUser($user)->withTags($tag_array);

        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    public function update_profile(Request $request, $id)
    {
        $user = User::find($id);

        $this->validate($request, array(
            'name' => 'required|max:255',
            //'avatar' => 'required|image'
        ));

        $user->name = $request->input('name');

        if ($request->hasFile('avatar')) {
            // Creating Write Permission to path
            $path = storage_path('app/public/avatars/');
            if (!file_exists($path)) mkdir($path, 0755);

            // Delete Old File if exists
            if (isset($user->avatar)) {
                $oldAvatar = $user->avatar;
                Storage::delete('/public/avatars/'.$oldAvatar);
            }

            $image = $request->file('avatar');
            $filename = time().'_'.$user->name.'.'.$image->getClientOriginalExtension();
            $location = $path.$filename;
            //if (!file_exists($location)) mkdir($location, 0755);
            Image::make($image)->resize(320,240)->save($location);
            $user->avatar = $filename;
            //dd($user->avatar);
        }

        if ($request->hasFile('cv')) {
            // Creating Write Permission to path
            $path = storage_path('app/public/cvs/');
            if (!file_exists($path)) mkdir($path, 0755);

            
            // Delete Old File if exists
            if (isset($user->cv)) {
                $oldCV = $user->cv;
                Storage::delete('/public/cvs/'.$oldCV);
            }

            $resume = $request->file('cv');
            $filename = time().'_'.$user->name.'.'.$resume->getClientOriginalExtension();
            Storage::putFileAs('public/cvs', $resume, $filename);
            $user->cv = $filename;
            //dd($user->avatar);
        } 
        // Save Updates
        $user->save();
        
        // Check to see if Tags are associated with Jobs or Not 
        if (isset($request->tags) ) {
            $user->tags()->sync($request->tags);
        } else {
            $user->tags()->sync([]);
        }

        Session::flash('info', 'Your Profile is successfully updated!');
        return redirect()->back();
    }
}
