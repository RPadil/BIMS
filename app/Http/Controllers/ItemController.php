<?php

namespace App\Http\Controllers;

use DB;
use App\Sku;
use App\Item;
use App\Subcategories;
use App\Suppliers;
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

        $sku_array = array();
        $skus = Sku::select('sku_id','sku_name')->get();
        foreach ($skus as $sku)
        {
            $sku_array[$sku->sku_id] = $sku->sku_name;
        }

        $supp_array = array();
        $supps = Suppliers::select('supp_id','supp_name')->get();
        foreach ($supps as $supp)
        {
            $supp_array[$supp->supp_id] = $supp->supp_name;
        }
        // dd($subcat_array);
        $items = Item::latest()->paginate(2);
        return view('item.index',compact('items','cat_array','subcat_array','sku_array','supp_array'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $suppliers = Suppliers::select('id','supp_name','supp_id')->get();
        $categories = Categories::select('id','cat_name','cat_id')->get();
        return view('item.create',compact('categories','suppliers'));
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
        'item_name'=>'required',
        'item_desc'=> 'required',
        'supp_name'=>'required',
        'cat_name'=> 'required',
        'subcat_name'=>'required',
        'sku_name'=> 'required',
        'qty'=>'required',
        'price'=> 'required'
      ]);

      $it = DB::table('items')->max('item_id');
      $item = new Item();
      $item->item_id = $it + 1;
      $item->item_name = $request->get('item_name');
      $item->item_desc = $request->get('item_desc');
      $item->supp_id = $request->get('supp_name');
      $item->cat_id = $request->get('cat_name');
      $item->subcat_id = $request->get('subcat_name');
      $item->sku_id = $request->get('sku_name');
      $item->price = $request->get('price');
      $item->qty = $request->get('qty');
      $item->is_active = 1;
      $item->created_at = Now();

      $item->save();
      return redirect('/item')->with('success', 'Item Successfully Added!');
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
        $items = Item::find($id);
        $suppliers = Suppliers::select('id','supp_name','supp_id')->get();
        $categories = Categories::select('id','cat_name','cat_id')->get();
        $subcategories = Subcategories::where('cat_id',$items->cat_id)->get();
        $skus = Sku::where('sku_id',$items->sku_id)->get();
        // dd($subcategories);
        return view('item.edit', compact('items','suppliers','skus','categories','subcategories'));
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
        'item_name'=>'required',
        'item_desc'=> 'required',
        'supp_name'=>'required',
        'cat_name'=> 'required',
        'subcat_name'=>'required',
        'sku_name'=> 'required',
        'qty'=>'required',
        'price'=> 'required'
      ]);
      $item = Item::find($id);
      $item->item_name = $request->get('item_name');
      $item->item_desc = $request->get('item_desc');
      $item->supp_id = $request->get('supp_name');
      $item->cat_id = $request->get('cat_name');
      $item->subcat_id = $request->get('subcat_name');
      $item->sku_id = $request->get('sku_name');
      $item->price = number_format($request->get('price'),2);
      $item->qty = $request->get('qty');
      $item->is_active = 1;
      $item->updated_at = Now();

      $item->save();
      return redirect('/item')->with('success', 'Item Successfully Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::find($id);
        $item->delete();

        return redirect('/item')->with('success', 'Item Successfully Deleted!');
    }

    public function deactivate($id)
    {
        //deactivates
        $item = Item::find($id);
        $item->is_active = 2;
        $item->save();
        return redirect('/item')->with('success', 'Item Successfully Deactivated!');
    }

    public function activate($id)
    {
        //activates
        $item = Item::find($id);
        $item->is_active = 1;
        $item->save();
        return redirect('/item')->with('success', 'Item Successfully Activated!');
    }

    public function subcatskudd($catid=null,$subcatid=null)
    {
        $sku = Sku::select('sku_id','sku_name')->where('cat_id', $catid)->where('subcat_id', $subcatid)->get();
        return response()->json($sku);
    }
}
