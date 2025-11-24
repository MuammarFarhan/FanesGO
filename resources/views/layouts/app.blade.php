<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - FANES.GO</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>

<body class="bg-gray-50">
    <div class="flex min-h-screen">

        <!-- Sidebar -->
        <aside id="sidebar" class="w-64 bg-white text-gray-800 flex flex-col shadow-xl border-r border-gray-200 fixed lg:sticky top-0 h-screen z-40 transform -translate-x-full lg:translate-x-0 transition-transform duration-300">
            <!-- Logo -->
            <div class="p-6 border-b border-gray-200 bg-gradient-to-r from-green-600 to-green-700">
                <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                    <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center shadow-md group-hover:shadow-lg transition-all">
                        <span class="text-green-600 font-bold text-lg">F</span>
                    </div>
                    <div>
                        <span class="text-xl font-bold text-white">FANES.GO</span>
                        <p class="text-xs text-green-100">Admin Panel</p>
                    </div>
                </a>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 p-4 space-y-1 overflow-y-auto">
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 py-3 px-4 rounded-lg text-gray-700 hover:bg-green-50 hover:text-green-700 transition-all duration-200 group {{ request()->routeIs('dashboard') ? 'bg-green-50 text-green-700' : '' }}">
                    <svg class="w-5 h-5 {{ request()->routeIs('dashboard') ? 'text-green-600' : 'text-gray-400 group-hover:text-green-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    <span class="font-medium">Dashboard</span>
                </a>

                @if(Auth::user()->role === 'admin')
                <a href="{{ route('produk.index') }}" class="flex items-center space-x-3 py-3 px-4 rounded-lg text-gray-700 hover:bg-green-50 hover:text-green-700 transition-all duration-200 group {{ request()->routeIs('produk.*') ? 'bg-green-50 text-green-700' : '' }}">
                    <svg class="w-5 h-5 {{ request()->routeIs('produk.*') ? 'text-green-600' : 'text-gray-400 group-hover:text-green-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                    <span class="font-medium">Produk Saya</span>
                </a>

                <a href="{{ route('kategori.index') }}" class="flex items-center space-x-3 py-3 px-4 rounded-lg text-gray-700 hover:bg-green-50 hover:text-green-700 transition-all duration-200 group {{ request()->routeIs('kategori.*') ? 'bg-green-50 text-green-700' : '' }}">
                    <svg class="w-5 h-5 {{ request()->routeIs('kategori.*') ? 'text-green-600' : 'text-gray-400 group-hover:text-green-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                    </svg>
                    <span class="font-medium">Kategori</span>
                </a>

                <div class="pt-4 mt-4 border-t border-gray-200">
                    <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Lainnya</p>

                    <a href="#" class="flex items-center space-x-3 py-3 px-4 rounded-lg text-gray-700 hover:bg-green-50 hover:text-green-700 transition-all duration-200 group">
                        <svg class="w-5 h-5 text-gray-400 group-hover:text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        <span class="font-medium">Laporan</span>
                    </a>

                    <a href="#" class="flex items-center space-x-3 py-3 px-4 rounded-lg text-gray-700 hover:bg-green-50 hover:text-green-700 transition-all duration-200 group">
                        <svg class="w-5 h-5 text-gray-400 group-hover:text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span class="font-medium">Pengaturan</span>
                    </a>
                </div>
                @endif
            </nav>

            <!-- Logout Button -->
            <div class="p-4 border-t border-gray-200 bg-gray-50">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center justify-center space-x-2 w-full py-3 px-4 rounded-lg bg-gradient-to-r from-red-500 to-red-600 text-white font-semibold hover:from-red-600 hover:to-red-700 shadow-md hover:shadow-lg transition-all duration-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Overlay for mobile -->
        <div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-30 hidden lg:hidden" onclick="toggleSidebar()"></div>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col min-h-screen lg:ml-0">

            <!-- Top Header -->
            <header class="bg-white shadow-md sticky top-0 z-20">
                <div class="flex justify-between items-center px-6 py-4">
                    <!-- Mobile Menu + Page Title -->
                    <div class="flex items-center space-x-4">
                        <button onclick="toggleSidebar()" class="lg:hidden p-2 rounded-lg hover:bg-gray-100 transition-colors">
                            <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                        <div>
                            <h1 class="text-xl md:text-2xl font-bold text-gray-800">@yield('page-title', 'Dashboard')</h1>
                            <p class="text-sm text-gray-500 hidden md:block">Kelola bisnis Anda dengan mudah</p>
                        </div>
                    </div>

                    <!-- Right Section -->
                    <div class="flex items-center space-x-4">
                        <!-- Notifications -->
                        <button class="relative p-2 rounded-lg hover:bg-gray-100 transition-colors">
                            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                            </svg>
                            <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                        </button>

                        <!-- User Profile -->
                        <div class="relative">
                            <button id="admin-user-menu-btn" class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-gray-100 transition-colors">
                                <img src="{{ Auth::user()->file ? Auth::user()->file->file_stream : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name ?? 'Guest') . '&background=10b981&color=fff' }}"
                                    class="w-10 h-10 rounded-full border-2 border-green-500 object-cover shadow-md"
                                    alt="profile">
                                <div class="hidden md:block text-left">
                                    <p class="text-sm font-semibold text-gray-800">{{ Auth::user()->name ?? 'Guest' }}</p>
                                    <p class="text-xs text-gray-500">{{ Auth::user()->role === 'admin' ? 'Administrator' : 'User' }}</p>
                                </div>
                                <svg class="w-4 h-4 text-gray-600 hidden md:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>

                            <!-- Dropdown Menu -->
                            <div id="admin-user-dropdown"
                                class="absolute right-0 mt-2 w-64 bg-white rounded-xl shadow-2xl border border-gray-100 opacity-0 scale-95 transform transition-all duration-200 pointer-events-none z-50">
                                <div class="p-4 border-b border-gray-100 bg-gradient-to-r from-green-50 to-green-100">
                                    <div class="flex items-center space-x-3">
                                        <img src="{{ Auth::user()->file ? Auth::user()->file->file_stream : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name ?? 'Guest') . '&background=10b981&color=fff' }}"
                                            class="w-12 h-12 rounded-full border-2 border-green-500 object-cover"
                                            alt="profile">
                                        <div>
                                            <p class="text-sm font-semibold text-gray-800">{{ Auth::user()->name ?? 'Guest' }}</p>
                                            <p class="text-xs text-gray-600">{{ Auth::user()->email ?? '-' }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="py-2">
                                    <a href="{{ route('profile.show') }}" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-green-50 transition-colors">
                                        <svg class="w-5 h-5 mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                        Profil Saya
                                    </a>

                                    <a href="{{ route('home') }}" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-green-50 transition-colors">
                                        <svg class="w-5 h-5 mr-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                        </svg>
                                        Kembali ke Beranda
                                    </a>

                                    <a href="#" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-green-50 transition-colors">
                                        <svg class="w-5 h-5 mr-3 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        Pengaturan
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
                    </div>
                </div>
            </header>

            <!-- Main Content -->
            <main class="p-6 flex-1 bg-gray-50">
                @yield('content')
            </main>

            <!-- Footer -->
            <footer class="bg-white border-t border-gray-200 py-4 px-6 text-center text-sm text-gray-600">
                &copy; {{ date('Y') }} FANES.GO - Admin Panel. All rights reserved.
            </footer>
        </div>
    </div>

    @stack('scripts')

    <script>
        // Admin User Dropdown
        const adminBtn = document.getElementById("admin-user-menu-btn");
        const adminDropdown = document.getElementById("admin-user-dropdown");

        if (adminBtn && adminDropdown) {
            adminBtn.addEventListener("click", (e) => {
                e.stopPropagation();
                adminDropdown.classList.toggle("opacity-0");
                adminDropdown.classList.toggle("scale-95");
                adminDropdown.classList.toggle("pointer-events-none");
            });

            document.addEventListener("click", (e) => {
                if (!adminDropdown.contains(e.target) && !adminBtn.contains(e.target)) {
                    adminDropdown.classList.add("opacity-0", "scale-95", "pointer-events-none");
                }
            });
        }

        // Mobile Sidebar Toggle
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');

            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }
    </script>
</body>

</html>