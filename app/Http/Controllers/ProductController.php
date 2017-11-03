<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productListTemp = Product::all()->toArray();

        $productList = array();
        foreach ($productListTemp as $product)
        {
            $productList[$product['id']] = $product;
        }

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

        $userId = $request['userId'];

        $validated_product = $this->validate($request,[
            'productName' => 'required',
            'productType' => 'required',
            'basePrice' => 'required|numeric',
        ]);

        // SETS $validate_product to $product
        $product = array();
        $product['product_name'] = $validated_product['productName'];
        $product['product_type'] = $validated_product['productType'];
        $product['base_price']   = $validated_product['basePrice'];
//        $product['front_image']  = $frontImageName;
//        $product['back_image']   = $backImageName;
//        $product['left_image']   = $leftImageName;
//        $product['right_image']  = $rightImageName;

        $insertedProduct = Product::create($product);

        $this->updateProductImageName($request, $insertedProduct->id);

        return redirect('products')->with('success', 'Product has been added');
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
//            'leftImage' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
//            'rightImage' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $image = $request->file('frontImage');
        $input['imagename'] = $id.'_'.$validated_product['productName'].'_'.time().'_front.'.$image->getClientOriginalExtension();
        $frontImageName = $input['imagename'];
        $destinationPath = public_path('/productimages');
        $image->move($destinationPath, $frontImageName);

        $image = $request->file('backImage');
        $input['imagename'] = $id.'_'.$validated_product['productName'].'_'.time().'_back.'.$image->getClientOriginalExtension();
        $backImageName = $input['imagename'];
        $destinationPath = public_path('/productimages');
        $image->move($destinationPath, $backImageName);

        $leftImageName = '';
        $rightImageName = '';

        if ($request['productType'] == 'jersey') {
            $image = $request->file('leftImage');
            $input['imagename'] = $id.'_'.$validated_product['productName'].'_'.time().'_left.'.$image->getClientOriginalExtension();
            $leftImageName = $input['imagename'];
            $destinationPath = public_path('/productimages');
            $image->move($destinationPath, $leftImageName);

            $image = $request->file('rightImage');
            $input['imagename'] = $id.'_'.$validated_product['productName'].'_'.time().'_right.'.$image->getClientOriginalExtension();
            $rightImageName = $input['imagename'];
            $destinationPath = public_path('/productimages');
            $image->move($destinationPath, $rightImageName);
        }

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
        $destinationPath = public_path('/productimages');
        $product = Product::find($id);
        $product->delete();
        File::delete([$destinationPath.'/'.$product['front_image'],
            $destinationPath.'/'.$product['back_image'],
            $destinationPath.'/'.$product['left_image'],
            $destinationPath.'/'.$product['right_image']]);
        return redirect('products')->with('success','Product has been deleted');
    }

    public function updateProductImageName($request, $id) {
        $product = Product::find($id);

        $validated_product = $this->validate($request,[
            'frontImage' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'backImage' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
//            'leftImage' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
//            'rightImage' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $image = $request->file('frontImage');
        $input['imagename'] = $id.'_'.$request['productName'].'_'.time().'_front.'.$image->getClientOriginalExtension();
        $frontImageName = $input['imagename'];
        $destinationPath = public_path('/productimages');
        $image->move($destinationPath, $frontImageName);

        $image = $request->file('backImage');
        $input['imagename'] = $id.'_'.$request['productName'].'_'.time().'_back.'.$image->getClientOriginalExtension();
        $backImageName = $input['imagename'];
        $destinationPath = public_path('/productimages');
        $image->move($destinationPath, $backImageName);

        $leftImageName = '';
        $rightImageName = '';

        if ($request['productType'] == 'jersey') {
            $image = $request->file('leftImage');
            $input['imagename'] = $id.'_'.$request['productName'].'_'.time().'_left.'.$image->getClientOriginalExtension();
            $leftImageName = $input['imagename'];
            $destinationPath = public_path('/productimages');
            $image->move($destinationPath, $leftImageName);

            $image = $request->file('rightImage');
            $input['imagename'] = $id.'_'.$request['productName'].'_'.time().'_right.'.$image->getClientOriginalExtension();
            $rightImageName = $input['imagename'];
            $destinationPath = public_path('/productimages');
            $image->move($destinationPath, $rightImageName);
        }


        $product['front_image']  = $frontImageName;
        $product['back_image']   = $backImageName;
        $product['left_image']   = $leftImageName;
        $product['right_image']  = $rightImageName;
        $product->save();

    }
}
