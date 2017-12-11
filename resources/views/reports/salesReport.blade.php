<!DOCTYPE html>

<html>

<head>
    <title>Sales Report</title>
    <style>
        .border
        {
            border: 1px solid black;
            border-collapse: collapse;
        }
        .border-top
        {
            border-top: 1px solid black;
            border-collapse: collapse;
        }
        .border-bot
        {
            border-bottom: 1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>

<body>
<table style="width:100%;margin-bottom: 30px;">
    <tr>
        <td style="text-align: center; font-size: 30px;">Sales Report</td>
    </tr>
    <tr>
        <td>Year: {{$data['year']}}</td>
    </tr>
    <tr>
        <td>Month: {{$data['monthName']}}</td>
    </tr>
</table>
<table style="width: 100%" class="border">
    <thead>
        <tr>
            <th class="border">Date</th>
            <th class="border">Transaction Code
            <th class="border">Order No.</th>
            <th class="border">Client</th>
            <th class="border">Amount</th>
        </tr>
    </thead>
    <tbody>
    @php
        $total = 0;
    @endphp
    @if(count($data['reports'])>0)
        @foreach($data['reports'] as $report)
        @php
            $total += $report['total_price'];
        @endphp
        <tr>
                <td class="border">{{date("m/d/Y", strtotime($report['created_at']))}}</td>
                <td style="text-align: center" class="border">{{$report['transaction_code']}}</td>
                <td style="text-align: center" class="border">{{$report['id']}}</td>
                <td class="border">{{$report['first_name'] . " " . $report['last_name']}}</td>
                <td style="text-align: right" class="border">{{number_format($report['total_price'], 2)}}</td>
        </tr>
        @endforeach
        <tr>
            <td style="text-align: right" colspan="4">Total: </td>
            <td style="text-align: right">{{number_format($total, 2)}}</td>
        </tr>
    @else
        <tr>
            <td style="text-align: center" class="border" colspan="5"><i>No data available.</i></td>
        </tr>
    @endif

    </tbody>
</table>

</body>

</html>