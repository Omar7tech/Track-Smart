<div class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="width: 260px; height: 100vh;">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
        <svg class="bi me-2" width="40" height="32">
            <use xlink:href="#bootstrap" />
        </svg>
        <style>
            .track-smart-container {
                display: flex;
                align-items: center;
                font-size: 1.25rem;
                font-weight: bold;
                color: #00d4ad;
                transition: transform 0.3s ease-in-out, color 0.3s ease-in-out;
            }

            .track-smart-container:hover {
                transform: scale(1.1) rotate(-3deg);

                color: #00d4ad;
                /* Darker shade for hover effect */
            }

            .track-smart-container i {
                font-size: 1.5rem;
                margin-right: 0.5rem;
                transition: transform 0.3s ease-in-out;
            }

            .track-smart-container:hover i {
                transform: rotate(15deg);
                color: #00d4ad;
                /* Change color when hovered */
            }
        </style>

        <span class="track-smart-container">
            <i class="bi bi-bar-chart-line me-2"></i>
            <span style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
                Track Smart
            </span>
        </span>
    </a>
    <hr>
    @can('analyst')
        <span class="fw-bold text-center">
            <i class="bi bi-bar-chart-steps"></i>
            STATISTICS
        </span>
        <hr>
    @endcan
    <ul class="nav nav-pills flex-column mb-auto" style="overflow: scroll">
        <x-nav.links />
    </ul>
</div>
