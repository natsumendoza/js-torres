<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use Session;
use Auth;
//use Intervention\Image\Facades\Image as Image;
use Intervention\Image\ImageManager as Image;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orderList = Order::all()->toArray();
        return view('orders.orderList', compact('orderList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if(!(\Session::has('transactionCode'))) :
            //SET $transactionCode
            $transactionCode = date("dmy") . Auth::user()->id . date("siH");
            Session::put('transactionCode', $transactionCode);

        else:
            $transactionCode = Session::get('transactionCode');
        endif;

        $validated_order = $this->validate($request,[
            'userId' => 'required|numeric',
            'quantity' => 'required|numeric',
            'totalPrice' => 'required|numeric'
        ]);

        // CONVERTION FROM BASE64 TO IMAGE
        $userId = $request['userId'];
        $imageManager = new Image();

        $frontFileName = $userId."_".time()."_front.png";
        $frontPath = public_path("orderimages/".$frontFileName);
        $frontImage = $imageManager->make($request['frontImage'])->encode('png');
        file_put_contents($frontPath, $frontImage);

        $backFileName = $userId."_".time()."_back.png";
        $backPath = public_path("orderimages/".$backFileName);
        $backImage = $imageManager->make($request['backImage'])->encode('png');
        file_put_contents($backPath, $backImage);

        $leftFileName = $userId."_".time()."_left.png";
        $leftPath = public_path("orderimages/".$leftFileName);
        $leftImage = $imageManager->make($request['leftImage'])->encode('png');
        file_put_contents($leftPath, $leftImage);

        $rightFileName = $userId."_".time()."_right.png";
        $rightPath = public_path("orderimages/".$rightFileName);
        $rightImage = $imageManager->make($request['rightImage'])->encode('png');
        file_put_contents($rightPath, $rightImage);
        // END


        // SETS $validated_order to $product
        $order = array();
        $order['transaction_code'] = $transactionCode;
        $order['user_id']          = $validated_order['userId'];
        $order['front_image']      = $frontFileName;
        $order['back_image']       = $backFileName;
        $order['left_image']       = $leftFileName;
        $order['right_image']      = $rightFileName;
        $order['quantity']         = $validated_order['quantity'];
        $order['total_price']      = $validated_order['totalPrice'];
        $order['status']           = config('constants.ORDER_STATUS_PENDING');
        $order['payment_mode']     = 'CART';

        Order::create($order);



        return redirect('cart/'.$order['transaction_code']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $test = "aaa".$id;
        return view('modal', compact('test'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        Order::where('id', $id)
            ->update(['status' => $request->get('status')]);

        return redirect('orders')->with('success','Order status has been updated to ' . $request->get('status'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::find($id);
        $transactionCode = $order['transaction_code'];
        $order->delete();

        return redirect('cart/'.$transactionCode);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $transactionCode
     * @return \Illuminate\Http\Response
     */
    public function destroyByTransactionCode($transactionCode)
    {
        Order::where('transaction_code', $transactionCode)->delete();
        Session::put('cartSize', 0);
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $userId
     * @return \Illuminate\Http\Response
     */
    public function showByUserId($userId)
    {
        $orderList = Order::where('user_id', $userId)
            ->where('status', '<>', 'pending')
            ->get()->toArray();

        return view('orders.orderListByUserId', compact('orderList'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $transactionCode
     * @return \Illuminate\Http\Response
     */
    public function updateByTransactionCode(Request $request, $transactionCode)
    {

        $data = array(
            'status' => config('constants.ORDER_STATUS_OPEN'),
            'payment_mode' => $request->get('payment_mode')
        );

        Order::where('transaction_code', $transactionCode)
            ->update($data);

        Session::forget('cartSize');
        Session::forget('transactionCode');
        return redirect('/');
    }
}
