<x-layouts.app>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white text-center">
                        <h3 class="mb-0">
                            <i class="bi bi-plus-circle me-2"></i> Add a New Category
                        </h3>
                    </div>
                    <div class="card-body">
                        <p class="text-muted text-center mb-4">
                            Create a new category to organize your products efficiently.
                        </p>
                        <form method="POST" action="{{ route('categories.store') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Category Name</label>
                                <input type="text" id="name" name="name" class="form-control"
                                       placeholder="Enter a unique category name"
                                       value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('categories.index') }}" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left me-2"></i> Back to Categories
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-circle me-2"></i> Save Category
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-layouts.app>
