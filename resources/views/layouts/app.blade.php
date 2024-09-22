<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LuxeLine</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <style>
        html, body {
            height: 100%;
            margin: 0;
        }

        body {
            display: flex;
            flex-direction: column;
        }

        .container-fluid {
            flex: 1; /* Allow the content to take up the available space */
        }

        .container {
            background-color: #fff;
            opacity: 1;
        }

        .card-link {
            transition: box-shadow 0.3s ease, transform 0.3s ease;
        }

        .card-link:hover {
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            transform: scale(1.05);
        }

        .card {
            background-color: #fff;
            border: 1px solid #ddd;
        }

        .card-body {
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        .image-container {
            width: 100%;
            padding-top: 100%;
            position: relative;
        }

        .profile-picture {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .mt-auto {
            margin-top: auto;
        }

        .navbar-toggler {
            margin-right: 1rem;
        }

        .dropdown-menu {
            right: 0;
            left: auto;
        }

        .price-container {
            min-height: 60px;
        }
    </style>
</head>

<body style="background-image: url('{{ asset('images/ll-background.png') }}'); background-position: center;">
    <nav class="navbar navbar-expand-lg navbar-dark bg-black sticky-top">
        <a class="navbar-brand ms-3" href="{{ url('/') }}">
            <img src="{{ asset('images/luxeline.png') }}" alt="LuxeLine Logo" height="40">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto me-2">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle btn btn-light" href="#" id="navbarDropdownMenuLink" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Manage
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li>
                            <a class="dropdown-item" href="{{ url('/suppliers') }}">Manage Suppliers</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ url('/categories') }}">Manage Categories</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-md-2 mt-2 ms-5">
                @yield('sidebar')
            </div>

            <div class="col-md-8">
                @yield('content')
            </div>
        </div>
    </div>

    <footer class="bg-black text-white text-center py-3 mt-5">
        <div class="container_footer">
            <p class="mb-0">&copy; 2024 LuxeLine. All Rights Reserved.</p>
        </div>
    </footer>
</body>

</html>
