@php 
    $products = \App\Models\Product::all();
@endphp
<add-sale-form :product_data='@json($products)'></add-sale-form>