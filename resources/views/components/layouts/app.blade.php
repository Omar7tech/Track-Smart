<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Track Smart</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" type="image/x-icon" href="{{ asset('icons/favicon.jpeg') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        /* Base styles for nav-link */
        .nav-link {
            display: flex;
            align-items: center;
            padding: 8px 16px;
            border-radius: 8px;
            color: #333;
            font-weight: 500;
            text-transform: uppercase;
            font-size: 14px;
            text-decoration: none;
            transition: background 0.3s ease, color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
            background: linear-gradient(90deg, #ffffff, #e0f7fa);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        /* Hover effect */
        .nav-link:hover {
            background: linear-gradient(90deg, #00b08a, #00b08a52);
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }

        /* Active state */
        .nav-link.active {
            background: #00b08a;
            color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Additional styling for inner span (icon spacing) */
        .nav-link span {
            margin-left: 8px;
            transition: transform 0.3s ease-in-out;
        }

        /* Optional: Add a focus effect */
        .nav-link:focus-visible {
            outline: none;
            box-shadow: 0 0 0 3px rgba(0, 176, 138, 0.5);
        }
    </style>

</head>

<body>
    @auth
        <div class="d-flex">
            <x-nav.main />
            <div class="flex-grow-1 p-4" style="max-height: 100vh ; oveRflow-y: auto;">
                {{ $slot }}

            </div>
        </div>
    @else
        {{ $slot }}
    @endauth
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
