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
    <div class="bg-green-700 text-white text-sm py-2 hidden md:block">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <span>📧 support@fanes.go</span>
                <span>📞 +62 895-3239-32558</span>
            </div>
            <div class="flex items-center space-x-2">
                <span>Belanja Murah Hanya Disini!</span>
            </div>
        </div>
    </div>

    <header class="bg-white shadow-md sticky top-0 z-50">
        <nav class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <a href="{{ route('home') }}" class="flex items-center space-x-2 group">
                    <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-700 rounded-xl flex items-center justify-center shadow-lg group-hover:shadow-xl transition-all duration-300 group-hover:scale-105">
                        <span class="text-white font-bold text-xl">F</span>
                    </div>
                    <div class="hidden sm:block">
                        <span class="text-2xl font-bold text-green-600">FANES</span>
                        <span class="text-2xl font-bold text-gray-800">.GO</span>
                        <p class="text-xs text-gray-500 -mt-1">Oleh-oleh UMKM</p>
                    </div>
                </a>

                <div class="hidden lg:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-green-600 font-bold' : 'text-gray-700 hover:text-green-600' }} font-medium transition-colors">Beranda</a>
                    <a href="{{ route('kategori.index') }}" class="{{ request()->routeIs('kategori.*') ? 'text-green-600 font-bold' : 'text-gray-700 hover:text-green-600' }} font-medium transition-colors">Kategori</a>
                    <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'text-green-600 font-bold' : 'text-gray-700 hover:text-green-600' }} font-medium transition-colors">Tentang Kami</a>
                    <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'text-green-600 font-bold' : 'text-gray-700 hover:text-green-600' }} font-medium transition-colors">Kontak</a>
                </div>

                <div class="flex items-center space-x-3">
                    @guest
                    <a href="{{ route('login') }}" class="hidden sm:inline-flex items-center px-5 py-2.5 border-2 border-green-600 text-green-600 rounded-lg font-semibold hover:bg-green-50 transition-all duration-300">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}" class="inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-green-600 to-green-700 text-white rounded-lg font-semibold hover:from-green-700 hover:to-green-800 shadow-md hover:shadow-lg transition-all duration-300">
                        Daftar
                    </a>
                    @else
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

                        <div id="user-dropdown" class="absolute right-0 mt-2 w-64 bg-white rounded-xl shadow-2xl border border-gray-100 opacity-0 scale-95 transform transition-all duration-200 pointer-events-none z-50">
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

                    <button id="mobile-menu-button" class="lg:hidden p-2 rounded-lg hover:bg-gray-100 transition-colors">
                        <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <div id="mobile-menu" class="lg:hidden hidden pb-4">
                <div class="space-y-2">
                    <a href="{{ route('home') }}" class="block px-4 py-3 text-gray-700 hover:bg-green-50 rounded-lg transition-colors {{ request()->routeIs('home') ? 'bg-green-50 text-green-600 font-bold' : '' }}">Beranda</a>
                    <a href="{{ route('kategori.index') }}" class="block px-4 py-3 text-gray-700 hover:bg-green-50 rounded-lg transition-colors {{ request()->routeIs('kategori.*') ? 'bg-green-50 text-green-600 font-bold' : '' }}">Kategori</a>
                    <a href="{{ route('about') }}" class="block px-4 py-3 text-gray-700 hover:bg-green-50 rounded-lg transition-colors {{ request()->routeIs('about') ? 'bg-green-50 text-green-600 font-bold' : '' }}">Tentang Kami</a>
                    <a href="{{ route('contact') }}" class="block px-4 py-3 text-gray-700 hover:bg-green-50 rounded-lg transition-colors {{ request()->routeIs('contact') ? 'bg-green-50 text-green-600 font-bold' : '' }}">Kontak</a>
                    @guest
                    <a href="{{ route('login') }}" class="block px-4 py-3 text-green-600 font-semibold hover:bg-green-50 rounded-lg transition-colors">Masuk</a>
                    <a href="{{ route('register') }}" class="block px-4 py-3 bg-green-600 text-white font-semibold hover:bg-green-700 rounded-lg transition-colors text-center">Daftar</a>
                    @endguest
                </div>
            </div>
        </nav>

        <div class="bg-gradient-to-r from-green-600 to-green-700 py-4 shadow-lg">
             <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <form action="{{ route('kategori.index') }}" method="GET" class="relative max-w-3xl mx-auto"> <div class="relative">
                        <input type="search" name="q" value="{{ request('q') }}"
                            placeholder="Cari produk oleh-oleh dari UMKM lokal..."
                            class="w-full px-5 py-4 pl-14 pr-32 rounded-xl border-0 focus:outline-none focus:ring-4 focus:ring-green-300/50 shadow-xl transition-all duration-300 text-gray-800 placeholder-gray-400">
                        <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none">
                            <svg class="h-6 w-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                            </svg>
                        </div>
                        <button type="submit" class="absolute inset-y-0 right-2 my-2 px-6 bg-green-600 hover:bg-green-700 text-white rounded-lg font-semibold transition-colors flex items-center shadow-md">
                            <span class="hidden sm:inline mr-2">Cari</span>
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </header>

    <main class="container mx-auto px-4 sm:px-6 lg:px-8 py-8 flex-grow">
        @yield('content')
    </main>

    <footer class="bg-gray-900 text-white mt-auto">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4 text-green-400">FANES.GO</h3>
                    <p class="text-gray-400 text-sm mb-4">Marketplace terpercaya untuk produk oleh-oleh UMKM di kawasan Bengkalis.</p>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Perusahaan</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="{{ route('about') }}" class="hover:text-green-400 transition-colors">Tentang Kami</a></li>
                        <li><a href="#" class="hover:text-green-400 transition-colors">Karir</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Bantuan</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="{{ route('contact') }}" class="hover:text-green-400 transition-colors">Pusat Bantuan</a></li>
                        <li><a href="#" class="hover:text-green-400 transition-colors">Syarat & Ketentuan</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Hubungi Kami</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li>📧 support@fanes.go</li>
                        <li>📞 +62 895-3229-32558</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-sm text-gray-400">
                <p>&copy; {{ date('Y') }} FANES.GO. All rights reserved.</p>
            </div>
        </div>
    </footer>

    @stack('scripts')
    <script>
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