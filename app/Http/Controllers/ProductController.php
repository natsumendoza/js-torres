<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\File;
use App\ProductImage;
use Illuminate\Support\Facades\DB;

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
            $product['base_price']   = $request['basePrice'];
        }

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
//        $product = Product::find($id);

        $productObj = DB::table('products')
            ->join('product_images', 'products.id', '=', 'product_images.product_id')
            ->select('products.*', 'product_images.*')
            ->where('products.id', '=', $id)
            ->get();

        $productData = array();
        foreach($productObj as $product)
        {
            $product = (array)$product;
            $productData[$product['product_id']] = $product;
        }

//        echo '<pre>';
//        print_r($productData);
//        die;

        return view('products.product')->with(array('product' => $productData[$id]));
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
        $formType = $request['formType'];

        $validated_product = $this->validate($request,[
            'productName' => 'required',
            'productType' => 'required',
        ]);

        // SETS $validate_product to $product
        $product['product_name'] = $validated_product['productName'];
        $product['product_type'] = $validated_product['productType'];

        if ($formType == 'jersey') {
            $product['gender_flag'] = $request['gender'];
            $product['jersey_type']   = $request['jerseyType'];
        } else {
            $product['base_price']   = $request['basePrice'];
        }


        // SETS $validate_product to $product
        $product['product_name'] = $validated_product['productName'];
        $product['product_type'] = $validated_product['productType'];
        $product->save();


        $this->updateProductImageNameEdit($request, $id);

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
        $productImage = ProductImage::find($id);
        $productImage->delete();

        if($product['product_type'] == 'jersey') {
            File::delete(public_path('productimages/'.$productImage['white_front_image']));
            File::delete(public_path('productimages/'.$productImage['white_back_image']));
            File::delete(public_path('productimages/'.$productImage['white_left_image']));
            File::delete(public_path('productimages/'.$productImage['white_right_image']));
            File::delete(public_path('productimages/'.$productImage['white_round_neck_image']));
            File::delete(public_path('productimages/'.$productImage['white_v_neck_image']));
            if($product['jersey_type'] == 'soccer') {
                File::delete(public_path('productimages/'.$productImage['white_collar_image']));
            }

            File::delete(public_path('productimages/'.$productImage['red_front_image']));
            File::delete(public_path('productimages/'.$productImage['red_back_image']));
            File::delete(public_path('productimages/'.$productImage['red_left_image']));
            File::delete(public_path('productimages/'.$productImage['red_right_image']));
            File::delete(public_path('productimages/'.$productImage['red_round_neck_image']));
            File::delete(public_path('productimages/'.$productImage['red_v_neck_image']));
            if($product['jersey_type'] == 'soccer') {
                File::delete(public_path('productimages/'.$productImage['red_collar_image']));
            }

            File::delete(public_path('productimages/'.$productImage['green_front_image']));
            File::delete(public_path('productimages/'.$productImage['green_back_image']));
            File::delete(public_path('productimages/'.$productImage['green_left_image']));
            File::delete(public_path('productimages/'.$productImage['green_right_image']));
            File::delete(public_path('productimages/'.$productImage['green_round_neck_image']));
            File::delete(public_path('productimages/'.$productImage['green_v_neck_image']));
            if($product['jersey_type'] == 'soccer') {
                File::delete(public_path('productimages/'.$productImage['green_collar_image']));
            }

            File::delete(public_path('productimages/'.$productImage['blue_front_image']));
            File::delete(public_path('productimages/'.$productImage['blue_back_image']));
            File::delete(public_path('productimages/'.$productImage['blue_left_image']));
            File::delete(public_path('productimages/'.$productImage['blue_right_image']));
            File::delete(public_path('productimages/'.$productImage['blue_round_neck_image']));
            File::delete(public_path('productimages/'.$productImage['blue_v_neck_image']));
            if($product['jersey_type'] == 'soccer') {
                File::delete(public_path('productimages/'.$productImage['blue_collar_image']));
            }

        } else {
            File::delete(public_path('productimages/'.$productImage['bag_front_image']));
        }


        return redirect('products')->with('success','Product has been deleted');
    }

    public function updateProductImageName($request, $id) {

        $formType = $request['formType'];
        $jerseyType = $request['jerseyType'];

        if ($formType == 'jersey') {
            // WHITE
            $image = $request->file('whiteFrontImage');
            $input['imagename'] = $id.'_'.$jerseyType.'_base_white_front.'.$image->getClientOriginalExtension();
            $whiteFrontImageName = $input['imagename'];
            $destinationPath = public_path('/productimages');
            $image->move($destinationPath, $whiteFrontImageName);

            $image = $request->file('whiteBackImage');
            $input['imagename'] = $id.'_'.$jerseyType.'_base_white_back.'.$image->getClientOriginalExtension();
            $whiteBackImageName = $input['imagename'];
            $destinationPath = public_path('/productimages');
            $image->move($destinationPath, $whiteBackImageName);

            $image = $request->file('whiteLeftImage');
            $input['imagename'] = $id.'_'.$jerseyType.'_base_white_left.'.$image->getClientOriginalExtension();
            $whiteLeftImageName = $input['imagename'];
            $destinationPath = public_path('/productimages');
            $image->move($destinationPath, $whiteLeftImageName);

            $image = $request->file('whiteRightImage');
            $input['imagename'] = $id.'_'.$jerseyType.'_base_white_right.'.$image->getClientOriginalExtension();
            $whiteRightImageName = $input['imagename'];
            $destinationPath = public_path('/productimages');
            $image->move($destinationPath, $whiteRightImageName);

            $image = $request->file('whiteRoundImage');
            $input['imagename'] = $id.'_'.$jerseyType.'_round_white_front.'.$image->getClientOriginalExtension();
            $whiteRoundImageName = $input['imagename'];
            $destinationPath = public_path('/productimages');
            $image->move($destinationPath, $whiteRoundImageName);

            $image = $request->file('whiteVImage');
            $input['imagename'] = $id.'_'.$jerseyType.'_v_white_front.'.$image->getClientOriginalExtension();
            $whiteVImageName = $input['imagename'];
            $destinationPath = public_path('/productimages');
            $image->move($destinationPath, $whiteVImageName);

            $whiteCollarImageName = '';
            if($request['jerseyType'] == 'soccer') {
                $image = $request->file('whiteCollarImage');
                $input['imagename'] = $id.'_'.$jerseyType.'_collar_white_front.'.$image->getClientOriginalExtension();
                $whiteCollarImageName = $input['imagename'];
                $destinationPath = public_path('/productimages');
                $image->move($destinationPath, $whiteCollarImageName);
            }

            // END WHITE

            // RED
            $image = $request->file('redFrontImage');
            $input['imagename'] = $id.'_'.$jerseyType.'_base_red_front.'.$image->getClientOriginalExtension();
            $redFrontImageName = $input['imagename'];
            $destinationPath = public_path('/productimages');
            $image->move($destinationPath, $redFrontImageName);

            $image = $request->file('redBackImage');
            $input['imagename'] = $id.'_'.$jerseyType.'_base_red_back.'.$image->getClientOriginalExtension();
            $redBackImageName = $input['imagename'];
            $destinationPath = public_path('/productimages');
            $image->move($destinationPath, $redBackImageName);

            $image = $request->file('redLeftImage');
            $input['imagename'] = $id.'_'.$jerseyType.'_base_red_left.'.$image->getClientOriginalExtension();
            $redLeftImageName = $input['imagename'];
            $destinationPath = public_path('/productimages');
            $image->move($destinationPath, $redLeftImageName);

            $image = $request->file('redRightImage');
            $input['imagename'] = $id.'_'.$jerseyType.'_base_red_right.'.$image->getClientOriginalExtension();
            $redRightImageName = $input['imagename'];
            $destinationPath = public_path('/productimages');
            $image->move($destinationPath, $redRightImageName);

            $image = $request->file('redRoundImage');
            $input['imagename'] = $id.'_'.$jerseyType.'_round_red_front.'.$image->getClientOriginalExtension();
            $redRoundImageName = $input['imagename'];
            $destinationPath = public_path('/productimages');
            $image->move($destinationPath, $redRoundImageName);

            $image = $request->file('redVImage');
            $input['imagename'] = $id.'_'.$jerseyType.'_v_red_front.'.$image->getClientOriginalExtension();
            $redVImageName = $input['imagename'];
            $destinationPath = public_path('/productimages');
            $image->move($destinationPath, $redVImageName);

            $redCollarImageName = '';
            if($request['jerseyType'] == 'soccer') {
                $image = $request->file('redCollarImage');
                $input['imagename'] = $id.'_'.$jerseyType.'_collar_red_front.'.$image->getClientOriginalExtension();
                $redCollarImageName = $input['imagename'];
                $destinationPath = public_path('/productimages');
                $image->move($destinationPath, $redCollarImageName);
            }

            // END RED

            // GREEN
            $image = $request->file('greenFrontImage');
            $input['imagename'] = $id.'_'.$jerseyType.'_base_green_front.'.$image->getClientOriginalExtension();
            $greenFrontImageName = $input['imagename'];
            $destinationPath = public_path('/productimages');
            $image->move($destinationPath, $greenFrontImageName);

            $image = $request->file('greenBackImage');
            $input['imagename'] = $id.'_'.$jerseyType.'_base_green_back.'.$image->getClientOriginalExtension();
            $greenBackImageName = $input['imagename'];
            $destinationPath = public_path('/productimages');
            $image->move($destinationPath, $greenBackImageName);

            $image = $request->file('greenLeftImage');
            $input['imagename'] = $id.'_'.$jerseyType.'_base_green_left.'.$image->getClientOriginalExtension();
            $greenLeftImageName = $input['imagename'];
            $destinationPath = public_path('/productimages');
            $image->move($destinationPath, $greenLeftImageName);

            $image = $request->file('greenRightImage');
            $input['imagename'] = $id.'_'.$jerseyType.'_base_green_right.'.$image->getClientOriginalExtension();
            $greenRightImageName = $input['imagename'];
            $destinationPath = public_path('/productimages');
            $image->move($destinationPath, $greenRightImageName);

            $image = $request->file('greenRoundImage');
            $input['imagename'] = $id.'_'.$jerseyType.'_round_green_front.'.$image->getClientOriginalExtension();
            $greenRoundImageName = $input['imagename'];
            $destinationPath = public_path('/productimages');
            $image->move($destinationPath, $greenRoundImageName);

            $image = $request->file('greenVImage');
            $input['imagename'] = $id.'_'.$jerseyType.'_v_green_front.'.$image->getClientOriginalExtension();
            $greenVImageName = $input['imagename'];
            $destinationPath = public_path('/productimages');
            $image->move($destinationPath, $greenVImageName);

            $greenCollarImageName = '';
            if($request['jerseyType'] == 'soccer') {
                $image = $request->file('greenCollarImage');
                $input['imagename'] = $id.'_'.$jerseyType.'_collar_green_front.'.$image->getClientOriginalExtension();
                $greenCollarImageName = $input['imagename'];
                $destinationPath = public_path('/productimages');
                $image->move($destinationPath, $greenCollarImageName);
            }

            // END GREEN

            // BLUE
            $image = $request->file('blueFrontImage');
            $input['imagename'] = $id.'_'.$jerseyType.'_base_blue_front.'.$image->getClientOriginalExtension();
            $blueFrontImageName = $input['imagename'];
            $destinationPath = public_path('/productimages');
            $image->move($destinationPath, $blueFrontImageName);

            $image = $request->file('blueBackImage');
            $input['imagename'] = $id.'_'.$jerseyType.'_base_blue_back.'.$image->getClientOriginalExtension();
            $blueBackImageName = $input['imagename'];
            $destinationPath = public_path('/productimages');
            $image->move($destinationPath, $blueBackImageName);


            $image = $request->file('blueLeftImage');
            $input['imagename'] = $id.'_'.$jerseyType.'_base_blue_left.'.$image->getClientOriginalExtension();
            $blueLeftImageName = $input['imagename'];
            $destinationPath = public_path('/productimages');
            $image->move($destinationPath, $blueLeftImageName);

            $image = $request->file('blueRightImage');
            $input['imagename'] = $id.'_'.$jerseyType.'_base_blue_right.'.$image->getClientOriginalExtension();
            $blueRightImageName = $input['imagename'];
            $destinationPath = public_path('/productimages');
            $image->move($destinationPath, $blueRightImageName);

            $image = $request->file('blueRoundImage');
            $input['imagename'] = $id.'_'.$jerseyType.'_round_blue_front.'.$image->getClientOriginalExtension();
            $blueRoundImageName = $input['imagename'];
            $destinationPath = public_path('/productimages');
            $image->move($destinationPath, $blueRoundImageName);

            $image = $request->file('blueVImage');
            $input['imagename'] = $id.'_'.$jerseyType.'_v_blue_front.'.$image->getClientOriginalExtension();
            $blueVImageName = $input['imagename'];
            $destinationPath = public_path('/productimages');
            $image->move($destinationPath, $blueVImageName);

            $blueCollarImageName = '';
            if($request['jerseyType'] == 'soccer') {
                $image = $request->file('blueCollarImage');
                $input['imagename'] = $id.'_'.$jerseyType.'_collar_blue_front.'.$image->getClientOriginalExtension();
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

            $bagProductImage = array();
            $bagProductImage['product_id'] = $id;
            $bagProductImage['bag_front_image'] = $bagFrontImageName;
            ProductImage::create($bagProductImage);

        }

    }

    public function updateProductImageNameEdit($request, $id) {

        $productImage = ProductImage::find($id);
        $formType = $request['formType'];
        $jerseyType = $request['jerseyType'];

        if ($formType == 'jersey') {
            // WHITE
            if ($request['whiteFrontImage'] != NULL) {
                File::delete(public_path('productimages/'.$productImage['white_front_image']));

                $image = $request->file('whiteFrontImage');
                $input['imagename'] = $id.'_'.$jerseyType.'_base_white_front.'.$image->getClientOriginalExtension();
                $whiteFrontImageName = $input['imagename'];
                $destinationPath = public_path('/productimages');
                $image->move($destinationPath, $whiteFrontImageName);

                $productImage['white_front_image'] = $whiteFrontImageName;
            }

            if ($request['whiteBackImage'] != NULL) {

                File::delete(public_path('productimages/'.$productImage['white_back_image']));

                $image = $request->file('whiteBackImage');
                $input['imagename'] = $id.'_'.$jerseyType.'_base_white_back.'.$image->getClientOriginalExtension();
                $whiteBackImageName = $input['imagename'];
                $destinationPath = public_path('/productimages');
                $image->move($destinationPath, $whiteBackImageName);

                $productImage['white_back_image'] = $whiteBackImageName;

            }

            if ($request['whiteLeftImage'] != NULL) {
                File::delete(public_path('productimages/'.$productImage['white_left_image']));

                $image = $request->file('whiteLeftImage');
                $input['imagename'] = $id.'_'.$jerseyType.'_base_white_left.'.$image->getClientOriginalExtension();
                $whiteLeftImageName = $input['imagename'];
                $destinationPath = public_path('/productimages');
                $image->move($destinationPath, $whiteLeftImageName);

                $productImage['white_left_image'] = $whiteLeftImageName;

            }

            if ($request['whiteRightImage'] != NULL) {
                File::delete(public_path('productimages/' . $productImage['white_right_image']));

                $image = $request->file('whiteRightImage');
                $input['imagename'] = $id.'_'.$jerseyType.'_base_white_right.'.$image->getClientOriginalExtension();
                $whiteRightImageName = $input['imagename'];
                $destinationPath = public_path('/productimages');
                $image->move($destinationPath, $whiteRightImageName);

                $productImage['white_right_image'] = $whiteRightImageName;
            }

            if ($request['whiteRoundImage'] != NULL) {
                File::delete(public_path('productimages/' . $productImage['white_round_neck_image']));

                $image = $request->file('whiteRoundImage');
                $input['imagename'] = $id.'_'.$jerseyType.'_round_white_front.'.$image->getClientOriginalExtension();
                $whiteRoundImageName = $input['imagename'];
                $destinationPath = public_path('/productimages');
                $image->move($destinationPath, $whiteRoundImageName);

                $productImage['white_round_neck_image'] = $whiteRoundImageName;
            }

            if ($request['whiteVImage'] != NULL) {
                File::delete(public_path('productimages/' . $productImage['white_v_neck_image']));

                $image = $request->file('whiteVImage');
                $input['imagename'] = $id.'_'.$jerseyType.'_v_white_front.'.$image->getClientOriginalExtension();
                $whiteVImageName = $input['imagename'];
                $destinationPath = public_path('/productimages');
                $image->move($destinationPath, $whiteVImageName);

                $productImage['white_v_neck_image'] = $whiteVImageName;
            }



            if($request['jerseyType'] == 'soccer') {
                if ($request['whiteCollarImage'] != NULL) {
                    File::delete(public_path('productimages/' . $productImage['white_collar_image']));

                    $image = $request->file('whiteCollarImage');
                    $input['imagename'] = $id.'_'.$jerseyType.'_collar_white_front.'.$image->getClientOriginalExtension();
                    $whiteCollarImageName = $input['imagename'];
                    $destinationPath = public_path('/productimages');
                    $image->move($destinationPath, $whiteCollarImageName);

                    $productImage['white_collar_image'] = $whiteCollarImageName;
                }
            }

            // END WHITE

            // RED

            if ($request['redFrontImage'] != NULL) {
                File::delete(public_path('productimages/' . $productImage['red_front_image']));

                $image = $request->file('redFrontImage');
                $input['imagename'] = $id.'_'.$jerseyType.'_base_red_front.'.$image->getClientOriginalExtension();
                $redFrontImageName = $input['imagename'];
                $destinationPath = public_path('/productimages');
                $image->move($destinationPath, $redFrontImageName);

                $productImage['red_front_image'] = $redFrontImageName;
            }


            if ($request['redBackImage'] != NULL) {
                File::delete(public_path('productimages/' . $productImage['red_back_image']));

                $image = $request->file('redBackImage');
                $input['imagename'] = $id.'_'.$jerseyType.'_base_red_back.'.$image->getClientOriginalExtension();
                $redBackImageName = $input['imagename'];
                $destinationPath = public_path('/productimages');
                $image->move($destinationPath, $redBackImageName);

                $productImage['red_back_image'] = $redBackImageName;
            }

            if ($request['redLeftImage'] != NULL) {
                File::delete(public_path('productimages/' . $productImage['red_left_image']));

                $image = $request->file('redLeftImage');
                $input['imagename'] = $id.'_'.$jerseyType.'_base_red_left.'.$image->getClientOriginalExtension();
                $redLeftImageName = $input['imagename'];
                $destinationPath = public_path('/productimages');
                $image->move($destinationPath, $redLeftImageName);

                $productImage['red_left_image'] = $redLeftImageName;
            }

            if ($request['redRightImage'] != NULL) {
                File::delete(public_path('productimages/' . $productImage['red_right_image']));

                $image = $request->file('redRightImage');
                $input['imagename'] = $id.'_'.$jerseyType.'_base_red_right.'.$image->getClientOriginalExtension();
                $redRightImageName = $input['imagename'];
                $destinationPath = public_path('/productimages');
                $image->move($destinationPath, $redRightImageName);

                $productImage['red_right_image'] = $redRightImageName;
            }

            if ($request['redRoundImage'] != NULL) {
                File::delete(public_path('productimages/' . $productImage['red_round_neck_image']));

                $image = $request->file('redRoundImage');
                $input['imagename'] = $id.'_'.$jerseyType.'_round_red_front.'.$image->getClientOriginalExtension();
                $redRoundImageName = $input['imagename'];
                $destinationPath = public_path('/productimages');
                $image->move($destinationPath, $redRoundImageName);

                $productImage['red_round_neck_image'] = $redRoundImageName;
            }

            if ($request['redVImage'] != NULL) {
                File::delete(public_path('productimages/' . $productImage['red_v_neck_image']));

                $image = $request->file('redVImage');
                $input['imagename'] = $id.'_'.$jerseyType.'_v_red_front.'.$image->getClientOriginalExtension();
                $redVImageName = $input['imagename'];
                $destinationPath = public_path('/productimages');
                $image->move($destinationPath, $redVImageName);

                $productImage['red_v_neck_image'] = $redVImageName;
            }




            if($request['jerseyType'] == 'soccer') {
                if ($request['redCollarImage'] != NULL) {
                    File::delete(public_path('productimages/' . $productImage['red_collar_image']));

                    $image = $request->file('redCollarImage');
                    $input['imagename'] = $id.'_'.$jerseyType.'_collar_red_front.'.$image->getClientOriginalExtension();
                    $redCollarImageName = $input['imagename'];
                    $destinationPath = public_path('/productimages');
                    $image->move($destinationPath, $redCollarImageName);

                    $productImage['red_collar_image'] = $redCollarImageName;
                }

            }

            // END RED

            // GREEN

            if ($request['greenFrontImage'] != NULL) {
                File::delete(public_path('productimages/' . $productImage['green_front_image']));

                $image = $request->file('greenFrontImage');
                $input['imagename'] = $id.'_'.$jerseyType.'_base_green_front.'.$image->getClientOriginalExtension();
                $greenFrontImageName = $input['imagename'];
                $destinationPath = public_path('/productimages');
                $image->move($destinationPath, $greenFrontImageName);

                $productImage['green_front_image'] = $greenFrontImageName;
            }

            if ($request['greenBackImage'] != NULL) {
                File::delete(public_path('productimages/' . $productImage['green_back_image']));

                $image = $request->file('greenBackImage');
                $input['imagename'] = $id.'_'.$jerseyType.'_base_green_back.'.$image->getClientOriginalExtension();
                $greenBackImageName = $input['imagename'];
                $destinationPath = public_path('/productimages');
                $image->move($destinationPath, $greenBackImageName);

                $productImage['green_back_image'] = $greenBackImageName;
            }

            if ($request['greenLeftImage'] != NULL) {
                File::delete(public_path('productimages/' . $productImage['green_left_image']));

                $image = $request->file('greenLeftImage');
                $input['imagename'] = $id.'_'.$jerseyType.'_base_green_left.'.$image->getClientOriginalExtension();
                $greenLeftImageName = $input['imagename'];
                $destinationPath = public_path('/productimages');
                $image->move($destinationPath, $greenLeftImageName);

                $productImage['green_left_image'] = $greenLeftImageName;
            }

            if ($request['greenRightImage'] != NULL) {
                File::delete(public_path('productimages/' . $productImage['green_right_image']));

                $image = $request->file('greenRightImage');
                $input['imagename'] = $id.'_'.$jerseyType.'_base_green_right.'.$image->getClientOriginalExtension();
                $greenRightImageName = $input['imagename'];
                $destinationPath = public_path('/productimages');
                $image->move($destinationPath, $greenRightImageName);

                $productImage['green_right_image'] = $greenRightImageName;
            }

            if ($request['greenRoundImage'] != NULL) {
                File::delete(public_path('productimages/' . $productImage['green_round_neck_image']));

                $image = $request->file('greenRoundImage');
                $input['imagename'] = $id.'_'.$jerseyType.'_round_green_front.'.$image->getClientOriginalExtension();
                $greenRoundImageName = $input['imagename'];
                $destinationPath = public_path('/productimages');
                $image->move($destinationPath, $greenRoundImageName);

                $productImage['green_round_neck_image'] = $greenRoundImageName;
            }

            if ($request['greenVImage'] != NULL) {
                File::delete(public_path('productimages/' . $productImage['green_v_neck_image']));

                $image = $request->file('greenVImage');
                $input['imagename'] = $id.'_'.$jerseyType.'_v_green_front.'.$image->getClientOriginalExtension();
                $greenVImageName = $input['imagename'];
                $destinationPath = public_path('/productimages');
                $image->move($destinationPath, $greenVImageName);

                $productImage['green_v_neck_image'] = $greenVImageName;

            }



            if($request['jerseyType'] == 'soccer') {
                if ($request['greenCollarImage'] != NULL) {
                    File::delete(public_path('productimages/' . $productImage['green_collar_image']));

                    $image = $request->file('greenCollarImage');
                    $input['imagename'] = $id.'_'.$jerseyType.'_collar_green_front.'.$image->getClientOriginalExtension();
                    $greenCollarImageName = $input['imagename'];
                    $destinationPath = public_path('/productimages');
                    $image->move($destinationPath, $greenCollarImageName);

                    $productImage['green_collar_image'] = $greenCollarImageName;
                }

            }

            // END GREEN

            // BLUE

            if ($request['blueFrontImage'] != NULL) {
                File::delete(public_path('productimages/' . $productImage['blue_front_image']));

                $image = $request->file('blueFrontImage');
                $input['imagename'] = $id.'_'.$jerseyType.'_base_blue_front.'.$image->getClientOriginalExtension();
                $blueFrontImageName = $input['imagename'];
                $destinationPath = public_path('/productimages');
                $image->move($destinationPath, $blueFrontImageName);

                $productImage['blue_front_image'] = $blueFrontImageName;
            }

            if ($request['blueBackImage'] != NULL) {
                File::delete(public_path('productimages/' . $productImage['blue_back_image']));

                $image = $request->file('blueBackImage');
                $input['imagename'] = $id.'_'.$jerseyType.'_base_blue_back.'.$image->getClientOriginalExtension();
                $blueBackImageName = $input['imagename'];
                $destinationPath = public_path('/productimages');
                $image->move($destinationPath, $blueBackImageName);

                $productImage['blue_back_image'] = $blueBackImageName;
            }

            if ($request['blueLeftImage'] != NULL) {
                File::delete(public_path('productimages/' . $productImage['blue_left_image']));

                $image = $request->file('blueLeftImage');
                $input['imagename'] = $id.'_'.$jerseyType.'_base_blue_left.'.$image->getClientOriginalExtension();
                $blueLeftImageName = $input['imagename'];
                $destinationPath = public_path('/productimages');
                $image->move($destinationPath, $blueLeftImageName);

                $productImage['blue_left_image'] = $blueLeftImageName;
            }


            if ($request['blueRightImage'] != NULL) {
                File::delete(public_path('productimages/' . $productImage['blue_right_image']));

                $image = $request->file('blueRightImage');
                $input['imagename'] = $id.'_'.$jerseyType.'_base_blue_right.'.$image->getClientOriginalExtension();
                $blueRightImageName = $input['imagename'];
                $destinationPath = public_path('/productimages');
                $image->move($destinationPath, $blueRightImageName);

                $productImage['blue_right_image'] = $blueRightImageName;
            }

            if ($request['blueRoundImage'] != NULL) {
                File::delete(public_path('productimages/' . $productImage['blue_round_neck_image']));

                $image = $request->file('blueRoundImage');
                $input['imagename'] = $id.'_'.$jerseyType.'_round_blue_front.'.$image->getClientOriginalExtension();
                $blueRoundImageName = $input['imagename'];
                $destinationPath = public_path('/productimages');
                $image->move($destinationPath, $blueRoundImageName);

                $productImage['blue_round_neck_image'] = $blueRoundImageName;
            }

            if ($request['blueVImage'] != NULL) {
                File::delete(public_path('productimages/' . $productImage['blue_v_neck_image']));

                $image = $request->file('blueVImage');
                $input['imagename'] = $id.'_'.$jerseyType.'_v_blue_front.'.$image->getClientOriginalExtension();
                $blueVImageName = $input['imagename'];
                $destinationPath = public_path('/productimages');
                $image->move($destinationPath, $blueVImageName);

                $productImage['blue_v_neck_image'] = $blueVImageName;
            }


            if($request['jerseyType'] == 'soccer') {
                if ($request['blueCollarImage'] != NULL) {
                    File::delete(public_path('productimages/' . $productImage['blue_collar_image']));

                    $image = $request->file('blueCollarImage');
                    $input['imagename'] = $id.'_'.$jerseyType.'_collar_blue_front.'.$image->getClientOriginalExtension();
                    $blueCollarImageName = $input['imagename'];
                    $destinationPath = public_path('/productimages');
                    $image->move($destinationPath, $blueCollarImageName);

                    $productImage['blue_collar_image'] = $blueCollarImageName;
                }

            }

            // END BLUE


            $productImage->save();
        } else {
            $bagProductImage = ProductImage::find($id);

            if ($request['bagFrontImage'] != NULL) {
                File::delete(public_path('productimages/'.$bagProductImage['bag_front_image']));

                $image = $request->file('bagFrontImage');
                $input['imagename'] = $id.'_'.$request['productName'].'_'.time().'_bag_front.'.$image->getClientOriginalExtension();
                $bagFrontImageName = $input['imagename'];
                $destinationPath = public_path('/productimages');
                $image->move($destinationPath, $bagFrontImageName);


                $bagProductImage['bag_front_image'] = $bagFrontImageName;
            }

            $bagProductImage->save();

        }

    }
}
