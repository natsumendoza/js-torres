<!-- orderList.blade.php -->
@extends('layouts.layout')

@section('content')
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
            <th style="text-align: center">Ordered By</th>
            <th style="text-align: center">Order Images</th>
            <th style="text-align: center">Type of Fabric</th>
            <th style="text-align: center">Type of Print</th>
            <th style="text-align: center">Type of Order</th>
            <th style="text-align: center">Size</th>
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
                <td style="text-align: center;">{{"[".$order['user_id']."] " . $order['first_name'] . " " . $order['last_name']}} </td>
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
                <td style="text-align: center;">
                    <a class="viewSizeModal" id="{{$order['id']}}" data-toggle="modal" data-target="#orderSizeModal">
                        {{explode(',', $order['description'])[0]}}
                    </a>
                </td>
                <td style="text-align: center;">{{$order['quantity']}}</td>
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
                <td style="text-align: center;" colspan="11">
                    There is no order
                </td>
            </tr>
        @endif
        <tr>
            <td style="text-align: right;" colspan="11">
                <a href="{{url('')}}" class="btn btn-default">Close</a>
            </td>
        </tr>
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

        $('.viewSizeModal').on('click', function (e) {
            var id = e.target.id;
            var sizes = (orders[id]['description']).split(',');

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