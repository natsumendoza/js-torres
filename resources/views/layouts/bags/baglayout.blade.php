<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>June Sportshop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <!--[if IE]><script type="text/javascript" src="{{ env('APP_URL') == 'http://localhost' ? asset('js/excanvas.js') : secure_asset('js/excanvas.js')}}"></script><![endif]-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script type="text/javascript" src="{{ env('APP_URL') == 'http://localhost' ? asset('js/fabric.js') : secure_asset('js/fabric.js') }}"></script>

    <script type="text/javascript" src="{{ env('APP_URL') == 'http://localhost' ? asset('js/jquery.miniColors.min.js') : secure_asset('js/jquery.miniColors.min.js') }}"></script>
    <!-- Le styles -->
    <link type="text/css" rel="stylesheet" href="{{ env('APP_URL') == 'http://localhost' ? asset('css/jquery.miniColors.css') : secure_asset('css/jquery.miniColors.css') }}" />
    <link href="{{ env('APP_URL') == 'http://localhost' ? asset('css/bootstrap.min.css') : secure_asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ env('APP_URL') == 'http://localhost' ? asset('css/bootstrap-responsive.min.css') : secure_asset('css/bootstrap-responsive.min.css') }}" rel="stylesheet">

    <script type="text/javascript">
    </script>
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
            <a class="brand" href="{{ url('/') }}">June Sportshop</a>
            <div class="nav-collapse" id="main-menu">
                <ul class="nav" id="main-menu-left">
                    <li><a href="{{ url('/cutomize') }}">Jerseys</a></li>
                    <li><a href="{{ url('/bags') }}">Bags</a></li>
                </ul>
            </div>
            
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


                                <li><a href="{{(url('/cart/'.\base64_encode(Session::get('transactionCode')))) }}"><i class="icon-shopping-cart icon-white"></i>({{$cartSize}})</a></li>
                            @endif


                            <li class="dropdown">
                                {{--{{ Auth::user()->name }}--}}
                                <a href="javascript:;" data-toggle="dropdown" class="dropdown-toggle">{{ Auth::user()->isAdmin() ? "Admin" : Auth::user()->first_name }} <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    @if(Auth::user()->isAdmin())
                                        <li><a href="{{ url('/products') }}">Products</a></li>
                                        <li><a href="{{ url('/orders') }}">Order List</a></li>
                                    @else
                                        <li><a href="{{url('/orders/'.Auth::user()->id)}}">Track my order</a></li>
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
<footer class="footer">
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

    var getShirtId = function(fileName) {
        var start = fileName.lastIndexOf('/') + 1;
        var end = fileName.substr(start).indexOf('_');
        return fileName.substr(start, end);
    };

    // DATA PASSED FROM PHP
    var productData = <?php echo json_encode(@$productData) ?>;
    //console.log(productData);


    var drawProductPriceRow = function (productName, productPrice) {
        $('#priceTable').empty();
        $('#priceTable').prepend(
            "<tr>\n" +
            "<td id='productName'>"+productName+"</td>\n" +
            "<td align=\"right\">&#8369;<span id='basePrice'>"+productPrice+"</span></td>\n" +
            "</tr>"
        );
    }

    $(document).ready(function() {
        var totalPrice = 0;
        var basePrice = 0;
        var quantity = 1;

        $('.logoList').hide();
        $('#addToCart').attr('disabled', 'disabled');
        $('#colorList').hide();


        $('.img-tshirt').on('click', function() {
            $('#quantity').val(1);
            $("#imageeditor").css('display', 'block');
            $("#selectItem").css('display', 'none');

            var tempId = getShirtId($('.img-tshirt').attr('src'));
            console.log('tempId: ' + tempId);

            var total = parseFloat($('#totalPrice').val())
            if($('#tshirtFacing').attr('src') === '') {
                $('#tshirtFacing').attr('src', $(this).attr('src'));

                $('.logoList').show();
                $('#addToCart').prop('disabled', false);
                $('#colorList').show();
                $('#tshirtFacing').hide();

                var fileName = $('#tshirtFacing').attr('src');
                var productId = getShirtId(fileName);
                var product = productData[productId];
                console.log('productId: ' + productId);
                drawProductPriceRow(product.product_name, product.base_price);
                basePrice = parseFloat(product.base_price);
            } else {
                $('#tshirtFacing').attr('src', $(this).attr('src'));
                var fileName = $('#tshirtFacing').attr('src');
                var productId = getShirtId(fileName);
                var product = productData[productId];

                if(tempId !== productId) {
                    drawProductPriceRow(product.product_name, product.base_price);
                    basePrice = parseFloat(product.base_price);
                } else {
                    drawProductPriceRow(product.product_name, product.base_price);
                    $('#productName').text(product.product_name);
                    $('#basePrice').text(product.base_price);
                    basePrice = parseFloat(product.base_price);
                }


            }


//            quantity = parseFloat($('#quantity').val());
//            totalPrice = total + (basePrice * quantity);
            $('#totalPrice').val(basePrice.toFixed(2));
        });

        $('#quantity').change(function() {
            var total = parseFloat($('#totalPrice').val());
            quantity = parseFloat($(this).val());
            totalPrice = (basePrice * quantity);
            $('#totalPrice').val(totalPrice.toFixed(2));
        });

    });

</script>

<script type="text/javascript" src="{{ env('APP_URL') == 'http://localhost' ? asset('js/bagEditor.js') : secure_asset('js/bagEditor.js') }}"></script>

</body>
</html>