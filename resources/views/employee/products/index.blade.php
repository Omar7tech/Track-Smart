<x-layouts.app>
    <div class="container mt-2">
        <div class="mb-2 fw-bold fs-3">
            @if (request()->get('search'))
                <span class="text-muted"> Search results for: "{{ request()->get('search') }}"</span>
            @endif
            @if (request()->get('category'))
                <span class="text-muted"> Category: "{{ $categories->find(request()->get('category'))->name }}"</span>
            @endif
        </div>
        <!-- Search and Filter -->
        <div class="mb-4 d-flex justify-content-between align-items-center">
            <form method="GET" action="{{ route('products.index') }}" class="d-flex">
                <input type="text" name="search" class="form-control me-2" placeholder="Search products"
                    value="{{ request()->get('search') }}">
                <button type="submit" class="btn btn-primary">Search</button>
            </form>

            <div>
                <a href="{{ route('products.index') }}" class="btn btn-danger">Clear Filter</a>
            </div>
            <form method="GET" action="{{ route('products.index') }}" class="d-flex">
                <select name="category" class="form-select me-2">
                    <option value="">Select Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ request()->get('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-secondary">Filter</button>
            </form>
        </div>

        <!-- Products Table -->
        <x-tables.products :$products />

        <!-- Pagination -->
        <div>
            {{ $products->appends(['search' => request()->get('search'), 'category' => request()->get('category')])->links('vendor.pagination.bootstrap-5') }}
        </div>


        <div class="toast-container position-fixed top-0 end-0 p-3">
            @if ($errors->any())
                <div class="toast align-items-center text-bg-danger border-0 show" role="alert" aria-live="assertive"
                    aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body">
                            {{ $errors->first() }}
                        </div>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast"
                            aria-label="Close"></button>
                    </div>
                </div>
            @endif
        </div>


    </div>
</x-layouts.app>
