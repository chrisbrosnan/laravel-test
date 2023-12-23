<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all(); 
        return view( 'products.index', compact( 'products' ) );
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
        Product::create($request->all());
        return redirect()->route('products.index')
          ->with('success', 'Product record created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);
        return view( 'products.show', compact( 'products' ) );
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
        $product = Product::find($id);
        $product->update($request->all());
        return redirect()->route('products.index')
          ->with('success', 'Product record updated successfully.');
    }
 
   /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('products.index')
          ->with('success', 'Product record deleted successfully');
    }

    /**
    * Show the form for creating a new post.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('products.create');
    }
}
