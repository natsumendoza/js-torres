<?php

use Illuminate\Support\Facades\Auth;
use App\Order;
use App\Product;
use App\FinishedProduct;
use App\Message;

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

    if (!Auth::guest()) {
        $cartItems = Order::where('user_id', Auth::user()->id)
            ->where('status', 'pending')
            ->get()->toArray();

        if(!empty($cartItems))
        {
            Session::put('cartSize', count($cartItems));
            if(!(\Session::has('transactionCode')))
            {
                Session::put('transactionCode', $cartItems[0]['transaction_code']);
            }
        }

        $unreadMessages = Message::where('to', Auth::user()->id)
            ->where('read_flag', config('constants.NO'))
            ->count();

        Session::put('unreadMessages', $unreadMessages);

    }

    $productList = FinishedProduct::all()->toArray();

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
    Route::get('users', 'UserController@showUserList');
    Route::resource('user', 'UserController');
    Route::resource('products','ProductController');
    Route::delete('orders/transaction/{transactionCode}', 'OrderController@destroyByTransactionCode');
    Route::patch('orders/transaction/{transactionCode}', 'OrderController@updateByTransactionCode');
    Route::get('orders/{userId}', 'OrderController@showByUserId');
    Route::get('orders/images/{orderId}', 'OrderController@modal');
    Route::resource('orders', 'OrderController');
    Route::resource('cart', 'CartController');
    Route::resource('finishedproduct', 'FinishedProductController');
    Route::get('chat/admin/{clientId}', 'ChatController@chatAdminSide');
    Route::get('chat/client', 'ChatController@chatClientSide');
    Route::resource('chat', 'ChatController');
    Route::get('error', function ()
    {
        return view('customException');
    });
});


