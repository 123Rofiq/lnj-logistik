<?php

use Illuminate\Support\Facades\Route;

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
Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
// Route::post('/home/submit_home_data', 'HomeController@submit_home_data')->name('post.data');
// Route::get('/home/json','HomeController@json')->name('home.json');
// Route::resource('posts', 'HomeController');
// Route::post('/data', 'HomeController@submit_customer_data')->name('data.post');
Route::resource('home', 'HomeController');
/** Grafik */
Route::get('/grafik/transaksi/status', 'ChartController@transaksi_status')->name('grafik.transaksi.status');
/**
 * import data
 */
Route::get('export', 'ImportController@export')->name('export');
Route::get('importExportView', 'ImportController@importExportView');
Route::post('import', 'ImportController@import')->name('import');

/** CRUD Customer */
Route::get('/customer', 'CustomersController@add_customer_form')->name('customer.add');
Route::post('/customer', 'CustomersController@submit_customer_data')->name('customer.save');
Route::get('/customer/list', 'CustomersController@fetch_all_customer')->name('customer.list');
Route::get('/customer/edit/{customer}', 'CustomersController@edit_customer_form')->name('customer.edit');
Route::patch('/customer/edit/{customer}', 'CustomersController@edit_customer_form_submit')->name('customer.update');
Route::get('/customer/{customer}', 'CustomersController@view_single_customer')->name('customer.view');
Route::delete('/customer/{customer}', 'CustomersController@delete_customer')->name('customer.delete');

/** CRUD Container */
Route::get('/container', 'ContainerController@add_container_form')->name('container.add');
Route::post('/container', 'ContainerController@submit_container_data')->name('container.save');
Route::get('/container/list', 'ContainerController@fetch_all_container')->name('container.list');
Route::get('/container/edit/{container}', 'ContainerController@edit_container_form')->name('container.edit');
Route::patch('/container/edit/{container}', 'ContainerController@edit_container_form_submit')->name('container.update');
Route::get('/container/{container}', 'ContainerController@view_single_container')->name('container.view');
Route::delete('/container/{container}', 'ContainerController@delete_container')->name('container.delete');
Route::get('/grafik/transaksi/container', 'ChartController@transaksi_status2')->name('grafik.transaksi.status2');


/** Transaksi */
Route::get('/transaksi', 'TransactionController@add_transaksi_form')->name('transaksi.add');
Route::post('/transaksi', 'TransactionController@submit_transaksi_data')->name('transaksi.save');
Route::get('/transaksi/list', 'TransactionController@transaksi_list')->name('transaksi.list');
Route::get('/grafik/transaksi/transaksi', 'ChartController@transaksi_status3')->name('grafik.transaksi.status3');