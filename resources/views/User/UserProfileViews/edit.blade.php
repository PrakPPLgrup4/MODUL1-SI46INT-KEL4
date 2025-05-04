<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>User Profile - Amanda</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('css/User/userprofile.css') }}">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
        <!-- Display success message if any -->
        @if(session('success'))
          <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        @endif
      </div>
        
      <div class="profile-body">
        <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
          @csrf
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
            <a href="#" class="edit-button" id="show-upload-btn"><i class="fas fa-pen"></i> Edit</a>
            <div id="upload-controls" style="display: none; margin-top: 15px;">
              <label class="btn btn-primary upload-btn">
                <i class="fas fa-upload"></i> Upload new photo
                <input type="file" name="profile_picture" class="account-settings-fileinput" accept="image/jpeg,image/png,image/gif" style="display: none;">
              </label>
            </div>
          </div>

          <div class="profile-form">
            <div>
              <label><i class="fas fa-user"></i> First Name</label>
              <input type="text" name="firstname" class="form-control" value="{{ $firstName }}">
              @error('firstname')
                <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
            <div>
              <label><i class="fas fa-user"></i> Last Name</label>
              <input type="text" name="lastname" class="form-control" value="{{ $lastName }}">
              @error('lastname')
                <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
            <div>
              <label><i class="fas fa-at"></i> Username</label>
              <input type="text" name="username" class="form-control" value="{{ $user->username }}">
              @error('username')
                <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
            <div>
              <label><i class="fas fa-venus-mars"></i> Gender</label>
              <select name="gender" class="form-control">
                <option value="">Select Gender</option>
                <option value="female" {{ $user->gender == 'female' ? 'selected' : '' }}>Female</option>
                <option value="male" {{ $user->gender == 'male' ? 'selected' : '' }}>Male</option>
                <option value="other" {{ $user->gender == 'other' ? 'selected' : '' }}>Other</option>
              </select>
              @error('gender')
                <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
            <div>
              <label><i class="fas fa-phone"></i> Phone</label>
              <input type="text" name="phone" class="form-control" value="{{ $user->phone }}">
              @error('phone')
                <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
            <div>
              <label><i class="fas fa-calendar"></i> Date of Birth</label>
              <input type="date" name="dob" class="form-control" value="{{ $user->dob }}">
              @error('dob')
                <div class="text-danger">{{ $message }}</div>
              @enderror
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
                <input type="email" name="email" class="form-control" value="{{ $user->email }}">
                @error('email')
                  <div class="text-danger">{{ $message }}</div>
                @enderror
                <small><i class="fas fa-clock"></i> {{ $user->created_at ? $user->created_at->diffForHumans() : '1 month ago' }}</small>
              </div>
            </div>

            <div class="text-right mt-4 action-buttons">
              <a href="{{ route('user.profile') }}" class="btn btn-outline-secondary"><i class="fas fa-times"></i> Cancel</a>
              <button type="submit" name="reset" value="1" class="btn btn-warning"><i class="fas fa-undo"></i> Reset to Default</button>
              <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save changes</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </main>
</div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript">
    // Set current date
    const currentDate = new Date();
    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    document.getElementById("current-date").textContent = currentDate.toLocaleDateString('en-US', options);
    
    // Show/hide upload controls when Edit button is clicked
    document.addEventListener('DOMContentLoaded', function() {
      const showUploadBtn = document.getElementById('show-upload-btn');
      const uploadControls = document.getElementById('upload-controls');
      
      if (showUploadBtn && uploadControls) {
        showUploadBtn.addEventListener('click', function(e) {
          e.preventDefault();
          if (uploadControls.style.display === 'none' || !uploadControls.style.display) {
            uploadControls.style.display = 'block';
          } else {
            uploadControls.style.display = 'none';
          }
        });
      }
    });
      
      if (resetPhotoBtn) {
        resetPhotoBtn.addEventListener('click', function() {
          // Reset gambar ke default
          profileImage.src = defaultImageUrl;
          
          // Bersihkan input file
          const fileInput = document.querySelector('.account-settings-fileinput');
          if (fileInput) {
            fileInput.value = '';
          }
          
          // Tampilkan pesan sukses
          const successMessage = document.createElement('div');
          successMessage.className = 'alert alert-success mt-2';
          successMessage.textContent = 'Photo reset to default. Save changes to apply.';
          
          const photoContainer = document.querySelector('.account-settings-fileinput').closest('div');
          photoContainer.appendChild(successMessage);
          
          // Hapus pesan setelah 3 detik
          setTimeout(function() {
            successMessage.remove();
          }, 3000);
        });
      }
      
      // Tampilkan nama file yang dipilih
      const fileInput = document.querySelector('.account-settings-fileinput');
      if (fileInput) {
        fileInput.addEventListener('change', function() {
          if (this.files && this.files[0]) {
            // Tampilkan preview gambar
            const reader = new FileReader();
            reader.onload = function(e) {
              profileImage.src = e.target.result;
            }
            reader.readAsDataURL(this.files[0]);
            
            // Tampilkan nama file
            const fileName = this.files[0].name;
            const fileInfo = document.createElement('div');
            fileInfo.className = 'text-primary mt-2';
            fileInfo.innerHTML = '<i class="fas fa-check-circle"></i> Selected: ' + fileName;
            
            // Hapus info file lama jika ada
            const oldFileInfo = document.querySelector('.text-primary.mt-2');
            if (oldFileInfo) {
              oldFileInfo.remove();
            }
            
            const photoContainer = this.closest('div');
            photoContainer.appendChild(fileInfo);
          }
        });
      }
      
      // Tampilkan pesan sukses jika ada
      const urlParams = new URLSearchParams(window.location.search);
      if (urlParams.has('success')) {
        const successMessage = document.createElement('div');
        successMessage.className = 'alert alert-success';
        successMessage.textContent = urlParams.get('success');
        
        const container = document.querySelector('.container');
        container.insertBefore(successMessage, container.firstChild);
        
        // Hapus pesan setelah 5 detik
        setTimeout(function() {
          successMessage.remove();
        }, 5000);
      }
    });
  </script>
</body>
</html>