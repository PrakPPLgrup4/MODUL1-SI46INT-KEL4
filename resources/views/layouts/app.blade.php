<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Psylography</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- CSS --}}
    <link href="{{ asset('css/navStyle.css') }}" rel="stylesheet">
</head>
<body>
    @include('partials.navbar')

    <div class="container mt-4">
        @yield('content')
    </div>

    <script src="{{ asset('js/index.js') }}"></script>
</body>
</html>
