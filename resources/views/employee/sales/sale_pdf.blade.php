<!DOCTYPE html>
<html>

<head>
    <title>Sale Details</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 20px;
            color: #333;
        }

        .container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #f9f9f9;
        }

        h2,
        h3 {
            text-align: center;
            margin-bottom: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .info {
            margin-bottom: 20px;
        }

        .info p {
            margin: 5px 0;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .table th,
        .table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        .table th {
            background-color: #4CAF50;
            color: white;
            text-transform: uppercase;
        }

        .table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .table td {
            font-size: 14px;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>Sale Details</h2>
            <p><strong>Date:</strong> {{ $sale->created_at->format('d M Y, h:i A') }}</p>
        </div>

        <div class="info">
            <h3>Product Information</h3>
            <p><strong>Product Name:</strong> {{ $sale->product->name }}</p>
            <p><strong>Category:</strong> {{ $sale->product->category->name }}</p>
            <p><strong>Price per Unit:</strong> ${{ number_format($sale->product->price / 100, 2, '.', ',') }}</p>
        </div>

        <div class="info">
            <h3>Sale Information</h3>
            <p><strong>Quantity Sold:</strong> {{ $sale->quantity }}</p>
            <p><strong>Total Price:</strong> ${{ number_format($sale->total / 100, 2, '.', ',') }}</p>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price per Unit</th>
                    <th>Total Price</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $sale->product->name }}</td>
                    <td>{{ $sale->quantity }}</td>
                    <td>${{ number_format($sale->product->price / 100, 2, '.', ',') }}</td>
                    <td>${{ number_format($sale->total / 100, 2, '.', ',') }}</td>
                </tr>
            </tbody>
        </table>

        <div class="footer">
            <p>&copy; {{ date('Y') }} Track Smart . All rights reserved.</p>
        </div>
    </div>
</body>

</html>
