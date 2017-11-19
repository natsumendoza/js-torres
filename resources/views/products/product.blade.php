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
                        <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{(isset($product['id'])) ? action('ProductController@update', $id) : url('products')}}">
                            {{ csrf_field() }}
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
                                        <option @if(isset($product['product_type']) AND $product['product_type'] == 'jersey') selected @endif value="jersey">Jersey</option>
                                        <option @if(isset($product['product_type']) AND $product['product_type'] == 'bag') selected @endif value="bag">Bag</option>
                                    </select>

                                    @if ($errors->has('productType'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('productType') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('jerseyType') ? ' has-error' : '' }}">
                                <label for="productType" class="col-md-4 control-label">Jersey Type (Hide if not Jersey)</label>

                                <div class="col-md-6">
                                    <select name="jerseyType" id="jerseyType">
                                        <option value="basketball">Jersey</option>
                                        <option value="football">Bag</option>
                                    </select>

                                    @if ($errors->has('jerseyType'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('productType') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('basePrice') ? ' has-error' : '' }}">
                                <label for="basePrice" class="col-md-4 control-label">Base Price</label>

                                <div class="col-md-6">
                                    <input id="basePrice" type="number" step="0.01" class="form-control" name="basePrice" value="{{@$product['base_price']}}" required autofocus>

                                    @if ($errors->has('basePrice'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('basePrice') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div>
                                <label for="colors" class="col-md-4 control-label">Colors</label>

                                <div class="col-md-6" style="margin-bottom: 20px;">
                                    <label class="checkbox-inline">
                                        <input type="checkbox" value="red">Red
                                    </label>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" value="green">Green
                                    </label>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" value="blue">Blue
                                    </label>
                                </div>
                            </div>

                            <br>
                            <div>
                                <label style="float:left;">Red</label>
                                <div class="form-group{{ $errors->has('redFrontImage') ? ' has-error' : '' }}">
                                    <label for="frontImage" class="col-md-4 control-label">Red Front Image</label>

                                    <div class="col-md-6">
                                        <input id="frontImage" type="file" class="form-control" name="frontImage" value="{{@$product['front_image']}}" required autofocus>

                                        @if ($errors->has('redFrontImage'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('redFrontImage') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('redBackImage') ? ' has-error' : '' }}">
                                    <label for="backImage" class="col-md-4 control-label">Red Back Image</label>

                                    <div class="col-md-6">
                                        <input id="redBackImage" type="file" class="form-control" name="redBackImage" value="{{@$product['back_image']}}" required autofocus>

                                        @if ($errors->has('redBackImage'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('redBackImage') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

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

                                <div id="redRightImageForm" class="form-group{{ $errors->has('rightImage') ? ' has-error' : '' }}">
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
                                <div id="redCollarForm" class="form-group{{ $errors->has('redVImage') ? ' has-error' : '' }}">
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
                            </div>

                            <div>
                                <label>Green</label>
                                <div class="form-group{{ $errors->has('greenFrontImage') ? ' has-error' : '' }}">
                                    <label for="frontImage" class="col-md-4 control-label">Green Front Image</label>

                                    <div class="col-md-6">
                                        <input id="frontImage" type="file" class="form-control" name="frontImage" value="{{@$product['front_image']}}" requigreen autofocus>

                                        @if ($errors->has('greenFrontImage'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('greenFrontImage') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('greenBackImage') ? ' has-error' : '' }}">
                                    <label for="backImage" class="col-md-4 control-label">Green Back Image</label>

                                    <div class="col-md-6">
                                        <input id="greenBackImage" type="file" class="form-control" name="greenBackImage" value="{{@$product['back_image']}}" requigreen autofocus>

                                        @if ($errors->has('greenBackImage'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('greenBackImage') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

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

                                <div id="greenRightImageForm" class="form-group{{ $errors->has('rightImage') ? ' has-error' : '' }}">
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
                                <div id="greenCollarForm" class="form-group{{ $errors->has('greenVImage') ? ' has-error' : '' }}">
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
                            </div>

                            <div>
                                <label>Blue</label>
                                <div class="form-group{{ $errors->has('blueFrontImage') ? ' has-error' : '' }}">
                                    <label for="frontImage" class="col-md-4 control-label">Blue Front Image</label>

                                    <div class="col-md-6">
                                        <input id="frontImage" type="file" class="form-control" name="frontImage" value="{{@$product['front_image']}}" requiblue autofocus>

                                        @if ($errors->has('blueFrontImage'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('blueFrontImage') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('blueBackImage') ? ' has-error' : '' }}">
                                    <label for="backImage" class="col-md-4 control-label">Blue Back Image</label>

                                    <div class="col-md-6">
                                        <input id="blueBackImage" type="file" class="form-control" name="blueBackImage" value="{{@$product['back_image']}}" requiblue autofocus>

                                        @if ($errors->has('blueBackImage'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('blueBackImage') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

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

                                <div id="blueRightImageForm" class="form-group{{ $errors->has('rightImage') ? ' has-error' : '' }}">
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
                                <div id="blueCollarForm" class="form-group{{ $errors->has('blueVImage') ? ' has-error' : '' }}">
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
                            </div>

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
