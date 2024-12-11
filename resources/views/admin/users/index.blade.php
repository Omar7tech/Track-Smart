<x-layouts.app>
    <div class="container mt-4">
        <h1>Users</h1>
        <div class="row mb-3">
            <div class="col-md-6">
                <form method="GET" action="{{ route('users.index') }}" class="d-flex">
                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        class="form-control me-2"
                        placeholder="Search users by name or username"
                    >
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
            </div>
        </div>
        <x-tables.users :$users />
        <div class="mt-3">
            {{ $users->links('vendor.pagination.bootstrap-5') }}
        </div>
    </div>
</x-layouts.app>
