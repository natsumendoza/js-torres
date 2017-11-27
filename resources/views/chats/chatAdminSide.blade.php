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
    <style>
        tbody {
            display:block;
            height:300px;
            overflow:auto;
        }
        thead, tbody tr {
            display:table;
            width:100%;
            table-layout:fixed;/* even columns width , fix width of table too*/
        }
        thead {
            width: calc( 100% - 1em )/* scrollbar is average 1em/16px width, remove it from thead width */
        }

    </style>
</head>
<body>
<div class="container">
    <br />
    @if (\Session::has('success'))
        <div class="alert alert-success">
            <p>{{ \Session::get('success') }}</p>
        </div><br />
    @endif

    <table class="" style="text-align: center;width: 50%;" align="center">
        <thead>
            <tr>
                <th style="text-align: center">{{'[' . $data['user']['id'] . '] ' . $data['user']['first_name'] . ' ' . $data['user']['last_name']}}</th>
            </tr>
            <tr>
                <th style="text-align: center;">&nbsp;</th>
            </tr>
        </thead>
        <tbody id="chat_list">
        @if(count($data['messages'])>0)
            @foreach($data['messages'] as $message)
                @php
                    date_default_timezone_set('Asia/Manila');
                    $time = date_format(date_create($message['created_at']), 'M d, Y g:i:s a');

                    if(date('Ymd') == date('Ymd', strtotime($message['created_at'])))
                    {
                        $time = date_format(date_create($message['created_at']), 'g:i:s a');
                    }
                @endphp


                @if($message['from']== Auth::user()->id)
                    <tr>
                        <td style="text-align:right;">{{$message['message']}}</td>
                    </tr>
                    <tr>
                        <td style="text-align:right;"><span style="font-size: 8px;">{{$time}}</span></td>
                    </tr>
                @else
                    @php($avatar = 'avatar_male.png')
                    @if($data['user']['gender'] == config('constants.FEMALE'))
                        @php($avatar = 'avatar_female.png')
                    @endif
                    <tr>
                        <td style="text-align:left;"><img src="{{asset('images/'.$avatar)}}" height="25px;" width="25px;" style="margin-right: 10px;">{{$message['message']}}</td>
                    </tr>
                    <tr>
                        <td style="text-align:left;"><span style="font-size: 8px;">{{$time}}</span></td>
                    </tr>
                @endif
            @endforeach
        @else
            <tr>
                <td style="text-align: center;">
                    Start conversation with {{'[' . $data['user']['id'] . '] ' . $data['user']['first_name'] . ' ' . $data['user']['last_name']}}...
                </td>
            </tr>
        @endif
        </tbody>
        <tr>
            <td style="text-align: right;">
                <form method="POST" action="{{url('chat')}}">
                    {{ csrf_field() }}
                    <input type="hidden" name="to" id="to" value="{{base64_encode($data['user']['id'])}}">
                    <textarea id="message" name="message" style="width: 75%;"></textarea>
                    <button type="submit" class="btn btn-primary">Send</button>
                </form>
            </td>
        </tr>
        <tr>
            <td style="text-align: right;">
                <a href="{{url('/chat')}}" class="btn btn-default">Close</a>
            </td>
        </tr>
    </table>
</div>
</body>
<script>
    $(document).ready(function()
    {
        var objDiv = document.getElementById("chat_list");
        objDiv.scrollTop = objDiv.scrollHeight;
    });
</script>
</html>
@endsection