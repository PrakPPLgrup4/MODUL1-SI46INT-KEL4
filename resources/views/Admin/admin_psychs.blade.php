<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Manage Psychiatrist Profiles</title>
  <link rel="stylesheet" href="{{ asset('css/Admin/index.css') }}">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>

  <header>
    <img class="logo" src="{{ asset('images/logo.png') }}" alt="Psylography Logo">

    <a href="{{ route('views.Homepage') }}"> <!-- Update with the correct route for logout -->
        <img class="logo" src="{{ asset('images/logout.png') }}" alt="logout">
    </a>
  </header>

  <div class="container">
    <aside class="sidebar">
      <ul>
        <li><a href="#">User Account</a></li>
        <li><a href="{{ route('admin.psychs') }}">Psychiatric Profile</a></li>
        <li><a href="#">Symptoms</a></li>
      </ul>
    </aside>

    <main class="main-content">
      <h2>Manage Psychiatrist Profiles</h2>

      <a href="{{ route('admin.create') }}" class="btn btn-primary">Add New Psychiatrist</a>

      <table class="table">
        <thead>
          <tr>
            <th>Full Name</th>
            <th>Description</th>
            <th>Picture</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($psychs as $psych)
          <tr>
            <td>{{ $psych->full_name }}</td>
            <td>{{ $psych->description }}</td>
            <td><img src="{{ asset('storage/' . $psych->picture) }}" alt="{{ $psych->full_name }}" style="width: 50px;"></td>
            <td>
              <a href="{{ route('admin.edit', $psych->id) }}" class="btn btn-warning">Edit</a>
              <form action="{{ route('admin.destroy', $psych->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this profile?')">Delete</button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </main>
  </div>

</body>
</html>
