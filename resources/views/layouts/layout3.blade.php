<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>JS Torres Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!--[if IE]><script type="text/javascript" src="{{ env('APP_ENV') == 'local' ? asset('js/excanvas.js') : secure_asset('js/excanvas.js')}}"></script><![endif]-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script type="text/javascript" src="{{ env('APP_ENV') == 'local' ? asset('js/fabric.js') : secure_asset('js/fabric.js') }}"></script>

    <script type="text/javascript" src="{{ env('APP_ENV') == 'local' ? asset('js/jquery.miniColors.min.js') : secure_asset('js/jquery.miniColors.min.js') }}"></script>
    <!-- Le styles -->
    <link type="text/css" rel="stylesheet" href="{{ env('APP_ENV') == 'local' ? asset('css/jquery.miniColors.css') : secure_asset('css/jquery.miniColors.css') }}" />
    <link href="{{ env('APP_ENV') == 'local' ? asset('css/bootstrap.min.css') : secure_asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ env('APP_ENV') == 'local' ? asset('css/bootstrap-responsive.min.css') : secure_asset('css/bootstrap-responsive.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <style type="text/css">
        .footer {
            padding: 70px 0;
            margin-top: 70px;
            border-top: 1px solid #E5E5E5;
            background-color: whiteSmoke;
        }
        body {
            padding-top: 60px;

        }
        .color-preview {
            border: 1px solid #CCC;
            margin: 2px;
            zoom: 1;
            vertical-align: top;
            display: inline-block;
            cursor: pointer;
            overflow: hidden;
            width: 20px;
            height: 20px;
        }
        .rotate {
            -webkit-transform:rotate(90deg);
            -moz-transform:rotate(90deg);
            -o-transform:rotate(90deg);
            /* filter:progid:DXImageTransform.Microsoft.BasicImage(rotation=1.5); */
            -ms-transform:rotate(90deg);
        }
        .Arial{font-family:"Arial";}
        .Helvetica{font-family:"Helvetica";}
        .MyriadPro{font-family:"Myriad Pro";}
        .Delicious{font-family:"Delicious";}
        .Verdana{font-family:"Verdana";}
        .Georgia{font-family:"Georgia";}
        .Courier{font-family:"Courier";}
        .ComicSansMS{font-family:"Comic Sans MS";}
        .Impact{font-family:"Impact";}
        .Monaco{font-family:"Monaco";}
        .Optima{font-family:"Optima";}
        .HoeflerText{font-family:"Hoefler Text";}
        .Plaster{font-family:"Plaster";}
        .Engagement{font-family:"Engagement";}

        .dropdown2 {
            position: relative;
            display: inline-block;
        }

        .dropdown-content2 {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 200px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            padding: 12px 16px;
            z-index: 1;
        }

        .dropdown2:hover .dropdown-content2 {
            display: block;
        }

        @media only screen and (max-width: 768px) {
            /* For mobile phones: */
            .dropdown2 {
                display:block;
            }
            body {
                padding-top: 0px;

            }

        }

        .link-active {
            color: #45aeea !important;
        }

        /*.dropdown-submenu, .dropdown-menu {*/
            /*top: 0;*/
            /*left: 100%;*/
            /*margin-top: -1px;*/
        /*}*/
        .dropdown-submenu {
            position: relative;
        }


    </style>
</head>

<body class="preview" data-spy="scroll" data-target=".subnav" data-offset="80">

<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
            <a class="brand" href="{{ url('/') }}">JS Torres Shop</a>
            {{--<div class="nav-collapse" id="main-menu">--}}
                {{--<ul class="nav" id="main-menu-left">--}}
                    {{--<li><a href="{{ url('') }}">Jerseys</a></li>--}}
                    {{--<li><a href="{{ url('/bags') }}">Bags</a></li>--}}
                {{--</ul>--}}
            {{--</div>--}}

            <div class="nav-collapse" id="main-menu">
                <ul class="nav navbar-nav navbar-right" style="float:right">

                    @guest
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            @if(!Auth::user()->isAdmin())
                                @php($cartSize = 0)
                                @if (\Session::has('cartSize'))
                                    @php($cartSize = \Session::get('cartSize'))
                                @endif
                                <li><a href="{{ url('/cart/'.\base64_encode(Session::get('transactionCode'))) }}"><i class="icon-shopping-cart icon-white"></i>@if($cartSize>0)<span class="w3-badge w3-red">{{$cartSize}}</span>@endif</a></li>

                                @php($unreadMessages = 0)
                                @if (\Session::has('unreadMessages'))
                                    @php($unreadMessages = \Session::get('unreadMessages'))
                                @endif
                                <li><a href="{{ url('/chat/client') }}"><i class="icon-comment icon-white"></i>@if($unreadMessages>0)<span class="w3-badge w3-red">{{$unreadMessages}}</span>@endif</a></li>
                            @endif

                            @if(Auth::user()->isAdmin())
                                @php($unreadMessages = 0)
                                @if (\Session::has('unreadMessages'))
                                    @php($unreadMessages = \Session::get('unreadMessages'))
                                @endif
                                <li><a href="{{ url('/chat')}}"><i class="icon-comment icon-white"></i>@if($unreadMessages>0)<span class="w3-badge w3-red">{{$unreadMessages}}</span>@endif</a></li>

                            @endif

                            <li class="dropdown">
                                {{--{{ Auth::user()->name }}--}}
                                <a href="javascript:;" data-toggle="dropdown" class="dropdown-toggle">{{ Auth::user()->isAdmin() ? "Admin" : Auth::user()->first_name }} <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    @if(Auth::user()->isAdmin())
                                        <li><a href="{{ url('/products') }}">Products</a></li>
                                        <li><a href="{{ url('/finishedproduct') }}">Sample Products</a></li>
                                        <li><a href="{{ url('/orders') }}">Orders</a></li>
                                        <li><a href="{{ url('/users') }}">Users</a></li>
                                        <li><a href="{{ url('/reports') }}">Sales Report</a></li>
                                    @else
                                        <li><a href="{{url('/orders/'.base64_encode(Auth::user()->id))}}">Track my order</a></li>
                                        <li><a href="{{ url('/user') }}">My Profile</a></li>
                                    @endif
                                    <li>
                                        <a href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                            @endguest

                </ul>
            </div>
        </div>
    </div>
</div>

@yield('content')

<!-- Footer ================================================== -->
<footer class="footer" style="margin-top: 0px !important;">
    <div class="container">
        <p class="pull-right"><a href="#">Back to top</a></p>
    </div>
</footer>
<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<!-- Scripts -->
<script src="{{ env('APP_URL') == 'http://localhost' ? asset('js/bootstrap.min.js') : secure_asset('js/bootstrap.min.js')}}"></script>
<script src="{{ env('APP_URL') == 'http://localhost' ? asset('js/canvas2image.js') : secure_asset('js/canvas2image.js')}}"></script>
<script type="text/javascript">

    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-35639689-1']);
    _gaq.push(['_trackPageview']);

    (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();

    $(document).ready(function () {
        $('.contact-row').hide();
        $('.payment-row').hide();
        $('.product-row').hide();
        $('#home-link').addClass('link-active');

        $('#home-link').click(function () {
            $('#ad-link').removeClass('link-active');
            $('#payment-link').removeClass('link-active');
            $(this).addClass('link-active');
            $('.bg-row').show();
            $('.contact-row').hide();
            $('.payment-row').hide();
            $('.product-row').hide();
        });

        $('#ad-link').click(function () {
            $('#home-link').removeClass('link-active');
            $('#payment-link').removeClass('link-active');
            $(this).addClass('link-active');
            $('.bg-row').hide();
            $('.contact-row').hide();
            $('.payment-row').hide();
            $('.product-row').show();
        });

        $('#contact-link').click(function () {
            $('#home-link').removeClass('link-active');
            $('#payment-link').removeClass('link-active');
            $('#ad-link').removeClass('link-active');
            $(this).addClass('link-active');
            $('.bg-row').hide();
            $('.contact-row').show();
            $('.payment-row').hide();
            $('.product-row').hide();
        });
        $('#payment-link').click(function () {
            $('#home-link').removeClass('link-active');
            $('#contact-link').removeClass('link-active');
            $(this).addClass('link-active');
            $('.bg-row').hide();
            $('.contact-row').hide();
            $('.payment-row').show();
            $('.product-row').hide();
        });
    });

</script>
<script type="text/javascript" src="{{ env('APP_ENV') == 'local' ? asset('js/jstorres.js') : secure_asset('js/jstorres.js') }}"></script>

</body>
</html>