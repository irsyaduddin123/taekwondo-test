<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login ke Akun</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #6366f1, #8b5cf6, #ec4899);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .card {
            border: none;
            border-radius: 1rem;
        }
        .form-control {
            border-radius: 0.75rem;
        }
        .btn-primary {
            background: linear-gradient(to right, #6366f1, #8b5cf6);
            border: none;
            border-radius: 0.75rem;
            transition: 0.3s;
        }
        .btn-primary:hover {
            background: linear-gradient(to right, #4f46e5, #7c3aed);
            transform: scale(1.02);
        }
        .btn-outline-light {
            border-radius: 0.75rem;
        }
    </style>
</head>
<body>

<div class="card shadow-lg p-4" style="max-width: 420px; width: 100%; background: #fff;">
    <div class="text-center mb-4">
        <h1 class="h4 fw-bold text-dark">Selamat Datang 👋</h1>
        <p class="text-muted small">Silakan login untuk melanjutkan</p>
    </div>

    {{-- Pesan sukses --}}
    @if(session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    {{-- Pesan error --}}
    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    {{-- Form Login --}}
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label fw-semibold">Email</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="you@example.com" required autofocus>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label fw-semibold">Password</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="********" required>
            <div class="text-end mt-1">
                <a href="#" class="small text-decoration-none" style="color:#6366f1;">Lupa password?</a>
            </div>
        </div>

        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="remember" id="remember">
            <label class="form-check-label small" for="remember">Ingat saya</label>
        </div>

        <div class="d-grid mb-3">
            <button type="submit" class="btn btn-primary btn-lg">Masuk</button>
        </div>
    </form>

    <div class="text-center small text-muted mb-3">
        Belum punya akun? 
        <a href="{{ route('register') }}" class="text-decoration-none" style="color:#6366f1;">Daftar</a>
    </div>

    {{-- Tombol kembali ke welcome --}}
    <div class="d-grid">
        <a href="{{ route('home') }}" class="btn btn-outline-light bg-dark text-white">
            ← Kembali ke Halaman Utama
        </a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
