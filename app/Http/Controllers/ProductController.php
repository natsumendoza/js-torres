<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\File;
use App\ProductImage;

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
        $formType = $request['formType'];

        $validated_product = $this->validate($request,[
            'productName' => 'required',
            'productType' => 'required',
        ]);

        // SETS $validate_product to $product
        $product = array();
        $product['product_name'] = $validated_product['productName'];
        $product['product_type'] = $validated_product['productType'];

        if ($formType == 'jersey') {
            $product['gender_flag'] = $request['gender'];
            $product['jersey_type']   = $request['jerseyType'];
        } else {
            $product['base_price']   = $validated_product['basePrice'];
        }
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

        $formType = $request['formType'];

        if ($formType == 'jersey') {
            // WHITE
            $image = $request->file('whiteFrontImage');
            $input['imagename'] = $id.'_'.$request['productName'].'_base_white_front.'.$image->getClientOriginalExtension();
            $whiteFrontImageName = $input['imagename'];
            $destinationPath = public_path('/productimages');
            $image->move($destinationPath, $whiteFrontImageName);

            $image = $request->file('whiteBackImage');
            $input['imagename'] = $id.'_'.$request['productName'].'_base_white_back.'.$image->getClientOriginalExtension();
            $whiteBackImageName = $input['imagename'];
            $destinationPath = public_path('/productimages');
            $image->move($destinationPath, $whiteBackImageName);

            $image = $request->file('whiteLeftImage');
            $input['imagename'] = $id.'_'.$request['productName'].'_base_white_left.'.$image->getClientOriginalExtension();
            $whiteLeftImageName = $input['imagename'];
            $destinationPath = public_path('/productimages');
            $image->move($destinationPath, $whiteLeftImageName);

            $image = $request->file('whiteRightImage');
            $input['imagename'] = $id.'_'.$request['productName'].'_base_white_right.'.$image->getClientOriginalExtension();
            $whiteRightImageName = $input['imagename'];
            $destinationPath = public_path('/productimages');
            $image->move($destinationPath, $whiteRightImageName);

            $image = $request->file('whiteRoundImage');
            $input['imagename'] = $id.'_'.$request['productName'].'_round_white_front.'.$image->getClientOriginalExtension();
            $whiteRoundImageName = $input['imagename'];
            $destinationPath = public_path('/productimages');
            $image->move($destinationPath, $whiteRoundImageName);

            $image = $request->file('whiteVImage');
            $input['imagename'] = $id.'_'.$request['productName'].'_v_white_front.'.$image->getClientOriginalExtension();
            $whiteVImageName = $input['imagename'];
            $destinationPath = public_path('/productimages');
            $image->move($destinationPath, $whiteVImageName);

            $whiteCollarImageName = '';
            if($request['jerseyType'] == 'soccer') {
                $image = $request->file('whiteCollarImage');
                $input['imagename'] = $id.'_'.$request['productName'].'_collar_white_front.'.$image->getClientOriginalExtension();
                $whiteCollarImageName = $input['imagename'];
                $destinationPath = public_path('/productimages');
                $image->move($destinationPath, $whiteCollarImageName);
            }

            // END WHITE

            // RED
            $image = $request->file('redFrontImage');
            $input['imagename'] = $id.'_'.$request['productName'].'_base_red_front.'.$image->getClientOriginalExtension();
            $redFrontImageName = $input['imagename'];
            $destinationPath = public_path('/productimages');
            $image->move($destinationPath, $redFrontImageName);

            $image = $request->file('redBackImage');
            $input['imagename'] = $id.'_'.$request['productName'].'_base_red_back.'.$image->getClientOriginalExtension();
            $redBackImageName = $input['imagename'];
            $destinationPath = public_path('/productimages');
            $image->move($destinationPath, $redBackImageName);

            $image = $request->file('redLeftImage');
            $input['imagename'] = $id.'_'.$request['productName'].'_base_red_left.'.$image->getClientOriginalExtension();
            $redLeftImageName = $input['imagename'];
            $destinationPath = public_path('/productimages');
            $image->move($destinationPath, $redLeftImageName);

            $image = $request->file('redRightImage');
            $input['imagename'] = $id.'_'.$request['productName'].'_base_red_right.'.$image->getClientOriginalExtension();
            $redRightImageName = $input['imagename'];
            $destinationPath = public_path('/productimages');
            $image->move($destinationPath, $redRightImageName);

            $image = $request->file('redRoundImage');
            $input['imagename'] = $id.'_'.$request['productName'].'_round_red_front.'.$image->getClientOriginalExtension();
            $redRoundImageName = $input['imagename'];
            $destinationPath = public_path('/productimages');
            $image->move($destinationPath, $redRoundImageName);

            $image = $request->file('redVImage');
            $input['imagename'] = $id.'_'.$request['productName'].'_v_red_front.'.$image->getClientOriginalExtension();
            $redVImageName = $input['imagename'];
            $destinationPath = public_path('/productimages');
            $image->move($destinationPath, $redVImageName);

            $redCollarImageName = '';
            if($request['jerseyType'] == 'soccer') {
                $image = $request->file('redCollarImage');
                $input['imagename'] = $id.'_'.$request['productName'].'_collar_red_front.'.$image->getClientOriginalExtension();
                $redCollarImageName = $input['imagename'];
                $destinationPath = public_path('/productimages');
                $image->move($destinationPath, $redCollarImageName);
            }

            // END RED

            // GREEN
            $image = $request->file('greenFrontImage');
            $input['imagename'] = $id.'_'.$request['productName'].'_base_green_front.'.$image->getClientOriginalExtension();
            $greenFrontImageName = $input['imagename'];
            $destinationPath = public_path('/productimages');
            $image->move($destinationPath, $greenFrontImageName);

            $image = $request->file('greenBackImage');
            $input['imagename'] = $id.'_'.$request['productName'].'_base_green_back.'.$image->getClientOriginalExtension();
            $greenBackImageName = $input['imagename'];
            $destinationPath = public_path('/productimages');
            $image->move($destinationPath, $greenBackImageName);

            $image = $request->file('greenLeftImage');
            $input['imagename'] = $id.'_'.$request['productName'].'_base_green_left.'.$image->getClientOriginalExtension();
            $greenLeftImageName = $input['imagename'];
            $destinationPath = public_path('/productimages');
            $image->move($destinationPath, $greenLeftImageName);

            $image = $request->file('greenRightImage');
            $input['imagename'] = $id.'_'.$request['productName'].'_base_green_right.'.$image->getClientOriginalExtension();
            $greenRightImageName = $input['imagename'];
            $destinationPath = public_path('/productimages');
            $image->move($destinationPath, $greenRightImageName);

            $image = $request->file('greenRoundImage');
            $input['imagename'] = $id.'_'.$request['productName'].'_round_green_front.'.$image->getClientOriginalExtension();
            $greenRoundImageName = $input['imagename'];
            $destinationPath = public_path('/productimages');
            $image->move($destinationPath, $greenRoundImageName);

            $image = $request->file('greenVImage');
            $input['imagename'] = $id.'_'.$request['productName'].'_v_green_front.'.$image->getClientOriginalExtension();
            $greenVImageName = $input['imagename'];
            $destinationPath = public_path('/productimages');
            $image->move($destinationPath, $greenVImageName);

            $greenCollarImageName = '';
            if($request['jerseyType'] == 'soccer') {
                $image = $request->file('greenCollarImage');
                $input['imagename'] = $id.'_'.$request['productName'].'_collar_green_front.'.$image->getClientOriginalExtension();
                $greenCollarImageName = $input['imagename'];
                $destinationPath = public_path('/productimages');
                $image->move($destinationPath, $greenCollarImageName);
            }

            // END GREEN

            // BLUE
            $image = $request->file('blueFrontImage');
            $input['imagename'] = $id.'_'.$request['productName'].'_base_blue_front.'.$image->getClientOriginalExtension();
            $blueFrontImageName = $input['imagename'];
            $destinationPath = public_path('/productimages');
            $image->move($destinationPath, $blueFrontImageName);

            $image = $request->file('blueBackImage');
            $input['imagename'] = $id.'_'.$request['productName'].'_base_blue_back.'.$image->getClientOriginalExtension();
            $blueBackImageName = $input['imagename'];
            $destinationPath = public_path('/productimages');
            $image->move($destinationPath, $blueBackImageName);


            $image = $request->file('blueLeftImage');
            $input['imagename'] = $id.'_'.$request['productName'].'_base_blue_left.'.$image->getClientOriginalExtension();
            $blueLeftImageName = $input['imagename'];
            $destinationPath = public_path('/productimages');
            $image->move($destinationPath, $blueLeftImageName);

            $image = $request->file('blueRightImage');
            $input['imagename'] = $id.'_'.$request['productName'].'_base_blue_right.'.$image->getClientOriginalExtension();
            $blueRightImageName = $input['imagename'];
            $destinationPath = public_path('/productimages');
            $image->move($destinationPath, $blueRightImageName);

            $image = $request->file('blueRoundImage');
            $input['imagename'] = $id.'_'.$request['productName'].'_round_blue_front.'.$image->getClientOriginalExtension();
            $blueRoundImageName = $input['imagename'];
            $destinationPath = public_path('/productimages');
            $image->move($destinationPath, $blueRoundImageName);

            $image = $request->file('blueVImage');
            $input['imagename'] = $id.'_'.$request['productName'].'_v_blue_front.'.$image->getClientOriginalExtension();
            $blueVImageName = $input['imagename'];
            $destinationPath = public_path('/productimages');
            $image->move($destinationPath, $blueVImageName);

            $blueCollarImageName = '';
            if($request['jerseyType'] == 'soccer') {
                $image = $request->file('blueCollarImage');
                $input['imagename'] = $id.'_'.$request['productName'].'_collar_blue_front.'.$image->getClientOriginalExtension();
                $blueCollarImageName = $input['imagename'];
                $destinationPath = public_path('/productimages');
                $image->move($destinationPath, $blueCollarImageName);
            }

            // END BLUE

            $productImage = array();
            $productImage['product_id'] = $id;
            $productImage['white_front_image'] = $whiteFrontImageName;
            $productImage['white_back_image'] = $whiteBackImageName;
            $productImage['white_left_image'] = $whiteLeftImageName;
            $productImage['white_right_image'] = $whiteRightImageName;
            $productImage['white_round_neck_image'] = $whiteRoundImageName;
            $productImage['white_v_neck_image'] = $whiteVImageName;
            $productImage['white_collar_image'] = $whiteCollarImageName;

            $productImage['red_front_image'] = $redFrontImageName;
            $productImage['red_back_image'] = $redBackImageName;
            $productImage['red_left_image'] = $redLeftImageName;
            $productImage['red_right_image'] = $redRightImageName;
            $productImage['red_round_neck_image'] = $redRoundImageName;
            $productImage['red_v_neck_image'] = $redVImageName;
            $productImage['red_collar_image'] = $redCollarImageName;

            $productImage['green_front_image'] = $greenFrontImageName;
            $productImage['green_back_image'] = $greenBackImageName;
            $productImage['green_left_image'] = $greenLeftImageName;
            $productImage['green_right_image'] = $greenRightImageName;
            $productImage['green_round_neck_image'] = $greenRoundImageName;
            $productImage['green_v_neck_image'] = $greenVImageName;
            $productImage['green_collar_image'] = $greenCollarImageName;

            $productImage['blue_front_image'] = $blueFrontImageName;
            $productImage['blue_back_image'] = $blueBackImageName;
            $productImage['blue_left_image'] = $blueLeftImageName;
            $productImage['blue_right_image'] = $blueRightImageName;
            $productImage['blue_round_neck_image'] = $blueRoundImageName;
            $productImage['blue_v_neck_image'] = $blueVImageName;
            $productImage['blue_collar_image'] = $blueCollarImageName;

            ProductImage::create($productImage);
        } else {
            $image = $request->file('bagFrontImage');
            $input['imagename'] = $id.'_'.$request['productName'].'_'.time().'_bag_front.'.$image->getClientOriginalExtension();
            $bagFrontImageName = $input['imagename'];
            $destinationPath = public_path('/productimages');
            $image->move($destinationPath, $bagFrontImageName);

            $image = $request->file('bagBackImage');
            $input['imagename'] = $id.'_'.$request['productName'].'_'.time().'_bag_back.'.$image->getClientOriginalExtension();
            $bagBackImageName = $input['imagename'];
            $destinationPath = public_path('/productimages');
            $image->move($destinationPath, $bagBackImageName);

            $bagProductImage = array();
            $bagProductImage['product_id'] = $id;
            $bagProductImage['bag_front_image'] = $bagFrontImageName;
            $bagProductImage['bag_back_image'] = $bagBackImageName;
            ProductImage::create($bagProductImage);

        }

    }
}
