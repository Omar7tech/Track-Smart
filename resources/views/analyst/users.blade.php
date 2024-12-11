<x-layouts.app>
    <div class="container my-5">
        <h1 class="text-center mb-4 text-primary">User  Statistics</h1>

        <!-- Statistics Summary Cards -->
        <div class="row g-4">
            <!-- Total Users -->
            <div class="col-md-6 col-lg-6">
                <div class="card shadow border-0 text-center bg-light">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Total Users</h5>
                        <p class="display-4 fw-bold text-primary">{{ $totalUsers }}</p>
                    </div>
                </div>
            </div>

            <!-- Users by Role -->
            <div class="col-md-6 col-lg-6">
                <div class="card shadow border-0 bg-light">
                    <div class="card-body">
                        <h5 class="card-title">Users by Role</h5>
                        <canvas id="rolesChart" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Monthly Registration Trends -->
        <div class="card shadow border-0 mt-4 bg-light">
            <div class="card-body">
                <h5 class="card-title">Monthly Registration Trends</h5>
                <canvas id="registrationChart" height="100"></canvas>
            </div>
        </div>

        <!-- Latest Users -->
        <div class="card shadow border-0 mt-4 bg-light">
            <div class="card-body">
                <h5 class="card-title">Latest Users</h5>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-primary">
                            <tr>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Role</th>
                                <th>Joined At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($latestUsers as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ ucfirst($user->role) }}</td>
                                    <td>{{ $user->created_at->format('d M Y, H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Data for Users by Role
        const rolesData = @json($rolesCount);
        const rolesChart = new Chart(document.getElementById('rolesChart'), {
            type: 'doughnut',
            data: {
                labels: Object.keys(rolesData),
                datasets: [{
                    data: Object.values(rolesData),
                    backgroundColor: ['#007bff', '#28a745', '#ffc107', '#dc3545', '#17a2b8'],
                }],
            },
            options: {
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            font: {
                                size: 14,
                            },
                        },
                    },
                },
            },
        });

        // Data for Registration Trends
        const registrationData = @json($registrationTrends);
        const registrationChart = new Chart(document.getElementById('registrationChart'), {
            type: 'bar',
            data: {
                labels: Object.keys(registrationData),
                datasets: [{
                    label: 'Registrations',
                    data: Object.values(registrationData),
                    backgroundColor: 'rgba(0, 123, 255, 0.5)',
                    borderColor: '#007bff',
                    borderWidth: 1,
                }],
            },
            options: {
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Month',
                            font: {
                                size: 16,
                            },
                        },
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Users',
                            font: {
                                size: 16,
                            },
                        },
                        beginAtZero: true,
                    },
                },
                plugins: {
                    legend: {
                        display: false,
                    },
                },
            },
        });
    </script>
</x-layouts.app>
