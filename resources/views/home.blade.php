@extends('layouts.layout3')

@section('content')
<div class="container" style="min-height: 500px;">
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
    <div class="row " style="margin-top: 40px; margin-bottom: 400px; text-align: center">
        <div class="col-md-3 text-center">
        </div>
        <div class="col-md-2 text-center dropdown2" style="margin-right: 20px;">
            <a style="text-decoration: none" href="{{url('/home')}}"><h2>Customize</h2></a>
            <div class="dropdown-content2">
                <p>Click here to continue</p>
            </div>

        </div>
        <div  class="col-md-2 text-center dropdown2" style="margin-right: 20px;">
            <h2>About Us</h2>
            <div class="dropdown-content2">
                <p>JS Torres Shop was established in the year 2010. It is located at San Roque Tarlac City</p>
            </div>
        </div>
        <div class="col-md-2 text-center dropdown2">
            <h2>Contact Us</h2>
            <div class="dropdown-content2">
                <p>Mobile:</p>
                <p>09473018756</p>
                <p>Email:</p>
                <p>jstrs2010@gmail.com</p>
            </div>
        </div>
        <div class="col-md-2 text-center">
        </div>


    </div>
</div>
@endsection
