<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New ☕️ Sales') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @include('components.add-sale')
                    <table class="w-100">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Unit Cost</th>
                                <th>Selling Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php 
                                $sales_records = DB::table('sales')->get();
                                foreach( $sales_records as $sale ):
                                    $product = DB::table('products')->where('id', $sale->product_id)->first();
                                    print_r( $product ); 
                                    echo '<tr>
                                        <td>'.$sale->product_id.'</td>
                                        <td>'.$sale->quantity.'</td>
                                        <td>£'.number_format((float)$sale->unit_cost, 2, '.', '').'</td>
                                        <td>£'.number_format((float)$sale->selling_price, 2, '.', '').'</td>
                                    </tr>';
                                endforeach;
                            @endphp
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
