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
            <th style="text-align: center">Images</th>
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
                    <a class="viewImage" id="{{$order['id']}}" data-toggle="modal" data-target="#orderImageModal">View Images</a>
                </td>
                <td style="text-align: center;">{{$order['quantity']}}</td>
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
<script>
    $(document).ready(function() {
        var orders = <?php echo json_encode(@$orderList); ?>;
        var orderImagePath = <?php echo json_encode(URL::asset('/orderimages/')); ?>;

        $('.viewImage').on('click',function (e) {
            var id = e.target.id;

            // FOR ANCHOR <a> TAG
            $('#frontAnchor').attr("href", orderImagePath + '/' + orders[id]['front_image']);
            $('#backAnchor').attr("href", orderImagePath + '/' + orders[id]['back_image']);
            $('#leftAnchor').attr("href", orderImagePath + '/' + orders[id]['left_image']);
            $('#rightAnchor').attr("href", orderImagePath + '/' + orders[id]['right_image']);

            // FOR IMAGE src
            $('#frontImgSrc').attr("src", orderImagePath + '/' + orders[id]['front_image']);
            $('#backImgSrc').attr("src", orderImagePath + '/' + orders[id]['back_image']);
            $('#leftImgSrc').attr("src", orderImagePath + '/' + orders[id]['left_image']);
            $('#rightImgSrc').attr("src", orderImagePath + '/' + orders[id]['right_image']);
        });

    });
</script>
</html>
@endsection