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
            'frontImage' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'backImage' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'leftImage' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'rightImage' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $image = $request->file('frontImage');
        $input['imagename'] = $validated_product['productName'].'_front.'.$image->getClientOriginalExtension();
        $frontImageName = $input['imagename'];
        $destinationPath = public_path('/productimages');
        $image->move($destinationPath, $frontImageName);

        $image = $request->file('backImage');
        $input['imagename'] = $validated_product['productName'].'_back.'.$image->getClientOriginalExtension();
        $backImageName = $input['imagename'];
        $destinationPath = public_path('/productimages');
        $image->move($destinationPath, $backImageName);

        $image = $request->file('leftImage');
        $input['imagename'] = $validated_product['productName'].'_left.'.$image->getClientOriginalExtension();
        $leftImageName = $input['imagename'];
        $destinationPath = public_path('/productimages');
        $image->move($destinationPath, $leftImageName);

        $image = $request->file('rightImage');
        $input['imagename'] = $validated_product['productName'].'_right.'.$image->getClientOriginalExtension();
        $rightImageName = $input['imagename'];
        $destinationPath = public_path('/productimages');
        $image->move($destinationPath, $rightImageName);

        // SETS $validate_product to $product
        $product = array();
        $product['product_name'] = $validated_product['productName'];
        $product['product_type'] = $validated_product['productType'];
        $product['base_price']   = $validated_product['basePrice'];
        $product['front_image']  = $frontImageName;
        $product['back_image']   = $backImageName;
        $product['left_image']   = $leftImageName;
        $product['right_image']  = $rightImageName;

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
            'frontImage' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'backImage' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'leftImage' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'rightImage' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $image = $request->file('frontImage');
        $input['imagename'] = $validated_product['productName'].'_front.'.$image->getClientOriginalExtension();
        $frontImageName = $input['imagename'];
        $destinationPath = public_path('/productimages');
        $image->move($destinationPath, $frontImageName);

        $image = $request->file('backImage');
        $input['imagename'] = $validated_product['productName'].'_back.'.$image->getClientOriginalExtension();
        $backImageName = $input['imagename'];
        $destinationPath = public_path('/productimages');
        $image->move($destinationPath, $backImageName);

        $image = $request->file('leftImage');
        $input['imagename'] = $validated_product['productName'].'_left.'.$image->getClientOriginalExtension();
        $leftImageName = $input['imagename'];
        $destinationPath = public_path('/productimages');
        $image->move($destinationPath, $leftImageName);

        $image = $request->file('rightImage');
        $input['imagename'] = $validated_product['productName'].'_right.'.$image->getClientOriginalExtension();
        $rightImageName = $input['imagename'];
        $destinationPath = public_path('/productimages');
        $image->move($destinationPath, $rightImageName);

        // SETS $validate_product to $product
        $product['product_name'] = $validated_product['productName'];
        $product['product_type'] = $validated_product['productType'];
        $product['base_price']   = $validated_product['basePrice'];
        $product['front_image']  = $frontImageName;
        $product['back_image']   = $backImageName;
        $product['left_image']   = $leftImageName;
        $product['right_image']  = $rightImageName;
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
