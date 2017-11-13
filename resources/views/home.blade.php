@extends('layouts.layout2')

@section('content')
<div class="container" style="min-height: 500px;">
    <div class="row">
        <div class="col-md-12 text-center">
            {{--<div class="panel panel-default">--}}
                {{--<div class="panel-heading">Dashboard</div>--}}

                {{--<div class="panel-body">--}}
                   {{----}}
                {{--</div>--}}
            {{--</div>--}}
            <img src="{{asset('images/jst_logo.png')}}">
        </div>
    </div>
    <div class="row " style="margin-top: 40px; margin-bottom: 400px;">
        <div class="col-md-3 text-center">
        </div>
        <div class="col-md-2 text-center">
            <a style="text-decoration: none" href="#customize"><h2>Customize</h2></a>
        </div>
        <div  class="col-md-2 text-center">
            <a style="text-decoration: none" href="#about"><h2>About Us</h2></a>
        </div>
        <div class="col-md-2 text-center">
            <a style="text-decoration: none" href="#contact"><h2>Contact Us</h2></a>
        </div>
        <div class="col-md-2 text-center">
        </div>


    </div>

    <hr>
    <div id="customize" class="row" style="margin-bottom: 100px;">
        <div class="col-md-12 text-center" style="margin-top: 51px">
            <h2>Customize</h2>
        </div>
        <div class="col-md-12 text-center">
            {{--<div class="panel panel-default">--}}
            {{--<div class="panel-heading">Dashboard</div>--}}

            {{--<div class="panel-body">--}}
            {{----}}
            {{--</div>--}}
            {{--</div>--}}
            <img src="{{asset('images/jersey_background.png')}}">
        </div>
        <div class="col-md-12 text-center">
            <a href="{{url('/home')}}" class="btn btn-primary">Click here to start</a>
        </div>
    </div>
    <hr>

    <div class="row" id="about" style="margin-bottom: 500px;">
        <div class="col-md-12 text-center" style="margin-top: 51px">
            <h1>About Us</h1>
        </div>
        <div class="col-md-12 text-center">
            <h5>JS Torres Shop was established in the year 2010. It is located at San Roque Tarlac City</h5>
        </div>
    </div>
    <hr>
    <div class="row" id="contact" style="margin-bottom: 400px;">
        <div class="col-md-12 text-center" style="margin-top: 51px">
            <h1>Contact Us</h1>
        </div>
        <div class="col-md-12 text-center">
            <h5>Mobile: 09473018756</h5>
            <h5>Email: jstrs2010@gmail.com</h5>
        </div>
    </div>
    <hr>
</div>
@endsection
