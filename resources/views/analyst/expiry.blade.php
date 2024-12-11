<x-layouts.app>
    <div class="container my-5">
        <h1 class="text-center mb-4"><i class="bi bi-calendar-x-fill text-danger"></i> Expiry Statistics</h1>

        <!-- Search and Filter Section -->
        <form method="GET" action="{{ route('stats.expiry') }}" class="mb-4">
            <div class="row g-3 align-items-center">
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-calendar-event"></i></span>
                        <input
                            type="date"
                            name="expiry_date"
                            class="form-control"
                            value="{{ request('expiry_date') }}"
                            placeholder="Filter by Expiry Date">
                    </div>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-funnel"></i> Filter
                    </button>
                </div>
                <div class="col-md-2">
                    <a href="{{ route('stats.expiry') }}" class="btn btn-secondary w-100">
                        <i class="bi bi-arrow-repeat"></i> Reset
                    </a>
                </div>
            </div>
        </form>

        <!-- Expiry Summary Section -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card border-danger shadow-sm">
                    <div class="card-header bg-danger text-white d-flex align-items-center">
                        <i class="bi bi-exclamation-octagon-fill me-2"></i>
                        <h5 class="mb-0">Total Expired Products</h5>
                    </div>
                    <div class="card-body text-center">
                        <p class="fs-3 fw-bold">{{ $totalExpired }}</p>
                        <p class="text-muted">products have expired</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-warning shadow-sm">
                    <div class="card-header bg-warning text-dark d-flex align-items-center">
                        <i class="bi bi-clock-fill me-2"></i>
                        <h5 class="mb-0">Expiring Soon (Next 30 Days)</h5>
                    </div>
                    <div class="card-body text-center">
                        <p class="fs-3 fw-bold">{{ $soonToExpireCount }}</p>
                        <p class="text-muted">products are expiring soon</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Expired Products List -->
        <div class="card mb-4 shadow-sm border-0">
            <div class="card-header bg-danger text-white d-flex align-items-center">
                <i class="bi bi-x-circle-fill me-2"></i>
                <h5 class="mb-0">Expired Products</h5>
            </div>
            <div class="card-body">
                @if($expiredProducts->isEmpty())
                    <p class="text-center text-muted"><i class="bi bi-emoji-frown"></i> No expired products found.</p>
                @else
                    <table class="table table-hover">
                        <thead class="table-danger">
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
                    <form action="{{ route('stats.printExpiredProductsPDF') }}" method="GET" class="mt-4 text-end">
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-file-earmark-pdf-fill"></i> Print All Expired Products
                        </button>
                    </form>
                @endif
            </div>
        </div>

        <!-- Soon-To-Expire Products List -->
        <div class="card mb-4 shadow-sm border-0">
            <div class="card-header bg-warning text-dark d-flex align-items-center">
                <i class="bi bi-clock-history me-2"></i>
                <h5 class="mb-0">Products Expiring Soon (Next 30 Days)</h5>
            </div>
            <div class="card-body">
                @if($soonToExpireProducts->isEmpty())
                    <p class="text-center text-muted"><i class="bi bi-emoji-smile"></i> No products are expiring soon.</p>
                @else
                    <ul class="list-group">
                        @foreach($soonToExpireProducts as $product)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>{{ $product->name }} , {{ $product->barcode }}</span>
                                <span class="badge bg-warning text-dark">
                                    Expiry: {{ $product->expiry_date->format('Y-m-d') }}
                                </span>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
</x-layouts.app>
