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
            <th style="text-align: center">Product (Link of image)</th>
            <th style="text-align: center">Quantity</th>
            <th style="text-align: center">Total Price</th>
            <th style="text-align: center">Status</th>
        </tr>
        </thead>
        <tbody>
        @foreach($orderList as $order)
            <tr>
                <td style="text-align: center;">{{$order['id']}}</td>
                <td>{{$order['transaction_code']}}</td>
                <td>Link Modal</td>
                <td>{{$order['quantity']}}</td>
                <td style="text-align: center;">{{$order['total_price']}}</td>
                <td style="text-align: center;"><a href="{{action('OrderController@edit', $order['id'])}}" class="btn btn-warning">Edit</a></td>
            </tr>
        @endforeach
        <tr>
            <td style="text-align: right;" colspan="6">
                <a href="{{url('')}}" class="btn btn-default">Close</a>
            </td>
        </tbody>
    </table>
</div>
</body>
</html>
@endsection