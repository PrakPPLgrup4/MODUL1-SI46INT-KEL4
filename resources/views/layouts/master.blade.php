<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title', 'Psylography')</title>
    <meta name="description" content="@yield('meta_description', 'Psylography - Mental Health Support Platform')">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <!-- Page Specific CSS -->
    @yield('styles')
    
    <style>
      body {
        font-family: 'Poppins', sans-serif;
        background-color: #f8f9fa;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        margin: 0;
        padding: 0;
      }
      
      main {
        flex: 1;
      }
      
      footer {
        margin-top: auto;
      }
      
      .blog-post-content {
        font-family: 'Merriweather', serif;
        line-height: 1.8;
      }
      
      /* Consistent Header Styling */
      header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 20px;
        background-color: white;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1000;
      }
      
      /* Add padding to body to prevent content from being hidden under the fixed header */
      body {
        padding-top: 60px;
      }
      
      .logo-link {
        text-decoration: none;
      }
      
      .logo-text {
        color: #8CBF1C;
        font-weight: bold;
        margin: 0;
        font-size: 24px;
      }
      
      nav ul.nav_links {
        display: flex;
        list-style: none;
        margin: 0;
        padding: 0;
      }
      
      nav ul.nav_links li {
        margin: 0 15px;
      }
      
      nav ul.nav_links li a {
        text-decoration: none;
        color: #333;
        font-weight: 500;
        transition: color 0.3s ease;
      }
      
      nav ul.nav_links li a:hover {
        color: #8CBF1C;
      }
      
      nav ul.nav_links li a.active-nav {
        color: #FFDB99;
      }
      
      .profile-icon {
        width: 40px;
        height: 40px;
        background-color: #8CBF1C;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-left: 20px;
        cursor: pointer;
      }
      
      .profile-icon i {
        color: white;
      }
      .text-primary {
          color: #8CBF1C !important;
      }
      .bg-primary {
          background-color: #8CBF1C !important;
      }
      .btn-primary {
          background-color: #8CBF1C !important;
          border-color: #8CBF1C !important;
      }
      .btn-primary:hover {
          background-color: #8CBF1C !important;
          border-color: #8CBF1C !important;
      }
    </style>
  </head>
  <body>
    <!-- Header with Consistent Styling -->
    <header>
      <a href="{{ route('views.Homepage') }}" class="logo-link">
        <h1 class="logo-text">PSYLOGRAPHY</h1>
      </a>
      <nav style="display: flex; align-items: center;">
        <ul class="nav_links">
          <li><a href="{{ route('views.journal') }}" class="{{ request()->routeIs('views.journal*') ? 'active-nav' : '' }}">Journal</a></li>
          <li><a href="{{ route('appointments.index') }}" class="{{ request()->routeIs('appointments.*') ? 'active-nav' : '' }}">Appointment</a></li>
          <li><a >Blog</a></li>
          <li><a href="#" class="{{ request()->routeIs('chat.*') ? 'active-nav' : '' }}">Chat</a></li>
        </ul>
        <a href="{{ route('user.profile') }}" title="View Profile">
          <div class="profile-icon">
            <i class="fas fa-user"></i>
          </div>
        </a>
      </nav>
    </header>
    
    <!-- Main Content -->
    <main>
      @yield('content')
    </main>
    
    
    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Page Specific Scripts -->
    @yield('scripts')
  </body>
</html>
