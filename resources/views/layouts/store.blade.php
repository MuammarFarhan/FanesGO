<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'FANES.GO')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>

<body class="bg-gray-50">
    <!-- Top Bar (Optional - Info bar) -->
    <div class="bg-green-700 text-white text-sm py-2 hidden md:block">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <span>📧 support@fanes.go</span>
                <span>📞 +62 895-3239-32558</span>
            </div>
            <div class="flex items-center space-x-2">
                <span>Gratis Ongkir ke seluruh Indonesia!</span>
            </div>
        </div>
    </div>

    <!-- Main Navbar -->
    <header class="bg-white shadow-md sticky top-0 z-50">
        <nav class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <a href="/" class="flex items-center space-x-2 group">
                    <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-700 rounded-xl flex items-center justify-center shadow-lg group-hover:shadow-xl transition-all duration-300 group-hover:scale-105">
                        <span class="text-white font-bold text-xl">F</span>
                    </div>
                    <div class="hidden sm:block">
                        <span class="text-2xl font-bold text-green-600">FANES</span>
                        <span class="text-2xl font-bold text-gray-800">.GO</span>
                        <p class="text-xs text-gray-500 -mt-1">Oleh-oleh UMKM</p>
                    </div>
                </a>

                <!-- Desktop Menu -->
                <div class="hidden lg:flex items-center space-x-8">
                    <a href="/" class="text-gray-700 hover:text-green-600 font-medium transition-colors">Beranda</a>
                    <a href="#" class="text-gray-700 hover:text-green-600 font-medium transition-colors">Kategori</a>
                    <a href="#" class="text-gray-700 hover:text-green-600 font-medium transition-colors">Tentang Kami</a>
                    <a href="#" class="text-gray-700 hover:text-green-600 font-medium transition-colors">Kontak</a>
                </div>

                <!-- Right Menu -->
                <div class="flex items-center space-x-3">
                    @guest
                    <a href="{{ route('login') }}" class="hidden sm:inline-flex items-center px-5 py-2.5 border-2 border-green-600 text-green-600 rounded-lg font-semibold hover:bg-green-50 transition-all duration-300">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}" class="inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-green-600 to-green-700 text-white rounded-lg font-semibold hover:from-green-700 hover:to-green-800 shadow-md hover:shadow-lg transition-all duration-300">
                        Daftar
                    </a>
                    @else
                    <!-- User Dropdown -->
                    <div class="relative">
                        <button id="user-menu-button" class="flex items-center space-x-2 px-4 py-2 rounded-lg hover:bg-gray-100 transition-colors">
                            <img src="{{ Auth::user()->file ? Auth::user()->file->file_stream : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=10b981&color=fff' }}"
                                class="w-10 h-10 rounded-full border-2 border-green-500 object-cover"
                                alt="{{ Auth::user()->name }}">
                            <div class="hidden md:block text-left">
                                <p class="text-sm font-semibold text-gray-800">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-500">{{ Auth::user()->role === 'admin' ? 'Admin' : 'User' }}</p>
                            </div>
                            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div id="user-dropdown" class="absolute right-0 mt-2 w-64 bg-white rounded-xl shadow-2xl border border-gray-100 opacity-0 scale-95 transform transition-all duration-200 pointer-events-none">
                            <div class="p-4 border-b border-gray-100">
                                <p class="text-sm font-semibold text-gray-800">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                            </div>

                            <div class="py-2">
                                @if(Auth::user()->role === 'admin')
                                <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-green-50 transition-colors">
                                    <svg class="w-5 h-5 mr-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                    </svg>
                                    Admin Dashboard
                                </a>
                                @endif

                                <a href="{{ route('profile.show') }}" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-green-50 transition-colors">
                                    <svg class="w-5 h-5 mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    Profil Saya
                                </a>

                                <a href="#" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-green-50 transition-colors">
                                    <svg class="w-5 h-5 mr-3 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                    </svg>
                                    Pesanan Saya
                                </a>
                            </div>

                            <div class="border-t border-gray-100 py-2">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="flex items-center w-full px-4 py-3 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                        </svg>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endguest

                    <!-- Mobile Menu Button -->
                    <button id="mobile-menu-button" class="lg:hidden p-2 rounded-lg hover:bg-gray-100 transition-colors">
                        <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="lg:hidden hidden pb-4">
                <div class="space-y-2">
                    <a href="/" class="block px-4 py-3 text-gray-700 hover:bg-green-50 rounded-lg transition-colors">Beranda</a>
                    <a href="#" class="block px-4 py-3 text-gray-700 hover:bg-green-50 rounded-lg transition-colors">Kategori</a>
                    <a href="#" class="block px-4 py-3 text-gray-700 hover:bg-green-50 rounded-lg transition-colors">Tentang Kami</a>
                    <a href="#" class="block px-4 py-3 text-gray-700 hover:bg-green-50 rounded-lg transition-colors">Kontak</a>
                    @guest
                    <a href="{{ route('login') }}" class="block px-4 py-3 text-green-600 font-semibold hover:bg-green-50 rounded-lg transition-colors">Masuk</a>
                    <a href="{{ route('register') }}" class="block px-4 py-3 bg-green-600 text-white font-semibold hover:bg-green-700 rounded-lg transition-colors text-center">Daftar</a>
                    @endguest
                </div>
            </div>
        </nav>

        <!-- Search Bar -->
        <div class="bg-gradient-to-r from-green-600 to-green-700 py-4 shadow-lg">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <form action="#" method="GET" class="relative max-w-3xl mx-auto">
                    <div class="relative">
                        <input type="search"
                            name="q"
                            placeholder="Cari produk oleh-oleh dari UMKM lokal..."
                            class="w-full px-5 py-4 pl-14 pr-32 rounded-xl border-0 focus:outline-none focus:ring-4 focus:ring-green-300/50 shadow-xl transition-all duration-300 text-gray-800 placeholder-gray-400">

                        <!-- Search Icon -->
                        <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none">
                            <svg class="h-6 w-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                            </svg>
                        </div>

                        <!-- Search Button -->
                        <button type="submit" class="absolute inset-y-0 right-2 my-2 px-6 bg-green-600 hover:bg-green-700 text-white rounded-lg font-semibold transition-colors flex items-center shadow-md">
                            <span class="hidden sm:inline mr-2">Cari</span>
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                            </svg>
                        </button>
                    </div>

                    <!-- Popular Searches -->
                    <div class="mt-3 flex flex-wrap gap-2">
                        <span class="text-white text-sm">Populer:</span>
                        <a href="#" class="text-white text-sm hover:underline">Kue Kering</a>
                        <span class="text-white">•</span>
                        <a href="#" class="text-white text-sm hover:underline">Keripik</a>
                        <span class="text-white">•</span>
                        <a href="#" class="text-white text-sm hover:underline">Batik</a>
                        <span class="text-white">•</span>
                        <a href="#" class="text-white text-sm hover:underline">Kopi</a>
                    </div>
                </form>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white mt-16">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- About -->
                <div>
                    <h3 class="text-xl font-bold mb-4 text-green-400">FANES.GO</h3>
                    <p class="text-gray-400 text-sm mb-4">Marketplace terpercaya untuk produk oleh-oleh UMKM dari seluruh Indonesia.</p>
                    <div class="flex space-x-3">
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-green-600 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                            </svg>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-green-600 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z" />
                            </svg>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center hover:bg-green-600 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Links -->
                <div>
                    <h4 class="font-semibold mb-4">Perusahaan</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-green-400 transition-colors">Tentang Kami</a></li>
                        <li><a href="#" class="hover:text-green-400 transition-colors">Blog</a></li>
                        <li><a href="#" class="hover:text-green-400 transition-colors">Karir</a></li>
                        <li><a href="#" class="hover:text-green-400 transition-colors">Press</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-semibold mb-4">Bantuan</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-green-400 transition-colors">Pusat Bantuan</a></li>
                        <li><a href="#" class="hover:text-green-400 transition-colors">Cara Berbelanja</a></li>
                        <li><a href="#" class="hover:text-green-400 transition-colors">Kebijakan Privasi</a></li>
                        <li><a href="#" class="hover:text-green-400 transition-colors">Syarat & Ketentuan</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-semibold mb-4">Hubungi Kami</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li>📧 support@fanes.go</li>
                        <li>📞 +62 895-3229-32558</li>
                        <li>📍 Bengkalis, Riau, Indonesia</li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-sm text-gray-400">
                <p>&copy; {{ date('Y') }} FANES.GO - Marketplace Oleh-oleh UMKM Indonesia. All rights reserved.</p>
            </div>
        </div>
    </footer>

    @stack('scripts')

    <script>
        // User Dropdown
        const userMenuButton = document.getElementById('user-menu-button');
        const userDropdown = document.getElementById('user-dropdown');

        if (userMenuButton && userDropdown) {
            userMenuButton.addEventListener('click', (e) => {
                e.stopPropagation();
                userDropdown.classList.toggle('opacity-0');
                userDropdown.classList.toggle('scale-95');
                userDropdown.classList.toggle('pointer-events-none');
            });

            document.addEventListener('click', (e) => {
                if (!userDropdown.contains(e.target) && !userMenuButton.contains(e.target)) {
                    userDropdown.classList.add('opacity-0', 'scale-95', 'pointer-events-none');
                }
            });
        }

        // Mobile Menu
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        if (mobileMenuButton && mobileMenu) {
            mobileMenuButton.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        }
    </script>
</body>

</html>