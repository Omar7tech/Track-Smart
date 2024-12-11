<x-layouts.app>
    <div class="container">
        <h1 class="my-4">Manage Stock</h1>

        <!-- Search Bar -->
        <form method="GET" action="{{ route('stock.index') }}" class="mb-4">
            <input type="text" name="search" class="form-control" placeholder="Search by product name or barcode"
                value="{{ request('search') }}">
        </form>

        <div class="row">
            @foreach($products as $product)
            <div class="col-md-3 mb-4">
                <div class="card border-{{ $product->quantity > 10 ? 'success' : ($product->quantity > 0 ? 'warning' : 'danger') }} shadow-lg rounded">
                    <div class="card-body text-center">
                        <h5 class="card-title text-{{ $product->quantity > 10 ? 'success' : ($product->quantity > 0 ? 'warning' : 'danger') }} fw-bold">
                            {{ $product->name }}
                        </h5>
                        <p class="card-text"><span class="fw-bold text-muted">{{ $product->barcode }}</span></p>
                        <p class="card-text display-6 fw-bold text-{{ $product->quantity > 10 ? 'success' : ($product->quantity > 0 ? 'warning' : 'danger') }}">
                            {{ $product->quantity }}
                        </p>

                        <!-- Buttons to open modals -->
                        <div class="d-flex justify-content-center mt-3">
                            <div class="btn-group" role="group">
                                <button class="btn btn-primary btn-sm d-flex align-items-center gap-1 {{ $product->quantity >= 100 ? 'disabled' : '' }}"
                                        data-bs-toggle="modal" data-bs-target="#addStockModal{{ $product->id }}">
                                    <i class="bi bi-plus-circle"></i>
                                </button>
                                <button class="btn btn-info btn-sm d-flex align-items-center gap-1 {{ $product->quantity <= 0 ? 'disabled' : '' }}"
                                        data-bs-toggle="modal" data-bs-target="#minusStockModal{{ $product->id }}">
                                    <i class="bi bi-dash-circle"></i>
                                </button>
                                <button class="btn btn-danger btn-sm d-flex align-items-center gap-1"
                                        data-bs-toggle="modal" data-bs-target="#resetStockModal{{ $product->id }}">
                                    <i class="bi bi-arrow-counterclockwise"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Add Stock Modal -->
            <div class="modal fade" id="addStockModal{{ $product->id }}" tabindex="-1">
                <div class="modal-dialog">
                    <form method="POST" action="{{ route('stock.add', $product) }}">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add Stock for {{ $product->name }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <input type="number" name="quantity" class="form-control" placeholder="Enter quantity to add" required>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Add</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Minus Stock Modal -->
            <div class="modal fade" id="minusStockModal{{ $product->id }}" tabindex="-1">
                <div class="modal-dialog">
                    <form method="POST" action="{{ route('stock.minus', $product) }}">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Reduce Stock for {{ $product->name }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <input type="number" name="quantity" class="form-control" placeholder="Enter quantity to subtract" required>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-warning">Minus</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Reset Stock Modal -->
            <div class="modal fade" id="resetStockModal{{ $product->id }}" tabindex="-1">
                <div class="modal-dialog">
                    <form method="POST" action="{{ route('stock.reset', $product) }}">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Reset Stock for {{ $product->name }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to reset stock to zero?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-danger">Reset</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endforeach

        </div>

        {{ $products->links('vendor.pagination.bootstrap-5') }} <!-- Pagination links -->
    </div>
</x-layouts.app>
