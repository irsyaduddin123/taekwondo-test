<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - Aplikasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-indigo-500 to-blue-600 min-h-screen flex flex-col">

    <!-- Navbar -->
    <nav class="bg-white shadow-md px-6 py-4 flex justify-between items-center">
        <!-- Logo -->
        <a href="{{ url('/') }}" 
        class="text-xl font-bold bg-gradient-to-r from-indigo-600 to-pink-500 bg-clip-text text-transparent">
            Aplikasi
        </a>

        <!-- Menu kanan -->
        <div class="flex items-center space-x-4">
            @auth
                <span class="text-gray-700">Halo, {{ Auth::user()->name }}</span>

                <!-- Tombol Dashboard -->
                @if(Auth::user()->role === 'admin')
                    <a href="{{ route('dashboard') }}" 
                    class="bg-gradient-to-r from-purple-600 to-pink-500 px-4 py-2 rounded-lg font-semibold text-white shadow-md hover:opacity-90 transition">
                    Dashboard Admin
                    </a>
                @else
                    <a href="{{ route('dashboarduser') }}" 
                    class="bg-gradient-to-r from-green-500 to-blue-600 px-4 py-2 rounded-lg font-semibold text-white shadow-md hover:opacity-90 transition">
                    Dashboard Kamu
                    </a>
                @endif

                <!-- Tombol Logout -->
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" 
                            class="bg-gradient-to-r from-red-500 to-red-700 px-4 py-2 rounded-lg font-semibold text-white shadow-md hover:opacity-90 transition">
                        Logout
                    </button>
                </form>
            @endauth

            @guest
                <!-- Tombol Login -->
                <a href="{{ route('login') }}" 
                class="bg-white text-indigo-600 px-4 py-2 rounded-lg font-semibold shadow-md border border-indigo-600 hover:bg-indigo-50 transition">
                Login
                </a>

                <!-- Tombol Register -->
                <a href="{{ route('register') }}" 
                class="bg-gradient-to-r from-indigo-600 to-pink-500 px-4 py-2 rounded-lg font-semibold text-white shadow-md hover:opacity-90 transition">
                Register
                </a>
            @endguest
        </div>
    </nav>

    <!-- Hero Section -->
    <main class="flex-grow flex flex-col items-center justify-center text-center text-white px-6 py-20">
        <h1 class="text-4xl md:text-5xl font-extrabold mb-4 
                   bg-gradient-to-r from-yellow-300 via-pink-400 to-purple-600 bg-clip-text text-transparent">
            Selamat Datang di Aplikasi
        </h1>
        <p class="text-lg md:text-xl max-w-xl">
            Taekwondo scorpion✨
        </p>
    </main>

    <!-- Tentang Kami -->
    <section class="bg-white py-16 px-6 text-center text-gray-800">
        <h2 class="text-3xl font-bold mb-6 text-indigo-600">Tentang Kami</h2>
        <p class="max-w-2xl mx-auto mb-8">
            Kami adalah komunitas Taekwondo Scorpion yang berkomitmen membangun prestasi atlet, 
            meningkatkan kedisiplinan, serta memberikan kontribusi positif dalam dunia olahraga. 
            Aplikasi ini dibuat untuk mendukung pengelolaan data, prestasi, dan kegiatan secara modern dan efisien.
        </p>
    </section>

    <!-- Visi & Misi -->
    <section class="bg-gray-50 py-16 px-6 text-center">
        <h2 class="text-3xl font-bold mb-6 text-indigo-600">Visi & Misi</h2>
        <div class="grid md:grid-cols-2 gap-8 max-w-4xl mx-auto text-left">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="font-semibold text-lg mb-3">Visi</h3>
                <p>
                    Menjadi pusat pelatihan taekwondo terbaik yang melahirkan atlet berprestasi dan berkarakter.
                </p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="font-semibold text-lg mb-3">Misi</h3>
                <ul class="list-disc pl-5 space-y-2">
                    <li>Meningkatkan kualitas latihan dengan sistem modern</li>
                    <li>Menciptakan lingkungan yang disiplin dan positif</li>
                    <li>Memajukan taekwondo di tingkat nasional dan internasional</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Fitur -->
    <section class="bg-white py-16 px-6 text-center text-gray-800">
        <h2 class="text-3xl font-bold mb-6 text-indigo-600">Fitur Aplikasi</h2>
        <div class="grid md:grid-cols-3 gap-8 max-w-5xl mx-auto">
            <div class="p-6 rounded-lg shadow-md bg-gradient-to-br from-indigo-500 to-blue-600 text-white">
                <h3 class="text-lg font-semibold mb-3">Manajemen Atlet</h3>
                <p>Catat data atlet dengan mudah dan terstruktur.</p>
            </div>
            <div class="p-6 rounded-lg shadow-md bg-gradient-to-br from-pink-500 to-purple-600 text-white">
                <h3 class="text-lg font-semibold mb-3">Prestasi & Event</h3>
                <p>Kelola prestasi atlet serta rencana kegiatan tahunan.</p>
            </div>
            <div class="p-6 rounded-lg shadow-md bg-gradient-to-br from-green-500 to-teal-600 text-white">
                <h3 class="text-lg font-semibold mb-3">Dashboard & Laporan</h3>
                <p>Visualisasi data dengan grafik interaktif dan laporan otomatis.</p>
            </div>
        </div>
    </section>

@php
    $waNumber = '6281228132856'; // nomor WA (tanpa +)
    $waMessage = urlencode('Halo, saya ingin bertanya tentang Taekwondo Scorpion.');
@endphp

<!-- Kontak -->
<section class="bg-gray-50 py-16 px-6 text-center">
    <h2 class="text-3xl font-bold mb-6 text-indigo-600">Kontak</h2>
    <p class="mb-4">Hubungi kami untuk informasi lebih lanjut</p>
    <p class="font-semibold">
        Email: 
        <a href="mailto:info@taekwondoscorpion.com" class="text-indigo-600 hover:underline">
            info@taekwondoscorpion.com
        </a>
    </p>
    <p class="font-semibold">Telp: +62 812-3456-7890</p>

    <!-- Tombol WhatsApp -->
    <div class="mt-6">
        <a href="https://wa.me/{{ $waNumber }}?text={{ $waMessage }}" 
           target="_blank"
           class="inline-flex items-center gap-2 bg-green-500 hover:bg-green-600 text-white font-semibold px-6 py-3 rounded-lg shadow-md transition">
            <!-- Icon WhatsApp -->
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16" class="w-5 h-5">
                <path d="M13.601 2.326A7.854 7.854 0 0 0 8.002 0a7.964 7.964 0 0 0-6.82 11.905L0 16l4.223-1.107A7.963 7.963 0 0 0 8.002 16a7.854 7.854 0 0 0 5.599-2.326A7.854 7.854 0 0 0 16 8a7.855 7.855 0 0 0-2.399-5.674ZM8.002 14.56c-1.282 0-2.544-.34-3.637-.983l-.26-.155-2.506.656.67-2.445-.17-.251a6.62 6.62 0 0 1-1.006-3.465c0-3.68 2.995-6.675 6.675-6.675a6.61 6.61 0 0 1 4.717 1.957 6.61 6.61 0 0 1 1.957 4.718c0 3.68-2.995 6.633-6.44 6.633Zm3.59-4.937c-.197-.099-1.164-.573-1.345-.637-.18-.066-.311-.099-.441.099-.133.197-.508.637-.623.77-.115.132-.23.148-.426.05-.197-.099-.833-.307-1.586-.979-.586-.523-.979-1.165-1.094-1.362-.115-.198-.012-.304.087-.403.09-.089.198-.23.296-.345.1-.115.132-.197.198-.33.065-.132.033-.248-.017-.346-.05-.099-.441-1.064-.605-1.463-.16-.385-.323-.332-.441-.338-.115-.006-.248-.006-.38-.006a.733.733 0 0 0-.529.248c-.181.197-.693.677-.693 1.654 0 .976.71 1.92.809 2.054.099.132 1.398 2.137 3.394 2.993.475.206.845.33 1.133.422.476.151.91.13 1.253.079.382-.058 1.164-.476 1.329-.936.164-.46.164-.855.115-.937-.05-.082-.182-.132-.38-.23Z"/>
            </svg>
            WhatsApp Kami
        </a>
    </div>
</section>




    <!-- Footer -->
    <footer class="bg-white shadow-md text-center py-4 text-gray-600 text-sm">
        &copy; {{ date('Y') }} Taekwondo Scorpion. All rights reserved.
    </footer>
</body>
</html>
