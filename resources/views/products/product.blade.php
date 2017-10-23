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

                            <div class="form-group{{ $errors->has('frontImage') ? ' has-error' : '' }}">
                                <label for="frontImage" class="col-md-4 control-label">Front Image</label>

                                <div class="col-md-6">
                                    <input id="frontImage" type="file" class="form-control" name="frontImage" value="{{@$product['front_image']}}" required autofocus>

                                    @if ($errors->has('frontImage'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('frontImage') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('backImage') ? ' has-error' : '' }}">
                                <label for="backImage" class="col-md-4 control-label">Back Image</label>

                                <div class="col-md-6">
                                    <input id="backImage" type="file" class="form-control" name="backImage" value="{{@$product['back_image']}}" required autofocus>

                                    @if ($errors->has('backImage'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('backImage') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('leftImage') ? ' has-error' : '' }}">
                                <label for="leftImage" class="col-md-4 control-label">Left Side Image</label>

                                <div class="col-md-6">
                                    <input id="leftImage" type="file" class="form-control" name="leftImage" value="{{@$product['left_image']}}" required autofocus>

                                    @if ($errors->has('leftImage'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('leftImage') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('rightImage') ? ' has-error' : '' }}">
                                <label for="rightImage" class="col-md-4 control-label">Right Side Image</label>

                                <div class="col-md-6">
                                    <input id="rightImage" type="file" class="form-control" name="rightImage" value="{{@$product['right_image']}}" required autofocus>

                                    @if ($errors->has('rightImage'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('rightImage') }}</strong>
                                    </span>
                                    @endif
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
