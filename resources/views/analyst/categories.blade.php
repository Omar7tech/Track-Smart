<x-layouts.app>
    <div class="container my-4">
        <h1>Category Statistics</h1>

        <!-- Total Categories -->
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Total Categories</h5>
                <p class="fs-3">{{ $totalCategories }}</p>
            </div>
        </div>

        <!-- Top 5 Categories by Product Count -->
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Top 5 Categories by Product Count</h5>
                <canvas id="topCategoriesChart" height="150"></canvas>
            </div>
        </div>

        <!-- Category Distribution -->
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Category Distribution</h5>
                <canvas id="categoryDistributionChart" height="150"></canvas>
            </div>
        </div>

        <!-- Average Products per Category -->
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Average Products per Category</h5>
                <p class="fs-3">{{ $averageProductsPerCategory }}</p>
            </div>
        </div>

        <!-- Total Products -->
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Total Products</h5>
                <p class="fs-3">{{ $totalProducts }}</p>
            </div>
        </div>

        <!-- Total Prices per Category -->
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Total Prices per Category</h5>
                <canvas id="categoryPricesChart" height="150"></canvas>
            </div>
        </div>

        <!-- Include Chart.js -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            // Data for Top 5 Categories by Product Count
            const topCategoriesData = @json($topCategoriesChartData);
            const topCategoriesChart = new Chart(document.getElementById('topCategoriesChart'), {
                type: 'bar',
                data: {
                    labels: topCategoriesData.map(category => category.label),
                    datasets: [{
                        label: 'Number of Products',
                        data: topCategoriesData.map(category => category.count),
                        backgroundColor: '#007bff',
                    }],
                },
                options: {
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Category'
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'Number of Products'
                            },
                            beginAtZero: true
                        }
                    }
                }
            });

            // Data for Category Distribution
            const categoryDistributionData = @json($categoryDistributionData);
            const categoryDistributionChart = new Chart(document.getElementById('categoryDistributionChart'), {
                type: 'pie',
                data: {
                    labels: categoryDistributionData.map(category => category.label),
                    datasets: [{
                        data: categoryDistributionData.map(category => category.count),
                        backgroundColor: ['#007bff', '#28a745', '#ffc107', '#dc3545', '#6c757d'],
                    }],
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return `${context.label}: ${context.raw}`;
                                }
                            }
                        }
                    }
                }
            });

            // Data for Total Prices per Category
            const categoryPricesData = @json($categoryPrices);
            const categoryPricesChart = new Chart(document.getElementById('categoryPricesChart'), {
                type: 'bar',
                data: {
                    labels: categoryPricesData.map(category => category.label),
                    datasets: [{
                        label: 'Total Price',
                        data: categoryPricesData.map(category => category.total_price),
                        backgroundColor: '#28a745',
                    }],
                },
                options: {
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Category'
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'Total Price'
                            },
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    </div>
</x-layouts.app>
