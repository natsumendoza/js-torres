<?php

use App\Product;
use App\FinishedProduct;

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

Route::group(['middleware' => 'web'], function () {
    Route::get('fileUpload', function () {
        return view('index');
    });
    Route::post('fileUpload', ['as'=>'fileUpload','uses'=>'UploadController@fileUpload']);
});
Auth::routes();

Route::get('/customize', 'HomeController@index');

Route::get('/bags', 'BagController@index');

Route::get('/', function () {

    $productList = FinishedProduct::all()->where('product_type', 'jersey')->toArray();

    return view('home')->with(array('productList' => $productList));
});

Route::get('/sparkpost', function () {
    Mail::send('emails.test', [], function ($message) {
        $message
            ->from('admin@mutyaph.com', 'Your Name')
      ->to('roxelrollmendoza@gmail.com', 'Receiver Name')
      ->subject('From SparkPost with ❤');
  });
});

Route::group(['middleware' => ['auth']], function () {
    Route::resource('user', 'UserController');
    Route::resource('products','ProductController');
    Route::delete('orders/transaction/{transactionCode}', 'OrderController@destroyByTransactionCode');
    Route::patch('orders/transaction/{transactionCode}', 'OrderController@updateByTransactionCode');
    Route::get('orders/{userId}', 'OrderController@showByUserId');
    Route::get('orders/images/{orderId}', 'OrderController@modal');
    Route::resource('orders', 'OrderController');
    Route::resource('cart', 'CartController');
    Route::resource('finishedproduct', 'FinishedProductController');
    Route::get('error', function ()
    {
        return view('customException');
    });
});


