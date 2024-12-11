<x-layouts.app>
    <div class="container mt-4">
        <div class="mb-4">
            <h2 class="fw-bold">Sales History</h2>
            <p class="text-muted">{{ Auth::user()->name }}. Here are your recorded sales.</p>
        </div>
        <!-- Date Filter Form -->
        <div class="mb-4">
            <form method="GET" action="{{ route('sales.index') }}" class="d-flex justify-content-start gap-3">
                <input type="date" name="start_date" class="form-control form-control-sm" placeholder="Start Date"
                    value="{{ request()->get('start_date') }}" style="width: 150px;">
                <input type="date" name="end_date" class="form-control form-control-sm" placeholder="End Date"
                    value="{{ request()->get('end_date') }}" style="width: 150px;">
                <button type="submit" class="btn btn-primary btn-sm">
                    <i class="bi bi-filter"></i> Filter by Date
                </button>
                <a href="{{ route('sales.index') }}" class="btn btn-secondary btn-sm">
                    <i class="bi bi-x-circle"></i> Clear Filters
                </a>
            </form>
        </div>


        <div class="table-responsive">
            <table class="table table-hover table-bordered table-sm align-middle shadow-sm">
                <thead class="table-light">
                    <tr>
                        <th scope="col" class="text-center">Barcode</th>
                        <th scope="col" class="text-center">Product Name</th>
                        <th scope="col" class="text-center">Quantity</th>
                        <th scope="col" class="text-center">Total Price</th>
                        <th scope="col" class="text-center">Date</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sales as $sale)
                        <tr>
                            <td class="text-center">{{ $sale->product->barcode }}</td>
                            <td class="text-center">{{ $sale->product->name }}</td>
                            <td class="text-center">{{ $sale->quantity }}</td>
                            <td class="text-center text-success fw-bold">${{ number_format($sale->total / 100, 2, '.', ',') }}</td>
                            <td class="text-center">{{ $sale->created_at->format('d M Y, h:i A') }}</td>
                            <td class="text-center">
                                <a href="{{ route('sales.printSale', $sale->id) }}"
                                    class="btn btn-outline-danger btn-sm d-flex align-items-center justify-content-center gap-1"
                                    role="button" aria-label="Print Sale PDF">
                                        <i class="bi bi-file-earmark-pdf fs-5"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="my-3">
            {{ $sales->links('vendor.pagination.bootstrap-5') }}
        </div>

        <div class="mt-4">
            <h4 class="fw-bold">Sales Summary</h4>
            <div class="row">
                <div class="col-md-4 mb-2">
                    <div class="p-3 bg-light border rounded text-center">
                        <h5>Total Sales</h5>
                        <p class="fw-bold">{{ $totalSales }}</p>
                    </div>
                </div>
                <div class="col-md-4 mb-2">
                    <div class="p-3 bg-light border rounded text-center">
                        <h5>Total Revenue</h5>
                        <p class="fw-bold">${{ number_format($totalRevenue / 100, 2, '.', ',') }}</p>
                    </div>
                </div>
                <div class="col-md-4 mb-2">
                    <div class="p-3 bg-light border rounded text-center">
                        <h5>Average Sale Value</h5>
                        <p class="fw-bold">${{ number_format($averageSaleValue / 100, 2, '.', ',') }}</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-layouts.app>
