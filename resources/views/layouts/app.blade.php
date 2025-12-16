<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}"> {{-- ADD THIS --}}
    <title>@yield('title', 'Admin Panel') - FANES.GO</title>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Alpine.js for Interactivity -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    @stack('styles')
</head>

<body class="bg-gray-50 font-sans antialiased">
    <div class="flex min-h-screen">

        <!-- SIDEBAR (existing code) -->
        <aside id="sidebar" class="w-64 bg-white text-gray-800 flex flex-col shadow-xl border-r border-gray-200 fixed lg:sticky top-0 h-screen z-40 transform -translate-x-full lg:translate-x-0 transition-transform duration-300">
            <!-- Your existing sidebar code -->
            <div class="p-6 border-b border-gray-200 bg-gradient-to-r from-green-600 to-green-700">
                <!-- ... existing logo ... -->
            </div>
            <!-- ... existing nav items ... -->
        </aside>

        <!-- MAIN CONTENT AREA -->
        <div class="flex-1 flex flex-col min-h-screen lg:ml-0 overflow-hidden">

            <!-- TOP HEADER -->
            <header class="bg-white shadow-sm border-b border-gray-100 sticky top-0 z-20">
                <div class="flex justify-between items-center px-6 py-3">
                    
                    <!-- Left: Title -->
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

                    <!-- Right: Notifications & Profile -->
                    <div class="flex items-center space-x-4">
                        
                        {{-- BELL NOTIFICATION - ADD THIS --}}
                        @include('notifications._bell')
                        
                        <!-- Profile Dropdown (existing code) -->
                        <div class="relative">
                            <button id="admin-user-menu-btn" class="flex items-center space-x-3 p-1.5 rounded-full hover:bg-gray-50 transition-colors border border-transparent hover:border-gray-200">
                                <!-- Your existing profile button -->
                            </button>
                            <!-- Your existing dropdown -->
                        </div>
                    </div>
                </div>
            </header>

            <!-- CONTENT BODY -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-6">
                @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg mb-6" role="alert">
                    <p class="font-semibold">{{ session('success') }}</p>
                </div>
                @endif

                @if(session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg mb-6" role="alert">
                    <p class="font-semibold">{{ session('error') }}</p>
                </div>
                @endif

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

    <!-- EXISTING JAVASCRIPT -->
    <script>
        // Your existing sidebar toggle and dropdown code
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            sidebar.classList.toggle('-translate-x-full');
            if(overlay) overlay.classList.toggle('hidden');
        }
    </script>
</body>
</html>