<form method="GET" action="{{ route( 'add.sales' ) }}">
    <div class="row">
        <div class="col-3">
            <p>Product</p>
            <select name="product_id" class="w-100">
                @php
                    $products = DB::table('products')->get();
                    foreach( $products as $product ):
                        echo '<option value="'.$product->id.'">'.$product->product_name.'</option>';
                    endforeach;
                @endphp
            </select>
        </div>
        <div class="col-2">
            <p>Quantity</p>
            <input type="number" name="quantity" placeholder="1" class="w-100" />
        </div>
        <div class="col-2">
            <p>Unit Cost</p>
            <input type="number" name="unit_cost" class="w-100" />
        </div>
        <div class="col-2">
            <p>Selling Price</p>
            <input type="number" name="selling_price" class="w-100" />
        </div>
        <div class="col-3">
            <p>&nbsp;</p>
            <input type="submit" name="submit" value="Record Sale" style="border: 1px solid #000; padding: .5em;" class="w-100" /><br/><br/>
        </div>
    </div>
</form>