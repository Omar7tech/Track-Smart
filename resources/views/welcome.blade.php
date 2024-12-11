<x-layouts.app>
    @auth
        <div>
            <div class="p-3 bg-light rounded shadow-sm">
                <div class="d-flex align-items-center">
                    <div class="me-3">
                        <i class="bi bi-person-circle" style="font-size: 3rem; color: #00d4ad;"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h3 class="fw-bold text-dark mb-1">Welcome Back, {{ auth()->user()->name }}</h3>
                        <p class="mb-0 text-muted">
                            Role: <span class="fw-semibold text-dark">{{ auth()->user()->role }}</span>
                        </p>
                    </div>
                    <div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-box-arrow-right"></i> Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="my-3">
                <x-accordion.main title="Change Password" id="changepass">
                    <form action="{{ route('changePassword') }}" method="POST" class="p-3">
                        @csrf
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Current Password</label>
                            <input type="password" name="current_password" id="current_password" class="form-control"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="new_password" class="form-label">New Password</label>
                            <input type="password" name="new_password" id="new_password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                            <input type="password" name="new_password_confirmation" id="new_password_confirmation"
                                class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Change Password</button>
                    </form>
                </x-accordion.main>
            </div>


            <div class="my-3">
                <x-accordion.main title="Support Information" id="support">
                    <div class="p-3">
                        <h5>Contact Support</h5>
                        <p>If you need assistance, please reach out to us using the information below:</p>
                        <ul class="list-unstyled">
                            <li><strong>Mobile:</strong> <a href="tel:+96170736618">+961 70/736-618</a></li>
                            <li><strong>Email:</strong> <a href="mailto:ahmad.dah@gmail.com">ahmad.dah@gmail.com</a></li>
                        </ul>
                    </div>
                </x-accordion.main>
            </div>
            <div class="d-flex justify-content-center mt-5">
                <img class="img-fluid" style="max-width: 200px" src="{{ asset('icons/grocery.png') }}" alt="">
            </div>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

        </div>
    @else
        <div class="container my-5">
            <div class="text-center mb-4">
                <div>
                    <h1>TrackSmart</h1>
                    <span>
                        <a href="{{ route('login') }}" class="btn btn-info">login</a>
                    </span>
                </div>
                <p class="lead">Business Performance Dashboard for Supermarkets</p>
                <img src="{{ asset('icons/favicon.jpeg') }}" class="img-fluid rounded" alt="...">
            </div>

            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    Student Information
                </div>
                <div class="card-body">
                    <p><strong>Student Name:</strong> Ahmad Dah</p>
                    <p><strong>Course:</strong> CSCI-4900 / Dr. Adelle Abdallah</p>
                </div>
            </div>

            <div class="card">
                <div class="card-header bg-success text-white">
                    System Description
                </div>
                <div class="card-body">
                    <h5 class="card-title">TrackSmart Overview</h5>
                    <p class="card-text">
                        "TrackSmart" is a web-based business performance dashboard tailored for small to medium-sized
                        supermarkets. It focuses on efficient
                        inventory management by categorizing products into main categories. Designed for business analysts,
                        the system enables users to
                        monitor key inventory metrics such as low stock, expiring products, and total stock value. It also
                        provides insights into sales
                        trends, top categories, and revenue through interactive visualizations like bar graphs and pie
                        charts.
                    </p>
                    <p class="card-text">
                        With features like category-specific inventory reports and detailed sales performance analysis,
                        TrackSmart empowers supermarkets
                        to optimize operations, reduce waste, and improve decision-making.
                    </p>
                </div>
            </div>

            <!-- Footer Section -->
            <footer class="text-center mt-4">
                <p class="text-muted">&copy; 2024 Ahmad Dah | CSCI-4900</p>
            </footer>
        </div>

    @endauth
</x-layouts.app>
