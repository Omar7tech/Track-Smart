    <x-layouts.app>
        <div class="container mt-5">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-6">
                    <img src="{{ asset('icons/favicon.jpeg') }}" alt="Login Image" class="img-fluid rounded">
                </div>
                <div class="col-md-6">
                    <div class="card shadow p-4">
                        <h3 class="text-center mb-4">Login</h3>
                        <form method="POST" action="{{ route('loginPost') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username"
                                    placeholder="Enter your username" name="username">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password"
                                    placeholder="Enter your password" name="password">
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                        </form>
                        @if (session('error'))
                            <div class="alert alert-danger mt-5" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </x-layouts.app>
