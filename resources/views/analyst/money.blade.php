<x-layouts.app>
    <div class="container my-5">
        <h1 class="text-center mb-4">Product Sales and Profit Statistics</h1>

        <!-- Total Revenue Section -->
        <div class="card mb-4 shadow-sm border-0">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Total Revenue</h4>
            </div>
            <div class="card-body text-center">
                <p class="fs-3 fw-bold text-success">${{ number_format($totalRevenue, 2) }}</p>
                <!-- Chart for Total Revenue -->
                <canvas id="totalRevenueChart" class="mt-4"></canvas>
            </div>
        </div>

        <!-- Most Sold Product by Revenue Section -->
        <div class="card mb-4 shadow-sm border-0">
            <div class="card-header bg-info text-white">
                <h4 class="mb-0">Most Sold Product by Revenue</h4>
            </div>
            <div class="card-body">
                @if($mostSoldProduct)
                    <p class="fw-bold">Product: {{ $mostSoldProduct->name }}</p>
                    <p class="fs-5 text-muted">Total Revenue: ${{ number_format($mostSoldProduct->total_revenue, 2) }}</p>
                    <canvas id="mostSoldProductChart" class="mt-4"></canvas>
                @else
                    <p class="text-center">No data available for the most sold product.</p>
                @endif
            </div>
        </div>

        <!-- Highest Profit Product Section -->
        <div class="card mb-4 shadow-sm border-0">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0">Highest Profit Product</h4>
            </div>
            <div class="card-body">
                @if($highestProfitProduct)
                    <p class="fw-bold">Product: {{ $highestProfitProduct->name }}</p>
                    <p class="fs-5 text-muted">Profit: ${{ number_format($highestProfitProduct->profit, 2) }}</p>
                    <canvas id="highestProfitProductChart" class="mt-4"></canvas>
                @else
                    <p class="text-center">No data available for the highest profit product.</p>
                @endif
            </div>
        </div>

        <!-- Lowest Profit Product Section -->
        <div class="card mb-4 shadow-sm border-0">
            <div class="card-header bg-danger text-white">
                <h4 class="mb-0">Lowest Profit Product</h4>
            </div>
            <div class="card-body">
                @if($lowestProfitProduct)
                    <p class="fw-bold">Product: {{ $lowestProfitProduct->name }}</p>
                    <p class="fs-5 text-muted">Profit: ${{ number_format($lowestProfitProduct->profit, 2) }}</p>
                    <canvas id="lowestProfitProductChart" class="mt-4"></canvas>
                @else
                    <p class="text-center">No data available for the lowest profit product.</p>
                @endif
            </div>
        </div>

        <!-- Top 5 Most Profitable Products Section -->
        <div class="card mb-4 shadow-sm border-0">
            <div class="card-header bg-warning text-dark">
                <h4 class="mb-0">Top 5 Most Profitable Products</h4>
            </div>
            <div class="card-body">
                @if($mostProfitableProducts->isEmpty())
                    <p class="text-center">No data available for the top 5 most profitable products.</p>
                @else
                    <canvas id="mostProfitableProductsChart" class="mt-4"></canvas>
                @endif
            </div>
        </div>

        <!-- Top 5 Least Profitable Products Section -->
        <div class="card mb-4 shadow-sm border-0">
            <div class="card-header bg-secondary text-white">
                <h4 class="mb-0">Top 5 Least Profitable Products</h4>
            </div>
            <div class="card-body">
                @if($leastProfitableProducts->isEmpty())
                    <p class="text-center">No data available for the top 5 least profitable products.</p>
                @else
                    <canvas id="leastProfitableProductsChart" class="mt-4"></canvas>
                @endif
            </div>
        </div>

        <!-- Top 10 Products by Profit Percentage Section -->
        <div class="card shadow-sm border-0">
            <div class="card-header bg-dark text-white">
                <h4 class="mb-0">Top 10 Products by Profit Percentage</h4>
            </div>
            <div class="card-body">
                @if($top10ProfitPercentageProducts->isEmpty())
                    <p class="text-center">No data available for the top 10 products by profit percentage.</p>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover mt-3">
                            <thead class="table-dark">
                                <tr>
                                    <th>Product</th>
                                    <th>Profit Percentage (%)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($top10ProfitPercentageProducts as $product)
                                    <tr>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ number_format($product->profit_percentage, 2) }}%</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Chart.js Library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- JavaScript for rendering charts -->
    <script>
        // Total Revenue Chart
        new Chart(document.getElementById('totalRevenueChart'), {
            type: 'pie',
            data: {
                labels: ['Total Revenue'],
                datasets: [{
                    label: 'Revenue',
                    data: [{{ $totalRevenue }}],
                    backgroundColor: ['rgba(75, 192, 192, 0.2)'],
                    borderColor: ['rgba(75, 192, 192, 1)'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                    },
                    tooltip: {
                        enabled: true,
                    }
                }
            }
        });

        // Most Sold Product by Revenue Chart
        @if($mostSoldProduct)
        new Chart(document.getElementById('mostSoldProductChart'), {
            type: 'bar',
            data: {
                labels: ['{{ $mostSoldProduct->name }}'],
                datasets: [{
                    label: 'Revenue',
                    data: [{{ $mostSoldProduct->total_revenue }}],
                    backgroundColor: ['rgba(54, 162, 235, 0.2)'],
                    borderColor: ['rgba(54, 162, 235, 1)'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false,
                    },
                    tooltip: {
                        enabled: true,
                    }
                }
            }
        });
        @endif

        // Highest Profit Product Chart
        @if($highestProfitProduct)
        new Chart(document.getElementById('highestProfitProductChart'), {
            type: 'bar',
            data: {
                labels: ['{{ $highestProfitProduct->name }}'],
                datasets: [{
                    label: 'Profit',
                    data: [{{ $highestProfitProduct->profit }}],
                    backgroundColor: ['rgba(75, 192, 192, 0.2)'],
                    borderColor: ['rgba(75, 192, 192, 1)'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false,
                    },
                    tooltip: {
                        enabled: true,
                    }
                }
            }
        });
        @endif

        // Lowest Profit Product Chart
        @if($lowestProfitProduct)
        new Chart(document.getElementById('lowestProfitProductChart'), {
            type: 'bar',
            data: {
                labels: ['{{ $lowestProfitProduct->name }}'],
                datasets: [{
                    label: 'Profit',
                    data: [{{ $lowestProfitProduct->profit }}],
                    backgroundColor: ['rgba(255, 99, 132, 0.2)'],
                    borderColor: ['rgba(255, 99, 132, 1)'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false,
                    },
                    tooltip: {
                        enabled: true,
                    }
                }
            }
        });
        @endif

        // Top 5 Most Profitable Products Chart
        @if(!$mostProfitableProducts->isEmpty())
        new Chart(document.getElementById('mostProfitableProductsChart'), {
            type: 'bar',
            data: {
                labels: @json($mostProfitableProducts->pluck('name')),
                datasets: [{
                    label: 'Profit',
                    data: @json($mostProfitableProducts->pluck('profit')),
                    backgroundColor: 'rgba(75, 192, 192, 0.5)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                    },
                    tooltip: {
                        enabled: true,
                    }
                }
            }
        });
        @endif

        // Top 5 Least Profitable Products Chart
        @if(!$leastProfitableProducts->isEmpty())
        new Chart(document.getElementById('leastProfitableProductsChart'), {
            type: 'bar',
            data: {
                labels: @json($leastProfitableProducts->pluck('name')),
                datasets: [{
                    label: 'Profit',
                    data: @json($leastProfitableProducts->pluck('profit')),
                    backgroundColor: 'rgba(255, 99, 132, 0.5)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                    },
                    tooltip: {
                        enabled: true,
                    }
                }
            }
        });
        @endif
    </script>
</x-layouts.app>
