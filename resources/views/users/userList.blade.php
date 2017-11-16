<!-- productList.blade.php -->
@extends('layouts.layout')

@section('content')
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

    <table class="table table-striped">
        <thead>
        <tr>
            <th style="text-align: center">ID</th>
            <th style="text-align: center">Full Name</th>
            <th style="text-align: center">Email</th>
            <th style="text-align: center">Phone Number</th>
            <th style="text-align: center">Address</th>
            <th style="text-align: center">Action</th>
        </tr>
        </thead>
        <tbody>
        @if(count($userList)>0)
            @foreach($userList as $user)
                <tr>
                    <td style="text-align: center;">{{$user['id']}}</td>
                    <td style="text-align: center;">{{$user['first_name'] . ' ' . $user['middle_name'] . ' ' . $user['last_name']}}</td>
                    <td style="text-align: center;">{{$user['email']}}</td>
                    <td style="text-align: center;">{{$user['phone_no']}}</td>
                    <td style="text-align: center;">{{$user['address']}}</td>
                    <td style="text-align: center;">
                        <form action="{{action('UserController@destroy', base64_encode($user['id']))}}" method="post">
                            {{csrf_field()}}
                            <input name="_method" type="hidden" value="DELETE">
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td style="text-align: center;" colspan="6">
                    There is no user.
                </td>
            </tr>
        @endif
        <tr>
            <td style="text-align: right;" colspan="6">
                <a href="{{url('/customize')}}" class="btn btn-default">Close</a>
            </td>
        </tr>
        </tbody>
    </table>
</div>
</body>
</html>
@endsection