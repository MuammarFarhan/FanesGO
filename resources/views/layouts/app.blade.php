<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - FANES.GO</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-gray-100">
    <div class="flex min-h-screen">
        
        <aside class="w-64 bg-white text-gray-800 flex flex-col border-r border-gray-200">
            <div class="p-4 text-2xl font-bold border-b border-gray-200">
                <a href="{{ route('home') }}" class="text-green-600">FANES.GO</a>
            </div>
            
            <nav class="flex-1 p-4 space-y-2">
                <a href="{{ route('dashboard') }}" class="block py-2 px-3 rounded text-gray-600 hover:bg-green-50 hover:text-green-700">Dashboard</a>
                
                @if(Auth::user()->role === 'admin')
                    <a href="{{ route('produk.index') }}" class="block py-2 px-3 rounded text-gray-600 hover:bg-green-50 hover:text-green-700">Produk Saya</a>
                    <a href="{{ route('kategori.index') }}" class="block py-2 px-3 rounded text-gray-600 hover:bg-green-50 hover:text-green-700">Kategori</a>
                @endif
            </nav>
            
            <div class="p-4 border-t border-gray-200">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full py-2 px-3 rounded bg-green-600 text-white text-center hover:bg-green-700">
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <div class="flex-1 flex flex-col">
            
            <header class="bg-green-600 shadow p-4 flex justify-between items-center relative text-white">
                <h1 class="text-xl font-semibold">@yield('page-title', 'Dashboard')</h1>
                
                <div class="relative">
                    <button id="user-menu-btn" class="flex items-center space-x-3 focus:outline-none">
                        <span class="font-medium">{{ Auth::user()->name ?? 'Guest' }}</span>
                        <img src="{{ Auth::user()->file ? Auth::user()->file->file_stream : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name ?? 'Guest') }}"
                             class="w-10 h-10 rounded-full border-2 border-white/50" alt="profile">
                    </button>
                    <div id="user-dropdown"
                         class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border opacity-0 scale-95 transform transition-all duration-200 ease-out pointer-events-none z-10">
                        <div class="px-4 py-3 border-b">
                            <p class="text-sm text-gray-600">Masuk sebagai</p>
                            <p class="text-sm font-semibold text-gray-900">{{ Auth::user()->email ?? '-' }}</p>
                        </div>
                        <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">
                            Profil
                        </a>
                        <div class="border-t"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-100 transition">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </header>
            
            <main class="p-6 flex-1">
                @yield('content')
            </main>
        </div>
    </div>
    
    @stack('scripts')
    
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const btn = document.getElementById("user-menu-btn");
            const dropdown = document.getElementById("user-dropdown");
            if (btn) {
                btn.addEventListener("click", (e) => {
                    e.stopPropagation();
                    dropdown.classList.toggle("opacity-0");
                    dropdown.classList.toggle("scale-95");
                    dropdown.classList.toggle("pointer-events-none");
                });
            }
            document.addEventListener("click", (e) => {
                if (dropdown && !dropdown.contains(e.target) && !btn.contains(e.target)) {
                    dropdown.classList.add("opacity-0", "scale-95", "pointer-events-none");
                }
            });
        });
    </script>
</body>
</html>