<?php

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
    return view('welcome');
});

Route::get('customers', 'CustomersController@index');

Route::get('customers/fetch', 'CustomersController@fetchCustomers');
Route::get('customers/{customer}', 'CustomersController@calcuateCustomerOrderAverage');

Route::get('orders', 'OrdersController@index');
Route::get('orders/fetch', 'OrdersController@fetchOrders');

Route::get('products', 'ProductsController@index');
Route::get('products/fetch', 'ProductsController@fetchProducts');

Route::get('variants', 'VariantsController@index');
Route::get('variants/{variant}', 'ProductsController@calcuateVariantAverage');
