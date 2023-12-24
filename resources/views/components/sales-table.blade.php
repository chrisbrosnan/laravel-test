
        @php 
            $sales_records = DB::table('sales')->get();
            $sales_array   = []; 
            $n = 0; 
            foreach( $sales_records as $sale ):
                $product           = DB::table('products')->where('product_id', $sale->product_id)->first();
                $sales_array[ $n ] = [ 'id' => $sale->id, 'product_name' => $product->product_name, 'sale_quantity' => $sale->quantity, 'sale_unit_cost' => $sale->unit_cost, 'sale_selling_price' => $sale->selling_price ];
                $n++; 
            endforeach;
        @endphp
        <sales-table :sales_data='@json($sales_array)'></sales-table>