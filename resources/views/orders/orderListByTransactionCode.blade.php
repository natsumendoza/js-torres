<!-- orderListByTransactionCode.blade.php -->
@extends('layouts.layout')
@section('content')
@php
    $transactionCode = "";
    if(isset($cartItems) and !empty($cartItems))
    {
        $cartItem = reset($cartItems);
        $transactionCode = base64_encode($cartItem['transaction_code']);
    }

    $totalQuantity = 0;
    foreach($cartItems as $cart)
    {
        $totalQuantity += $cart['quantity'];
    }

    $totalPrice = 0.00;

@endphp
@include('modals.paymentModal', ['transactionCode'=>$transactionCode, 'totalQuantity'=>$totalQuantity])
@include('modals.orderImageModal')
@include('modals.orderSizeModal')
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Orders</title>
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
            <th style="text-align: center">Order Images</th>
            <th style="text-align: center">Type of Fabric</th>
            <th style="text-align: center">Type of Print</th>
            <th style="text-align: center">Size</th>
            <th style="text-align: center">Quantity</th>
            <th style="text-align: center">Total Price</th>
            <th style="text-align: center">Action</th>
        </tr>
        </thead>
        <tbody>
        @if(!empty($cartItems))
        @foreach($cartItems as $item)
                @php
                    $totalPrice = $totalPrice + $item['total_price'];
                @endphp
                <tr>
                <td style="text-align: center;">{{$item['id']}}</td>
                <td style="text-align: center;">{{$item['transaction_code']}}</td>
                <td style="text-align: center;">
                    <a class="viewOrderImage" id="{{$item['id']}}" data-toggle="modal" data-target="#orderImageModal">View Images</a>
                </td>
                <td style="text-align: center;">
                    @if(ISSET($item['fabric_type']) AND !EMPTY($item['fabric_type']))
                        {{$item['fabric_type']}}
                    @else
                        N/A
                    @endif
                </td>
                <td style="text-align: center;">
                    @if(ISSET($item['print_type']) AND !EMPTY($item['print_type']))
                        {{$item['print_type']}}
                    @else
                        N/A
                    @endif
                </td>
                    <td style="text-align: center;">
                        <a class="viewSizeModal" id="{{$item['id']}}" data-toggle="modal" data-target="#orderSizeModal">
                            {{explode(',', $item['description'])[0]}}
                        </a></td>
                <td style="text-align: center;">{{$item['quantity']}}</td>
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
            <td style="text-align: right;" colspan="6">{{number_format($totalPrice, 2)}}</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td style="text-align: left;">
                <a href="{{url('/customize')}}" class="btn btn-primary">Continue Shopping</a>
            </td>
            <td style="text-align: left;">
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#paymentModal">Proceed to checkout</button>
            </td>
            <td style="text-align: right;" colspan="6">
                <form action="{{action('OrderController@destroyByTransactionCode', $transactionCode)}}" method="POST">
                    {{csrf_field()}}
                    <input name="_method" type="hidden" value="DELETE">
                    <button class="btn btn-danger" type="submit">Empty Cart</button>
                </form>
            </td>
        </tr>
        @else
        <tr>
            <td colspan="8" style="text-align: center">No item in cart</td>
        </tr>
        <tr>
            <td colspan="8" style="text-align: left;">
                <a href="{{url('/customize')}}" class="btn btn-primary">Continue Shopping</a>
            </td>
        </tr>
        @endif
        </tbody>
    </table>

</div>
</body>
<script>
    $(document).ready(function() {
        var items = <?php echo json_encode(@$cartItems); ?>;
        var orderImagePath = <?php echo json_encode(URL::asset('/orderimages/')); ?>


        $('.viewOrderImage').on('click',function (e) {
            var id = e.target.id;

            // FOR ANCHOR <a> TAG
            $('#frontAnchorOrder').attr("href", orderImagePath + '/' + items[id]['front_image']);
            $('#backAnchorOrder').attr("href", orderImagePath + '/' + items[id]['back_image']);
            $('#leftAnchorOrder').attr("href", orderImagePath + '/' + items[id]['left_image']);
            $('#rightAnchorOrder').attr("href", orderImagePath + '/' + items[id]['right_image']);
            // FOR IMAGE src
            $('#frontImgSrcOrder').attr("src", orderImagePath + '/' + items[id]['front_image']);
            $('#backImgSrcOrder').attr("src", orderImagePath + '/' + items[id]['back_image']);
            $('#leftImgSrcOrder').attr("src", orderImagePath + '/' + items[id]['left_image']);
            $('#rightImgSrcOrder').attr("src", orderImagePath + '/' + items[id]['right_image']);
        });

        $('.viewSizeModal').on('click', function (e) {
            var id = e.target.id;
            var sizes = (items[id]['description']).split(',');

            var size = sizes[0];
            var chest = sizes[1];
            var frontLength = sizes[2];
            var backLength = sizes[3];
            var shortWaist = sizes[4];
            var shortLength = sizes[5];
            var legOpening = sizes[6];
            var corchLength = sizes[7];

            $('#size').text(size);
            $('#chest').text(chest + "\"");
            $('#frontLength').text(frontLength + "\"");
            $('#backLength').text(backLength + "\"");
            $('#shortWaist').text(shortWaist + "\"");
            $('#shortLength').text(shortLength + "\"");
            $('#legOpening').text(legOpening + "\"");
            $('#corchLength').text(corchLength + "\"");
        });

    });
</script>
</html>
@endsection