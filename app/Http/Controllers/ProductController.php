<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

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
          'product_name' => 'required',
          'quantity' => 'required',
          'unit_cost' => 'required',
          'selling_price' => 'required',
          'profit_margin' => 'required',
        ]);
        Product::create($request->all());
        return redirect()->route('products.index')
          ->with('success', 'Product record created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $product_id)
    {
        $product = Product::find($product_id);
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
          'product_name' => 'required',
          'quantity' => 'required',
          'unit_cost' => 'required',
          'selling_price' => 'required',
          'profit_margin' => 'required',
        ]);
        $product = Product::find($id);
        $product->update($request->all());
        return redirect()->route('products.index')
          ->with('success', 'Product record updated successfully.');
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
