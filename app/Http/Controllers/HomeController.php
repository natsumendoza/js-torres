<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Logo;
use App\Order;
use Session;
use Auth;

class HomeController extends Controller
{

//    protected $redirectTo = '/';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        }

        $productList = Product::all()->where('product_type', 'jersey')->toArray();
        $logos = Logo::all()->where('logo_type', 'jersey')->toArray();
        $productData = array();
        foreach($productList as $product)
        {
            $productData[$product['id']] = $product;
        }

        $data = array('productList' => $productList, 'logos' => $logos, 'productData' => $productData);

        return view('index')->with($data);
    }
}
