<x-layouts.app>
    <div class="container mt-2">
        <h1 class="mb-5 text-center" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #00b08a; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);">
            <i class="bi bi-folder-plus"></i> Manage Categories
        </h1>


        <!-- Search and Add Category -->
        <div class="d-flex justify-content-between align-items-center mb-5">
            <!-- Search Form -->
            <div class="col-md-6">
                <form method="GET" action="{{ route('categories.index') }}" class="input-group">
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                        placeholder="Search categories by name">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-search"></i> Search
                    </button>
                </form>
            </div>
            <!-- Add Category Button -->
            <a href="{{ route('categories.create') }}" class="btn btn-success d-flex align-items-center">
                <i class="bi bi-plus me-2"></i> Add Category
            </a>
        </div>

        <!-- Categories Grid -->
        <div class="row">
            @forelse ($categories as $category)
                <div class="col-md-4">
                    <div class="card mb-4 shadow">
                        <div class="card-body">
                            <h5 class="card-title d-flex justify-content-between align-items-center">
                                <span class="fw-bold">{{ $category->name }}</span>
                                @php
                                    $products_count =  $category->products->count();
                                @endphp
                                <span class="badge {{ $products_count ? 'bg-primary' : 'bg-danger'}}">{{ $products_count }}</span>
                            </h5>
                            <p class="card-text text-muted">
                                <small>Created at: {{ $category->created_at->format('d M Y') }}</small>
                                <br>
                                <small>Updated at: {{ $category->updated_at->format('d M Y') }}</small>
                            </p>

                            <div class="d-flex justify-content-between align-items-center">
                                <!-- View Products Button -->
                                <a href="{{ route('products.index', ['category' => $category->id]) }}" class="btn btn-outline-success btn-sm d-flex align-items-center">
                                    <i class="bi bi-box-seam me-2"></i> View Products
                                </a>
                                <!-- Actions Dropdown -->
                                <div class="dropdown">
                                    <button class="btn btn-outline-secondary dropdown-toggle btn-sm" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        Actions
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="{{ route('categories.edit', $category) }}" class="dropdown-item">
                                                <i class="bi bi-pencil-square me-2"></i> Edit
                                            </a>
                                        </li>
                                        <li>
                                            <form method="POST" action="{{ route('categories.destroy', $category) }}"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger"
                                                    onclick="return confirm('Are you sure you want to delete this category?')">
                                                    <i class="bi bi-trash-fill me-2"></i> Delete
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center text-muted">No categories found. Try searching or add a new category!</p>
            @endforelse
        </div>

        <!-- Pagination Links -->
        <div class="mt-5">
            {{ $categories->links('vendor.pagination.bootstrap-5') }}
        </div>
    </div>
</x-layouts.app>
