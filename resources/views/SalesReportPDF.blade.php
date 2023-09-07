<!DOCTYPE html>
<html>
<head>
    <title>Sales Report PDF</title>
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
    <table>
    <tr>
        <th>Name</th>
        <th>Purchase Total</th>
    </tr>
        </table>
</header>

<footer>
    Copyright © <?php echo date("Y");?> -
</footer>


<table class="table table-bordered">
    <tr>
        <th>Name</th>
        <th>Purchase Total</th>
    </tr>
    @foreach($salesReport as $saleReport)

        <tr>

            <td>{{ $saleReport->name }}</td>
            <td>{{ $saleReport->purchase_sum_total }}</td>

        </tr>
    @endforeach
</table>

</body>
</html>
