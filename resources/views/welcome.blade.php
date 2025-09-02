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
        <a href="{{ url('/') }}" class="text-xl font-bold bg-gradient-to-r from-indigo-600 to-pink-500 bg-clip-text text-transparent">
            Aplikasi
        </a>

        <div class="space-x-4">
            @auth
                <span class="text-gray-700">Halo, {{ Auth::user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-red-500 hover:underline">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login</a>
                <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Register</a>
            @endauth
        </div>
    </nav>

    <!-- Hero Section -->
    <main class="flex-grow flex flex-col items-center justify-center text-center text-white px-6">
        <h1 class="text-4xl md:text-5xl font-extrabold mb-4 bg-gradient-to-r from-yellow-300 via-pink-400 to-purple-600 bg-clip-text text-transparent">
            Selamat Datang di Aplikasi
        </h1>
        <p class="text-lg md:text-xl mb-8 max-w-xl">
            Sistem manajemen dan pengelolaan yang lebih mudah, cepat, dan efisien ✨
        </p>

        @guest
            <div class="flex flex-col md:flex-row gap-4">
                <a href="{{ route('login') }}" 
                   class="bg-white text-indigo-600 px-6 py-3 rounded-lg font-semibold shadow-md hover:bg-gray-200 transition">
                   Login
                </a>
                <a href="{{ route('register') }}" 
                   class="bg-gradient-to-r from-indigo-600 to-pink-500 px-6 py-3 rounded-lg font-semibold shadow-md hover:opacity-90 transition">
                   Register
                </a>
            </div>
        @endguest
    </main>

    <!-- Footer -->
    <footer class="bg-white shadow-md text-center py-4 text-gray-600 text-sm">
        &copy; {{ date('Y') }} Aplikasi. All rights reserved.
    </footer>
</body>
</html>
