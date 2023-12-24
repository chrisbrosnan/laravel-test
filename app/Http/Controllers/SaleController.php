<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Sale;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view( 'coffee_sales' )->with( 'sales_table', $this->render_sales_table() );
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
          'product_id'    => 'required',
          'quantity'      => 'required',
          'unit_cost'     => 'required',
          'selling_price' => 'required',
        ]);

        $sale = [
          'product_id'    => $request->input('product_id'), 
          'quantity'      => $request->input('quantity'),
          'unit_cost'     => $request->input('unit_cost'),
          'selling_price' => $request->input('selling_price'),
        ];
        
        DB::table('sales')->insert(
          [
            $sale
          ],
        );  
        
        return redirect()->route('sales.index')
        ->with('success', 'Sale record updated successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
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
    public function update(Request $request, int $id)
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

    /**
     * Render table for sales
     * 
     * @return string $table
     */
    public function render_sales_table()
    {
      $sales_records = DB::table('sales')->pluck( 'product_id', 'quantity', 'unit_cost', 'selling_price' );
      $table = '<table style="width: 100%; padding: 1em; display: inline-table;">
                <tr style="background: #e1e1e1;">
                  <th>Quantity</th>
                  <th>Unit Cost</th>
                  <th>Selling Price</th>
                </tr>';
      foreach ( $sales_records as $record ) {
        $table .= '<tr>
                    <td>'.$record['quantity'].'</td>
                    <td>'.$record['unit_cost'].'</td>
                    <td>'.$record['selling_price'].'</td>
                  </tr>';
      }
      $table .= '</table>'; 
      return $table; 
    }
}
