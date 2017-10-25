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

<<<<<<< HEAD
//Route::get('/', function () {
//    $productList = Product::all()->toArray();
//    $logos = Logo::all()->toArray();
//    $data = array('productList' => $productList, 'logos' => $logos);
//    return view('index')->with($data);
//});
=======
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
>>>>>>> ae88b45bbdb8d9d70c765a54ac3d68bf2f854cbf

Route::group(['middleware' => 'web'], function () {
    Route::get('fileUpload', function () {
        return view('index');
    });
    Route::post('fileUpload', ['as'=>'fileUpload','uses'=>'UploadController@fileUpload']);
});
Auth::routes();

Route::get('/', 'HomeController@index');


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
Route::patch('orders/transaction/{transactionCode}', 'OrderController@updateByTransactionCode');
Route::get('orders/{userId}', 'OrderController@showByUserId');
Route::resource('orders', 'OrderController');
Route::resource('cart', 'CartController');
