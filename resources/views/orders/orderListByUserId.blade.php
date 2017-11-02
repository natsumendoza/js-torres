<!-- orderListListByUserId.blade.php -->
@extends('layouts.layout')

@section('content')
        <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Orders</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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
                <td style="text-align: center;">
                    <a data-toggle="modal" data-target="#orderImageModal">View Images</a>
                    @php($orderImage = ['frontImage'=>$order['front_image'], 'backImage'=>$order['back_image'], 'leftImage'=>$order['left_image'],'rightImage'=>$order['right_image']])
                    @include('modals.orderImageModal', $orderImage)
                </td>
                <td>{{$order['quantity']}}</td>
                <td style="text-align: center;">{{$order['total_price']}}</td>
                <td style="text-align: center;">{{$order['status']}}</td>
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