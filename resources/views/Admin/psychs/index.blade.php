<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Manage Psychiatrist Profiles</title>
  <link rel="stylesheet" href="{{ asset('css/Admin/index.css') }}">

  <style>
    /* Table-specific CSS */
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
      table-layout: fixed;
    }

    table, th, td {
      border: 1px solid #ddd;
      padding: 10px;
      text-align: left;
    }

    th {
      background-color: #f4f4f4;
      font-weight: bold;
    }

    td {
      vertical-align: top;
      word-break: break-word;
    }

    td.description-column {
      max-width: 300px;
      white-space: pre-wrap;
    }

    td img {
      width: 100px;
      height: auto;
      border-radius: 5px;
    }

    /* Button styling */
    .btn {
      padding: 8px 16px;
      border-radius: 5px;
      display: inline-block;
      text-decoration: none;
      color: white;
      font-weight: bold;
      border: none;
      cursor: pointer;
    }

    .btn:hover {
      opacity: 0.8;
    }

    /* Make the "+" button square */
    .btn-create {
      background-color: #4CAF50;
      margin-top: 20px;
      display: block;
      width: 50px; /* Adjust width */
      height: 50px; /* Adjust height to make it square */
      margin-bottom: 20px;
      text-align: center;
      line-height: 50px; /* Center the "+" symbol vertically */
      font-size: 24px; /* Adjust font size */
      border-radius: 10px; /* Optional: Adjust to make button rounded */
    }

    .btn-edit {
      background-color: #FFC107; /* Yellow */
      color: black;
    }

    .btn-delete {
      background-color: red; /* Red for delete button */
      color: white;
    }

    .alert-success {
      position: fixed;
      top: 20px;
      right: 20px;
      background-color: #4CAF50;
      color: white;
      padding: 10px 20px;
      border-radius: 5px;
      font-size: 16px;
      display: none;
    }

    .alert-success.show {
      display: block;
    }

    /* Add responsiveness */
    @media (max-width: 768px) {
      table, th, td {
        font-size: 14px;
      }

      td img {
        width: 80px;
      }
    }

    /* Centered Title */
    .center-title {
      width: 100%;
      text-align: center;
      margin-top: 20px;
    }
  </style>

  <script>
    // Show success message for 5 seconds
    window.onload = function() {
      if (document.querySelector('.alert-success')) {
        setTimeout(function() {
          document.querySelector('.alert-success').classList.remove('show');
        }, 5000);
      }
    }
  </script>
</head>
<body>

  <header>
    <img class="logo" src="{{ asset('images/logo.png') }}" alt="Psylography Logo">
    <a href="{{ route('views.Homepage') }}">
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
      <!-- Create Profile Button -->
      <a href="{{ route('admin.create') }}" class="btn btn-create">+</a>

      <!-- Display Success Message -->
      @if(session('success'))
        <div class="alert-success show">
          {{ session('success') }}
        </div>
      @endif

      <!-- Psychiatrist Table -->
      <table>
        <thead>
          <tr>
            <th>Full Name</th>
            <th>Description</th>
            <th>Picture</th>
            <th>Average Rating</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($psychs as $psych)
            <tr>
              <td>{{ $psych->full_name }}</td>
              <td class="description-column">{{ $psych->description }}</td>
              <td><img src="{{ asset('storage/' . $psych->picture) }}" alt="{{ $psych->full_name }}"></td>
              <td>{{ number_format($psych->average_rating, 1) }}</td>
              <td>
                <a href="{{ route('admin.edit', $psych->id) }}" class="btn btn-edit">Edit</a>
                <form action="{{ route('admin.destroy', $psych->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this profile?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-delete">Delete</button>
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
