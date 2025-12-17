<nav class="bg-green-600 text-white">
    <div class="max-w-7xl mx-auto px-6 py-3 flex justify-between items-center">

        {{-- LOGO --}}
        <a href="{{ route('dashboard') }}" class="flex items-center gap-2 font-bold text-lg">
            <div class="w-8 h-8 bg-white text-green-600 rounded-full flex items-center justify-center">
                F
            </div>
            FANES.GO
        </a>

        {{-- MENU --}}
        <div class="flex items-center gap-6 text-sm">
            <a href="{{ route('dashboard') }}" class="hover:underline">
                Dashboard
            </a>
            <a href="{{ route('produk.index') }}" class="hover:underline">
                Produk
            </a>
            <a href="{{ route('kategori.index') }}" class="hover:underline">
                Kategori
            </a>

            {{-- LOGOUT --}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="bg-white text-green-600 px-3 py-1 rounded-lg hover:bg-gray-100">
                    Logout
                </button>
            </form>
        </div>

    </div>
</nav>
