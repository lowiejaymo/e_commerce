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


    <style>
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
    </style>
</head>

<body style="background-image: url('{{ asset('images/ll-background.png') }}'); 
        background-position: center; ">
    <nav class="navbar navbar-expand-lg navbar-dark bg-black justify-content-center sticky-top">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('images/luxeline.png') }}" alt="LuxeLine Logo" height="40">
        </a>
    </nav>
    <div class="container mt-4">
        @yield('content')
    </div>
</body>

</html>