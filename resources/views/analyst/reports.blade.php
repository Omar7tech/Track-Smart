<x-layouts.app>
    <div class="container my-5">
        <h1 class="text-center mb-4 text-primary">Reports</h1>

        <div class="card shadow-lg border-0 rounded">
            <div class="card-body">
                <h4 class="card-title text-center mb-3">Generate Reports</h4>
                <p class="card-text text-center mb-4">Select a report to generate or download:</p>

                <div class="text-center">
                    <div class="dropdown d-inline-block">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="reportsDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-file-alt"></i> Select Report
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="reportsDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('stats.printLowStockPDF') }}" target="_blank">
                                    <i class="fas fa-boxes"></i> Low Stock Products
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('stats.printExpiredProductsPDF') }}" target="_blank">
                                    <i class="fas fa-calendar-times"></i> Expired Products
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="mt-3">
                        <a href="{{ route('stats.reports.comprehensive') }}" class="btn btn-success">
                            <i class="fas fa-download"></i> Download Comprehensive Report
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>

<style>
    body {
        background-color: #f8f9fa;
    }

    .card {
        border-radius: 1rem;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
    }

    .btn-success:hover {
        background-color: #218838;
        border-color: #1e7e34;
    }

    .dropdown-menu {
        border-radius: 0.5rem;
    }

    .dropdown-item:hover {
        background-color: #e9ecef;
    }
</style>
