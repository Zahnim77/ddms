<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Job;
use Session;

class CategoryController extends Controller
{
    public function __construct()
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
        //View for all categories
        $categories = Category::orderBy('id', 'desc')->paginate(10);
        return view('categories.index')->withCategories($categories);
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
        //Save a  new category and redirect back to index
        $this->validate($request, array(
            'name' => 'required|max:255'
        ));

        $category = new Category;

        $category->name = $request->name;
        $category->save();

        Session::flash('success', 'New Category has been created!');

        return redirect()->route('categories.index');

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
        $category = Category::find($id);

        if ($request->input('name') == $category->name) {

            Session::flash('caution', 'Nothing To Update!');
            return redirect()->route('categories.index');

        } else {

            $this->validate($request, array(
                'name' => 'required|max:255'
            ));

            $category->name = $request->input('name');
            $category->save();
            Session::flash('success', 'Category Name has been updated!');
            return redirect()->route('categories.index');
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
        $category = Category::findOrFail($id);
        $jobs = Job::all();
        global $record;
        
        foreach($jobs as $job) {

            if ($job->category_id == $id) {
                $record = 'found';
            break;
            }
        }

        if ($record == 'found') {

            Session::flash('caution', 'The Category you\'re trying to delete is linked to Jobs!');
            return redirect()->route('categories.index');
        } else {

            $category->delete();

            Session::flash('delete', 'The Category Name is deleted!');
            return redirect()->route('categories.index');
        }
    }
}
