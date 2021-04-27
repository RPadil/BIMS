<?php

namespace App\Http\Controllers;

use DB;
use App\Sku;
use App\Subcategories;
use App\Categories;
use App\Parentsku;
use Illuminate\Http\Request;

class SkuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //index
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

        $psku_array = array();
        $parentskus = Parentsku::select('id','psku_name')->get();
        foreach ($parentskus as $parentsku)
        {
            $psku_array[$parentsku->id] = $parentsku->psku_name;
        }
        // dd($subcat_array);
        $sku = Sku::latest()->paginate(5);
        return view('sku.index',compact('sku','cat_array','subcat_array','psku_array'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //create
        $categories = Categories::select('id','cat_name','cat_id')->get();
        $parentskus = Parentsku::select('id','psku_id','psku_name')->get();
        return view('sku.create',compact('categories','parentskus'));
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
        'sku_name'=>'required',
        'sku_desc'=> 'required',
        'cat_name'=>'required',
        'subcat_name'=> 'required',
        'psku_name'=> 'required'
      ]);

      $sk = DB::table('skus')->max('sku_id');
      $sku = new Sku();
      $sku->sku_id = $sk + 1;
      $sku->sku_name = $request->get('sku_name');
      $sku->sku_desc = $request->get('sku_desc');
      $sku->cat_id = $request->get('cat_name');
      $sku->subcat_id = $request->get('subcat_name');
      $sku->psku_id = $request->get('psku_name');
      $sku->is_active = 1;
      $sku->created_at = Now();

      $sku->save();
      return redirect('/sku')->with('success', 'SKU Successfully Added!');
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
        //edit
        $categories = Categories::select('id','cat_name','cat_id')->get();
        $sku = Sku::find($id);
        $subcategories = Subcategories::where('cat_id',$sku->cat_id)->get();
        $parentskus = Parentsku::where('psku_id',$sku->psku_id)->get();
        // dd($subcategories);
        return view('sku.edit', compact('sku','categories','subcategories','parentskus'));
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
        'sku_name'=>'required',
        'sku_desc'=> 'required',
        'cat_name'=>'required',
        'subcat_name'=> 'required',
        'psku_name'=> 'required'
      ]);
        //updates
      $sku = Sku::find($id);
      $sku->sku_name = $request->get('sku_name');
      $sku->sku_desc = $request->get('sku_desc');
      $sku->cat_id = $request->get('cat_name');
      $sku->subcat_id = $request->get('subcat_name');
      $sku->psku_id = $request->get('psku_name');
      $sku->is_active = 1;
      $sku->updated_at = Now();

      $sku->save();
      return redirect('/sku')->with('success', 'SKU Successfully Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //deletes
        $sku = Sku::find($id);
        $sku->delete();

        return redirect('/sku')->with('success', 'SKU Successfully Deleted!');
    }
    public function skusdeactivate($id)
    {
        //deactivates
        $sku = Sku::find($id);
        $sku->is_active = 2;
        $sku->save();
        return redirect('/sku')->with('success', 'SKU Successfully Deactivated!');
    }

    public function skusactivate($id)
    {
        //activates
        $sku = Sku::find($id);
        $sku->is_active = 1;
        $sku->save();
        return redirect('/sku')->with('success', 'SKU Successfully Activated!');
    }
    public function subcatdd($id)
    {
        $subcat = Subcategories::where('cat_id',$id)->get();
        return response()->json($subcat);
    }
}