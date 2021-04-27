<?php

namespace App\Http\Controllers;

use DB;
use App\Parentsku;
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
        $parentsku = Parentsku::latest()->paginate(5);
        return view('parentsku.index',compact('parentsku'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('parentsku.create');
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
        'psku_desc'=> 'required'
      ]);

      $psku = DB::table('parentskus')->max('psku_id');
      $parentsku = new Parentsku();
      $parentsku->psku_id = $psku + 1;
      $parentsku->psku_name = $request->get('psku_name');
      $parentsku->psku_desc = $request->get('psku_desc');
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
        $psku = Parentsku::find($id);
        return view('parentsku.edit', compact('psku'));
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
        'psku_desc'=> 'required'
      ]);
        //update
      $parentsku = Parentsku::find($id);
      $parentsku->psku_name = $request->get('psku_name');
      $parentsku->psku_desc = $request->get('psku_desc');
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
