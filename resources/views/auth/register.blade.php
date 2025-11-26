<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Akun Baru</title>
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
            overflow: hidden;
        }

        /* Overlay gelap */
        body::before {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(3px);
            z-index: -1;
        }

        /* Card transparan */
        .card {
            position: relative;
            z-index: 1;
            border: none;
            border-radius: 1rem;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            color: #fff !important;
        }

        /* Label */
        .form-label {
            color: #eaeaea !important;
        }

        /* Input */
        .form-control {
            border-radius: 0.75rem;
            background: rgba(255,255,255,0.25);
            color: #fff;
            border: 1px solid rgba(255,255,255,0.4);
        }
        .form-control::placeholder {
            color: #e0e0e0;
        }

        /* Tombol primary */
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

        /* Tombol kembali */
        .btn-outline-light {
            border-radius: 0.75rem;
            border: 1px solid #fff;
            color: #fff;
            background: rgba(0, 0, 0, 0.4);
        }

        /* Link */
        a {
            color: #c7d2fe !important;
        }
        a:hover {
            color: #e0e7ff !important;
        }
    </style>

</head>
<body>

<div class="card shadow-lg p-4" style="max-width: 420px; width: 100%;">
    <div class="text-center mb-4">
        <h1 class="h4 fw-bold">Buat Akun Baru ✨</h1>
        <p class="small text-light">Daftar sekarang untuk mulai menggunakan aplikasi</p>
    </div>

    {{-- Pesan error --}}
    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    {{-- Form Register --}}
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label fw-semibold">Nama Lengkap</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Nama kamu" required autofocus>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label fw-semibold">Email</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="you@example.com" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label fw-semibold">Password</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="********" required>
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label fw-semibold">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="********" required>
        </div>

        <div class="d-grid mb-3">
            <button type="submit" class="btn btn-primary btn-lg">Daftar</button>
        </div>
    </form>

    <div class="text-center small mb-3">
        Sudah punya akun?
        <a href="{{ route('login') }}" class="text-decoration-none">Masuk</a>
    </div>

    <div class="d-grid">
        <a href="{{ route('home') }}" class="btn btn-outline-light">
            ← Kembali ke Halaman Utama
        </a>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
