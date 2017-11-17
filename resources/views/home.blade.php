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
            <h3 id="home-link" style="cursor: pointer; color: #000000;">Home</h3>

        </div>
        <div class="col-md-2 text-center dropdown2" style="margin-right: 20px;">
            <h3 id="ad-link" style="cursor: pointer; color: #000000;">Advertisements</h3>

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
    {{--height: 859px;--}}
    <div class="row2 bg-row" style="background-color: #f3f7e5; margin: 0px; min-height: 400px;  text-align: center; background-size: 100% 859px; height: 859px;background-repeat: no-repeat; background-image: url(../images/team_torres.jpg);
 +
 +            ;">

    </div>
    <div class="row2 product-row" style="background-color: #f3f7e5; min-height: 400px; margin: 0px; text-align: center; width: 100%">
            <div style="width: 50%; margin: 0 auto; margin-top: 4%;">
                <h3 class="h2-mod" style="">Finished Products</h3>
                @foreach($productList as $product)
                    <form style="margin: 0px;" method="POST" action="{{url('orders')}}">
                        {{csrf_field()}}
                        <input id="userId" type="hidden" class="hidden" name="userId" value="{{ @Auth::user()->id }}">
                        <input id="orderType" type="hidden" class="hidden" name="orderType" value="jersey">
                        <input id="orderType" type="hidden" class="hidden" name="quantity" value="1">
                        <input id="orderType" type="hidden" class="hidden" name="totalPrice" value="{{$product['price']}}">


                        <div class="col2-md-2" style="margin-top: 10px;">
                            <img height="100" width="150" style="cursor:pointer;" class="img-tshirt" src="{{URL::asset('/finishedproducts/'.$product['image'])}}">
                            @auth
                                <button type="submit" class="btn  btn-success" name="addToCart" id="addToCart">Buy <i class="icon-shopping-cart icon-white"></i></button>
                            @endauth
                        </div>

                    </form>
                @endforeach
            </div>
        <div class="clearfix" style="margin-bottom: 4%;"></div>
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
            <h3 class="h2-mod" style="line-height: 35px;">Payment Method</h3>
            <h3 style="color: #45aeea; line-height: 35px;">Our bdo account number will be sent to you privately through email once we've received your order.</h3>
            <p>Send the Reference and Control numbers to the business contact number or email, including your name and amount sent.</p>
        </div>
    </div>
    <div class="row faq-row" style="height: 100%; background-color: #f3f7e5;">
        <div class="col-md-12" style="text-align: center; margin-top: 4%;">
            <div style="width: 50%; margin: 0 auto;">
                <h3 class="h2-mod" style="line-height: 35px;">FAQs</h3>
                <h3 style="color: #45aeea; line-height: 35px;text-align: left; ">1. There are no email verification in my email account, what should I do?
                </h3>
                <p>Answer: Be sure you registered the correct email address, refresh the page stating an email verification was sent to your email. Also try refreshing your email inbox and try to check your spam folder. I you still haven’t found the verification email you are welcome to register another account.
                </p>

                <h3 style="color: #45aeea; line-height: 35px; text-align: left;">2. How can I pay my order?
                </h3>
                <p>Answer: There is the "Payment Instructions" button. Once clicked, it will display the payment methods and instructions. Beside from what is displayed, gong directly to the tailoring shop is always an option.
                </p>

                <h3 style="color: #45aeea; line-height: 35px; text-align: left;">3. How can I keep track on my order?
                </h3>
                <p>Answer: The website enables you as the client to see your order is paid, ready to shipped or delivered. In order to see so, click the Track my order at the upper right of the client home page. Another way is to directly ask the store, the contact info and address of the store is available or no.
                </p>

                <h3 style="color: #45aeea; line-height: 35px; text-align: left;">4. I want to change my account info, how would is that?
                </h3>
                <p>Answer: After logging in, Account setting link is present, click the link and you may update your account info.
                </p>

                <h3 style="color: #45aeea; line-height: 35px; text-align: left;">5. Can I still register another account?

                </h3>
                <p>Answer: Yes, you may register countless accounts, but take note that orders by an account can be monitored by the admin. If your account doesn’t contain any ordering activity over a given of period time , the admin can delete that account. </p>
            </div>

        </div>
    </div>
</div>
@endsection
