<!DOCTYPE html>
<html>
<head>
    <title>Tree PDF</title>
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

        pre{
            font-size: 15px;
            font-weight: bold;
            padding: 0px;
            margin: 0px;
        }
    </style>
</head>
<body>
<header>
    {{$title}}
</header>
<table class="table table-bordered">
    <tr>
        <th>Code</th>
        <th>Name</th>
    </tr>
    @foreach($tree as $treeNode)
        @include('treeNodeViewPDF', [
                'treeNode' => $treeNode,
                'counter' => 0
                ])
    @endforeach
</table>

</body>
</html>
