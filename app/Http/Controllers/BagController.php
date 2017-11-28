<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;
use App\Logo;
use App\Order;
use Session;
use Auth;
use Illuminate\Support\Facades\DB;
use App\Message;

class BagController extends Controller
{
    public function index()
    {
        // COUNT CART SIZE
        if(!Auth::guest()) {
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
        }

        $unreadMessages = Message::where('to', Auth::user()->id)
            ->where('read_flag', config('constants.NO'))
            ->count();

        Session::put('unreadMessages', $unreadMessages);

//        $productList = Product::all()->where('product_type', 'bag')->toArray();

        $productList = DB::table('products')
            ->join('product_images', 'products.id', '=', 'product_images.product_id')
            ->select('products.*', 'product_images.*')
            ->where('products.product_type', '=', 'bag')
            ->get();

        $logos = Logo::all()->where('logo_type', 'jersey')->toArray();

        $productData = array();
        foreach($productList as $product)
        {
            $product = (array)$product;
            $productData[$product['product_id']] = $product;
        }

        $data = array(
            'productList' => $productList,
            'logos' => $logos,
            'productData' => $productData,
        );

        return view('bags/index')->with($data);
    }
}
