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
use App\Message;

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

        // COUNT UNREAD MESSAGE
        $unreadMessages = Message::where('to', Auth::user()->id)
            ->where('read_flag', config('constants.NO'))
            ->count();

        Session::put('unreadMessages', $unreadMessages);

//        $productList = Product::all()->where('product_type', 'jersey')->toArray();
        $productListBasketballMale = DB::table('products')
                        ->join('product_images', 'products.id', '=', 'product_images.product_id')
                        ->select('products.*', 'product_images.*')
                        ->where('products.product_type', '=', 'jersey')
                        ->where('products.jersey_type', '=', 'basketball')
                        ->where('products.gender_flag', '=', 'M')
                        ->get();

        $productListSoccerMale = DB::table('products')
            ->join('product_images', 'products.id', '=', 'product_images.product_id')
            ->select('products.*', 'product_images.*')
            ->where('products.product_type', '=', 'jersey')
            ->where('products.jersey_type', '=', 'soccer')
            ->where('products.gender_flag', '=', 'M')
            ->get();

        $productListBasketballFemale = DB::table('products')
            ->join('product_images', 'products.id', '=', 'product_images.product_id')
            ->select('products.*', 'product_images.*')
            ->where('products.product_type', '=', 'jersey')
            ->where('products.jersey_type', '=', 'basketball')
            ->where('products.gender_flag', '=', 'F')
            ->get();

        $productListSoccerFemale = DB::table('products')
            ->join('product_images', 'products.id', '=', 'product_images.product_id')
            ->select('products.*', 'product_images.*')
            ->where('products.product_type', '=', 'jersey')
            ->where('products.jersey_type', '=', 'soccer')
            ->where('products.gender_flag', '=', 'F')
            ->get();
//        echo '<pre>';
//        print_r($productList);

//        echo '<pre>';
//        print_r($productData);
//        die;
        $logos = Logo::all()->where('logo_type', 'jersey')->toArray();
        $productDataBasketballMale = array();
        foreach($productListBasketballMale as $product)
        {
            $product = (array)$product;
            $productDataBasketballMale[$product['product_id']] = $product;
        }
        $productDataSoccerMale = array();
        foreach($productListSoccerMale as $product)
        {
            $product = (array)$product;
            $productDataSoccerMale[$product['product_id']] = $product;
        }
        $productDataBasketballFemale = array();
        foreach($productListBasketballFemale as $product)
        {
            $product = (array)$product;
            $productDataBasketballFemale[$product['product_id']] = $product;
        }
        $productDataSoccerFemale = array();
        foreach($productListSoccerFemale as $product)
        {
            $product = (array)$product;
            $productDataSoccerFemale[$product['product_id']] = $product;
        }

//        echo '<pre>';
//        print_r($productData);
//        die;


        $data = array(
            'productListBasketballMale' => $productListBasketballMale,
            'productListSoccerMale' => $productDataSoccerMale,
            'productListBasketballFemale' => $productDataBasketballFemale,
            'productListSoccerFemale' => $productDataSoccerFemale,

            'productDataBasketballMale' => $productDataBasketballMale,
            'productDataSoccerMale' => $productDataSoccerMale,
            'productDataBasketballFemale' => $productDataBasketballFemale,
            'productDataSoccerFemale' => $productDataSoccerFemale,
            'logos' => $logos
        );

        return view('index')->with($data);
    }
}
