<!-- orderList.blade.php -->
@extends('layouts.layout')

@section('content')
@include('modals.orderImageModal')
        <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Orders</title>
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

    <table class="table table-striped" style="text-align: center;width: 50%;" align="center">
        <thead>
        <tr>
            <th style="text-align: center;" colspan="2">Choose Client to Chat</th>
        </tr>
        </thead>
        <tbody>
        @if(count($clientList)>0)
        @foreach($clientList as $client)
            <tr>
                <td style="text-align: left;">{{$client['first_name'] . " " . $client['last_name']}} @if($client['unread_message']>0)<span class="w3-badge w3-red">{{$client['unread_message']}}</span>@endif</td>
                <td style="text-align: center;"><a href="{{url('/chat/admin/'. base64_encode($client['id']))}}">Chat</a></td>
            </tr>
        @endforeach
        @else
            <tr>
                <td style="text-align: center;" colspan="2">
                    No client to chat.
                </td>
            </tr>
        @endif
        <tr>
            <td style="text-align: right;" colspan="2">
                <a href="{{url('')}}" class="btn btn-default">Close</a>
            </td>
        </tr>
        </tbody>
    </table>
</div>
</body>
<script>
    $(document).ready(function() {
    });
</script>
</html>
@endsection