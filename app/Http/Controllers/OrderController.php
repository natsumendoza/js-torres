<?php

namespace App\Http\Controllers;

use App\Http\Helpers;
use Illuminate\Http\Request;
use App\Order;
use App\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
//use Intervention\Image\Facades\Image as Image;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager as Image;
use Mockery\Exception;
use App\Exceptions\CustomException;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orderListTemp = Order::where('status', '<>', config('constants.ORDER_STATUS_PENDING'))
            ->get()->toArray();;

        $orderList = array();
        foreach ($orderListTemp as $order)
        {
            $orderList[$order['id']] = $order;
        }

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



        $orderType = $request['orderType'];
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

        // CONVERSION FROM BASE64 TO IMAGE
        $userId = $request['userId'];
        $imageManager = new Image();


//        $base64_str_front = substr($request['frontImage'], strpos($request['frontImage'], ",")+1);
//        $image = base64_decode($base64_str_front);
//        Storage::disk('public')->put('image.png', $image);
//        $storagePath = Storage::disk('public')->getDriver()->getAdapter()->getPathPrefix();
//        file_put_contents($storagePath.'image.png', $image);
//
//        die;

        $frontFileName = $userId."_".time()."_front.png";
        $frontPath = public_path("orderimages/".$frontFileName);
        $base64_str_front = substr($request['frontImage'], strpos($request['frontImage'], ",")+1);
        $image = base64_decode($base64_str_front);
        Storage::disk('prod')->put($frontFileName, $image);
//        $storagePath = Storage::disk('prod')->getDriver()->getAdapter()->getPathPrefix();
//        file_put_contents($frontPath.$frontFileName, $image);

        $backFileName = $userId."_".time()."_back.png";
        $backPath = public_path("orderimages/".$backFileName);
        $base64_str_back = substr($request['frontImage'], strpos($request['frontImage'], ",")+1);
        $image = base64_decode($base64_str_back);
        Storage::disk('prod')->put($backFileName, $image);
//        $storagePath = Storage::disk('public')->getDriver()->getAdapter()->getPathPrefix();
//        file_put_contents($backPath.$frontFileName, $image);


//        $frontFileName = $userId."_".time()."_front.png";
//        $frontPath = public_path("orderimages/".$frontFileName);
//        $frontImage = $imageManager->make($request['frontImage'])->encode('png');
//        file_put_contents($frontPath, $frontImage);
//
//        $backFileName = $userId."_".time()."_back.png";
//        $backPath = public_path("orderimages/".$backFileName);
//        $backImage = $imageManager->make($request['backImage'])->encode('png');
//        file_put_contents($backPath, $backImage);

        $leftFileName = '';
        $rightFileName = '';



        if($orderType == 'jersey') {

            $leftFileName = $userId."_".time()."_left.png";
            $leftPath = public_path("orderimages/".$leftFileName);
            $base64_str_left = substr($request['leftImage'], strpos($request['leftImage'], ",")+1);
            $image = base64_decode($base64_str_left);
            Storage::disk('prod')->put($leftFileName, $image);
            $storagePath = Storage::disk('prod')->getDriver()->getAdapter()->getPathPrefix();
            echo base_path('public/orderimages');
            die;
//            file_put_contents($leftPath.$leftFileName, $image);

            $rightFileName = $userId."_".time()."_right.png";
            $rightPath = public_path("orderimages/".$backFileName);
            $base64_str_right = substr($request['rightImage'], strpos($request['rightImage'], ",")+1);
            $image = base64_decode($base64_str_right);
            Storage::disk('prod')->put($rightFileName, $image);
//            $storagePath = Storage::disk('public')->getDriver()->getAdapter()->getPathPrefix();
//            file_put_contents($rightPath.$rightFileName, $image);

//            $leftFileName = $userId."_".time()."_left.png";
//            $leftPath = public_path("orderimages/".$leftFileName);
//            $leftImage = $imageManager->make($request['leftImage'])->encode('png');
//            file_put_contents($leftPath, $leftImage);
//
//            $rightFileName = $userId."_".time()."_right.png";
//            $rightPath = public_path("orderimages/".$rightFileName);
//            $rightImage = $imageManager->make($request['rightImage'])->encode('png');
//            file_put_contents($rightPath, $rightImage);
        }


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

        return redirect('cart/'.base64_encode($order['transaction_code']));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
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

        $orderId    = base64_decode($id);
        $status     = base64_decode($request->get('status'));

        $order  = Order::find($orderId);
        $user   = User::find(base64_decode($request->get('userId')));

        $data                       = array();
        $data['orderId']            = $order['id'];
        $data['transactionCode']    = $order['transaction_code'];
        $data['name']               = $user['first_name'];
        $data['status']             = $status;
        $data['email']              = $user['email'];

        Helpers::sendEmail($data);

        Order::where('id', $orderId)
            ->update(['status' => $status]);
        
        return redirect('orders')->with('success','Order with ID ' . $orderId . ' status has been updated to ' . $status);
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

        return redirect('cart/'.base64_encode($transactionCode));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $transactionCode
     * @return \Illuminate\Http\Response
     */
    public function destroyByTransactionCode($transactionCode)
    {
        Order::where('transaction_code', base64_decode($transactionCode))->delete();
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
        $orderListTemp = Order::where('user_id', base64_decode($userId))
            ->where('status', '<>', config('constants.ORDER_STATUS_PENDING'))
            ->get()->toArray();

        $orderList = array();
        foreach ($orderListTemp as $order)
        {
            $orderList[$order['id']] = $order;
        }

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
        $transactionCode = base64_decode($transactionCode);

        $orderList  = Order::where('transaction_code', '=', $transactionCode)->get()->toArray();
        $user       = User::find(Auth::user()->id);

        $emailData                      = array();
        $emailData['transactionCode']   = $transactionCode;
        $emailData['name']              = $user['first_name'];
        $emailData['status']            = 'RECEIVED';
        $emailData['email']             = $user['email'];

        // SEND EMAIL FOR EVERY ITEM
        foreach ($orderList as $order)
        {
            $emailData['orderId']        = $order['id'];
            Helpers::sendEmail($emailData);
        }

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
