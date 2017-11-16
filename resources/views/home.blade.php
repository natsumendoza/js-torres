@extends('layouts.layout3')

@section('content')
<div class="container" style="min-height: 500px; width: 100%;">
    <div class="row">
        <div class="col-md-12 text-center" style="text-align: center">
            {{--<div class="panel panel-default">--}}
                {{--<div class="panel-heading">Dashboard</div>--}}

                {{--<div class="panel-body">--}}
                   {{----}}
                {{--</div>--}}
            {{--</div>--}}
            <img src="{{asset('images/jstlogo.PNG')}}">
        </div>
    </div>
    <div class="row" style=" text-align: center;">

        <div class="col-md-2 text-center dropdown2" style="margin-right: 20px;">
            <a style="text-decoration: none" href="{{url('/')}}"><h3 style=" color: #000000;">Home</h3></a>

        </div>
        <div class="col-md-2 text-center dropdown2" style="margin-right: 20px;">
            <a style="text-decoration: none" href="{{url('/customize')}}"><h3 style=" color: #000000;">Customize</h3></a>

        </div>
        <div  class="col-md-2 text-center dropdown2" style="margin-right: 20px;">
            <h3 id="faqs-link" style="cursor: pointer; color: #000000;">FAQs</h3>
        </div>
        <div  class="col-md-2 text-center dropdown2" style="margin-right: 20px;">
            <h3 id="contact-link" style="cursor: pointer; color: #000000;">Contact Us</h3>
        </div>
        <div class="col-md-2 text-center dropdown2">
            <h3 class="" id="payment-link" style="cursor: pointer;  color: #000000;">Payment Instructions</h3>
        </div>
        <div class="col-md-2 text-center">
        </div>

    </div>
    <div class="row2 bg-row" style="background-color: #f3f7e5; height: 859px; margin: 0px; text-align: center; width: 100%">
            <div style="width: 50%; margin: 0 auto;">
                @foreach($productList as $product)
                    <div class="col2-md-3" style="margin-top: 10px">
                        <img height="100" width="150" style="cursor:pointer;" class="img-tshirt" src="{{URL::asset('/finishedproducts/'.$product['image'])}}">
                        <button type="submit" class="btn  btn-success" name="addToCart" id="addToCart">Buy <i class="icon-shopping-cart icon-white"></i></button>
                    </div>
                @endforeach
            </div>
    </div>
    <div class="row contact-row" style="height: 420px; background-color: #f3f7e5;">
        <div class="col-md-12" style="text-align: center; margin-top: 4%;">
            <h3 class="" style="color: #45aeea; line-height: 35px;">Location: <span class="h2-mod">San Roque Tarlac City</span></h3>
            <h3 style="color: #45aeea; line-height: 35px;">Email: <span class="h2-mod">jstrs2010@gmail.com</span></h3>
            <h3 style="color: #45aeea; line-height: 35px;">Mobile: <span class="h2-mod">09473018756</span></h3>
        </div>
    </div>
    <div class="row payment-row" style="height: 420px; background-color: #f3f7e5;">
        <div class="col-md-12" style="text-align: center; margin-top: 4%;">
            <h2 class="h2-mod" style="line-height: 35px;">Payment Method</h2>
            <h3 style="color: #45aeea; line-height: 35px;">BDO: <span class="h2-mod">12345678</span></h3>
            <p>Send the Reference and Control numbers to the business contact number or email, including your name and amount sent.</p>
        </div>
    </div>
</div>
@endsection
