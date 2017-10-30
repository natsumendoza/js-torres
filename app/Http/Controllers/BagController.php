<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;
use App\Logo;
use App\Order;
use Session;
use Auth;

class BagController extends Controller
{
    public function index()
    {
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

        $productList = Product::all()->where('product_type', 'bag')->toArray();
        $logos = Logo::all()->where('logo_type', 'bag')->toArray();
        $productData = array();
        foreach($productList as $product)
        {
            $productData[$product['id']] = $product;
        }

        $data = array('productList' => $productList, 'logos' => $logos, 'productData' => $productData);

        return view('bags/index')->with($data);
    }
}
