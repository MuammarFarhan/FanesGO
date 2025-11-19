<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'FANES.GO')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">
    <header class="bg-white shadow-sm border-b">
        <nav class="container mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
            <a href="/" class="text-3xl font-bold text-green-600">FANES.GO</a>
            <div class="flex items-center space-x-3">
                @guest
                <a href="{{ route('register') }}"
                    class="px-4 py-2 bg-green-600 text-white rounded-md font-semibold hover:bg-green-700 text-sm shadow">DAFTAR</a>
                <a href="{{ route('login') }}"
                    class="px-4 py-2 border border-gray-400 text-gray-700 rounded-md font-semibold hover:bg-gray-100 text-sm">MASUK</a>
                @else
                @if(Auth::user()->role === 'admin')
                <a href="{{ route('dashboard') }}"
                    class="text-sm font-medium text-gray-700 hover:text-green-600">Admin Dashboard</a>
                @endif
                <a href="{{ route('profile.show') }}"
                    class="text-sm font-medium text-gray-700 hover:text-green-600">Profil Saya</a>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit"
                        class="text-sm font-medium text-red-600 hover:text-red-800">Logout</button>
                </form>
                @endguest
            </div>
        </nav>
    </header>

    <div class="bg-green-600 p-4 shadow-md">
        <div class="container mx-auto">
            <form action="#" method="GET" class="relative">
                <input type="search" name="q" placeholder="Cari Produk..."
                    class="w-full px-4 py-2 pl-10 rounded-md border-0 focus:outline-none focus:ring-2 focus:ring-green-300"
                    required>

                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                </div>
            </form>
        </div>
    </div>

    <button type="submit"
        class="absolute inset-y-0 right-0 flex items-center pr-3 text-white hover:text-gray-100">
        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
        </svg>
    </button>
    </form>
    </div>
    </div>

    <main class="container mx-auto p-4 sm:p-6 lg:p-8">
        @yield('content')
    </main>

    <footer class="text-center py-6 mt-8 text-gray-600 text-sm">
        &copy; {{ date('Y') }} FANES.GO
    </footer>
</body>

</html>