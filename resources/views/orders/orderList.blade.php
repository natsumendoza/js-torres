<!-- orderList.blade.php -->
@extends('layouts.layout2')

@section('content')
        <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Orders</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body>
<div class="container">
    <br />
    @if (\Session::has('success'))
        <div class="alert alert-success">
            <p>{{ \Session::get('success') }}</p>
        </div><br />
    @endif

    <table class="table table-striped">
        <thead>
        <tr>
            <th style="text-align: center">ID</th>
            <th style="text-align: center">Transaction Code</th>
            <th style="text-align: center">Ordered By</th>
            <th style="text-align: center">Product (Link of image)</th>
            <th style="text-align: center">Quantity</th>
            <th style="text-align: center">Total Price</th>
            <th style="text-align: center">Current Status</th>
            <th style="text-align: center">Action</th>
        </tr>
        </thead>
        <tbody>
        @if(count($orderList)>0);
        @foreach($orderList as $order)
            <tr>
                <td style="text-align: center;">{{$order['id']}}</td>
                <td>{{$order['transaction_code']}}</td>
                <td style="text-align: center;">{{$order['user_id']}}</td>
                <td>Link Modal</td>
                <td>{{$order['quantity']}}</td>
                <td style="text-align: right;">{{$order['total_price']}}</td>
                <td style="text-align: center;">{{$order['status']}}</td>
                @if( $order['status'] == config('constants.ORDER_STATUS_OPEN') )

                <td style="text-align: center;">
                        <form action="{{action('OrderController@update', base64_encode($order['id']))}}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="status" id="status" value="{{base64_encode(config('constants.ORDER_STATUS_SHIPPED'))}}">
                            <input type="hidden" name="userId" id="userId" value="{{base64_encode($order['user_id'])}}">
                            <input name="_method" type="hidden" value="PATCH">
                            <button class="btn btn-warning" type="submit">Ship</button>
                        </form>
                    </td>
                @elseif( $order['status'] == config('constants.ORDER_STATUS_SHIPPED') )
                    <td style="text-align: center;">
                        <form action="{{action('OrderController@update', base64_encode($order['id']))}}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="status" id="status" value="{{base64_encode(config('constants.ORDER_STATUS_DELIVERED'))}}">
                            <input type="hidden" name="userId" id="userId" value="{{base64_encode($order['user_id'])}}">
                            <input name="_method" type="hidden" value="PATCH">
                            <button class="btn btn-primary" type="submit">Deliver</button>
                        </form>
                    </td>
                @elseif( $order['status'] == config('constants.ORDER_STATUS_DELIVERED') )
                    <td style="text-align: center;">No available action.</td>
                @endif
            </tr>
        @endforeach
        @else
            <tr>
                <td style="text-align: center;" colspan="8">
                    There is no order
                </td>
            </tr>
        @endif
        <tr>
            <td style="text-align: right;" colspan="8">
                <a href="{{url('')}}" class="btn btn-default">Close</a>
            </td>
        </tr>
        </tbody>
    </table>
</div>
</body>
</html>
@endsection