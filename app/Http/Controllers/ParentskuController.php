<?php

namespace App\Http\Controllers;

use DB;
use App\Parentsku;
use App\Subcategories;
use App\Categories;
use Illuminate\Http\Request;

class ParentskuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cat_array = array();
        $categories = Categories::select('id','cat_name')->get();
        foreach ($categories as $category)
        {
            $cat_array[$category->id] = $category->cat_name;
        }

        $subcat_array = array();
        $subcategories = Subcategories::select('id','subcat_name')->get();
        foreach ($subcategories as $subcategory)
        {
            $subcat_array[$subcategory->id] = $subcategory->subcat_name;
        }

        $parentsku = Parentsku::latest()->paginate(5);
        return view('parentsku.index',compact('parentsku','cat_array','subcat_array'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Categories::select('id','cat_name','cat_id')->get();
        return view('parentsku.create',compact('categories'));
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
        'psku_name'=>'required',
        'psku_desc'=> 'required',
        'cat_name'=>'required',
        'subcat_name'=> 'required'
      ]);

      $psku = DB::table('parentskus')->max('psku_id');
      $parentsku = new Parentsku();
      $parentsku->psku_id = $psku + 1;
      $parentsku->psku_name = $request->get('psku_name');
      $parentsku->psku_desc = $request->get('psku_desc');
      $parentsku->cat_id = $request->get('cat_name');
      $parentsku->subcat_id = $request->get('subcat_name');
      $parentsku->is_active = 1;
      $parentsku->created_at = Now();

      $parentsku->save();
      return redirect('/parentsku')->with('success', 'Parent SKU Successfully Added!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Categories::select('id','cat_name','cat_id')->get();
        $psku = Parentsku::find($id);
        $subcategories = Subcategories::where('cat_id',$psku->cat_id)->get();
        return view('parentsku.edit', compact('psku','categories','subcategories'));
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
        $request->validate([
        'psku_name'=>'required',
        'psku_desc'=> 'required',
        'cat_name'=>'required',
        'subcat_name'=> 'required'
      ]);
        //update
      $parentsku = Parentsku::find($id);
      $parentsku->psku_name = $request->get('psku_name');
      $parentsku->psku_desc = $request->get('psku_desc');
      $parentsku->cat_id = $request->get('cat_name');
      $parentsku->subcat_id = $request->get('subcat_name');
      $parentsku->is_active = 1;
      $parentsku->updated_at = Now();

      $parentsku->save();
      return redirect('/parentsku')->with('success', 'Parent SKU Successfully Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete
        $parentsku = Parentsku::find($id);
        $parentsku->delete();

        return redirect('/parentsku')->with('success', 'Parent SKU Successfully Deleted!');
    }

    public function parentskudeactivate($id)
    {
        //deactivate
        $parentsku = Parentsku::find($id);
        $parentsku->is_active = 2;
        $parentsku->save();
        return redirect('/parentsku')->with('success', 'Parent SKU Successfully Deactivated!');
    }

    public function parentskuactivate($id)
    {
        //activate
        $parentsku = Parentsku::find($id);
        $parentsku->is_active = 1;
        $parentsku->save();
        return redirect('/parentsku')->with('success', 'Parent SKU Successfully Activated!');
    }
}
