<?php

namespace App\Http\Controllers;

use DB;
use App\Suppliers;
use Illuminate\Http\Request;

class SuppliersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Suppliers::latest()->paginate(5);
        return view('suppliers.index',compact('suppliers'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('suppliers.create');
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
        'supp_code'=>'required',
        'supp_name'=> 'required',
        'loc'=>'required',
        'contact'=> 'required'
      ]);

      $supp = DB::table('suppliers')->max('supp_id');
      $suppliers = new Suppliers();
      $suppliers->supp_id = $supp + 1;
      $suppliers->supp_code = $request->get('supp_code');
      $suppliers->supp_name = $request->get('supp_name');
      $suppliers->location = $request->get('loc');
      $suppliers->contact = $request->get('contact');
      $suppliers->is_active = 1;
      $suppliers->created_at = Now();

      $suppliers->save();
      return redirect('/suppliers')->with('success', 'Supplier Successfully Added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Suppliers  $suppliers
     * @return \Illuminate\Http\Response
     */
    public function show(Suppliers $suppliers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Suppliers  $suppliers
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $supplier = Suppliers::find($id);
        return view('suppliers.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Suppliers  $suppliers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
        'supp_code'=>'required',
        'supp_name'=> 'required',
        'loc'=>'required',
        'contact'=> 'required'
      ]);

      $suppliers = Suppliers::find($id);
      $suppliers->supp_code = $request->get('supp_code');
      $suppliers->supp_name = $request->get('supp_name');
      $suppliers->location = $request->get('loc');
      $suppliers->contact = $request->get('contact');
      $suppliers->is_active = 1;
      $suppliers->updated_at = Now();

      $suppliers->save();
      return redirect('/suppliers')->with('success', 'Supplier Successfully Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Suppliers  $suppliers
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier = Suppliers::find($id);
        $supplier->delete();

        return redirect('/suppliers')->with('success', 'Supplier Successfully Deleted!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Suppliers  $suppliers
     * @return \Illuminate\Http\Response
     */
    public function suppliersdeactivate($id)
    {
        //deactivate
        $suppliers = Suppliers::find($id);
        $suppliers->is_active = 2;
        $suppliers->save();
        return redirect('/suppliers')->with('success', 'Supplier Successfully Deactivated!');
    }

    public function suppliersactivate($id)
    {
        //activate
        $suppliers = Suppliers::find($id);
        $suppliers->is_active = 1;
        $suppliers->save();
        return redirect('/suppliers')->with('success', 'Supplier Successfully Activated!');
    }
}
