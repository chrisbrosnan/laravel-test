<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalculationController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $calculations = Calculation::all(); 
        return view( 'calculations.index', compact( 'calculations' ) );
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
          'calculation_id' => 'required',
          'quantity' => 'required',
          'unit_cost' => 'required',
          'selling_price' => 'required',
        ]);
        Calculation::create($request->all());
        return redirect()->route('calculations.index')
          ->with('success', 'Calculation record created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $calculation = Calculation::find($id);
        return view( 'calculations.show', compact( 'calculation' ) );
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
          'calculation_id' => 'required',
          'quantity' => 'required',
          'unit_cost' => 'required',
          'selling_price' => 'required',
        ]);
        $calculation = Calculation::find($id);
        $calculation->update($request->all());
        return redirect()->route('calculations.index')
          ->with('success', 'Calculation record updated successfully.');
    }
 
   /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
    public function destroy(string $id)
    {
        $calculation = Calculation::find($id);
        $calculation->delete();
        return redirect()->route('calculations.index')
          ->with('success', 'Calculation record deleted successfully');
    }

    /**
    * Show the form for creating a new post.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('calculations.create');
    }
}
