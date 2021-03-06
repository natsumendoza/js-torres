<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>JS Torres Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href="{{ env('APP_ENV') == 'local' ? asset('css/app.css') : secure_asset('css/app.css') }}" rel="stylesheet">
    <!-- Le styles -->
{{--    <link type="text/css" rel="stylesheet" href="{{asset('css/jquery.miniColors.css')}}" />--}}
    <link href="{{ env('APP_ENV') == 'local' ? asset('css/bootstrap-rev.min.css') : secure_asset('css/bootstrap-rev.min.css') }}" rel="stylesheet">
{{--    <link href="{{asset('css/bootstrap-responsive.min.css')}}" rel="stylesheet">--}}

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

        @media (min-width: 1200px){
            .container {
                width: 1170px !important;
            }
        }

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
            <a class="brand" href="{{url('/')}}">JS Torres Shop</a>


        </div>
    </div>
</div>

@yield('content')
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<!-- Footer ================================================== -->
<footer class="footer">
    <div class="container">
        <p class="pull-right"><a href="#">Back to top</a></p>
    </div>
</footer>
<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

<script src="{{ env('APP_ENV') == 'local' ? asset('js/bootstrap.min.js') : secure_asset('js/bootstrap.min.js')}}"></script>
<script src="{{ env('APP_ENV') == 'local' ? asset('js/jstorres.js') : secure_asset('js/jstorres.js')}}"></script>
<script src="{{ env('APP_ENV') == 'local' ? asset('js/jstorresProduct.js') : secure_asset('js/jstorresProduct.js')}}"></script>


</body>
</html>