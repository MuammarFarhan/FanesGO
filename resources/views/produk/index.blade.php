<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk - FANES.GO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .sidebar {
            width: 250px;
            min-height: 100vh;
            background-color: #fff;
            border-right: 1px solid #dee2e6;
        }
        .nav-link {
            color: #333;
            padding: 10px 15px;
            border-radius: 5px;
            transition: all 0.3s;
        }
        .nav-link:hover {
            background-color: #f8f9fa;
            color: #28a745;
        }
        .nav-link.active {
            background-color: #e9ecef;
            color: #28a745;
            font-weight: 500;
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="p-3">
                <h4 class="text-success mb-4">FANES.GO</h4>
                
                <ul class="nav flex-column">
                    <li class="nav-item mb-2">
                        <a href="{{ url('/') }}" class="nav-link">
                            <i class="fas fa-tachometer-alt me-2"></i>
                            Dashboard
                        </a>
                    </li>
                    
                    <li class="nav-item mb-2">
                        <a href="{{ url('/produk') }}" class="nav-link active">
                            <i class="fas fa-box me-2"></i>
                            Produk Saya
                        </a>
                    </li>
                    
                    <li class="nav-item mb-2">
                        <a href="{{ url('/kategori') }}" class="nav-link">
                            <i class="fas fa-tags me-2"></i>
                            Kategori
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="flex-grow-1">
            <!-- Header -->
            <div class="bg-success text-white p-3 d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Produk Saya</h5>
                <span>siti aisyah</span>
            </div>

            <!-- Content -->
            <div class="container-fluid p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4>Daftar Produk</h4>
                    <a href="{{ url('/produk/create') }}" class="btn btn-success">
                        <i class="fas fa-plus"></i> Tambah Produk
                    </a>
                </div>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Gambar</th>
                                        <th>Nama Produk</th>
                                        <th>Kategori</th>
                                        <th>Harga</th>
                                        <th>Stok</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($produks as $produk)
                                    <tr>
                                        <td class="text-center">
                                            @if($produk->gambar)
                                                <img src="{{ asset('storage/' . $produk->gambar) }}" 
                                                     alt="{{ $produk->nama_produk }}" 
                                                     class="img-thumbnail" 
                                                     style="width: 60px; height: 60px; object-fit: cover;">
                                            @else
                                                <div class="bg-secondary d-flex align-items-center justify-content-center text-white mx-auto" 
                                                     style="width: 60px; height: 60px; font-size: 10px;">
                                                    No Image
                                                </div>
                                            @endif
                                        </td>
                                        <td>{{ $produk->nama_produk }}</td>
                                        <td>
                                            <span class="badge bg-info">
                                                {{ $produk->kategori->nama_kategori ?? '-' }}
                                            </span>
                                        </td>
                                        <td>Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
                                        <td class="text-center">
                                            <span class="badge {{ $produk->stok > 10 ? 'bg-success' : ($produk->stok > 0 ? 'bg-warning' : 'bg-danger') }}">
                                                {{ $produk->stok }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ url('/produk/' . $produk->id . '/edit') }}" 
                                                   class="btn btn-sm btn-warning" 
                                                   title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ url('/produk/' . $produk->id) }}" 
                                                      method="POST" 
                                                      class="d-inline"
                                                      onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="btn btn-sm btn-danger" 
                                                            title="Hapus">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4">
                                            <p class="text-muted mb-2">Anda belum memiliki produk.</p>
                                            <a href="{{ url('/produk/create') }}" class="btn btn-success btn-sm">
                                                <i class="fas fa-plus"></i> Tambah Produk Pertama
                                            </a>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>