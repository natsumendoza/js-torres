@extends('layouts.layout')

<!-- Navbar
  ================================================== -->
@section('content')
<div class="container">
    <section id="typography">
        <div class="page-header">
            <h1>Customize Jersey</h1>
        </div>

        <!-- Headings & Paragraph Copy -->
        <div class="row">
            <div class="span3">

                <div class="tabbable"> <!-- Only required for left/right tabs -->
                    <ul class="nav nav-tabs">
                        @if ($message = Session::get('success'))
                            <li><a href="#tab1" data-toggle="tab">Jersey</a></li>
                            <li><a href="#tab2" data-toggle="tab">Design</a></li>
                            @guest
                            @else
                                <li class="active"><a href="#tab3" data-toggle="tab">Upload Logo</a></li>
                            @endguest
                        @else
                            <li class="active"><a href="#tab1" data-toggle="tab">Jersey</a></li>
                            <li><a href="#tab2" data-toggle="tab">Design</a></li>
                            @guest
                            @else
                                <li><a href="#tab3" data-toggle="tab">Upload Logo</a></li>
                             @endguest

                        @endif
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane {{$message = Session::get('success') ? "" : "active"}}" id="tab1">
                            <div class="well">
                                <!--					      	<h3>Tee Styles</h3>-->
                                <!--						      <p>-->
                                <label for="jersey-type">Jersey Type</label>
                                <select id="jersey-type">
                                    <option value="basketball">Basketball</option>
                                    <option value="soccer">Soccer</option>
                                </select>

                                <label for="gender-type">Gender</label>
                                <select id="gender-type">
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>

                                <div class="basketball-male" id="avatarlist" style="display: none;">
                                    @if(count($productDataBasketballMale) > 0)
                                        @foreach($productDataBasketballMale as $product)
                                            <img height="100" width="100" style="cursor:pointer;" class="img-tshirt" src="{{URL::asset('/productimages/'.$product['white_front_image'])}}">
                                        @endforeach
                                    @endif
                                </div>

                                <div class="soccer-male" id="avatarlist" style="display: none;">
                                    @if(count($productDataSoccerMale) > 0)
                                        @foreach($productDataSoccerMale as $product)
                                            <img height="100" width="100" style="cursor:pointer;" class="img-tshirt" src="{{URL::asset('/productimages/'.$product['white_front_image'])}}">
                                        @endforeach
                                    @endif
                                </div>

                                <div class="basketball-female" id="avatarlist" style="display: none;">
                                    @if(count($productDataBasketballFemale) > 0)
                                        @foreach($productDataBasketballFemale as $product)
                                            <img height="100" width="100" style="cursor:pointer;" class="img-tshirt" src="{{URL::asset('/productimages/'.$product['white_front_image'])}}">
                                        @endforeach
                                    @endif
                                </div>

                                <div class="soccer-female" id="avatarlist" style="display: none;">
                                    @if(count($productDataSoccerFemale) > 0)
                                        @foreach($productDataSoccerFemale as $product)
                                            <img height="100" width="100" style="cursor:pointer;" class="img-tshirt" src="{{URL::asset('/productimages/'.$product['white_front_image'])}}">
                                        @endforeach
                                    @endif
                                </div>
                                <!--						      </p>-->
                            </div>
                            <div id="neck-styles" style="display: none;" class="well">
                                <!--					      	<h3>Tee Styles</h3>-->
                                <!--						      <p>-->
                                <p style="text-align: center">Select Neck Style</p>
                                <div id="avatarlist">

                                    <img height="100" width="100" style="cursor:pointer;" class="" id="round-neck" src="{{asset('neckstyles/round_neck.png')}}">
                                    <img height="100" width="100" style="cursor:pointer;" class="" id="v-neck" src="{{asset('neckstyles/v_neck.png')}}">
                                    <img height="100" width="100" style="cursor:pointer; display: none;" class="" id="collar-neck" src="{{asset('neckstyles/collar_neck.png')}}">

                                    <p id="lining-label" style="text-align: center; display: none;">Select Lining Color</p>
                                    <ul style="text-align: center; display: none;" class="nav neck-colors">
                                        <li class="neck-color-preview" title="White" style="background-color:#ffffff;"></li>
                                        <li class="neck-color-preview" title="Red" style="background-color:#ff0000;"></li>
                                        <li class="neck-color-preview" title="Blue" style="background-color:#0000ff;"></li>
                                        <li class="neck-color-preview" title="Green" style="background-color:#00ff00;"></li>
                                    </ul>
                                </div>
                                <!--						      </p>-->
                            </div>
                            <div class="well" id="colorList">
                                <ul class="nav">
                                    <li class="color-preview" title="White" style="background-color:#ffffff;"></li>
                                    <li class="color-preview" title="Dark Heather" style="background-color:#616161;"></li>
                                    <li class="color-preview" title="Gray" style="background-color:#f0f0f0;"></li>
                                    <li class="color-preview" title="Charcoal" style="background-color:#5b5b5b;"></li>
                                    <li class="color-preview" title="Black" style="background-color:#222222;"></li>
                                    <li class="color-preview" title="Heather Orange" style="background-color:#fc8d74;"></li>
                                    <li class="color-preview" title="Heather Dark Chocolate" style="background-color:#432d26;"></li>
                                    <li class="color-preview" title="Salmon" style="background-color:#eead91;"></li>
                                    <li class="color-preview" title="Chesnut" style="background-color:#806355;"></li>
                                    <li class="color-preview" title="Dark Chocolate" style="background-color:#382d21;"></li>
                                    <li class="color-preview" title="Citrus Yellow" style="background-color:#faef93;"></li>
                                    <li class="color-preview" title="Avocado" style="background-color:#aeba5e;"></li>
                                    <li class="color-preview" title="Kiwi" style="background-color:#8aa140;"></li>
                                    <li class="color-preview" title="Irish Green" style="background-color:#1f6522;"></li>
                                    <li class="color-preview" title="Scrub Green" style="background-color:#13afa2;"></li>
                                    <li class="color-preview" title="Teal Ice" style="background-color:#b8d5d7;"></li>
                                    <li class="color-preview" title="Heather Sapphire" style="background-color:#15aeda;"></li>
                                    <li class="color-preview" title="Sky" style="background-color:#a5def8;"></li>
                                    <li class="color-preview" title="Antique Sapphire" style="background-color:#0f77c0;"></li>
                                    <li class="color-preview" title="Heather Navy" style="background-color:#3469b7;"></li>
                                    <li class="color-preview" title="Cherry Red" style="background-color:#c50404;"></li>
                                </ul>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab2">
                            <div class="well">
                                <div class="input-append">
                                    <input class="span2" id="text-string" type="text" placeholder="add text here..."><button id="add-text" class="btn" title="Add text"><i class="icon-share-alt"></i></button>
                                    <hr>
                                </div>
                                <div id="avatarlist" class="logoList">
                                    @foreach($logos as $logo)
                                        @guest
                                            @if((substr($logo['logo_name'], 0, 5)) == 'admin')
                                                <img height="100" width="100" style="cursor:pointer;" class="img-polaroid" src="{{URL::asset('/logos/'.$logo['logo_name'])}}">
                                            @endif

                                        @endguest
                                        @auth
                                                @if(((substr($logo['logo_name'], 0, 5)) == 'admin') || ((substr($logo['logo_name'], 0)) == Auth::user()->id))
                                                    <img height="100" width="100" style="cursor:pointer;" class="img-polaroid" src="{{asset('/logos/'.$logo['logo_name'])}}">
                                                @endif
                                        @endauth
                                        {{--@if(isset(Auth::user()->id))--}}
                                            {{--@if((stripos($logo['logo_name'], Auth::user()->id) >= 0) || stripos($logo['logo_name'], 'admin') >= 0)--}}
                                                    {{--<img height="100" width="100" style="cursor:pointer;" class="img-polaroid" src="{{URL::asset('/logos/'.$logo['logo_name'])}}">--}}
                                            {{--@endif--}}
                                        {{--@endif--}}
                                    @endforeach

                                </div>
                            </div>
                        </div>
                        <div class="tab-pane {{$message = Session::get('success') ? "active" : ""}}" id="tab3">
                            <div class="well" style="overflow-x: hidden;">
                                @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                @if ($message = Session::get('success'))
                                    <div class="alert alert-success">
                                        <button type="button" class="close" data-dismiss="alert">x</button>
                                        <strong>{{$message}}</strong>
                                    </div>
                                @endif

                                {!! Form::open(array('route' => 'fileUpload','enctype' => 'multipart/form-data')) !!}
                                        {!! Form::file('image', array('class' => 'image')) !!}
                                        <input type="hidden" name="logoType" value="jersey" />
                                        <button type="submit" class="btn btn-success">Save</button>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="span6">
                <div align="center" style="min-height: 32px;">
                    <div class="clearfix">
                        <div class="btn-group inline pull-left" id="texteditor" style="display:none">
                            <button id="font-family" class="btn dropdown-toggle" data-toggle="dropdown" title="Font Style"><i class="icon-font" style="width:19px;height:19px;"></i></button>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="font-family-X">
                                <li><a tabindex="-1" href="#" onclick="setFont('Arial');" class="Arial">Arial</a></li>
                                <li><a tabindex="-1" href="#" onclick="setFont('Helvetica');" class="Helvetica">Helvetica</a></li>
                                <li><a tabindex="-1" href="#" onclick="setFont('Myriad Pro');" class="MyriadPro">Myriad Pro</a></li>
                                <li><a tabindex="-1" href="#" onclick="setFont('Delicious');" class="Delicious">Delicious</a></li>
                                <li><a tabindex="-1" href="#" onclick="setFont('Verdana');" class="Verdana">Verdana</a></li>
                                <li><a tabindex="-1" href="#" onclick="setFont('Georgia');" class="Georgia">Georgia</a></li>
                                <li><a tabindex="-1" href="#" onclick="setFont('Courier');" class="Courier">Courier</a></li>
                                <li><a tabindex="-1" href="#" onclick="setFont('Comic Sans MS');" class="ComicSansMS">Comic Sans MS</a></li>
                                <li><a tabindex="-1" href="#" onclick="setFont('Impact');" class="Impact">Impact</a></li>
                                <li><a tabindex="-1" href="#" onclick="setFont('Monaco');" class="Monaco">Monaco</a></li>
                                <li><a tabindex="-1" href="#" onclick="setFont('Optima');" class="Optima">Optima</a></li>
                                <li><a tabindex="-1" href="#" onclick="setFont('Hoefler Text');" class="Hoefler Text">Hoefler Text</a></li>
                                <li><a tabindex="-1" href="#" onclick="setFont('Plaster');" class="Plaster">Plaster</a></li>
                                <li><a tabindex="-1" href="#" onclick="setFont('Engagement');" class="Engagement">Engagement</a></li>
                            </ul>
                            <button id="text-bold" class="btn" data-original-title="Bold"><img src="img/font_bold.png" height="" width=""></button>
                            <button id="text-italic" class="btn" data-original-title="Italic"><img src="img/font_italic.png" height="" width=""></button>
                            <button id="text-strike" class="btn" title="Strike" style=""><img src="img/font_strikethrough.png" height="" width=""></button>
                            <button id="text-underline" class="btn" title="Underline" style=""><img src="img/font_underline.png"></button>
                            <a class="btn" href="#" rel="tooltip" data-placement="top" data-original-title="Font Color"><input type="hidden" id="text-fontcolor" class="color-picker" size="7" value="#000000"></a>
                            <a class="btn" href="#" rel="tooltip" data-placement="top" data-original-title="Font Border Color"><input type="hidden" id="text-strokecolor" class="color-picker" size="7" value="#000000"></a>
                            <!--- Background <input type="hidden" id="text-bgcolor" class="color-picker" size="7" value="#ffffff"> --->
                        </div>
                        <div class="pull-right" align="" id="imageeditor" style="display:none">
                            <div class="btn-group">
                                <button id="flip" type="button" class="btn" title="Show Back View"><i class="icon-retweet" style="height:19px;"></i></button>
                                <button class="btn" id="bring-to-left" title="Show Left"><i class="icon-fast-backward" style="height:19px;"></i></button>
                                <button class="btn" id="bring-to-right" title="Show Right"><i class="icon-fast-forward" style="height:19px;"></i></button>
                                <button id="remove-selected" class="btn" title="Delete selected item" style="display: none;"><i class="icon-trash" style="height:19px;"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--	EDITOR      -->
                <div id="shirtDiv" class="page" style="width: 530px; height: 530px; position: relative; background-color: rgb(255, 255, 255);">
                    <div id="selectItem" style="text-align: center">
                        Please select product to start.
                    </div>
                    <input type="hidden" id="currentImageId" value="">
                    <img id="tshirtFacing" src=""/>
                    <img id="tshirtFacingBackNeck" style="display: none;" src=""/>
                    <img id="tshirtFacingLeftNeck" style="display: none;" src=""/>
                    <img id="tshirtFacingRightNeck" style="display: none;" src=""/>
                    <div class="drawing-areas" id="frontDrawingArea"  style="position: absolute;top: 40px;left: 160px;z-index: 10;width: 200px;height: 400px;">
                        <canvas id="frontCanvas" width=200 height="400" class="hover" style="-webkit-user-select: none;"></canvas>
                    </div>
                    <div class="drawing-areas" id="backDrawingArea" style="position: absolute;top: 40px;left: 160px;z-index: 10;width: 200px;height: 400px;">
                        <canvas id="backCanvas" width=200 height="400" class="hover" style="-webkit-user-select: none;"></canvas>
                    </div>
                    <div class="drawing-areas" id="leftDrawingArea" style="position: absolute;top: 40px;left: 160px;z-index: 10;width: 200px;height: 400px;">
                        <canvas id="leftCanvas" width=200 height="400" class="hover" style="-webkit-user-select: none;"></canvas>
                    </div>
                    <div class="drawing-areas" id="rightDrawingArea" style="position: absolute;top: 40px;left: 160px;z-index: 10;width: 200px;height: 400px;">
                        <canvas id="rightCanvas" width=200 height="400" class="hover" style="-webkit-user-select: none;"></canvas>
                    </div>
                    {{--<a id="frontDownload">Download front image</a>--}}
                    {{--<a id="backDownload">Download back image</a>--}}
                    {{--<a id="leftDownload">Download left image</a>--}}
                    {{--<a id="rightDownload">Download right image</a>--}}
                </div>
                <!--					<div id="shirtBack" class="page" style="width: 530px; height: 630px; position: relative; background-color: rgb(255, 255, 255); display:none;">-->
                <!--						<img src="img/crew_back.png"></img>-->
                <!--						<div id="drawingArea" style="position: absolute;top: 100px;left: 160px;z-index: 10;width: 200px;height: 400px;">					-->
                <!--							<canvas id="backCanvas" width=200 height="400" class="hover" style="-webkit-user-select: none;"></canvas>-->
                <!--						</div>-->
                <!--					</div>						-->

                <!--	/EDITOR		-->
            </div>

            @auth
                    @if(!Auth::user()->isAdmin())
                        <form method="POST" action="{{url('orders')}}">
                            {{csrf_field()}}
                            <input id="userId" type="hidden" class="hidden" name="userId" value="{{ Auth::user()->id }}">
                            <input id="orderType" type="hidden" class="hidden" name="orderType" value="jersey">
                            <input id="frontImage" type="hidden" class="hidden" name="frontImage" value="frontImage">
                            <input id="backImage" type="hidden" class="hidden" name="backImage" value="backImage">
                            <input id="leftImage" type="hidden" class="hidden" name="leftImage" value="leftImage">
                            <input id="rightImage" type="hidden" class="hidden" name="rightImage" value="rightImage">
                            <input id="description" type="hidden" class="hidden" name="description" value="description">

                            <div class="span3">
                                <div class="well">
                                    <h4>Jersey Size</h4>
                                    <label for="gender-type">Size</label>
                                    <select id="size-type" disabled>
                                        <option value="XS">XS</option>
                                        <option value="S">S</option>
                                        <option value="M">M</option>
                                        <option value="L">L</option>
                                        <option value="XL">XL</option>
                                        <option value="2XL">2XL</option>
                                        <option value="3XL">3XL</option>
                                        <option value="4XL">4XL</option>
                                        <option value="customize">Customize</option>
                                    </select>
                                    <p>
                                    <table class="table">
                                        <tr>
                                            <td>Chest</td>
                                            <td><input id="chest" value="" type="text" class="form-control sizeClass" name="chest" style="width:91px" readonly required autofocus></td>
                                        </tr>
                                        <tr>
                                            <td>Front Length</td>
                                            <td><input id="backLength" type="text" class="form-control sizeClass" name="backLength" value="" style="width:91px" required autofocus readonly></td>
                                        </tr>
                                        <tr>
                                            <td>Back Length</td>
                                            <td><input id="frontLength" type="text" class="form-control sizeClass" name="frontLength" value="" style="width:91px" required autofocus readonly></td>
                                        </tr>
                                        <tr>
                                            <td>Short Waist</td>
                                            <td><input id="shortWaist" type="text" class="form-control sizeClass" name="shortWaist" value="" style="width:91px" required autofocus readonly></td>
                                        </tr>
                                        <tr>
                                            <td>Short Length</td>
                                            <td><input id="shortLength" type="text" class="form-control sizeClass" name="shortLength" value="" style="width:91px" required autofocus readonly></td>
                                        </tr>
                                        <tr>
                                            <td>Leg Opening</td>
                                            <td><input id="legOpening" type="text" class="form-control sizeClass" name="legOpening" value="" style="width:91px" required autofocus readonly></td>
                                        </tr>
                                        <tr>
                                            <td>Corch Length</td>
                                            <td><input id="corchLength" type="text" class="form-control sizeClass" name="corchLength" value="" style="width:91px" required autofocus readonly></td>
                                        </tr>

                                    </table>
                                    </p>
                                    <button type="button" class="btn btn-large btn-block btn-success" name="saveSize" id="saveSize">Save Size</button>
                                </div>
                                <div class="well">
                                    <h4>Types of Fabrics</h4>
                                    <p>
                                    <table>
                                        <tr>
                                            <td>
                                                <label class="radio-inline">
                                                    <input type="radio" class="fabricType" value="{{base64_encode('FABRIC_MICRO_SHINY')}}" name="fabricType" checked required>{{config('constants.FABRIC_MICRO_SHINY')}}
                                                </label>
                                            </td>
                                            <td>
                                                <label class="radio-inline"  style="margin-left: 10px;">
                                                    <input type="radio" class="fabricType" value="{{base64_encode('FABRIC_MICRO_NET')}}" name="fabricType">{{config('constants.FABRIC_MICRO_NET')}}
                                                </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="radio-inline">
                                                    <input type="radio" class="fabricType" value="{{base64_encode('FABRIC_TRIFIT')}}" name="fabricType">{{config('constants.FABRIC_TRIFIT')}}
                                                </label>
                                            </td>
                                            <td>
                                                <label class="radio-inline"  style="margin-left: 10px;">
                                                    <input type="radio" class="fabricType" value="{{base64_encode('FABRIC_SEMI_COOL')}}" name="fabricType">{{config('constants.FABRIC_SEMI_COOL')}}
                                                </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="radio-inline">
                                                    <input type="radio" class="fabricType" value="{{base64_encode('FABRIC_SQUARE_KNIT')}}" name="fabricType">{{config('constants.FABRIC_SQUARE_KNIT')}}
                                                </label>
                                            </td>
                                            <td>
                                                <label class="radio-inline"  style="margin-left: 10px;">
                                                    <input type="radio" class="fabricType" value="{{base64_encode('FABRIC_SPORTS_MAX')}}" name="fabricType">{{config('constants.FABRIC_SPORTS_MAX')}}
                                                </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="radio-inline">
                                                    <input type="radio" class="fabricType" value="{{base64_encode('FABRIC_CHECKERED')}}" name="fabricType">{{config('constants.FABRIC_CHECKERED')}}
                                                </label>
                                            </td>
                                            <td>
                                                &nbsp;
                                            </td>
                                        </tr>

                                    </table>
                                    </p>
                                </div>
                                <div class="well">
                                    <h4>Types of Print</h4>
                                    <p>
                                    <table>
                                        <tr>
                                            <td>
                                                <label class="radio-inline">
                                                    <input type="radio" class="{{base64_encode(config('constants.PRINT_PRIZE_CUTOUT'))}}" id="printType" value="{{base64_encode('PRINT_CUTOUT')}}" name="printType" checked>{{config('constants.PRINT_CUTOUT')}}
                                                </label>
                                            </td>
                                            <td>
                                                <label class="radio-inline"  style="margin-left: 10px;">
                                                    <input type="radio" class="{{base64_encode(config('constants.PRINT_PRIZE_RUBBERIZED'))}}" id="printType" value="{{base64_encode('PRINT_RUBBERIZED')}}" name="printType">{{config('constants.PRINT_RUBBERIZED')}}
                                                </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="radio-inline"  style="">
                                                    <input type="radio" class="{{base64_encode(config('constants.PRINT_PRIZE_VINYL'))}}" id="printType" value="{{base64_encode('PRINT_VINYL')}}" name="printType">{{config('constants.PRINT_VINYL')}}
                                                </label>
                                            </td>
                                            <td>
                                                <label class="radio-inline"  style="margin-left: 10px;">
                                                    <input type="radio" class="{{base64_encode(config('constants.PRINT_PRIZE_SUBLIMATION'))}}" id="printType" value="{{base64_encode('PRINT_SUBLIMATION')}}" name="printType">{{config('constants.PRINT_SUBLIMATION')}}
                                                </label>
                                            </td>
                                        </tr>
                                    </table>
                                    </p>
                                </div>
                                <div class="well">
                                    <h4>Total Prices</h4>
                                    <p>
                                    <table class="table" id="priceTable">

                                        {{--<tr>--}}
                                            {{--<td>Short Sleeve</td>--}}
                                            {{--<td align="right">&#8369;12.49</td>--}}
                                        {{--</tr>--}}
                                        {{--<tr>--}}
                                            {{--<td><strong>Total</strong></td>--}}
                                            {{--<td align="right"><strong id="totalPrice">&#8369;<span id="totalPrice">0.00</span></strong></td>--}}
                                        {{--</tr>--}}


                                    </table>
                                    <table class="table">
                                        <tr>
                                            <td>Quantity</td>
                                            <td><input id="quantity" value="1" type="text" class="form-control" name="quantity" style="width:50px" required autofocus></td>
                                        </tr>
                                        <tr>
                                            <td>Total Price</td>
                                            <td><input id="totalPrice" type="number" class="form-control" name="totalPrice" value="0" style="width:58px" required autofocus readonly></td>
                                        </tr>
                                    </table>
                                    </p>
                                    <button type="submit" class="btn btn-large btn-block btn-success" name="addToCart" id="addToCart">Add to cart <i class="icon-shopping-cart icon-white"></i></button>
                                </div>
                            </div>
                        </form>
                    @endif
                    @endauth

         </div>

    </section>
</div><!-- /container -->
@endsection