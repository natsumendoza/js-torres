<!-- orderListByTransactionCode.blade.php -->
@extends('layouts.layout')

@section('content')

@php
    $transactionCode = "";
    if(isset($cartItems) and !empty($cartItems))
    {
        $transactionCode = $cartItems[0]['transaction_code'];
    }
    $totalPrice = 0.00;

@endphp
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

    <div class="container">
        <!-- Modal -->
        <div class="modal fade" id="paymentModal" role="dialog">
            <div class="modal-dialog modal-sm">

                <!-- Modal content-->
                <form action="{{action('OrderController@updateByTransactionCode', $transactionCode)}}" method="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Choose mode of payment: </h4>
                    </div>
                    <table width="95%">
                        <tr>
                            <td colspan="3">&nbsp;<!-- spacer --></td>
                        </tr>
                        <tr>
                            <td width="20px;">&nbsp;</td>
                            <td>
                                <label><input type="radio" name="payment_mode" value="COD" checked><span style="font-size: 20px;"><b>Cash on delivery</b></span></label>
                            </td>
                            <td>
                                <label><input type="radio" name="payment_mode" value="BDO"><img src="{{URL::asset('/img/bdo_logo.png')}}" height="70" width="70"></label>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">&nbsp;<!-- spacer --></td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align: right">
                            {{ csrf_field() }}
                            <input name="_method" type="hidden" value="PATCH">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button class="btn btn-success" type="submit">Checkout</button>
                            </td>
                        </tr>
                    </table>
                </div>
                </form>
            </div>
        </div>

    </div>

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
                <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#paymentModal">Proceed to checkout</button>
            </td>
            <td style="text-align: right;" colspan="4">
                <form action="{{action('OrderController@destroyByTransactionCode', $transactionCode)}}" method="POST">
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