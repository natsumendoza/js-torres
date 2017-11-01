<!-- productList.blade.php -->
@extends('layouts.layout2')

@section('content')
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Products</title>
    <link rel="stylesheet" href="{{ env('APP_URL') == 'http://localhost' ? asset('css/app.css') : secure_asset('css/app.css') }}">
</head>
<body>
<div class="container">
    <br />
    @if (\Session::has('success'))
        <div class="alert alert-success">
            <p>{{ \Session::get('success') }}</p>
        </div><br />
    @endif

    <div>
        <a href="{{action('ProductController@create')}}" class="btn btn-success" style="float: right;">Create New Product</a>
    </div>
    <table class="table table-striped">
        <thead>
        <tr>
            <th style="text-align: center">ID</th>
            <th style="text-align: center">Name</th>
            <th style="text-align: center">Type</th>
            <th style="text-align: center">Base Price</th>
            <th style="text-align: center">Front Image</th>
            <th style="text-align: center">Back Image</th>
            <th style="text-align: center">Left Side Image</th>
            <th style="text-align: center">Right Side Image</th>
            <th style="text-align: center" colspan="2">Action</th>
        </tr>
        </thead>
        <tbody>
        @if(count($productList)>0)
        @foreach($productList as $product)
            <tr>
                <td style="text-align: center;">{{$product['id']}}</td>
                <td style="text-align: center;">{{$product['product_name']}}</td>
                <td style="text-align: center;">{{$product['product_type']}}</td>
                <td style="text-align: center;">{{$product['base_price']}}</td>
                <td style="text-align: center;"><img height="50" width="50" src="{{URL::asset('/productimages/'.$product['front_image'])}}"></td>
                <td style="text-align: center;"><img height="50" width="50" src="{{URL::asset('/productimages/'.$product['back_image'])}}"></td>
                <td style="text-align: center;"><img height="50" width="50" src="{{URL::asset('/productimages/'.$product['left_image'])}}"></td>
                <td style="text-align: center;"><img height="50" width="50" src="{{URL::asset('/productimages/'.$product['right_image'])}}"></td>
                <td style="text-align: center;"><a href="{{action('ProductController@edit', $product['id'])}}" class="btn btn-warning">Edit</a></td>
                <td style="text-align: center;">
                    <form action="{{action('ProductController@destroy', $product['id'])}}" method="post">
                        {{csrf_field()}}
                        <input name="_method" type="hidden" value="DELETE">
                        <button class="btn btn-danger" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        @else
            <tr>
                <td style="text-align: center;" colspan="10">
                    There is no product.
                </td>
            </tr>
        @endif
        <tr>
            <td style="text-align: right;" colspan="10">
                <a href="{{url('')}}" class="btn btn-default">Close</a>
            </td>
        </tr>
        </tbody>
    </table>
</div>
</body>
</html>
@endsection