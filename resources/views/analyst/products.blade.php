<x-layouts.app>
    <div class="container my-5">
        <h1 class="text-center mb-4 text-primary">Product Statistics</h1>

        <!-- Total Number of Products -->
        <div class="card shadow border-0 mb-4">
            <div class="card-body text-center">
                <h2 class="card-title">Total Number of Products</h2>
                <p class="display-4 fw-bold text-primary">{{ $totalProducts }}</p>
            </div>
        </div>

        <!-- Products by Category Chart -->
        <div class="card shadow border-0 mb-4">
            <div class="card-body">
                <h2 class="card-title">Products by Category</h2>
                <canvas id="productsByCategoryChart" width="400" height="200"></canvas>
            </div>
        </div>

        <!-- Top 5 Products by Total Sales -->
        <div class="card shadow border-0 mb-4">
            <div class="card-body">
                <h2 class="card-title">Top 5 Products by Total Sales</h2>
                @if($salesPerProduct->isEmpty())
                    <p>No sales data available for products.</p>
                @else
                    <canvas id="salesPerProductChart" width="400" height="200"></canvas>
                @endif
            </div>
        </div>

        <!-- Top 5 Products by Stock Quantity -->
        <div class="card shadow border-0 mb-4">
            <div class="card-body">
                <h2 class="card-title">Top 5 Products by Stock Quantity</h2>
                <ul class="list-group">
                    @foreach($topProductsByStock as $product)
                        <li class="list-group-item">{{ $product->name }}: {{ $product->quantity }} in stock</li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- Average Cost and Price -->
        <div class="card shadow border-0 mb-4">
            <div class="card-body">
                <h2 class="card-title">Average Cost and Price</h2>
                <p>Average Cost: <strong>${{ number_format($averageCostPrice->average_cost, 2) }}</strong></p>
                <p>Average Price: <strong>${{ number_format($averageCostPrice->average_price, 2) }}</strong></p>
            </div>
        </div>
    </div>

    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Products by Category Chart
        const ctx1 = document.getElementById('productsByCategoryChart').getContext('2d');
        const productsByCategoryData = @json($productsByCategoryData);

        new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: productsByCategoryData.map(category => category.label),
                datasets: [{
                    label: 'Number of Products',
                    data: productsByCategoryData.map(category => category.count),
                    backgroundColor: '#28a745',
                }],
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Number of Products'
                        }
                    }
                }
            }
        });

        // Top 5 Products by Total Sales Chart
        @if(!$salesPerProduct->isEmpty())
            const ctx2 = document.getElementById('salesPerProductChart').getContext('2d');
            const salesPerProductData = @json($salesPerProduct);

            new Chart(ctx2, {
                type: 'bar',
                data: {
                    labels: salesPerProductData.map(product => product.name),
                    datasets: [{
                        label: 'Total Sales ($)',
                        data: salesPerProductData.map(product => product.total_sales),
                        backgroundColor: '#007bff',
                    }],
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Total Sales ($)'
                            }
                        }
                    }
                }
            });
        @endif
    </script>

    <style>
        .container {
            max-width: 1200px;
        }

        .card {
            border-radius: 10px;
            transition: transform 0.2s;
        }

        .card:hover {
            transform: scale(1.02);
        }

        .card-title {
            font-size: 1.5rem;
            font -weight: 600;
            color: #343a40;
        }

        .display-4 {
            font-size: 2.5rem;
            font-weight: 700;
            color: #007bff;
        }

        .list-group-item {
            font-size: 1.1rem;
        }

        h1 {
            font-family: 'Arial', sans-serif;
            font-weight: bold;
            color: #007bff;
        }

        h2 {
            font-family: 'Arial', sans-serif;
            font-weight: bold;
            color: #495057;
        }

        .bg-gradient {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
        }

        .shadow {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</x-layouts.app>
