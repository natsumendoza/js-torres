<!-- orderList.blade.php -->
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
            <th style="text-align: center">Status</th>
            <th style="text-align: center">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($cartItems as $item)
            <tr>
                <td style="text-align: center;">{{$item['id']}}</td>
                <td>{{$item['transaction_code']}}</td>
                <td>Link Modal</td>
                <td>{{$item['quantity']}}</td>
                <td>{{$item['total_price']}}</td>
                <td>{{$item['status']}}</td>
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
            <td colspan="7">&nbsp;</td>
        </tr>
        <tr>
            <td style="text-align: right;" colspan="6">
                <a href="{{url('')}}" class="btn btn-primary">Continue Shoping</a>
            </td>
            <td style="text-align: right;">
                <form action="{{action('OrderController@destroyByTransactionCode', $item['transaction_code'])}}" method="post">
                    {{csrf_field()}}
                    <input name="_method" type="hidden" value="DELETE">
                    <button class="btn btn-danger" type="submit">Empty Cart</button>
                </form>
            </td>
        </tr>
        </tbody>
    </table>
</div>
</body>
</html>
@endsection