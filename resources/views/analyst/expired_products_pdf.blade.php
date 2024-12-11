<!DOCTYPE html>
<html>
<head>
    <title>Expired Products</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid #000;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Expired Products</h1>
    <table>
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Expiry Date</th>
                <th>Stock Quantity</th>
            </tr>
        </thead>
        <tbody>
            @foreach($expiredProducts as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->expiry_date->format('Y-m-d') }}</td>
                    <td>{{ $product->quantity }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
