<!-- orderListListByUserId.blade.php -->
@extends('layouts.layout')

@section('content')
@include('modals.orderImageModal')
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
            <th style="text-align: center">Order Images</th>
            <th style="text-align: center">Type of Fabric</th>
            <th style="text-align: center">Type of Print</th>
            <th style="text-align: center">Type of Order</th>
            <th style="text-align: center">Quantity</th>
            <th style="text-align: center">Total Price</th>
            <th style="text-align: center">Status</th>
        </tr>
        </thead>
        <tbody>
        @if(count($orderList)>0);
        @foreach($orderList as $order)
            <tr>
                <td style="text-align: center;">{{$order['id']}}</td>
                <td>{{$order['transaction_code']}}</td>
                <td style="text-align: center;">
                    <a class="viewOrderImage" id="{{$order['id']}}" data-toggle="modal" data-target="#orderImageModal">View Images</a>
                </td>
                <td style="text-align: center;">
                    @if(ISSET($order['fabric_type']) AND !EMPTY($order['fabric_type']))
                        {{$order['fabric_type']}}
                    @else
                        N/A
                    @endif
                </td>
                <td style="text-align: center;">
                    @if(ISSET($order['print_type']) AND !EMPTY($order['print_type']))
                        {{$order['print_type']}}
                    @else
                        N/A
                    @endif
                </td>
                <td style="text-align: center;">{{$order['order_type']}}</td>
                <td style="text-align: center;">{{$order['quantity']}}</td>
                <td style="text-align: right;">{{$order['total_price']}}</td>
                <td style="text-align: center;">{{$order['status']}}</td>
            </tr>
        @endforeach
        @else
            <tr>
                <td style="text-align: center;" colspan="9">
                    There is no order
                </td>
            </tr>
        @endif
        <tr>
            <td style="text-align: right;" colspan="9">
                <a href="{{url('')}}" class="btn btn-default">Close</a>
            </td>
        </tbody>
    </table>
</div>
</body>
<script>
    $(document).ready(function() {
        var orders = <?php echo json_encode(@$orderList); ?>;
        var orderImagePath = <?php echo json_encode(URL::asset('/orderimages/')); ?>;

        $('.viewOrderImage').on('click',function (e) {
            var id = e.target.id;
            // FOR ANCHOR <a> TAG
            $('#frontAnchorOrder').attr("href", orderImagePath + '/' + orders[id]['front_image']);
            $('#backAnchorOrder').attr("href", orderImagePath + '/' + orders[id]['back_image']);
            $('#leftAnchorOrder').attr("href", orderImagePath + '/' + orders[id]['left_image']);
            $('#rightAnchorOrder').attr("href", orderImagePath + '/' + orders[id]['right_image']);
            // FOR IMAGE src
            $('#frontImgSrcOrder').attr("src", orderImagePath + '/' + orders[id]['front_image']);
            $('#backImgSrcOrder').attr("src", orderImagePath + '/' + orders[id]['back_image']);
            $('#leftImgSrcOrder').attr("src", orderImagePath + '/' + orders[id]['left_image']);
            $('#rightImgSrcOrder').attr("src", orderImagePath + '/' + orders[id]['right_image']);
        });
    });
</script>
</html>
@endsection