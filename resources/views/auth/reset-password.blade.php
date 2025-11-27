<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: url('images/Scorpion.jpg') no-repeat center center fixed;
            background-size: contain;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            position: relative;
        }

        body::before {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(3px);
            z-index: 0;
        }

        .card {
            position: relative;
            z-index: 1;
            border: none;
            border-radius: 1rem;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            color: #f5f5f5;
        }

        .form-label {
            color: #eeeeee !important;
        }

        .form-control {
            border-radius: 0.75rem;
            background: rgba(255,255,255,0.25);
            color: #fff;
            border: 1px solid rgba(255,255,255,0.4);
        }

        .form-control::placeholder {
            color: #e0e0e0 !important;
        }

        .btn-primary {
            background: linear-gradient(to right, #6366f1, #8b5cf6);
            border: none;
            border-radius: 0.75rem;
        }

        .btn-primary:hover {
            background: linear-gradient(to right, #4f46e5, #7c3aed);
        }

        .btn-outline-light {
            border-radius: 0.75rem;
            border: 1px solid #fff;
            background: rgba(0,0,0,0.4);
            color: #fff;
        }
    </style>
</head>

<body>

<div class="card shadow-lg p-4" style="max-width: 420px; width: 100%;">
    <div class="text-center mb-4">
        <h1 class="h4 fw-bold">🔑 Reset Password</h1>
        <p class="small text-light">Masukkan password baru untuk akun Anda</p>
    </div>

    {{-- Pesan Error --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    {{-- Form Reset Password --}}
    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="mb-3">
            <label class="form-label fw-semibold">Email</label>
            <input type="email" name="email" class="form-control"
                   placeholder="you@example.com" required autofocus>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Password Baru</label>
            <input type="password" name="password" class="form-control"
                   placeholder="********" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="form-control"
                   placeholder="********" required>
        </div>

        <div class="d-grid mb-3">
            <button type="submit" class="btn btn-primary btn-lg">
                Reset Password
            </button>
        </div>
    </form>

    <div class="d-grid">
        <a href="{{ route('login') }}" class="btn btn-outline-light">
            ← Kembali ke Login
        </a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
