<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'FANES.GO')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>

<body class="bg-gray-50 flex flex-col min-h-screen">

    {{-- ================= TOP BAR ================= --}}
    <div class="bg-green-700 text-white text-sm py-2 hidden md:block">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <span>📧 support@fanes.go</span>
                <span>📞 +62 895-3239-32558</span>
            </div>
            <span>Enjoy!</span>
        </div>
    </div>

    {{-- ================= HEADER ================= --}}
    <header class="bg-white shadow-md sticky top-0 z-50">
        <nav class="container mx-auto px-4 lg:px-8">
            <div class="flex justify-between items-center h-20">

                {{-- LOGO --}}
                <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                    <img
                        src="{{ asset('images/logo/logo-fanesgo.png') }}"
                        alt="FANES.GO Logo"
                        class="w-11 h-11 object-contain transition-transform duration-300 group-hover:scale-105">

                    <div class="hidden sm:block leading-tight">
                        <span class="text-2xl font-bold text-green-600">FANES</span>
                        <span class="text-2xl font-bold text-gray-800">.GO</span>
                        <p class="text-xs text-gray-500 -mt-1">UMKM</p>
                    </div>
                </a>

                {{-- MENU DESKTOP --}}
                <div class="hidden lg:flex items-center space-x-8 font-medium">
                    <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-green-600 font-bold' : 'text-gray-700 hover:text-green-600' }}">Beranda</a>
                    <a href="{{ route('kategori.index') }}" class="{{ request()->routeIs('kategori.*') ? 'text-green-600 font-bold' : 'text-gray-700 hover:text-green-600' }}">Kategori</a>
                    <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'text-green-600 font-bold' : 'text-gray-700 hover:text-green-600' }}">Tentang Kami</a>
                    <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'text-green-600 font-bold' : 'text-gray-700 hover:text-green-600' }}">Feedback</a>
                </div>

                {{-- AKSI KANAN --}}
                <div class="flex items-center space-x-3">
                    @auth
                    <a href="{{ route('dashboard') }}"
                        class="hidden sm:inline-flex px-5 py-2.5 bg-green-600 text-white rounded-lg font-semibold hover:bg-green-700 transition">
                        Dashboard
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="px-4 py-2 border border-green-600 text-green-600 rounded-lg hover:bg-green-50 transition">
                            Logout
                        </button>
                    </form>
                    @else
                    <a href="{{ route('login') }}"
                        class="px-5 py-2.5 bg-green-600 text-white rounded-lg font-semibold hover:bg-green-700 transition">
                        Admin Login
                    </a>
                    @endauth

                    {{-- MOBILE BUTTON --}}
                    <button id="mobile-menu-button" class="lg:hidden p-2 rounded-lg hover:bg-gray-100">
                        <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>

            {{-- MOBILE MENU --}}
            <div id="mobile-menu" class="lg:hidden hidden pb-4 space-y-2">
                <a href="{{ route('home') }}" class="block px-4 py-3 rounded-lg hover:bg-green-50">Beranda</a>
                <a href="{{ route('kategori.index') }}" class="block px-4 py-3 rounded-lg hover:bg-green-50">Kategori</a>
                <a href="{{ route('about') }}" class="block px-4 py-3 rounded-lg hover:bg-green-50">Tentang Kami</a>
                <a href="{{ route('contact') }}" class="block px-4 py-3 rounded-lg hover:bg-green-50">Feedback</a>

                @auth
                <a href="{{ route('dashboard') }}" class="block px-4 py-3 font-semibold text-green-700 hover:bg-green-50">
                    Dashboard Admin
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="w-full text-left px-4 py-3 text-red-600 hover:bg-red-50 rounded-lg">
                        Logout
                    </button>
                </form>
                @else
                <a href="{{ route('login') }}" class="block px-4 py-3 bg-green-600 text-white text-center rounded-lg">
                    Admin Login
                </a>
                @endauth
            </div>
        </nav>

        {{-- SEARCH --}}
        <div class="bg-gradient-to-r from-green-600 to-green-700 py-4">
            <div class="container mx-auto px-4">
                <form action="{{ route('kategori.index') }}" method="GET" class="max-w-3xl mx-auto relative">
                    <input type="search" name="q" value="{{ request('q') }}"
                        placeholder="Cari produk UMKM..."
                        class="w-full px-5 py-4 pr-32 rounded-xl focus:ring-4 focus:ring-green-300">
                    <button class="absolute right-2 top-2 bottom-2 px-6 bg-green-700 text-white rounded-lg font-semibold">
                        Cari
                    </button>
                </form>
            </div>
        </div>
    </header>

    {{-- ================= CONTENT ================= --}}
    <main class="container mx-auto px-4 py-8 flex-grow">
        @yield('content')
    </main>

    {{-- ================= FOOTER ================= --}}
    <footer class="bg-gray-900 text-white mt-auto">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">

                {{-- BRAND --}}
                <div>
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-10 h-10 bg-green-600 rounded-lg flex items-center justify-center">
                            <span class="text-white font-bold text-lg">F</span>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-green-400">FANES.GO</h3>
                            <p class="text-xs text-gray-400">UMKM</p>
                        </div>
                    </div>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        FANES.GO adalah marketplace UMKM terpercaya yang
                        menghadirkan produk lokal berkualitas di Bengkalis.
                    </p>
                </div>

                {{-- MENU --}}
                <div>
                    <h4 class="font-semibold mb-4 text-white">Menu</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li>
                            <a href="{{ route('home') }}" class="hover:text-green-400 transition">
                                Beranda
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('kategori.index') }}" class="hover:text-green-400 transition">
                                Kategori
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('about') }}" class="hover:text-green-400 transition">
                                Tentang Kami
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('contact') }}" class="hover:text-green-400 transition">
                                Feedback
                            </a>
                        </li>
                    </ul>
                </div>

                {{-- KONTAK --}}
                <div>
                    <h4 class="font-semibold mb-4 text-white">Hubungi Kami</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li>📧 fanesgo123@gmail.com</li>
                        <li>📞 +62 895-3239-32558</li>
                        <li>📍 Bengkalis, Indonesia</li>
                    </ul>
                </div>

            </div>

            {{-- COPYRIGHT --}}
            <div class="border-t border-gray-800 mt-10 pt-6 text-center text-sm text-gray-500">
                © {{ date('Y') }} <span class="text-green-400 font-semibold">FANES.GO</span>
                All rights reserved.
            </div>
        </div>
    </footer>


    {{-- ================= POPUP SUCCESS (CENTER) ================= --}}
    @if (session('success'))
    <div id="success-modal"
        class="fixed inset-0 z-[9999] flex items-center justify-center bg-black/50">
        <div class="bg-white rounded-2xl shadow-2xl w-[90%] max-w-md p-8 text-center animate-scale-in">
            <div class="flex justify-center mb-4">
                <div class="w-16 h-16 rounded-full bg-green-100 flex items-center justify-center">
                    <span class="text-3xl">✅</span>
                </div>
            </div>
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Berhasil</h2>
            <p class="text-gray-600 mb-6">{{ session('success') }}</p>
            <button onclick="closeSuccessModal()"
                class="w-full py-3 bg-green-600 text-white rounded-xl font-semibold hover:bg-green-700 transition">
                OK
            </button>
        </div>
    </div>

    <script>
        function closeSuccessModal() {
            document.getElementById('success-modal')?.remove();
        }
        setTimeout(closeSuccessModal, 3000);
    </script>
    @endif

    {{-- ================= SCRIPTS ================= --}}
    <script>
        document.getElementById('mobile-menu-button')
            ?.addEventListener('click', () =>
                document.getElementById('mobile-menu').classList.toggle('hidden'));
    </script>

    @stack('scripts')
</body>

</html>