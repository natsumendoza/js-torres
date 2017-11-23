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
        .neck-color-preview {
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
            <a class="brand" href="{{ url('/') }}">JS Torres Shop</a>
            <div class="nav-collapse" id="main-menu">
                <ul class="nav" id="main-menu-left">
                    <li><a href="{{ url('/customize') }}">Jerseys</a></li>
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


                                <li><a href="{{ url('/cart/'.\base64_encode(Session::get('transactionCode'))) }}"><i class="icon-shopping-cart icon-white"></i>({{$cartSize}})</a></li>
                            @endif


                            <li class="dropdown">
                                <input type="hidden" id="neckstylepath" value="{{URL::asset('/')}}" />
                                {{--{{ Auth::user()->name }}--}}
                                <a href="javascript:;" data-toggle="dropdown" class="dropdown-toggle">{{ Auth::user()->isAdmin() ? "Admin" : Auth::user()->first_name }} <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    @if(Auth::user()->isAdmin())
                                        <li><a href="{{ url('/products') }}">Products</a></li>
                                        <li><a href="{{ url('/finishedproduct') }}">Finished Products</a></li>
                                        <li><a href="{{ url('/orders') }}">Orders</a></li>
                                        <li><a href="{{ url('/users') }}">Users</a></li>
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
    var productDataBasketballMale = <?php echo json_encode(@$productDataBasketballMale) ?>;
    var productDataSoccerMale = <?php echo json_encode(@$productDataSoccerMale) ?>;
    var productDataBasketballFemale = <?php echo json_encode(@$productDataBasketballFemale) ?>;
    var productDataSoccerFemale = <?php echo json_encode(@$productDataSoccerFemale) ?>;


    var drawProductPriceRow = function (productName) {
        $('#priceTable').empty();
        $('#priceTable').prepend(
            "<tr>\n" +
            "<td id='productName'>"+productName+"</td>\n" +
            "<td align=\"right\">&#8369;<span id='basePrice'>0.00</span></td>\n" +
            "</tr>"
        );
    }

    function changeType(jersey, gender) {
        $('.' + jersey + '-' + gender).show();
    }

    function hideAllTypes() {
        $('.basketball-male').hide();
        $('.soccer-male').hide();
        $('.basketball-female').hide();
        $('.soccer-female').hide();
    }


    $(document).ready(function() {
        var totalPrice = 0;
        var basePrice = 0;
        var quantity = 1;

        var currentProductObj;

        $('.fabricType').attr('disabled', 'disabled');
        $('#printType').attr('disabled', 'disabled');

        $('.logoList').hide();
        $('#addToCart').attr('disabled', 'disabled');
        $('#colorList').hide();

        var jerseyType = $('#jersey-type').val();
        var genderType = $('#gender-type').val();

        changeType(jerseyType, genderType);
        var price;

        $('input[name=printType]').change(function () {
            price = atob($(this).attr('class'));
            $('#totalPrice').val(price * quantity);
        });

        $('#jersey-type').change(function () {
            hideAllTypes();
            $('#tshirtFacing').hide();
            $('#lining-label').hide();
            $('.neck-colors').hide();
            $('#neck-styles').hide();
            $('#addToCart').prop('disabled', true);
            $('#colorList').hide();
            jerseyType = $(this).val();
            changeType(jerseyType, genderType);
        });
        $('#gender-type').change(function () {
            hideAllTypes();
            $('#tshirtFacing').hide();
            $('#lining-label').hide();
            $('.neck-colors').hide();
            $('#neck-styles').hide();
            $('#colorList').hide();
            $('#addToCart').prop('disabled', true);
            genderType = $(this).val();
            changeType(jerseyType, genderType);
        });
        
        $('#round-neck').on('click', function() {
            $('#lining-label').show();
            $('.neck-colors').show();
            $("#selectItem").css('display', 'none');
            $('#tshirtFacing').attr('src', '{{asset('productimages')}}/' + currentProductObj.white_round_neck_image);
            $('#tshirtFacingBackNeck').attr('src', '{{asset('productimages')}}/' + currentProductObj.white_back_image);
            $('#tshirtFacingLeftNeck').attr('src', '{{asset('productimages')}}/' + currentProductObj.white_left_image);
            $('#tshirtFacingRightNeck').attr('src', '{{asset('productimages')}}/' + currentProductObj.white_right_image);

            $('#tshirtFacing').hide();
        });
        $('#v-neck').on('click', function() {
            $('#lining-label').show();
            $('.neck-colors').show();
            $("#selectItem").css('display', 'none');
            $('#tshirtFacing').attr('src', '{{asset('productimages')}}/' + currentProductObj.white_v_neck_image);
            $('#tshirtFacingBackNeck').attr('src', '{{asset('productimages')}}/' + currentProductObj.white_back_image);
            $('#tshirtFacingLeftNeck').attr('src', '{{asset('productimages')}}/' + currentProductObj.white_left_image);
            $('#tshirtFacingRightNeck').attr('src', '{{asset('productimages')}}/' + currentProductObj.white_right_image);
            $('#tshirtFacing').hide();
        });

        $('.img-tshirt').on('click', function() {
            $('#neck-styles').show();
            $('#quantity').val(1);
            $("#imageeditor").css('display', 'block');
            $("#selectItem").css('display', 'none');

            $('.fabricType').prop('disabled', false);
            $('#printType').attr('disabled', false);

            var productData;

            if($('.basketball-male').is(':visible')) {
                productData = productDataBasketballMale;
            } else if($('.soccer-male').is(':visible')) {
                productData = productDataSoccerMale;
            } else if($('.basketball-female').is(':visible')) {
                productData = productDataBasketballFemale;
            } else if($('.soccer-female').is(':visible')) {
                productData = productDataSoccerFemale;
            }

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
                currentProductObj = product;
                console.log(product);
                console.log('productId: ' + productId);
                drawProductPriceRow(product.product_name);
            } else {
                $('#colorList').show();
                $('.logoList').show();
                $('#addToCart').prop('disabled', false);
                $('#tshirtFacing').attr('src', $(this).attr('src'));
                var fileName = $('#tshirtFacing').attr('src');
                var productId = getShirtId(fileName);
                var product = productData[productId];

                if(tempId !== productId) {
                    $('.neck-colors').hide();
                    $('#lining-label').hide();
                    drawProductPriceRow(product.product_name);
                } else {
                    $('.neck-colors').hide();
                    $('#lining-label').hide();
                    drawProductPriceRow(product.product_name);
                    $('#productName').text(product.product_name);
                }


            }


//            quantity = parseFloat($('#quantity').val());
//            totalPrice = total + (basePrice * quantity);
            $('#totalPrice').val(basePrice.toFixed(2));
        });

        $('#quantity').change(function() {
            var total = parseFloat($('#totalPrice').val());
            quantity = parseFloat($(this).val());
            totalPrice = (price * quantity);
            $('#totalPrice').val(totalPrice.toFixed(2));
        });

    });

</script>
<script type="text/javascript" src="{{ env('APP_ENV') == 'local' ? asset('js/tshirtEditor.js') : secure_asset('js/tshirtEditor.js') }}"></script>

</body>
</html>