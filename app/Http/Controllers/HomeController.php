<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Image;
use Storage;
use Session;

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
        return view('home');
    }

    public function profile($id)
    {
        $user = User::find($id);
        //dd($user);
        return view('profile')->withUser($user);
    }

    public function update_profile(Request $request, $id)
    {
        $user = User::find($id);

        $this->validate($request, array(
            'name' => 'required|max:255',
            'avatar' => 'required|image'
        ));

        $user->name = $request->input('name');

        if ($request->hasFile('avatar')) {
            $path = storage_path('app/public/avatars/');
            if (!file_exists($path)) mkdir($path, 0755);
            $image = $request->file('avatar');
            $filename = time().'_'.$user->name.'.'.$image->getClientOriginalExtension();
            $location = $path.$filename;
            //if (!file_exists($location)) mkdir($location, 0755);
            Image::make($image)->resize(320,240)->save($location);
            $user->avatar = $filename;
            //dd($user->avatar);
        }
        $user->save();
        //$avatar = $request->avatar;
        //dd($avatar);
        Session::flash('success', 'Your Profile is successfully updated!');
        return redirect()->back();
    }
}
