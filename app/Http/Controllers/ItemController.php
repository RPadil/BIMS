<?php

namespace App\Http\Controllers;

use DB;
use App\Sku;
use App\Subcategories;
use App\Categories;
use Illuminate\Http\Request;

class ItemController extends Controller
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
        // dd($subcat_array);
        $sku = Sku::latest()->paginate(5);
        return view('item.index',compact('sku','cat_array','subcat_array'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
