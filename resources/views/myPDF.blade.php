<!DOCTYPE html>
<html>
<head>
    <title>Bank Account PDF</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        @page {
            margin: 100px 25px;
        }

        header {
            position: fixed;
            top: -60px;
            left: 0px;
            right: 0px;
            height: 50px;
            font-size: 20px !important;
            background-color: #7dc8b1;
            color: white;
            text-align: center;
            line-height: 35px;
        }

        footer {
            position: fixed;
            bottom: -60px;
            left: 0px;
            right: 0px;
            height: 50px;
            font-size: 20px !important;
            background-color: #7dc8b1;
            color: white;
            text-align: center;
            line-height: 35px;
        }
    </style>
</head>
<body>
<header>
    {{$title}}
</header>

<footer>
    Copyright © <?php echo date("Y");?> -
</footer>


<table class="table table-bordered">
    <tr>
        <th>Code</th>
        <th>Name</th>
        <th>Status</th>
        <th>opening_balance</th>
        <th>current_balance</th>
        <th>Created By</th>
        <th>Creation Date</th>



    </tr>
    @foreach($bankaccounts as $bankaccount)
        <tr>
            <td>{{ $bankaccount->id }}</td>
            <td>{{ $bankaccount->name }}</td>
            <td>{{ $bankaccount->status }}</td>
            <td>{{ $bankaccount->opening_balance }}</td>
            <td>{{ $bankaccount->current_balance }}</td>
            <td>{{ $bankaccount->creator->name }}</td>
            <td>{{ $bankaccount->created_at }}</td>

        </tr>
    @endforeach
</table>

</body>
</html>