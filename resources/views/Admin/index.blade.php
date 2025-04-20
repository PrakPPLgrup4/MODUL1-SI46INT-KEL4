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

    <a href="{{ route('views.Homepage') }}"> <!-- harus diubah -->
        <img class="logo" src="{{ asset('images/logout.png') }}" alt="logout">
    </a>
  </header>

  <div class="container">
    <aside class="sidebar">
      <ul>
        <li><a href="#">User Account</a></li>
        <li><a href="#">Psychiatric Profile</a></li>
        <li><a href="#">Symptomps</a></li>
      </ul>
    </aside>

    <main class="main-content">
      <div class="welcome-image">
        <img src="{{ asset('images/adminwelcome.png') }}" alt="Welcome Admin" class="welcome-image">
      </div>
    </main>
  </div>

</body>
</html>
