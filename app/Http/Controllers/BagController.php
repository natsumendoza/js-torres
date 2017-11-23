<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;
use App\Logo;
use App\Order;
use Session;
use Auth;
use Illuminate\Support\Facades\DB;

class BagController extends Controller
{
    public function index()
    {
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

//        $productList = Product::all()->where('product_type', 'bag')->toArray();

        $productListBagMale = DB::table('products')
            ->join('product_images', 'products.id', '=', 'product_images.product_id')
            ->select('products.*', 'product_images.*')
            ->where('products.product_type', '=', 'bag')
            ->where('products.gender_flag', '=', 'M')
            ->get();

        $productListBagFemale = DB::table('products')
            ->join('product_images', 'products.id', '=', 'product_images.product_id')
            ->select('products.*', 'product_images.*')
            ->where('products.product_type', '=', 'bag')
            ->where('products.gender_flag', '=', 'F')
            ->get();

        $logos = Logo::all()->where('logo_type', 'jersey')->toArray();

        $productDataBagMale = array();
        foreach($productListBagMale as $product)
        {
            $product = (array)$product;
            $productDataBagMale[$product['product_id']] = $product;
        }
        $productDataBagFemale = array();
        foreach($productListBagFemale as $product)
        {
            $product = (array)$product;
            $productDataBagFemale[$product['product_id']] = $product;
        }

        $data = array(
            'productListBagMale' => $productListBagMale,
            'productListBagFemale' => $productListBagFemale,
            'logos' => $logos,
            'productDataBagMale' => $productDataBagMale,
            'productDataBagFemale' => $productDataBagFemale
        );

        return view('bags/index')->with($data);
    }
}
