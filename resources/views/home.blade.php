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
        <div class="col-md-3 text-center">
        </div>
        <div class="col-md-2 text-center dropdown2" style="margin-right: 20px;">
            <h2 style=" color: #000000;">Customize</h2>
            <div class="dropdown-content2">

                <a style="text-decoration: none" href="{{url('/customize')}}"><p class="">Click here to continue</p></a>
            </div>

        </div>
        <div  class="col-md-2 text-center dropdown2" style="margin-right: 20px;">
            <h2 id="contact-link" style="cursor: pointer; color: #000000;">Contact Us</h2>
        </div>
        <div class="col-md-2 text-center dropdown2">
            <h2 class="" id="payment-link" style="cursor: pointer;  color: #000000;">Payment Instructions</h2>
        </div>
        <div class="col-md-2 text-center">
        </div>

    </div>
    <div class="row bg-row" style="background-image: url(../images/jersey_torres.png);
            background-repeat: no-repeat;
            background-size: 1349px 859px; height: 859px; margin: 0px;">

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
