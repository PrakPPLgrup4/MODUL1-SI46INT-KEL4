<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Psylography - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #fff; font-family: Arial, sans-serif; }
        .login-box {
            max-width: 400px;
            margin: 80px auto;
            padding: 30px;
            background-color: #ffe3a3;
            border-radius: 15px;
        }
        .btn-login {
            background-color: #93b800;
            color: white;
        }
        .btn-login:hover {
            background-color: #7ea100;
        }
        .role-links {
            text-align: center;
            margin-top: 10px;
            color: #93b800;
        }
    </style>
</head>
<body>

<div class="text-center mt-5">
    <h2><strong>Sign In</strong></h2>
</div>

<div class="login-box">
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->has('login_error'))
        <div class="alert alert-danger">{{ $errors->first('login_error') }}</div>
    @endif

    <form method="POST" action="{{ route('login.submit') }}">
        @csrf
        <div class="mb-3">
            <label>Username</label>
            <input type="text" name="username" class="form-control" value="{{ old('username') }}" required>
        </div>
        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="role-links">
            Login as Psychiatrist | Login as Admin
        </div>

        <button type="submit" class="btn btn-login mt-3 w-100">Login</button>

        <div class="text-center mt-3">
            Don’t have an account? <a href="{{ route('register') }}">Sign Up</a>
        </div>
    </form>
</div>

</body>
</html>
