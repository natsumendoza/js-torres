<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FinishedProduct;
use Illuminate\Support\Facades\File;

class FinishedProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productListTemp = FinishedProduct::all()->toArray();

        $productList = array();
        foreach ($productListTemp as $product)
        {
            $productList[$product['id']] = $product;
        }

        return view('finishedproducts/finishedproductlist', compact('productList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('finishedproducts/finishedproduct');
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
            'price' => 'required|numeric',
        ]);

        // SETS $validate_product to $product
        $product = array();
        $product['product_name'] = $validated_product['productName'];
        $product['product_type'] = $validated_product['productType'];
        $product['price']   = $validated_product['price'];

        $insertedProduct = FinishedProduct::create($product);

        $this->updateProductImageName($request, $insertedProduct->id);

        return redirect('finishedproduct')->with('success', 'Product has been added');
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
        $product = FinishedProduct::find($id);
        return view('finishedproducts/finishedproduct',compact('product','id'));
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
        $product = FinishedProduct::find($id);

        $validated_product = $this->validate($request,[
            'productName' => 'required',
            'productType' => 'required',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);



        $image = $request->file('image');
        $input['imagename'] = $id.'_'.$validated_product['productName'].'_'.time().'.'.$image->getClientOriginalExtension();
        $frontImageName = $input['imagename'];
        $destinationPath = public_path('/finishedproducts');
        $image->move($destinationPath, $frontImageName);

        // SETS $validate_product to $product
        $product['product_name'] = $validated_product['productName'];
        $product['product_type'] = $validated_product['productType'];
        $product['price']   = $validated_product['price'];
        $product['image']  = $frontImageName;
        $product->save();

        return redirect('finishedproduct')->with('success','Product has been updated');
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
        $product = FinishedProduct::find($id);
        $product->delete();
        File::delete([$destinationPath.'/'.$product['image']]);
        return redirect('finishedproduct')->with('success','Product has been deleted');
    }

    public function updateProductImageName($request, $id) {
        $finishedproduct = FinishedProduct::find($id);

        $validated_product = $this->validate($request,[
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $image = $request->file('image');
        $input['imagename'] = $id.'_'.$request['productName'].'_'.time().'.'.$image->getClientOriginalExtension();
        $frontImageName = $input['imagename'];
        $destinationPath = public_path('/finishedproducts');
        $image->move($destinationPath, $frontImageName);



        $finishedproduct['image']  = $frontImageName;
        $finishedproduct->save();

    }
}
