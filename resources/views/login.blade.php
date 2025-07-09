<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - The Agni Canvas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(to right, #f3e7f3, #e7e4f8);
            font-family: 'Segoe UI', sans-serif;
        }

        .login-container {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(4px);
            max-width: 450px;
            margin: 80px auto;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            animation: fadeIn 1s ease;
        }

        .login-title {
            font-size: 2rem;
            color: #6f42c1;
            font-weight: bold;
            margin-bottom: 30px;
        }

        .btn-purple {
            background-color: #6f42c1;
            color: white;
            border-radius: 10px;
        }

        .btn-purple:hover {
            background-color: #5933a8;
        }

        .btn-outline-purple {
            border: 2px solid #6f42c1;
            color: #6f42c1;
            border-radius: 10px;
            background-color: transparent;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-outline-purple:hover {
            background-color: #6f42c1;
            color: white;
        }

        a {
            color: #6f42c1;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="login-container">
        <h2 class="text-center login-title">Login</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control rounded-3" required autofocus>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control rounded-3" required>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-purple">Login</button>
            </div>
        </form>

        <p class="mt-3 text-center">
            Belum punya akun?
            <a href="{{ route('register') }}">Daftar sekarang</a>
        </p>

        <div class="text-center mt-3">
            <a href="{{ url('/') }}" class="btn btn-outline-purple px-4 py-2">
                ← Kembali ke Beranda
            </a>
        </div>
    </div>
</div>

</body>
</html>
