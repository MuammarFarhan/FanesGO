<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard') - FANES.GO</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

    <div class="flex min-h-screen">

        <!-- SIDEBAR -->
        <aside class="w-64 bg-green-600 text-white flex flex-col p-4">

            <!-- BRAND -->
            <a href="{{ route('home') }}" class="text-xl font-bold mb-6">
                FANES.GO
                <span class="block text-xs font-normal">Admin Panel</span>
            </a>

            <!-- AVATAR ADMIN -->
            <a href="{{ route('profile.show') }}"
                class="flex flex-col items-center mb-6 group">

                <img
                    src="{{ auth()->user()->avatar 
                ? asset('storage/' . auth()->user()->avatar)
                : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&background=16a34a&color=fff'
            }}"
                    class="w-20 h-20 rounded-full border-4 border-white shadow
                   group-hover:scale-105 transition">

                <p class="mt-3 font-semibold text-sm">
                    {{ auth()->user()->name }}
                </p>

                <span class="text-xs opacity-80">
                    Admin
                </span>
            </a>

            <!-- NAVIGATION -->
            <nav class="space-y-2 flex-1">

                <a href="{{ route('dashboard') }}"
                    class="flex items-center gap-2 px-4 py-3 rounded-lg
                  {{ request()->routeIs('dashboard') ? 'bg-white text-green-600 font-semibold' : 'hover:bg-white/20' }}">
                    🏠 Dashboard
                </a>

                <a href="{{ route('produk.index') }}"
                    class="flex items-center gap-2 px-4 py-3 rounded-lg
                  {{ request()->is('dashboard/produk*') ? 'bg-white text-green-600 font-semibold' : 'hover:bg-white/20' }}">
                    📦 Produk
                </a>

                <a href="{{ route('profile.show') }}"
                    class="flex items-center gap-2 px-4 py-3 rounded-lg
                  {{ request()->is('dashboard/profile*') ? 'bg-white text-green-600 font-semibold' : 'hover:bg-white/20' }}">
                    ⚙️ Pengaturan Akun
                </a>

            </nav>

            <!-- LOGOUT -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button
                    class="w-full bg-white text-green-600 rounded py-2 font-semibold hover:bg-gray-100">
                    Logout
                </button>
            </form>

        </aside>

        <!-- CONTENT -->
        <main class="flex-1 p-8">
            @yield('content')
        </main>

    </div>

</body>

</html>