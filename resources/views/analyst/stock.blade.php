<x-layouts.app>
    <div class="container my-5">
        <h1 class="text-center mb-4">Product Stock Statistics</h1>

        <!-- Most Stocked Product Section -->
        <div class="card mb-4 shadow-sm border-0">
            <div class="card-header bg-info text-white">
                <h4 class="mb-0">Most Stocked Product</h4>
            </div>
            <div class="card-body">
                @if($mostStockedProduct)
                    <p class="fw-bold">Product: {{ $mostStockedProduct->name }}</p>
                    <p class="fs-5 text-muted">Stock Quantity: {{ number_format($mostStockedProduct->quantity) }} units</p>
                @else
                    <p class="text-center">No data available for the most stocked product.</p>
                @endif
            </div>
        </div>

        <!-- Least Stocked Product Section -->
        <div class="card mb-4 shadow-sm border-0">
            <div class="card-header bg-danger text-white">
                <h4 class="mb-0">Least Stocked Product</h4>
            </div>
            <div class="card-body">
                @if($leastStockedProduct)
                    <p class="fw-bold">Product: {{ $leastStockedProduct->name }}</p>
                    <p class="fs-5 text-muted">Stock Quantity: {{ number_format($leastStockedProduct->quantity) }} units</p>
                @else
                    <p class="text-center">No data available for the least stocked product.</p>
                @endif
            </div>
        </div>

        <!-- Top 5 Low Stock Products Section -->
        <div class="card mb-4 shadow-sm border-0">
            <div class="card-header bg-warning text-dark">
                <h4 class="mb-0">Top 5 Low Stock Products (Stock < 10)</h4>
            </div>
            <div class="card-body">
                @if($lowStockProducts->isEmpty())
                    <p class="text-center">No low-stock products available.</p>
                @else
                    <ul class="list-group">
                        @foreach($lowStockProducts as $product)
                            <li class="list-group-item">
                                {{ $product->name }} - {{ number_format($product->quantity) }} units
                            </li>
                        @endforeach
                    </ul>
                    <form action="{{ route('stats.printLowStockPDF') }}" method="GET" class="mt-4">
                        <button type="submit" class="btn btn-primary">Print All Low Stock Products</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</x-layouts.app>
