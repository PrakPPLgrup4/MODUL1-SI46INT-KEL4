<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Psychiatrist Profile</title>
    <link rel="stylesheet" href="{{ asset('css/Admin/index.css') }}"> <!-- Link to index.css for navbar/sidebar -->
    <style>
        /* Styling for the Create Form */
        .form-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 30px;
        }

        .form-content {
            background-color: #fff;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            width: 100%;
            max-width: 600px;
        }

        .form-content h2 {
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }

        .form-content label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        .form-content input, .form-content textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        .form-content textarea {
            resize: vertical;
            min-height: 150px;
        }

        .form-content button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
        }

        .form-content button:hover {
            background-color: #45a049;
        }

        .form-content .back-btn {
            background-color: #f44336;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            display: inline-block;
            margin-top: 20px;
            text-align: center;
        }

        .form-content .back-btn:hover {
            background-color: #e53935;
        }

        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
            font-size: 16px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
            font-size: 16px;
        }
    </style>
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
            <h2>Create New Psychiatrist Profile</h2>

            <!-- Error Handling Section -->
            @if ($errors->any())
                <div class="alert-error">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Success Message Section -->
            @if(session('success'))
                <div class="alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="form-container">
                <div class="form-content">
                    <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="full_name">Full Name</label>
                            <input type="text" name="full_name" id="full_name" class="form-control" value="{{ old('full_name') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" class="form-control" value="{{ old('username') }}" required>
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control" rows="4" required>{{ old('description') }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="picture">Profile Picture</label>
                            <input type="file" name="picture" id="picture" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Create Profile</button>
                    </form>

                    <a href="{{ route('admin.psychs') }}" class="back-btn">Back to Profile List</a>
                </div>
            </div>
        </main>
    </div>

</body>
</html>
