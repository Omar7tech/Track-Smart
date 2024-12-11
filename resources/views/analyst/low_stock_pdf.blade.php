<!DOCTYPE html>
<html>
<head>
    <title>Low Stock Products</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Low Stock Products</h1>
    <table>
        <thead>
            <tr>
                <th>Product Name</th>
                <th>barcode</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody>
            @foreach($lowStockProducts as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->barcode }}</td>
                    <td>{{ $product->quantity }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination Links -->
    <div>
        {{ $lowStockProducts->links() }} <!-- This will render pagination links -->
    </div>
</body>
</html>
