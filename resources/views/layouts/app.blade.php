<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - FANES.GO</title>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    @stack('styles')
</head>

<body class="bg-gray-50 font-sans antialiased">
    <div class="flex min-h-screen">

        <!-- ==================== SIDEBAR ==================== -->
        <aside id="sidebar" class="w-64 bg-white text-gray-800 flex flex-col shadow-xl border-r border-gray-200 fixed lg:sticky top-0 h-screen z-40 transform -translate-x-full lg:translate-x-0 transition-transform duration-300">
            
            <!-- Logo Area -->
            <div class="p-6 border-b border-gray-200 bg-gradient-to-r from-green-600 to-green-700">
                <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                    <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center shadow-md group-hover:shadow-lg transition-all">
                        <span class="text-green-600 font-bold text-lg">F</span>
                    </div>
                    <div>
                        <span class="text-xl font-bold text-white">FANES.GO</span>
                        <p class="text-xs text-green-100 opacity-80">Admin Panel</p>
                    </div>
                </a>
            </div>

            <!-- Navigation Menu -->
            <nav class="flex-1 p-4 space-y-1 overflow-y-auto">
                
                <!-- 1. Dashboard -->
                <a href="{{ route('dashboard') }}" 
                   class="flex items-center space-x-3 py-3 px-4 rounded-lg transition-all duration-200 group {{ request()->routeIs('dashboard') ? 'bg-green-50 text-green-700 font-semibold' : 'text-gray-600 hover:bg-green-50 hover:text-green-700' }}">
                    <svg class="w-5 h-5 {{ request()->routeIs('dashboard') ? 'text-green-600' : 'text-gray-400 group-hover:text-green-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    <span>Dashboard</span>
                </a>

                @auth
                    <!-- 2. Produk Saya -->
                    <a href="{{ route('produk.index') }}" 
                       class="flex items-center space-x-3 py-3 px-4 rounded-lg transition-all duration-200 group {{ request()->routeIs('produk.*') ? 'bg-green-50 text-green-700 font-semibold' : 'text-gray-600 hover:bg-green-50 hover:text-green-700' }}">
                        <svg class="w-5 h-5 {{ request()->routeIs('produk.*') ? 'text-green-600' : 'text-gray-400 group-hover:text-green-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                        <span>Produk Saya</span>
                    </a>

                    <!-- 3. Kategori -->
                    <a href="{{ route('kategori.index') }}" 
                       class="flex items-center space-x-3 py-3 px-4 rounded-lg transition-all duration-200 group {{ request()->routeIs('kategori.*') ? 'bg-green-50 text-green-700 font-semibold' : 'text-gray-600 hover:bg-green-50 hover:text-green-700' }}">
                        <svg class="w-5 h-5 {{ request()->routeIs('kategori.*') ? 'text-green-600' : 'text-gray-400 group-hover:text-green-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                        <span>Kategori</span>
                    </a>

                    <!-- DIVIDER: Transaksi -->
                    <div class="pt-4 mt-4 border-t border-gray-100">
                        <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Transaksi</p>

                        <!-- 4. Pesanan Masuk -->
                        <a href="{{ route('pesanan.index') }}" 
                           class="flex items-center space-x-3 py-3 px-4 rounded-lg transition-all duration-200 group {{ request()->routeIs('pesanan.*') ? 'bg-green-50 text-green-700 font-semibold' : 'text-gray-600 hover:bg-green-50 hover:text-green-700' }}">
                            <svg class="w-5 h-5 {{ request()->routeIs('pesanan.*') ? 'text-green-600' : 'text-gray-400 group-hover:text-green-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                            <span class="flex-1">Pesanan Masuk</span>
                        </a>
                    </div>

                    <!-- DIVIDER: Toko -->
                    <div class="pt-2 mt-2">
                        <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Toko</p>

                        <!-- 5. Pengaturan Toko -->
                        <a href="{{ route('profile.show') }}" 
                           class="flex items-center space-x-3 py-3 px-4 rounded-lg transition-all duration-200 group {{ request()->routeIs('profile.*') ? 'bg-green-50 text-green-700 font-semibold' : 'text-gray-600 hover:bg-green-50 hover:text-green-700' }}">
                            <svg class="w-5 h-5 {{ request()->routeIs('profile.*') ? 'text-green-600' : 'text-gray-400 group-hover:text-green-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span>Pengaturan Toko</span>
                        </a>
                    </div>
                @endauth
            </nav>

            <!-- Logout Section -->
            <div class="p-4 border-t border-gray-200 bg-gray-50">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center justify-center space-x-2 w-full py-2.5 px-4 rounded-lg bg-white border border-red-200 text-red-600 font-semibold hover:bg-red-50 hover:border-red-300 transition-all duration-300 group">
                        <svg class="w-5 h-5 group-hover:text-red-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        <span>Keluar</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Overlay Mobile -->
        <div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-30 hidden lg:hidden backdrop-blur-sm" onclick="toggleSidebar()"></div>

        <!-- ==================== MAIN CONTENT AREA ==================== -->
        <div class="flex-1 flex flex-col min-h-screen lg:ml-0 overflow-hidden">

            <!-- Top Header -->
            <header class="bg-white shadow-sm border-b border-gray-100 sticky top-0 z-20">
                <div class="flex justify-between items-center px-6 py-3">
                    
                    <!-- Left: Mobile Toggle & Title -->
                    <div class="flex items-center space-x-4">
                        <button onclick="toggleSidebar()" class="lg:hidden p-2 rounded-lg hover:bg-gray-100 text-gray-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                        <div>
                            <h1 class="text-xl md:text-2xl font-bold text-gray-800">@yield('page-title', 'Dashboard')</h1>
                            <p class="text-xs text-gray-500 hidden md:block">Selamat datang kembali, {{ Auth::user()->name ?? 'User' }}!</p>
                        </div>
                    </div>

                    <!-- Right: Profile Dropdown -->
                    <div class="flex items-center space-x-4">
                        
                        <!-- Profile Button -->
                        <div class="relative">
                            <button id="admin-user-menu-btn" class="flex items-center space-x-3 p-1.5 rounded-full hover:bg-gray-50 transition-colors border border-transparent hover:border-gray-200">
                                <img src="{{ Auth::user()->file ? route('files.action', ['id' => Auth::user()->file->id, 'action' => 'stream']) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name ?? 'Guest') . '&background=10b981&color=fff' }}"
                                     class="w-9 h-9 rounded-full border border-gray-200 object-cover"
                                     alt="Profile">
                                <div class="hidden md:block text-left pr-2">
                                    <p class="text-sm font-semibold text-gray-700 leading-tight">{{ Auth::user()->name ?? 'Guest' }}</p>
                                    <p class="text-[10px] text-gray-500 uppercase tracking-wide">{{ Auth::user()->role ?? 'User' }}</p>
                                </div>
                                <svg class="w-4 h-4 text-gray-400 hidden md:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>

                            <!-- Dropdown Menu -->
                            <div id="admin-user-dropdown" class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-lg border border-gray-100 opacity-0 scale-95 transform transition-all duration-200 pointer-events-none z-50 origin-top-right">
                                <div class="p-4 border-b border-gray-50">
                                    <p class="text-sm font-bold text-gray-800 truncate">{{ Auth::user()->name ?? 'Guest' }}</p>
                                    <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email ?? '' }}</p>
                                </div>
                                <div class="py-1">
                                    <a href="{{ route('home') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700">
                                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                                        Lihat Toko
                                    </a>
                                    <a href="{{ route('profile.show') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700">
                                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                        Pengaturan Toko
                                    </a>
                                </div>
                                <div class="border-t border-gray-100 py-1">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="flex w-full items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                            <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                            Keluar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- CONTENT BODY -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-6">
                @yield('content')
            </main>

            <!-- FOOTER -->
            <footer class="bg-white border-t border-gray-200 py-4 px-6">
                <div class="text-center md:text-right text-xs text-gray-500">
                    &copy; {{ date('Y') }} <strong>FANES.GO</strong> - Admin Panel. All rights reserved.
                </div>
            </footer>

        </div>
    </div>

    @stack('scripts')

    <!-- JAVASCRIPT LOGIC -->
    <script>
        // --- Admin User Dropdown Logic ---
        const adminBtn = document.getElementById("admin-user-menu-btn");
        const adminDropdown = document.getElementById("admin-user-dropdown");

        if (adminBtn && adminDropdown) {
            adminBtn.addEventListener("click", (e) => {
                e.stopPropagation();
                if (adminDropdown.classList.contains('opacity-0')) {
                    adminDropdown.classList.remove('opacity-0', 'scale-95', 'pointer-events-none');
                } else {
                    adminDropdown.classList.add('opacity-0', 'scale-95', 'pointer-events-none');
                }
            });

            document.addEventListener("click", (e) => {
                if (!adminDropdown.contains(e.target) && !adminBtn.contains(e.target)) {
                    adminDropdown.classList.add('opacity-0', 'scale-95', 'pointer-events-none');
                }
            });
        }

        // --- Mobile Sidebar Toggle Logic ---
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }
    </script>
</body>
</html>