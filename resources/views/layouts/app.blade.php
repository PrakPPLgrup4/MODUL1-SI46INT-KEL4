<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Psylography')</title>

    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('css/navStyle.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mainSymptomStyle.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;1,400;1,700&family=Poppins:ital,wght@0,100;0,200;0,300;0,500&display=swap" rel="stylesheet">
</head>
<body>

    {{-- Navbar --}}
    @include('partials.navbar')

    {{-- Page content --}}
    <main>
        @yield('content')
    </main>

    {{-- JS --}}
    <script src="{{ asset('js/navIndex.js') }}" defer></script>

</body>
</html>