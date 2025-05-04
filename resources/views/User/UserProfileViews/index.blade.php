<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>User Profile - Amanda</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('css/User/userprofile.css') }}">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
  <!-- Header -->
  <header style="display: flex; justify-content: space-between; align-items: center; padding: 10px 20px; background-color: white;">
    <a href="{{ route('views.Homepage') }}" style="text-decoration: none;">
      <h1 style="color: #8CBF1C; font-weight: bold; margin: 0; font-size: 24px;">PSYLOGRAPHY</h1>
    </a>
    <nav style="display: flex; align-items: center;">
      <ul style="display: flex; list-style: none; margin: 0; padding: 0;">
        <li style="margin: 0 15px;"><a href="{{ route('views.journal') }}" style="text-decoration: none; color: #FFC107;">Journal</a></li>
        <li style="margin: 0 15px;"><a href="#" style="text-decoration: none; color: #333;">Appointment</a></li>
        <li style="margin: 0 15px;"><a href="#" style="text-decoration: none; color: #333;">Blog</a></li>
        <li style="margin: 0 15px;"><a href="#" style="text-decoration: none; color: #333;">Chat</a></li>
      </ul>
      <a href="{{ route('user.profile') }}">
        <div style="width: 40px; height: 40px; background-color: #8CBF1C; border-radius: 50%; display: flex; justify-content: center; align-items: center; margin-left: 20px;">
          <i class="fas fa-user" style="color: white;"></i>
        </div>
      </a>
    </nav>
  </header>

  <div class="profile-layout">
    <aside class="sidebar">
      <h3>My Account</h3>
      <ul>
        <li><a href="{{ route('user.profile.edit') }}"><i class="fas fa-user-edit"></i> Edit Profile</a></li>
        <li><a href="#"><i class="fas fa-upload"></i> Upload Photo</a></li>
        <li><a href="#"><i class="fas fa-history"></i> Activity History</a></li>
      </ul>
    </aside>
    
  <main>
    <div class="profile-container">
      <div class="profile-header">
        <h2>Welcome, {{ $firstName }}</h2>
        <p id="current-date">Loading date...</p>
      </div>

      <div class="profile-body">
        <div class="profile-info">
          @if($user->profile_picture && file_exists(public_path('images/' . $user->profile_picture)))
            <img src="{{ asset('images/' . $user->profile_picture) }}" alt="profile">
          @else
            <img src="{{ asset('images/profile.png') }}" alt="profile">
          @endif
          <div>
            <h3>{{ $user->fullname }}</h3>
            <p><i class="fas fa-envelope"></i> {{ $user->email }}</p>
          </div>
          <a href="{{ route('user.profile.edit') }}" class="edit-button"><i class="fas fa-pen"></i> Edit</a>
        </div>

        <div class="profile-form">
          <div>
            <label><i class="fas fa-user"></i> First Name</label>
            <div class="readonly-box">{{ $firstName }}</div>
          </div>
          <div>
            <label><i class="fas fa-user"></i> Last Name</label>
            <div class="readonly-box">{{ $lastName }}</div>
          </div>
          <div>
            <label><i class="fas fa-at"></i> Username</label>
            <div class="readonly-box">{{ $user->username }}</div>
          </div>
          <div>
            <label><i class="fas fa-venus-mars"></i> Gender</label>
            <div class="readonly-box">{{ ucfirst($user->gender) }}</div>
          </div>
        </div>

        <hr style="margin-top: 2rem; margin-bottom: 2rem;">

        <div class="email-section">
          <h4><i class="fas fa-envelope"></i> My Email Address</h4>
          <div class="email-entry">
            <div class="email-icon">
              <i class="fas fa-envelope"></i>
            </div>
            <div>
              <p>{{ $user->email }}</p>
              <small><i class="fas fa-clock"></i> {{ $user->created_at ? $user->created_at->diffForHumans() : '1 month ago' }}</small>
            </div>
          </div>

          <button class="add-email-btn"><i class="fas fa-plus"></i> Add Email Address</button>
          <a href="{{ route('views.Homepage') }}" class="back-btn"><i class="fas fa-home"></i> Back to Main Page</a>
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
