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

use App\Product;
use App\Logo;

Route::get('/', function () {
    $productList = Product::all()->toArray();
    $logos = Logo::all()->toArray();
    $productData =array();
    foreach($productList as $product)
    {
        $productData[$product['id']] = $product;
    }
    $data = array('productList' => $productList, 'logos' => $logos, 'productData' => $productData);
    return view('index')->with($data);
});

Route::group(['middleware' => 'web'], function () {
    Route::get('fileUpload', function () {
        return view('index');
    });
    Route::post('fileUpload', ['as'=>'fileUpload','uses'=>'UploadController@fileUpload']);
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/sparkpost', function () {
    Mail::send('emails.test', [], function ($message) {
        $message
            ->from('admin@mutyaph.com', 'Your Name')
      ->to('roxelrollmendoza@gmail.com', 'Receiver Name')
      ->subject('From SparkPost with ❤');
  });
});

Route::resource('user', 'UserController');
Route::resource('products','ProductController');
Route::delete('orders/transaction/{transactionCode}', 'OrderController@destroyByTransactionCode');
Route::put('orders/transaction/{transactionCode}', 'OrderController@destroyByTransactionCode');
Route::get('orders/{userId}', 'OrderController@showByUserId');
Route::resource('orders', 'OrderController');
Route::resource('cart', 'CartController');
