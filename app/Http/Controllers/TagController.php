<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Tag;

class TagController extends Controller
{
    public function __construct ()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //View for all tags
        $tags = Tag::orderBy('id', 'desc')->paginate(10);
        return view('tags.index')->withTags($tags);
        //Form to create new category
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Save a  new tag and redirect back to index
        $this->validate($request, array(
            'name' => 'required|max:255'
        ));

        $tag = new Tag;

        $tag->name = $request->name;
        $tag->save();

        Session::flash('success', 'New Tag has been created!');

        return redirect()->route('tags.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tag = Tag::find($id);
        return view('tags.show')->withTag($tag);
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
        $tag = Tag::find($id);

        if ($request->input('name') == $tag->name) {

            Session::flash('caution', 'Nothing To Update!');
            return redirect()->route('tags.index');

        } else {

            $this->validate($request, array(
                'name' => 'required|max:255'
            ));

            $tag->name = $request->input('name');
            $tag->save();
            Session::flash('success', 'TAG Name has been updated!');
            return redirect()->route('tags.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag = Tag::findOrFail($id);

        $tag->jobs()->detach();

        $tag->delete();

        Session::flash('delete', 'The TAG Name is deleted!');
        return redirect()->route('tags.index');
    }
}
