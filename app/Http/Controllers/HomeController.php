<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Logo;
use App\Order;
use Session;
use Auth;
use App\FinishedProduct;
use Illuminate\Support\Facades\DB;

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



//        $productList = Product::all()->where('product_type', 'jersey')->toArray();
        $productList = DB::table('products')
                        ->join('product_images', 'products.id', '=', 'product_images.product_id')
                        ->select('products.*', 'product_images.*')
                        ->where('products.product_type', '=', 'jersey')
                        ->get();
//        echo '<pre>';
//        print_r($productList);
        $productData = array();
        foreach($productList as $product)
        {
            $product = (array)$product;
            $productData[$product['product_id']] = $product;
        }
//        echo '<pre>';
//        print_r($productData);
//        die;
        $logos = Logo::all()->where('logo_type', 'jersey')->toArray();
        $productData = array();
        foreach($productList as $product)
        {
            $product = (array)$product;
            $productData[$product['product_id']] = $product;
        }
//        echo '<pre>';
//        print_r($productData);
//        die;


        $data = array('productList' => $productList, 'logos' => $logos, 'productData' => $productData);

        return view('index')->with($data);
    }
}
