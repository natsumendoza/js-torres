@extends('layouts.layout2')

@section('content')
    @php
        $header = "Create New Product";
        $button_label = "Add Product";
    @endphp

    @isset($product['id'])
        @php
            $header = "Edit Product";
            $button_label = "Update Product";
        @endphp
    @endisset
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{$header}}</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{(isset($product['id'])) ? action('ProductController@update', $product['id']) : url('products')}}">
                            {{ csrf_field() }}
                            <input type="hidden" name="formType" id="formType" value="" />
                            @if(isset($product['id']))
                                <input name="_method" type="hidden" value="PATCH">
                            @endif
                            <input name="userId" type="hidden" value="{{Auth::user()->id}}"  />
                            <div class="form-group{{ $errors->has('productName') ? ' has-error' : '' }}">
                                <label for="productName" class="col-md-4 control-label">Product Name</label>

                                <div class="col-md-6">
                                    <input id="productName" type="text" class="form-control" name="productName" value="{{@$product['product_name']}}" required autofocus>

                                    @if ($errors->has('productName'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('productName') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('productType') ? ' has-error' : '' }}">
                                <label for="productType" class="col-md-4 control-label">Product Type</label>

                                <div class="col-md-6">
                                    <select name="productType" id="productType">
                                        <option value="jersey" {{@$product['product_type'] == 'jersey' ? 'selected' : ''}}>Jersey</option>
                                        <option value="bag" {{@$product['product_type'] == 'bag' ? 'selected' : ''}}>Bag</option>

                                    </select>

                                    @if ($errors->has('productType'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('productType') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div id="bag-div">

                                <div class="form-group{{ $errors->has('basePrice') ? ' has-error' : '' }}">
                                    <label for="basePrice" class="col-md-4 control-label">Base Price</label>

                                    <div class="col-md-6">
                                        <input id="basePrice" type="number" step="0.01" class="form-control" name="basePrice" value="{{@$product['base_price']}}">

                                        @if ($errors->has('basePrice'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('basePrice') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('bagFrontImage') ? ' has-error' : '' }}">
                                    <label for="bagFrontImage" class="col-md-4 control-label">Front Image</label>

                                    <div class="col-md-6">
                                        <input id="bagFrontImage" type="file" class="form-control" name="bagFrontImage" value="{{@$product['front_image']}}" autofocus>

                                        @if ($errors->has('bagFrontImage'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('bagFrontImage') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                @isset($product['id'])
                                    <div class="form-group">
                                        <label class="col-md-4 control-label">Current Bag Image</label>

                                        <div class="col-md-6">
                                            <a href="{{asset('productimages/'.$product['bag_front_image'])}}" target="_blank" data-toggle="tooltip" title="Click image"><img height="80" width="120" src="{{asset('productimages/'.$product['bag_front_image'])}}"></a>
                                        </div>
                                    </div>
                                @endisset


                            </div>


                            <div id="jersey-div">

                                <div class="form-group{{ $errors->has('jerseyType') ? ' has-error' : '' }}">
                                    <label for="jerseyType" class="col-md-4 control-label">Jersey Type</label>

                                    <div class="col-md-6">
                                        <select name="jerseyType" id="jerseyType">
                                            <option value="basketball"
                                                @isset($product['jersey_type'])
                                                    {{$product['jersey_type'] == 'basketball' ? 'selected' : ''}}
                                                @endisset
                                            >Basketball</option>
                                            <option value="soccer"
                                                @isset($product['jersey_type'])
                                                    {{$product['jersey_type'] == 'soccer' ? 'selected' : ''}}
                                                @endisset
                                            >Soccer</option>
                                        </select>

                                        @if ($errors->has('jerseyType'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('jerseyType') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                                    <label for="gender" class="col-md-4 control-label">Gender</label>

                                    <div class="col-md-6">
                                        <select name="gender" id="gender">
                                            <option value="M"
                                                @isset($product['gender_flag'])
                                                    {{$product['gender_flag'] == 'M' ? 'selected' : ''}}
                                                @endisset
                                            >Male</option>
                                            <option value="F"
                                                @isset($product['gender_flag'])
                                                    {{$product['gender_flag'] == 'F' ? 'selected' : ''}}
                                                @endisset
                                            >Female</option>
                                        </select>

                                        @if ($errors->has('gender'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                {{--// TODO under construction--}}
                                {{--<div class="form-group">--}}
                                    {{--<label for="colors" class="col-md-4 control-label">Colors</label>--}}

                                    {{--<div class="col-md-6" style="margin-bottom: 20px;">--}}
                                        {{--<label class="checkbox-inline">--}}
                                            {{--<input type="checkbox" value="red">Red--}}
                                        {{--</label>--}}
                                        {{--<label class="checkbox-inline">--}}
                                            {{--<input type="checkbox" value="green">Green--}}
                                        {{--</label>--}}
                                        {{--<label class="checkbox-inline">--}}
                                            {{--<input type="checkbox" value="blue">Blue--}}
                                        {{--</label>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--// end TODO under construction--}}

                                <br>

                                {{--// white--}}
                                <div >
                                    <label>White</label>
                                    <div class="form-group{{ $errors->has('whiteFrontImage') ? ' has-error' : '' }}">
                                        <label for="whiteFrontImage" class="col-md-4 control-label">White Front Image</label>

                                        <div class="col-md-6">
                                            <input id="whiteFrontImage" type="file" class="form-control" name="whiteFrontImage" value="{{@$product['front_image']}}" autofocus>

                                            @if ($errors->has('frontImageWhite'))
                                                <span class="help-block">
                                            <strong>{{ $errors->first('frontImageWhite') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                    </div>

                                    @isset($product['id'])
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Current White Front Image</label>

                                            <div class="col-md-6">
                                                <a href="{{asset('productimages/'.$product['white_front_image'])}}" target="_blank" data-toggle="tooltip" title="Click image"><img height="80" width="120" src="{{asset('productimages/'.$product['white_front_image'])}}"></a>
                                            </div>
                                        </div>
                                    @endisset

                                    <div class="form-group{{ $errors->has('whiteBackImage') ? ' has-error' : '' }}">
                                        <label for="whiteBackImage" class="col-md-4 control-label">White Back Image</label>

                                        <div class="col-md-6">
                                            <input id="whiteBackImage" type="file" class="form-control" name="whiteBackImage" value="{{@$product['back_image']}}" autofocus>

                                            @if ($errors->has('whiteBackImage'))
                                                <span class="help-block">
                                            <strong>{{ $errors->first('whiteBackImage') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                    </div>

                                    @isset($product['id'])
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Current White Back Image</label>

                                            <div class="col-md-6">
                                                <a href="{{asset('productimages/'.$product['white_back_image'])}}" target="_blank" data-toggle="tooltip" title="Click image">
                                                    <img height="80" width="120" src="{{asset('productimages/'.$product['white_back_image'])}}"></a>
                                            </div>
                                        </div>
                                    @endisset

                                    <div id="redLeftImage" class="form-group{{ $errors->has('whiteLeftImage') ? ' has-error' : '' }}">
                                        <label for="whiteLeftImage" class="col-md-4 control-label">White Left Side Image</label>

                                        <div class="col-md-6">
                                            <input id="whiteLeftImage" type="file" class="form-control" name="whiteLeftImage" value="{{@$product['left_image']}}">

                                            @if ($errors->has('whiteLeftImage'))
                                                <span class="help-block">
                                            <strong>{{ $errors->first('whiteLeftImage') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                    </div>

                                    @isset($product['id'])
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Current Left Side Image</label>

                                            <div class="col-md-6">
                                                <a href="{{asset('productimages/'.$product['white_left_image'])}}" target="_blank" data-toggle="tooltip" title="Click image">
                                                    <img height="80" width="120" src="{{asset('productimages/'.$product['white_left_image'])}}"></a>
                                            </div>
                                        </div>
                                    @endisset

                                    <div id="redRightImageForm" class="form-group{{ $errors->has('whiteRightImage') ? ' has-error' : '' }}">
                                        <label for="whiteRightImage" class="col-md-4 control-label">White Right Side Image</label>

                                        <div class="col-md-6">
                                            <input id="whiteRightImage" type="file" class="form-control" name="whiteRightImage" value="{{@$product['right_image']}}">

                                            @if ($errors->has('whiteRightImage'))
                                                <span class="help-block">
                                            <strong>{{ $errors->first('whiteRightImage') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                    </div>

                                    @isset($product['id'])
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Current Right Side Image</label>

                                            <div class="col-md-6">
                                                <a href="{{asset('productimages/'.$product['white_right_image'])}}" target="_blank" data-toggle="tooltip" title="Click image">
                                                    <img height="80" width="120" src="{{asset('productimages/'.$product['white_right_image'])}}"></a>
                                            </div>
                                        </div>
                                    @endisset

                                    <div id="redRoundForm" class="form-group{{ $errors->has('whiteRoundImage') ? ' has-error' : '' }}">
                                        <label for="whiteRoundImage" class="col-md-4 control-label">White Round Neck Type</label>

                                        <div class="col-md-6">
                                            <input id="whiteRoundImage" type="file" class="form-control" name="whiteRoundImage" value="{{@$product['right_image']}}">

                                            @if ($errors->has('whiteRoundImage'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('whiteRoundImage') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    @isset($product['id'])
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Current Round Neck Type Image</label>

                                            <div class="col-md-6">
                                                <a href="{{asset('productimages/'.$product['white_round_neck_image'])}}" target="_blank" data-toggle="tooltip" title="Click image">
                                                    <img height="80" width="120" src="{{asset('productimages/'.$product['white_round_neck_image'])}}"></a>
                                            </div>
                                        </div>
                                    @endisset

                                    <div id="redVForm" class="form-group{{ $errors->has('whiteVImage') ? ' has-error' : '' }}">
                                        <label for="whiteVImage" class="col-md-4 control-label">White V Neck Type</label>

                                        <div class="col-md-6">
                                            <input id="whiteVImage" type="file" class="form-control" name="whiteVImage" value="{{@$product['right_image']}}">

                                            @if ($errors->has('whiteVImage'))
                                                <span class="help-block">
                                                <strong>{{ $errors->first('whiteVImage') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                    @isset($product['id'])
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Current V Neck Type Image</label>

                                            <div class="col-md-6">
                                                <a href="{{asset('productimages/'.$product['white_v_neck_image'])}}" target="_blank" data-toggle="tooltip" title="Click image">
                                                    <img height="80" width="120" src="{{asset('productimages/'.$product['white_v_neck_image'])}}"></a>
                                            </div>
                                        </div>
                                    @endisset

                                    <div id="redCollarForm" class="form-group{{ $errors->has('whiteCollarImage') ? ' has-error' : '' }}">
                                        <label for="whiteCollarImage" class="col-md-4 control-label">White Collard Neck Type</label>

                                        <div class="col-md-6">
                                            <input id="whiteCollarImage" type="file" class="form-control" name="whiteCollarImage" value="{{@$product['right_image']}}">

                                            @if ($errors->has('whiteCollarImage'))
                                                <span class="help-block">
                                            <strong>{{ $errors->first('whiteCollarImage') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                    </div>

                                    @isset($product['id'])
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Current Collard Neck Type Image</label>

                                            <div class="col-md-6">
                                                <a href="{{asset('productimages/'.$product['white_collar_image'])}}" target="_blank" data-toggle="tooltip" title="Click image">
                                                    <img height="80" width="120" src="{{asset('productimages/'.$product['white_collar_image'])}}"></a>
                                            </div>
                                        </div>
                                    @endisset

                                </div>
                                {{--// end white--}}

                                {{--// red--}}
                                <div >
                                    <label>Red</label>
                                    <div class="form-group{{ $errors->has('redFrontImage') ? ' has-error' : '' }}">
                                        <label for="redFrontImage" class="col-md-4 control-label">Red Front Image</label>

                                        <div class="col-md-6">
                                            <input id="redFrontImage" type="file" class="form-control" name="redFrontImage" value="{{@$product['front_image']}}" autofocus>

                                            @if ($errors->has('redFrontImage'))
                                                <span class="help-block">
                                            <strong>{{ $errors->first('redFrontImage') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                    </div>

                                    @isset($product['id'])
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Current Red Front Image</label>

                                            <div class="col-md-6">
                                                <a href="{{asset('productimages/'.$product['red_front_image'])}}" target="_blank" data-toggle="tooltip" title="Click image">
                                                    <img height="80" width="120" src="{{asset('productimages/'.$product['red_front_image'])}}"></a>
                                            </div>
                                        </div>
                                    @endisset

                                    <div class="form-group{{ $errors->has('redBackImage') ? ' has-error' : '' }}">
                                        <label for="redBackImage" class="col-md-4 control-label">Red Back Image</label>

                                        <div class="col-md-6">
                                            <input id="redBackImage" type="file" class="form-control" name="redBackImage" value="{{@$product['back_image']}}" autofocus>

                                            @if ($errors->has('redBackImage'))
                                                <span class="help-block">
                                            <strong>{{ $errors->first('redBackImage') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                    </div>

                                    @isset($product['id'])
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Current Red Back Image</label>

                                            <div class="col-md-6">
                                                <a href="{{asset('productimages/'.$product['red_back_image'])}}" target="_blank" data-toggle="tooltip" title="Click image">
                                                    <img height="80" width="120" src="{{asset('productimages/'.$product['red_back_image'])}}"></a>
                                            </div>
                                        </div>
                                    @endisset

                                    <div id="redLeftImage" class="form-group{{ $errors->has('redLeftImage') ? ' has-error' : '' }}">
                                        <label for="redLeftImage" class="col-md-4 control-label">Red Left Side Image</label>

                                        <div class="col-md-6">
                                            <input id="redLeftImage" type="file" class="form-control" name="redLeftImage" value="{{@$product['left_image']}}">

                                            @if ($errors->has('redLeftImage'))
                                                <span class="help-block">
                                            <strong>{{ $errors->first('redLeftImage') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                    </div>

                                    @isset($product['id'])
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Current Red Left Side Image</label>

                                            <div class="col-md-6">
                                                <a href="{{asset('productimages/'.$product['red_left_image'])}}" target="_blank" data-toggle="tooltip" title="Click image">
                                                    <img height="80" width="120" src="{{asset('productimages/'.$product['red_left_image'])}}"></a>
                                            </div>
                                        </div>
                                    @endisset

                                    <div id="redRightImageForm" class="form-group{{ $errors->has('redRightImage') ? ' has-error' : '' }}">
                                        <label for="redRightImage" class="col-md-4 control-label">Red Right Side Image</label>

                                        <div class="col-md-6">
                                            <input id="redRightImage" type="file" class="form-control" name="redRightImage" value="{{@$product['right_image']}}">

                                            @if ($errors->has('redRightImage'))
                                                <span class="help-block">
                                            <strong>{{ $errors->first('redRightImage') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                    </div>

                                    @isset($product['id'])
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Current Red Right Side Image</label>

                                            <div class="col-md-6">
                                                <a href="{{asset('productimages/'.$product['red_right_image'])}}" target="_blank" data-toggle="tooltip" title="Click image">
                                                    <img height="80" width="120" src="{{asset('productimages/'.$product['red_right_image'])}}"></a>
                                            </div>
                                        </div>
                                    @endisset

                                    <div id="redRoundForm" class="form-group{{ $errors->has('redRoundImage') ? ' has-error' : '' }}">
                                        <label for="redRoundImage" class="col-md-4 control-label">Red Round Neck Type</label>

                                        <div class="col-md-6">
                                            <input id="redRoundImage" type="file" class="form-control" name="redRoundImage" value="{{@$product['right_image']}}">

                                            @if ($errors->has('redRoundImage'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('redRoundImage') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    @isset($product['id'])
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Current Red Round Neck Type Image</label>

                                            <div class="col-md-6">
                                                <a href="{{asset('productimages/'.$product['red_round_neck_image'])}}" target="_blank" data-toggle="tooltip" title="Click image">
                                                    <img height="80" width="120" src="{{asset('productimages/'.$product['red_round_neck_image'])}}"></a>
                                            </div>
                                        </div>
                                    @endisset

                                    <div id="redVForm" class="form-group{{ $errors->has('redVImage') ? ' has-error' : '' }}">
                                        <label for="redVImage" class="col-md-4 control-label">Red V Neck Type</label>

                                        <div class="col-md-6">
                                            <input id="redVImage" type="file" class="form-control" name="redVImage" value="{{@$product['right_image']}}">

                                            @if ($errors->has('redVImage'))
                                                <span class="help-block">
                                                <strong>{{ $errors->first('redVImage') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                    @isset($product['id'])
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Current Red V Neck Type Image</label>

                                            <div class="col-md-6">
                                                <a href="{{asset('productimages/'.$product['red_v_neck_image'])}}" target="_blank" data-toggle="tooltip" title="Click image">
                                                    <img height="80" width="120" src="{{asset('productimages/'.$product['red_v_neck_image'])}}"></a>
                                            </div>
                                        </div>
                                    @endisset

                                    <div id="redCollarForm" class="form-group{{ $errors->has('redCollarImage') ? ' has-error' : '' }}">
                                        <label for="redCollarImage" class="col-md-4 control-label">Red Collard Neck Type</label>

                                        <div class="col-md-6">
                                            <input id="redCollarImage" type="file" class="form-control" name="redCollarImage" value="{{@$product['right_image']}}">

                                            @if ($errors->has('redCollarImage'))
                                                <span class="help-block">
                                            <strong>{{ $errors->first('redCollarImage') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                    </div>

                                    @isset($product['id'])
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Current Red Collard Neck Type Image</label>

                                            <div class="col-md-6">
                                                <a href="{{asset('productimages/'.$product['red_collar_image'])}}" target="_blank" data-toggle="tooltip" title="Click image">
                                                    <img height="80" width="120" src="{{asset('productimages/'.$product['red_collar_image'])}}"></a>
                                            </div>
                                        </div>
                                    @endisset

                                </div>
                                {{--// end red--}}

                                {{--//green--}}
                                <div>
                                    <label>Green</label>
                                    <div class="form-group{{ $errors->has('greenFrontImage') ? ' has-error' : '' }}">
                                        <label for="greenFrontImage" class="col-md-4 control-label">Green Front Image</label>

                                        <div class="col-md-6">
                                            <input id="greenFrontImage" type="file" class="form-control" name="greenFrontImage" value="{{@$product['front_image']}}" autofocus>

                                            @if ($errors->has('greenFrontImage'))
                                                <span class="help-block">
                                            <strong>{{ $errors->first('greenFrontImage') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                    </div>

                                    @isset($product['id'])
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Current Green Front Image</label>

                                            <div class="col-md-6">
                                                <a href="{{asset('productimages/'.$product['green_front_image'])}}" target="_blank" data-toggle="tooltip" title="Click image">
                                                    <img height="80" width="120" src="{{asset('productimages/'.$product['green_front_image'])}}"></a>
                                            </div>
                                        </div>
                                    @endisset

                                    <div class="form-group{{ $errors->has('greenBackImage') ? ' has-error' : '' }}">
                                        <label for="greenBackImage" class="col-md-4 control-label">Green Back Image</label>

                                        <div class="col-md-6">
                                            <input id="greenBackImage" type="file" class="form-control" name="greenBackImage" value="{{@$product['back_image']}}" autofocus>

                                            @if ($errors->has('greenBackImage'))
                                                <span class="help-block">
                                            <strong>{{ $errors->first('greenBackImage') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                    </div>

                                    @isset($product['id'])
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Current Green Back Image</label>

                                            <div class="col-md-6">
                                                <a href="{{asset('productimages/'.$product['green_back_image'])}}" target="_blank" data-toggle="tooltip" title="Click image">
                                                    <img height="80" width="120" src="{{asset('productimages/'.$product['green_back_image'])}}"></a>
                                            </div>
                                        </div>
                                    @endisset

                                    <div id="greenLeftImage" class="form-group{{ $errors->has('greenLeftImage') ? ' has-error' : '' }}">
                                        <label for="greenLeftImage" class="col-md-4 control-label">Green Left Side Image</label>

                                        <div class="col-md-6">
                                            <input id="greenLeftImage" type="file" class="form-control" name="greenLeftImage" value="{{@$product['left_image']}}">

                                            @if ($errors->has('greenLeftImage'))
                                                <span class="help-block">
                                            <strong>{{ $errors->first('greenLeftImage') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                    </div>

                                    @isset($product['id'])
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Current Green Left Side Image</label>

                                            <div class="col-md-6">
                                                <a href="{{asset('productimages/'.$product['green_left_image'])}}" target="_blank" data-toggle="tooltip" title="Click image">
                                                    <img height="80" width="120" src="{{asset('productimages/'.$product['green_left_image'])}}"></a>
                                            </div>
                                        </div>
                                    @endisset

                                    <div id="greenRightImageForm" class="form-group{{ $errors->has('greenRightImage') ? ' has-error' : '' }}">
                                        <label for="greenRightImage" class="col-md-4 control-label">Green Right Side Image</label>

                                        <div class="col-md-6">
                                            <input id="greenRightImage" type="file" class="form-control" name="greenRightImage" value="{{@$product['right_image']}}">

                                            @if ($errors->has('greenRightImage'))
                                                <span class="help-block">
                                            <strong>{{ $errors->first('greenRightImage') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                    </div>

                                    @isset($product['id'])
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Current Green Right Side Image</label>

                                            <div class="col-md-6">
                                                <a href="{{asset('productimages/'.$product['green_right_image'])}}" target="_blank" data-toggle="tooltip" title="Click image">
                                                    <img height="80" width="120" src="{{asset('productimages/'.$product['green_right_image'])}}"></a>
                                            </div>
                                        </div>
                                    @endisset

                                    <div id="greenRoundForm" class="form-group{{ $errors->has('greenRoundImage') ? ' has-error' : '' }}">
                                        <label for="greenRoundImage" class="col-md-4 control-label">Green Round Neck Type</label>

                                        <div class="col-md-6">
                                            <input id="greenRoundImage" type="file" class="form-control" name="greenRoundImage" value="{{@$product['right_image']}}">

                                            @if ($errors->has('greenRoundImage'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('greenRoundImage') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    @isset($product['id'])
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Current Green Round Neck Type Image</label>

                                            <div class="col-md-6">
                                                <a href="{{asset('productimages/'.$product['green_round_neck_image'])}}" target="_blank" data-toggle="tooltip" title="Click image">
                                                    <img height="80" width="120" src="{{asset('productimages/'.$product['green_round_neck_image'])}}"></a>
                                            </div>
                                        </div>
                                    @endisset

                                    <div id="greenVForm" class="form-group{{ $errors->has('greenVImage') ? ' has-error' : '' }}">
                                        <label for="greenVImage" class="col-md-4 control-label">Green V Neck Type</label>

                                        <div class="col-md-6">
                                            <input id="greenVImage" type="file" class="form-control" name="greenVImage" value="{{@$product['right_image']}}">

                                            @if ($errors->has('greenVImage'))
                                                <span class="help-block">
                                                <strong>{{ $errors->first('greenVImage') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                    @isset($product['id'])
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Current Green V Neck Type Image</label>

                                            <div class="col-md-6">
                                                <a href="{{asset('productimages/'.$product['green_v_neck_image'])}}" target="_blank" data-toggle="tooltip" title="Click image">
                                                    <img height="80" width="120" src="{{asset('productimages/'.$product['green_v_neck_image'])}}"></a>
                                            </div>
                                        </div>
                                    @endisset

                                    <div id="greenCollarForm" class="form-group{{ $errors->has('greenCollarImage') ? ' has-error' : '' }}">
                                        <label for="greenCollarImage" class="col-md-4 control-label">Green Collard Neck Type</label>

                                        <div class="col-md-6">
                                            <input id="greenCollarImage" type="file" class="form-control" name="greenCollarImage" value="{{@$product['right_image']}}">

                                            @if ($errors->has('greenCollarImage'))
                                                <span class="help-block">
                                            <strong>{{ $errors->first('greenCollarImage') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                    </div>

                                    @isset($product['id'])
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Current Green Collard Neck Type Image</label>

                                            <div class="col-md-6">
                                                <a href="{{asset('productimages/'.$product['green_collar_image'])}}" target="_blank" data-toggle="tooltip" title="Click image">
                                                    <img height="80" width="120" src="{{asset('productimages/'.$product['green_collar_image'])}}"></a>
                                            </div>
                                        </div>
                                    @endisset

                                </div>
                                {{--// green--}}

                                {{--// blue--}}
                                <div>
                                    <label>Blue</label>
                                    <div class="form-group{{ $errors->has('blueFrontImage') ? ' has-error' : '' }}">
                                        <label for="blueFrontImage" class="col-md-4 control-label">Blue Front Image</label>

                                        <div class="col-md-6">
                                            <input id="blueFrontImage" type="file" class="form-control" name="blueFrontImage" value="{{@$product['front_image']}}" requiblue autofocus>

                                            @if ($errors->has('blueFrontImage'))
                                                <span class="help-block">
                                            <strong>{{ $errors->first('blueFrontImage') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                    </div>

                                    @isset($product['id'])
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Current Blue Front Image</label>

                                            <div class="col-md-6">
                                                <a href="{{asset('productimages/'.$product['blue_front_image'])}}" target="_blank" data-toggle="tooltip" title="Click image">
                                                    <img height="80" width="120" src="{{asset('productimages/'.$product['blue_front_image'])}}"></a>
                                            </div>
                                        </div>
                                    @endisset

                                    <div class="form-group{{ $errors->has('blueBackImage') ? ' has-error' : '' }}">
                                        <label for="backImage" class="col-md-4 control-label">Blue Back Image</label>

                                        <div class="col-md-6">
                                            <input id="blueBackImage" type="file" class="form-control" name="blueBackImage" value="{{@$product['back_image']}}" >

                                            @if ($errors->has('blueBackImage'))
                                                <span class="help-block">
                                            <strong>{{ $errors->first('blueBackImage') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                    </div>

                                    @isset($product['id'])
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Current Blue Back Image</label>

                                            <div class="col-md-6">
                                                <a href="{{asset('productimages/'.$product['blue_back_image'])}}" target="_blank" data-toggle="tooltip" title="Click image">
                                                    <img height="80" width="120" src="{{asset('productimages/'.$product['blue_back_image'])}}"></a>
                                            </div>
                                        </div>
                                    @endisset

                                    <div id="blueLeftImage" class="form-group{{ $errors->has('blueLeftImage') ? ' has-error' : '' }}">
                                        <label for="blueLeftImage" class="col-md-4 control-label">Blue Left Side Image</label>

                                        <div class="col-md-6">
                                            <input id="blueLeftImage" type="file" class="form-control" name="blueLeftImage" value="{{@$product['left_image']}}">

                                            @if ($errors->has('blueLeftImage'))
                                                <span class="help-block">
                                            <strong>{{ $errors->first('blueLeftImage') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                    </div>

                                    @isset($product['id'])
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Current Blue Left Side Image</label>

                                            <div class="col-md-6">
                                                <a href="{{asset('productimages/'.$product['blue_left_image'])}}" target="_blank" data-toggle="tooltip" title="Click image">
                                                    <img height="80" width="120" src="{{asset('productimages/'.$product['blue_left_image'])}}"></a>
                                            </div>
                                        </div>
                                    @endisset

                                    <div id="blueRightImageForm" class="form-group{{ $errors->has('blueRightImage') ? ' has-error' : '' }}">
                                        <label for="blueRightImage" class="col-md-4 control-label">Blue Right Side Image</label>

                                        <div class="col-md-6">
                                            <input id="blueRightImage" type="file" class="form-control" name="blueRightImage" value="{{@$product['right_image']}}">

                                            @if ($errors->has('blueRightImage'))
                                                <span class="help-block">
                                            <strong>{{ $errors->first('blueRightImage') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                    </div>

                                    @isset($product['id'])
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Current Blue Right Side Image</label>

                                            <div class="col-md-6">
                                                <a href="{{asset('productimages/'.$product['blue_right_image'])}}" target="_blank" data-toggle="tooltip" title="Click image">
                                                    <img height="80" width="120" src="{{asset('productimages/'.$product['blue_right_image'])}}"></a>
                                            </div>
                                        </div>
                                    @endisset

                                    <div id="blueRoundForm" class="form-group{{ $errors->has('blueRoundImage') ? ' has-error' : '' }}">
                                        <label for="blueRoundImage" class="col-md-4 control-label">Blue Round Neck Type</label>

                                        <div class="col-md-6">
                                            <input id="blueRoundImage" type="file" class="form-control" name="blueRoundImage" value="{{@$product['right_image']}}">

                                            @if ($errors->has('blueRoundImage'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('blueRoundImage') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    @isset($product['id'])
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Current Blue Round Neck Type Image</label>

                                            <div class="col-md-6">
                                                <a href="{{asset('productimages/'.$product['blue_round_neck_image'])}}" target="_blank" data-toggle="tooltip" title="Click image">
                                                    <img height="80" width="120" src="{{asset('productimages/'.$product['blue_round_neck_image'])}}"></a>
                                            </div>
                                        </div>
                                    @endisset

                                    <div id="blueVForm" class="form-group{{ $errors->has('blueVImage') ? ' has-error' : '' }}">
                                        <label for="blueVImage" class="col-md-4 control-label">Blue V Neck Type</label>

                                        <div class="col-md-6">
                                            <input id="blueVImage" type="file" class="form-control" name="blueVImage" value="{{@$product['right_image']}}">

                                            @if ($errors->has('blueVImage'))
                                                <span class="help-block">
                                                <strong>{{ $errors->first('blueVImage') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                    @isset($product['id'])
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Current Blue V Neck Type Image</label>

                                            <div class="col-md-6">
                                                <a href="{{asset('productimages/'.$product['blue_v_neck_image'])}}" target="_blank" data-toggle="tooltip" title="Click image">
                                                    <img height="80" width="120" src="{{asset('productimages/'.$product['blue_v_neck_image'])}}"></a>
                                            </div>
                                        </div>
                                    @endisset

                                    <div id="blueCollarForm" class="form-group{{ $errors->has('blueCollarImage') ? ' has-error' : '' }}">
                                        <label for="blueCollarImage" class="col-md-4 control-label">Blue Collard Neck Type</label>

                                        <div class="col-md-6">
                                            <input id="blueCollarImage" type="file" class="form-control" name="blueCollarImage" value="{{@$product['right_image']}}">

                                            @if ($errors->has('blueCollarImage'))
                                                <span class="help-block">
                                            <strong>{{ $errors->first('blueCollarImage') }}</strong>
                                        </span>
                                            @endif
                                        </div>
                                    </div>

                                    @isset($product['id'])
                                        <div class="form-group">
                                            <label class="col-md-4 control-label">Current Blue Collard Neck Type Image</label>

                                            <div class="col-md-6">
                                                <a href="{{asset('productimages/'.$product['blue_collar_image'])}}" target="_blank" data-toggle="tooltip" title="Click image">
                                                    <img height="80" width="120" src="{{asset('productimages/'.$product['blue_collar_image'])}}"></a>
                                            </div>
                                        </div>
                                    @endisset
                            </div>
                            </div>
                            {{--// blue--}}

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <a href="{{action('ProductController@index')}}" class="btn btn-default">Cancel</a>
                                    <button type="submit" class="btn btn-success" style="margin-left:15px">{{$button_label}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
