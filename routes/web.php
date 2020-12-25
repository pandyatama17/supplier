<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
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
Route::group(['middleware'=>'auth'], function()
{
  Route::get('/', function () {
      return view('home');
  });
  Route::get('/admin/items',[MainController::class,'showItems'])->name('show_items');
  Route::get('/admin/items/add',[MainController::class,'addItem'])->name('add_item');
  Route::post('/items/submit',[MainController::class,'submitItem'])->name('submit_item');
  Route::get('/admin/vendors/add',[MainController::class,'addVendor'])->name('add_vendor');
  Route::post('/vendors/submit',[MainController::class,'submitVendor'])->name('submit_vendor');
  Route::get('/admin/clients/add',[MainController::class,'addClient'])->name('add_client');
  Route::post('/clients/submit',[MainController::class,'submitClient'])->name('submit_client');
  Route::get('/admin/transactions',[MainController::class,'showTransactions'])->name('show_transactios');
  Route::get('/admin/transaction/new&method=in',[MainController::class,'addTransactionIn'])->name('add_transaction_in');
  Route::get('/admin/transaction/new&method=out',[MainController::class,'addTransactionOut'])->name('add_transaction_out');
  Route::get('/transaction/get_items&index={index}&vendor={vendor}',[MainController::class,'getItemsofVendor'])->name('get_items_from_vendor');
  Route::get('/transaction/get_all_items&index={index}',[MainController::class,'getAllItems'])->name('get_all_items');
  Route::post('/transaction/in/submit',[MainController::class,'submitTransactionIn'])->name('submit_transaction_in');
  Route::post('/transaction/out/submit',[MainController::class,'submitTransactionOut'])->name('submit_transaction_out');
  Route::get('/transaction/invoice&id={id}',[MainController::class,'showInvoice'])->name('show_invoice');


  Route::get('/client/order',[MainController::class,'clientOrderForm'])->name('client_order_form');
  Route::post('/order/submit',[MainController::class,'clientOrderSubmit'])->name('client_order_submit');
  Route::get('/client/invoice&order={id}',[MainController::class,'clientOrderInvoice'])->name('client_order_invoice');
  Route::get('/client/orders&user={id}',[MainController::class,'clientOrderList'])->name('client_order_list');

});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
