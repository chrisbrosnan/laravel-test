<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = Sale::all(); 
        return view( 'sales.index', compact( 'sales' ) );
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
          'product_id' => 'required',
          'quantity' => 'required',
          'unit_cost' => 'required',
          'selling_price' => 'required',
        ]);
        Sale::create($request->all());
        return redirect()->route('sales.index')
          ->with('success', 'Sale record created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $sale = Sale::find($id);
        return view( 'sales.show', compact( 'sale' ) );
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
          'product_id' => 'required',
          'quantity' => 'required',
          'unit_cost' => 'required',
          'selling_price' => 'required',
        ]);
        $sale = Sale::find($id);
        $sale->update($request->all());
        return redirect()->route('sales.index')
          ->with('success', 'Sale record updated successfully.');
    }
 
   /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
    public function destroy(string $id)
    {
        $sale = Sale::find($id);
        $sale->delete();
        return redirect()->route('sales.index')
          ->with('success', 'Sale record deleted successfully');
    }

    /**
    * Show the form for creating a new post.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('sales.create');
    }
}
