<!-- productList.blade.php -->
@extends('layouts.layout2')

@section('content')
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Products</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
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
        @foreach($productList as $product)
            <tr>
                <td style="text-align: center;">{{$product['id']}}</td>
                <td>{{$product['product_name']}}</td>
                <td>{{$product['product_type']}}</td>
                <td style="text-align: right;">{{$product['base_price']}}</td>
                <td>{{$product['front_image']}}</td>
                <td>{{$product['back_image']}}</td>
                <td>{{$product['left_image']}}</td>
                <td>{{$product['right_image']}}</td>
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
        </tbody>
    </table>
</div>
</body>
</html>
@endsection