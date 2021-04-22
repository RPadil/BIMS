<?php

namespace App\Http\Controllers;

use DB;
use App\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Categories::latest()->paginate(5);
        return view('categories.index',compact('categories'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
        'cat_code'=>'required',
        'cat_name'=> 'required'
      ]);

      $cat = DB::table('categories')->max('cat_id');
      $categories = new Categories();
      $categories->cat_id = $cat + 1;
      $categories->cat_code = $request->get('cat_code');
      $categories->cat_name = $request->get('cat_name');
      $categories->is_active = 1;
      $categories->created_at = Now();

      $categories->save();
      return redirect('/categories')->with('success', 'Category Successfully Added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function show(Categories $categories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Categories::find($id);
        return view('categories.edit', compact('categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
        'cat_code'=>'required',
        'cat_name'=> 'required'
      ]);
        //update
      $categories = Categories::find($id);
      $categories->cat_code = $request->get('cat_code');
      $categories->cat_name = $request->get('cat_name');
      $categories->is_active = 1;
      $categories->updated_at = Now();

      $categories->save();
      return redirect('/categories')->with('success', 'Category Successfully Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete
        $categories = Categories::find($id);
        $categories->delete();

        return redirect('/categories')->with('success', 'Category Successfully Deleted!');
    }
    public function categoriesdeactivate($id)
    {
        //deactivate
        $categories = Categories::find($id);
        $categories->is_active = 2;
        $categories->save();
        return redirect('/categories')->with('success', 'Category Successfully Deactivated!');
    }

    public function categoriesactivate($id)
    {
        //activate
        $categories = Categories::find($id);
        $categories->is_active = 1;
        $categories->save();
        return redirect('/categories')->with('success', 'Category Successfully Activated!');
    }
}
