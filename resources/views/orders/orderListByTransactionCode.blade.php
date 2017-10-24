<!-- orderListByTransactionCode.blade.php -->
@extends('layouts.layout')

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
            <th style="text-align: center">Product (Link of image)</th>
            <th style="text-align: center">Quantity</th>
            <th style="text-align: center">Total Price</th>
            <th style="text-align: center">Action</th>
        </tr>
        </thead>
        <tbody>
        @php
            $transactionCode = "";
            if(isset($cartItems) and !empty($cartItems))
            {
                $transactionCode = $cartItems[0]['transaction_code'];
            }
            $totalPrice = 0.00;

        @endphp
        @if(!empty($cartItems))
        @foreach($cartItems as $item)
                @php($totalPrice = $totalPrice + $item['total_price'])
                <tr>
                <td style="text-align: center;">{{$item['id']}}</td>
                <td>{{$item['transaction_code']}}</td>
                <td>Link Modal</td>
                <td>{{$item['quantity']}}</td>
                <td style="text-align: right;">{{number_format($item['total_price'], 2)}}</td>
                <td style="text-align: center;">
                    <form action="{{action('OrderController@destroy', $item['id'])}}" method="post">
                        {{csrf_field()}}
                        <input name="_method" type="hidden" value="DELETE">
                        <button class="btn btn-danger" type="submit">Remove</button>
                    </form>
                </td>
            </tr>
        @endforeach
        <tr>
            <td>&nbsp;</td>
            <td style="text-align: right;" colspan="4">{{number_format($totalPrice, 2)}}</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td style="text-align: left;">
                <a href="{{url('')}}" class="btn btn-primary">Continue Shopping</a>
            </td>
            <td style="text-align: left;">
                <a href="{{url('')}}" class="btn btn-success">Proceed to Checkout</a>
            </td>
            <td style="text-align: right;" colspan="4">
                <form action="{{action('OrderController@destroyByTransactionCode', $transactionCode)}}" method="post">
                    {{csrf_field()}}
                    <input name="_method" type="hidden" value="DELETE">
                    <button class="btn btn-danger" type="submit">Empty Cart</button>
                </form>
            </td>
        </tr>
        @else
        <tr>
            <td colspan="6" style="text-align: center">No item in cart</td>
        </tr>
        <tr>
            <td colspan="6" style="text-align: left;">
                <a href="{{url('')}}" class="btn btn-primary">Continue Shopping</a>
            </td>
        </tr>
        @endif
        </tbody>
    </table>
</div>
</body>
</html>
@endsection