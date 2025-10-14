<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - Aplikasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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

    <!-- Galeri Foto -->
<section class="bg-white py-16 px-6 text-center">
    <h2 class="text-3xl font-bold mb-8 text-indigo-600">Galeri Foto</h2>
    <p class="max-w-2xl mx-auto mb-12 text-gray-600">
        Momen terbaik latihan, kompetisi, dan kegiatan komunitas Taekwondo Scorpion.
    </p>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 max-w-6xl mx-auto">
        <!-- Foto 1 -->
        <div class="overflow-hidden rounded-xl shadow-md hover:scale-105 transition-transform duration-300">
            <img src="{{ asset('images/logo-background.png') }}" 
                 alt="Latihan Taekwondo 1" 
                 class="w-full h-56 object-cover">
        </div>

        <!-- Foto 2 -->
        <div class="overflow-hidden rounded-xl shadow-md hover:scale-105 transition-transform duration-300">
            <img src="{{ asset('images/taekwondo.png') }}" 
                 alt="Latihan Taekwondo 2" 
                 class="w-full h-56 object-cover">
        </div>

        <!-- Foto 3 -->
        <div class="overflow-hidden rounded-xl shadow-md hover:scale-105 transition-transform duration-300">
            <img src="{{ asset('images/galeri/kompetisi1.jpg') }}" 
                 alt="Kompetisi Taekwondo" 
                 class="w-full h-56 object-cover">
        </div>

        <!-- Foto 4 -->
        <div class="overflow-hidden rounded-xl shadow-md hover:scale-105 transition-transform duration-300">
            <img src="{{ asset('images/galeri/tim1.jpg') }}" 
                 alt="Tim Taekwondo Scorpion" 
                 class="w-full h-56 object-cover">
        </div>

        <!-- Tambahkan lebih banyak foto sesuai kebutuhan -->
    </div>
</section>


@php
    $waNumber = '6281228132856';
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
            <i class="fab fa-whatsapp text-xl"></i>
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
