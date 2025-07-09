<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Selamat Datang - The Agni Canvas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        body {
            background-image: 
                linear-gradient(to bottom right, rgba(251, 232, 255, 0.6), rgba(231, 228, 248, 0.6)),
                url('/images/login.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            font-family: 'Segoe UI', sans-serif;
            min-height: 100vh;
            margin: 0;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .hero-section {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            text-align: center;
            padding: 20px;
        }

        .brand-title {
            font-size: 3.5rem;
            color: #6f42c1;
            font-weight: 800;
            margin-bottom: 20px;
            text-shadow: 0 2px 10px rgba(255, 255, 255, 0.9);
        }

        .lead {
            font-size: 1.3rem;
            color: #4b4b4b;
            margin-bottom: 40px;
            background: rgba(255, 255, 255, 0.7);
            display: inline-block;
            padding: 10px 24px;
            border-radius: 12px;
        }

        .btn-purple {
            background-color: #6f42c1;
            color: white;
            border-radius: 10px;
            padding: 12px 28px;
            margin: 0 12px;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease;
        }

        .btn-purple:hover {
            background-color: #5933a8;
        }

        footer {
            background: rgba(111, 66, 193, 0.9);
            color: white;
            text-align: center;
            padding: 16px 0;
            font-size: 0.95rem;
        }
    </style>
</head>
<body>

<div class="hero-section" data-aos="fade-up">
    <h1 class="brand-title">Selamat Datang di The Agni Canvas</h1>
    <p class="lead">Eksplorasi dunia seni dan temukan perlengkapan lukis berkualitas tinggi yang menginspirasi</p>

    <div class="d-flex justify-content-center flex-wrap">
        <a href="{{ route('login') }}" class="btn btn-purple mb-2">Login</a>
        <a href="{{ route('register') }}" class="btn btn-purple mb-2">Register</a>
    </div>
</div>

<footer>
    <p class="mb-0">© {{ date('Y') }} The Agni Canvas. All rights reserved.</p>
</footer>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>AOS.init();</script>
</body>
</html>
