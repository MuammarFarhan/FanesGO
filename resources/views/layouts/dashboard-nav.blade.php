<nav class="bg-green-600 px-6 py-4 flex items-center justify-between">
    <div class="flex items-center gap-6">
        <span class="font-bold text-lg text-white">FANES.GO</span>

        <a href="{{ route('dashboard') }}" class="text-white hover:underline">Dashboard</a>
        <a href="{{ route('produk.index') }}" class="text-white hover:underline">Produk</a>
        <a href="{{ route('kategori.index') }}" class="text-white hover:underline">Kategori</a>
    </div>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button class="bg-white text-green-600 px-4 py-1 rounded">
            Logout
        </button>
    </form>
</nav>
