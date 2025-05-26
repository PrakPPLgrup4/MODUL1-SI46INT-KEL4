<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="{{ asset('css/Admin/index.css') }}">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>

  <header>
    <img class="logo" src="{{ asset('images/logo.png') }}" alt="Psylography Logo">

    <a href="{{ route('views.Homepage') }}">
        <img class="logo" src="{{ asset('images/logout.png') }}" alt="logout">
    </a>
  </header>

  <div class="container">
    @include('admin.sidebar')

    <main class="main-content">
      @yield('content')
    </main>
  </div>

</body>
</html>
