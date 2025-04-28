<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>User Profile - Amanda</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('css/User/userprofile.css') }}">
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>
<body>
  <!-- 80% -->
  {{-- HEADER --}}
  <header>
    <a href="{{ route('views.Homepage') }}">
      <img class="logo" src="{{ asset('images/logo.png') }}" alt="logo">
    </a>
    <nav>
      <ul class="nav_links">
        <li><a style="color:#FFDB99" href="{{ route('views.journal') }}">Journal</a></li>
        <li><a href="#">Appointment</a></li>
        <li><a href="#">Blog</a></li>
        <li><a href="#">Chat</a></li>
      </ul>
    </nav>
    <img style="width:50px; margin-left:15px;" src="{{ asset('images/profile.png') }}" alt="profile">
  </header>

  <div class="profile-layout">
    <aside class="sidebar">
      <h3>My Account</h3>
      <ul>
        <li><a href="{{ route('user.profile.edit') }}">Edit Profile</a></li>
        <li><a href="#">Upload Photo</a></li>
        <li><a href="#">Activity History</a></li>
      </ul>
    </aside>
    
  <main>
    <div class="profile-container">
      <div class="profile-header">
        <h2>Welcome, Amanda</h2>
        <p id="current-date">Loading date...</p>
      </div>

      <div class="profile-body">
        <div class="profile-info">
          <img src="{{ asset('images/profile.png') }}" alt="profile">
          <div>
            <h3>Amanda Lopez</h3>
            <p>amandalopez@gmail.com</p>
          </div>
          <a href="{{ route('user.profile.edit') }}" class="edit-button">Edit</a>
        </div>

        <div class="profile-form">
          <div>
            <label>First Name</label>
            <div class="readonly-box">Amanda</div>
          </div>
          <div>
            <label>Last Name</label>
            <div class="readonly-box">Lopez</div>
          </div>
          <div>
            <label>Username</label>
            <div class="readonly-box">amanda12</div>
          </div>
          <div>
            <label>Gender</label>
            <div class="readonly-box">Female</div>
          </div>
        </div>

        <hr style="margin-top: 2rem; margin-bottom: 2rem;">

        <div class="email-section">
          <h4>My Email Address</h4>
          <div class="email-entry">
            <img src="{{ asset('images/profile.png') }}" alt="email">
            <div>
              <p>amandalopez@gmail.com</p>
              <small>1 month ago</small>
            </div>
          </div>

          <button class="add-email-btn">+ Add Email Address</button>
          <a href="{{ route('views.Homepage') }}" class="back-btn">Back to Main Page</a>
        </div>
      </div>
    </div>
  </main>

  <script>
    const currentDate = new Date();
    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    document.getElementById("current-date").textContent = currentDate.toLocaleDateString('en-US', options);
  </script>

</body>
</html>
