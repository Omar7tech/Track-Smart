<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detailed Statistical Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
            color: #333;
        }
        h1, h2, h3 {
            text-align: center;
            color: #007bff;
        }
        h3 {
            color: #0056b3;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 10px 0;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .container {
            margin-bottom: 20px;
        }
        .stats-summary {
            text-align: left;
            margin: 10px;
            padding: 10px;
            background-color: #e9ecef;
            border-radius: 5px;
        }
        .section-title {
            font-weight: bold;
            font-size: 18px;
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <h1>Detailed Statistical Report</h1>
    <h2>Report Generated on: {{ $currentDate }}</h2>

    <!-- User Statistics -->
    <div class="stats-summary">
        <div class="section-title">User Statistics</div>
        <p>Total Users: {{ $totalUsers }}</p>
        <p>Users by Role:</p>
        <table>
            <thead>
                <tr>
                    <th>Role</th>
                    <th>Count</th>
                </tr>
            </thead>
            <tbody>
                @foreach($usersByRole as $role => $count)
                    <tr>
                        <td>{{ ucfirst($role) }}</td>
                        <td>{{ $count }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <p>New Users in Last Month: {{ $newUsersLastMonth }}</p>
        <p>Active Users in Last Month: {{ $activeUsersLastMonth }}</p>
    </div>

    <!-- Sales Statistics -->
    <div class="stats-summary">
        <div class="section-title">Sales Statistics</div>
        <p>Total Sales: {{ $totalSales }}</p>
        <p>Total Revenue: {{ $totalRevenue }}</p>
        <p>Average Sale per User: {{ number_format($averageSalePerUser, 2) }}</p>

        <h3>Top Selling Products</h3>
        <table>
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Total Sales</th>
                </tr>
            </thead>
            <tbody>
                @foreach($topSellingProducts as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->total_sales }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h3>Sales by Category</h3>
        <table>
            <thead>
                <tr>
                    <th>Category Name</th>
                    <th>Total Sales</th>
                </tr>
            </thead>
            <tbody>
                @foreach($salesByCategory as $category)
                    <tr>
                        <td>{{ $category->category_name }}</td>
                        <td>{{ $category->total_sales }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Product Health -->
    <div class="stats-summary">
        <div class="section-title">Product Health</div>
        <h3>Low Stock Products</h3>
        <table>
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Barcode</th>
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

        <h3>Expired Products</h3>
        <table>
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Expiry Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($expiredProducts as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->expiry_date }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="stats-summary">
        <div class="section-title">Financial Insights</div>
        <p>Gross Margin: {{ number_format($grossMargin, 2) }}</p>
        <p>Year-over-Year Sales Growth: {{ number_format($yearlySalesGrowth, 2) }}</p>
    </div>

</body>
</html>
