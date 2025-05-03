<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Psylography</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Optional Custom Styling --}}
    <style>
        body {
            background-color: #f5f5f5;
        }

        .form-container {
            background-color: white;
            padding: 2rem;
            border-radius: 1rem;
        }

        .btn-green {
            background-color: #28a745;
            color: white;
        }

        .btn-green:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="container">
        @yield('content')
    </div>

    {{-- Bootstrap JS (Optional if you need modals, alerts, etc.) --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
