<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - Aplikasi</title>
    <script src="https://cdn.tailwindcss.com"></script>

<style>
    body {
        background: url('images/Scorpion.jpg') no-repeat center center fixed;
        background-size: contain;
        min-height: 100vh;
        position: relative;
        overflow: hidden;
        z-index: 0;
    }

    /* Overlay gelap */
    body::before {
        content: "";
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, 0.55);
        backdrop-filter: blur(3px);
        z-index: 0;
    }

    /* Pastikan konten di atas overlay */
    .content {
        position: relative;
        z-index: 1;
    }

    /* Tombol biru tua */
    .btn-main {
        background-color: #0A2A43; /* Biru tua */
        border: 2px solid #0A2A43;
        color: white;
        padding: 0.5rem 1.2rem;
        font-weight: 600;
        border-radius: 0.6rem;
        transition: 0.25s ease;
        box-shadow: 0px 0px 8px rgba(0,0,0,0.4);
        display: inline-block;
    }

    /* Hover biru muda */
    .btn-main:hover {
        background-color: #154b74; /* Biru sedikit terang */
        border-color: #154b74;
        transform: scale(1.03);
    }
</style>

</head>
<body class="min-h-screen flex flex-col">

    <!-- Navbar -->
<nav class="content bg-white/20 backdrop-blur-xl border-b border-white/30 shadow-md px-6 py-4 flex justify-between items-center">

    <a href="{{ url('/') }}" class="text-xl font-bold text-white drop-shadow">
        Aplikasi
    </a>

    <div class="flex items-center space-x-4 text-white">

        @auth
            <span class="font-semibold">Halo, {{ Auth::user()->name }}</span>

            @php
                $user = Auth::user();

                // LOGIKA AKSES
                if ($user->role === 'admin') {
                    $punyaAkses = true;
                } elseif ($user->role === 'coach') {
                    $punyaAkses = true;
                } else {
                    // untuk atlet (role user)
                    $punyaAkses = $user->athletes()->exists();
                }
            @endphp

            @if($punyaAkses)

                {{-- DASHBOARD --}}
                @if($user->role === 'admin')
                    <a href="{{ route('dashboard') }}"
                       class="bg-blue-800 px-4 py-2 rounded-lg font-semibold text-white shadow hover:bg-blue-900 transition">
                        Dashboard Admin
                    </a>

                @elseif($user->role === 'coach')
                    <a href="{{ route('dashboard') }}"
                       class="bg-blue-800 px-4 py-2 rounded-lg font-semibold text-white shadow hover:bg-blue-900 transition">
                        Dashboard Coach
                    </a>

                @else
                    <a href="{{ route('dashboarduser') }}"
                       class="bg-blue-800 px-4 py-2 rounded-lg font-semibold text-white shadow hover:bg-blue-900 transition">
                        Dashboard Kamu
                    </a>
                @endif

            @else
                <span class="text-red-300 font-semibold">
                    Akses belum diberikan admin
                </span>
            @endif

            <!-- LOGOUT -->
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit"
                    class="bg-blue-800 px-4 py-2 rounded-lg font-semibold text-white shadow hover:bg-blue-900 transition">
                    Logout
                </button>
            </form>
        @endauth

        @guest
            <a href="{{ route('login') }}" class="bg-blue-800 px-4 py-2 rounded-lg font-semibold text-white shadow hover:bg-blue-900 transition">Login</a>
            <a href="{{ route('register') }}" class="bg-blue-800 px-4 py-2 rounded-lg font-semibold text-white shadow hover:bg-blue-900 transition">Register</a>
        @endguest

    </div>
</nav>


    <!-- Hero Section -->
    <main class="content flex-grow flex flex-col items-center justify-center text-center text-white px-6 py-20">
        <h1 class="text-4xl md:text-5xl font-extrabold drop-shadow-lg mb-4">
            Selamat Datang di Aplikasi Taekwondo Scorpion
        </h1>
    </main>

    <!-- Footer -->
    <footer class="content bg-white/20 backdrop-blur-lg text-center py-4 text-gray-200 text-sm border-t border-white/30">
        &copy; {{ date('Y') }} Taekwondo Scorpion. All rights reserved.
    </footer>

</body>
</html>
