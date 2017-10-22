<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productList = Product::all()->toArray();
        return view('products.productList', compact('productList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.product');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated_product = $this->validate($request,[
            'productName' => 'required',
            'productType' => 'required',
            'basePrice' => 'required|numeric',
            'frontImage' => 'required',
            'backImage' => 'required',
            'leftImage' => 'required',
            'rightImage' => 'required',
        ]);

        // SETS $validate_product to $product
        $product = array();
        $product['product_name'] = $validated_product['productName'];
        $product['product_type'] = $validated_product['productType'];
        $product['base_price']   = $validated_product['basePrice'];
        $product['front_image']  = $validated_product['frontImage'];
        $product['back_image']   = $validated_product['backImage'];
        $product['left_image']   = $validated_product['leftImage'];
        $product['right_image']  = $validated_product['rightImage'];

        Product::create($product);

        return redirect('products')->with('success', 'Product has been added');;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        return view('products.product',compact('product','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $product = Product::find($id);

        $validated_product = $this->validate($request,[
            'productName' => 'required',
            'productType' => 'required',
            'basePrice' => 'required|numeric',
            'frontImage' => 'required',
            'backImage' => 'required',
            'leftImage' => 'required',
            'rightImage' => 'required',
        ]);

        // SETS $validate_product to $product
        $product['product_name'] = $validated_product['productName'];
        $product['product_type'] = $validated_product['productType'];
        $product['base_price']   = $validated_product['basePrice'];
        $product['front_image']  = $validated_product['frontImage'];
        $product['back_image']   = $validated_product['backImage'];
        $product['left_image']   = $validated_product['leftImage'];
        $product['right_image']  = $validated_product['rightImage'];
        $product->save();

        return redirect('products')->with('success','Product has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect('products')->with('success','Product has been  deleted');
    }
}
