<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SaleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::redirect('/dashboard', '/sales')->name('sales.index');

Route::get('/sales', function () {
    $sales_table = DB::table('sales')->pluck( 'product_id', 'quantity', 'unit_cost', 'selling_price' );
    return view('coffee_sales', [ 'sales_table' => $sales_table ] );
})->middleware(['auth'])->name('coffee.sales');

Route::get('/sales/add', [ SaleController::class, 'store' ] )->middleware(['auth'])->name('add.sales'); 

Route::get('/shipping-partners', function () {
    return view('shipping_partners');
})->middleware(['auth'])->name('shipping.partners');

require __DIR__.'/auth.php';
