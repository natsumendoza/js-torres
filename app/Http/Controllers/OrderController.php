<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;

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
        $validated_order = $this->validate($request,[
            'transactionCode' => 'required',
            'userId' => 'required|numeric',
            'frontImage' => 'required',
            'backImage' => 'required',
            'leftImage' => 'required',
            'rightImage' => 'required',
            'quantity' => 'required|numeric',
            'totalPrice' => 'required|numeric',
            'status'    => 'required'
        ]);

        // SETS $validated_order to $product
        $order = array();
        $order['transaction_code'] = $validated_order['transactionCode'];
        $order['user_id']          = $validated_order['userId'];
        $order['front_image']      = $validated_order['frontImage'];
        $order['back_image']       = $validated_order['backImage'];
        $order['left_image']       = $validated_order['leftImage'];
        $order['right_image']      = $validated_order['rightImage'];
        $order['quantity']         = $validated_order['quantity'];
        $order['total_price']      = $validated_order['totalPrice'];
        $order['status']           = $validated_order['status'];

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
        //
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
        echo 'destroyByTransactionCode >>> ' . $transactionCode;
        die;
    }


}
