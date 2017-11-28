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
                        <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{(isset($product['id'])) ? action('FinishedProductController@update', $id) : url('finishedproduct')}}">
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

                            <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                                <label for="price" class="col-md-4 control-label">Price</label>

                                <div class="col-md-6">
                                    <input id="price" type="number" step="0.01" class="form-control" name="price" value="{{@$product['price']}}" required autofocus>

                                    @if ($errors->has('price'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                                <label for="image" class="col-md-4 control-label">Image</label>

                                <div class="col-md-6">
                                    <input id="image" type="file" class="form-control" name="image" value="{{@$product['front_image']}}" autofocus>

                                    @if ($errors->has('image'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            @isset($product['id'])
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Current Image</label>

                                    <div class="col-md-6">
                                        <a href="{{asset('finishedproducts/'.$product['image'])}}" target="_blank" data-toggle="tooltip" title="Click image"><img height="80" width="120" src="{{asset('finishedproducts/'.$product['image'])}}"></a>
                                    </div>
                                </div>
                            @endisset

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <a href="{{action('FinishedProductController@index')}}" class="btn btn-default">Cancel</a>
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
