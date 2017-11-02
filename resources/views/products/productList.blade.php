<!-- productList.blade.php -->
@extends('layouts.layout')

@section('content')
@include('modals.productImageModal')
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Products</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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
            <th style="text-align: center">Product Images</th>
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
                <td style="text-align: right;">{{$product['base_price']}}</td>
                <td style="text-align: center;">
                    <a class="viewProductImage" id="{{$product['id']}}" data-toggle="modal" data-target="#orderImageModal">View Images</a>
                </td>
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
<script>
    $(document).ready(function() {
        var products = <?php echo json_encode(@$productList); ?>;
        var productImagePath = <?php echo json_encode(URL::asset('/productimages/')); ?>;

        $('.viewProductImage').on('click',function (e) {
            var id = e.target.id;

            // FOR ANCHOR <a> TAG
            $('#frontAnchorProduct').attr("href", productImagePath + '/' + products[id]['front_image']);
            $('#backAnchorProduct').attr("href", productImagePath + '/' + products[id]['back_image']);
            $('#leftAnchorProduct').attr("href", productImagePath + '/' + products[id]['left_image']);
            $('#rightAnchorProduct').attr("href", productImagePath + '/' + products[id]['right_image']);

            // FOR IMAGE src
            $('#frontImgSrcProduct').attr("src", productImagePath + '/' + products[id]['front_image']);
            $('#backImgSrcProduct').attr("src", productImagePath + '/' + products[id]['back_image']);
            $('#leftImgSrcProduct').attr("src", productImagePath + '/' + products[id]['left_image']);
            $('#rightImgSrcProduct').attr("src", productImagePath + '/' + products[id]['right_image']);
        });

    });
</script>
</html>
@endsection