<?php

namespace App\Http\Controllers;

use App\Subcategories;
use App\Categories;
use Illuminate\Http\Request;

class SubcategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cat_array = array();
        $subcategories = Subcategories::latest()->paginate(5);
        $categories = Categories::select('id','cat_name')->get();

        foreach ($categories as $category)
        {
            $cat_array[$category->id] = $category->cat_name;
        }
         
        // dd($cat_array);
        return view('subcategories.index',compact('subcategories','cat_array'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Categories::select('id','cat_name')->get();
        return view('subcategories.create',compact('categories'));
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
        'subcat_code'=>'required',
        'subcat_name'=> 'required',
        'cat_name'=> 'required'
      ]);

      $subcategories = new Subcategories();
      $subcategories->subcat_code = $request->get('subcat_code');
      $subcategories->subcat_name = $request->get('subcat_name');
      $subcategories->cat_id = $request->get('cat_name');
      $subcategories->is_active = 1;
      $subcategories->created_at = Now();

      $subcategories->save();
      return redirect('/subcategories')->with('success', 'Sub Category Successfully Added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subcategories  $subcategories
     * @return \Illuminate\Http\Response
     */
    public function show(Subcategories $subcategories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subcategories  $subcategories
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cat_array = array();
        $categories = Categories::select('id','cat_name')->get();

        foreach ($categories as $category)
        {
            $cat_array[$category->id] = $category->cat_name;
        }
        $subcategories = Subcategories::find($id);
        return view('subcategories.edit', compact('subcategories','cat_array'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subcategories  $subcategories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
        'subcat_code'=>'required',
        'subcat_name'=> 'required'
      ]);
        //update
      $subcategories = Subcategories::find($id);
      $subcategories->subcat_code = $request->get('subcat_code');
      $subcategories->subcat_name = $request->get('subcat_name');
      $subcategories->is_active = 1;
      $subcategories->updated_at = Now();

      $subcategories->save();
      return redirect('/subcategories')->with('success', 'Sub Category Successfully Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subcategories  $subcategories
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subcategories = Subcategories::find($id);
        $subcategories->delete();

        return redirect('/subcategories')->with('success', 'Sub Category Successfully Deleted!');
    }
    public function deactivate($id)
    {
        //deactivate
        $subcategories = Subcategories::find($id);
        $subcategories->is_active = 2;
        $subcategories->save();
        return redirect('/subcategories')->with('success', 'Sub Category Successfully Deactivated!');
    }

    public function activate($id)
    {
        //activate
        $subcategories = Subcategories::find($id);
        $subcategories->is_active = 1;
        $subcategories->save();
        return redirect('/subcategories')->with('success', 'Sub Category Successfully Activated!');
    }
}
