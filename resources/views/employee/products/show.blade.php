<x-layouts.app>
    <div class="container my-4">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-dark text-white">
                <h4 class="mb-0">Product Details</h4>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <h5 class="text-muted">Product Name</h5>
                        <p class="fw-bold fs-5">{{ $product->name }}</p>
                    </div>
                    <div class="col-md-6">
                        <h5 class="text-muted">Category</h5>
                        <p class="fw-bold">
                            @if ($product->category && $product->category->name)
                                <a href="{{ route('products.index', ['category' => $product->category->id]) }}"
                                   class="text-decoration-none text-dark bg-light px-2 py-1 rounded border">
                                    {{ $product->category->name }}
                                </a>
                            @else
                                <span class="text-muted">Uncategorized</span>
                            @endif
                        </p>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <h5 class="text-muted">Barcode</h5>
                        <p class="fw-bold">
                            @if ($product->barcode)
                                <span class="badge bg-info text-dark">{{ $product->barcode }}</span>
                            @else
                                <span class="text-muted">N/A</span>
                            @endif
                        </p>
                    </div>
                    <div class="col-md-6">
                        <h5 class="text-muted">Quantity</h5>
                        <p class="fw-bold text-{{ $product->quantity > 10 ? 'success' : ($product->quantity > 0 ? 'warning' : 'danger') }}">
                            {{ $product->quantity }}
                        </p>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <h5 class="text-muted">Expiry Date</h5>
                        <p>
                            @php
                                $days = $product->expiry_date
                                    ? (int) \Carbon\Carbon::now()->diffInDays($product->expiry_date, false)
                                    : null;
                            @endphp
                            @if ($product->expiry_date)
                                <span class="fw-bold text-{{ $days > 0 ? 'success' : ($days == 0 ? 'warning' : 'danger') }}">
                                    {{ $product->expiry_date->format('d M Y') }}
                                </span>
                                <br>
                                <small class="text-muted">
                                    @if ($days > 0)
                                        {{ $days }} days until expiry
                                    @elseif ($days == 0)
                                        Expiring today
                                    @else
                                        Expired {{ abs($days) }} days ago
                                    @endif
                                </small>
                            @else
                                <span class="text-muted">N/A</span>
                            @endif
                        </p>
                    </div>
                    <div class="col-md-6">
                        <h5 class="text-muted">Price</h5>
                        <p class="fw-bold text-success fs-5">
                            <i class="bi bi-currency-dollar"></i>
                            {{ number_format($product->price / 100, 2, '.', ',') }}
                        </p>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <h5 class="text-muted">Cost</h5>
                        <p class="fw-bold">
                            <i class="bi bi-currency-dollar"></i>
                            {{ number_format($product->cost / 100, 2, '.', ',') }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Back to Products</a>
                <a href="{{ route('products.edit', $product) }}" class="btn btn-outline-warning">Edit</a>
                <form method="POST" action="{{ route('products.destroy', $product) }}" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger"
                            onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                </form>
            </div>
        </div>
    </div>

</x-layouts.app>
