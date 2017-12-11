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
<table>
    <tr>
        <td>Year: </td>
        <td>{{$data['year']}}</td>
    </tr>
    <tr>
        <td>Month: </td>
        <td>{{$data['monthName']}}</td>
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
        <tr>
            <td class="border">AA</td>
            <td style="text-align: center" class="border">AA</td>
            <td style="text-align: center" class="border">AA</td>
            <td class="border">AA</td>
            <td style="text-align: right" class="border">AA</td>
        </tr>
    </tbody>
</table>

</body>

</html>