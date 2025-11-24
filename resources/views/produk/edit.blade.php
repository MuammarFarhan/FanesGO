<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk - FANES.GO</title>
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
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center bg-white">
                                <h5 class="mb-0">Edit Produk</h5>
                                <a href="{{ url('/produk') }}" class="btn btn-sm btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                            </div>

                            <div class="card-body">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form action="{{ url('/produk/' . $produk->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="mb-3">
                                        <label for="nama_produk" class="form-label">Nama Produk <span class="text-danger">*</span></label>
                                        <input type="text" 
                                               class="form-control @error('nama_produk') is-invalid @enderror" 
                                               id="nama_produk" 
                                               name="nama_produk" 
                                               value="{{ old('nama_produk', $produk->nama_produk) }}"
                                               required>
                                        @error('nama_produk')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="kategori_id" class="form-label">Kategori <span class="text-danger">*</span></label>
                                        <select class="form-select @error('kategori_id') is-invalid @enderror" 
                                                id="kategori_id" 
                                                name="kategori_id" 
                                                required>
                                            <option value="">Pilih Kategori</option>
                                            @foreach($kategoris as $kategori)
                                                <option value="{{ $kategori->id }}" 
                                                        {{ old('kategori_id', $produk->kategori_id) == $kategori->id ? 'selected' : '' }}>
                                                    {{ $kategori->nama_kategori }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('kategori_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="harga" class="form-label">Harga <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <span class="input-group-text">Rp</span>
                                                <input type="number" 
                                                       class="form-control @error('harga') is-invalid @enderror" 
                                                       id="harga" 
                                                       name="harga" 
                                                       value="{{ old('harga', $produk->harga) }}"
                                                       min="0"
                                                       step="1000"
                                                       required>
                                                @error('harga')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="stok" class="form-label">Stok <span class="text-danger">*</span></label>
                                            <input type="number" 
                                                   class="form-control @error('stok') is-invalid @enderror" 
                                                   id="stok" 
                                                   name="stok" 
                                                   value="{{ old('stok', $produk->stok) }}"
                                                   min="0"
                                                   required>
                                            @error('stok')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="deskripsi" class="form-label">Deskripsi</label>
                                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                                  id="deskripsi" 
                                                  name="deskripsi" 
                                                  rows="4">{{ old('deskripsi', $produk->deskripsi) }}</textarea>
                                        @error('deskripsi')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="gambar" class="form-label">Gambar Produk</label>
                                        
                                        @if($produk->gambar)
                                            <div class="mb-2">
                                                <img src="{{ asset('storage/' . $produk->gambar) }}" 
                                                     alt="{{ $produk->nama_produk }}" 
                                                     class="img-thumbnail"
                                                     style="max-width: 200px;"
                                                     id="current-image">
                                                <p class="text-muted small mb-0 mt-1">Gambar saat ini</p>
                                            </div>
                                        @endif

                                        <input type="file" 
                                               class="form-control @error('gambar') is-invalid @enderror" 
                                               id="gambar" 
                                               name="gambar"
                                               accept="image/*"
                                               onchange="previewImage(event)">
                                        <small class="text-muted">Format: JPG, PNG, GIF (Max 2MB). Biarkan kosong jika tidak ingin mengganti gambar.</small>
                                        @error('gambar')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="mt-2">
                                            <img id="preview" src="" alt="" style="max-width: 200px; display: none;" class="img-thumbnail">
                                        </div>
                                    </div>

                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <a href="{{ url('/produk') }}" class="btn btn-secondary">Batal</a>
                                        <button type="submit" class="btn btn-warning">
                                            <i class="fas fa-save"></i> Update Produk
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    function previewImage(event) {
        const preview = document.getElementById('preview');
        const currentImage = document.getElementById('current-image');
        const file = event.target.files[0];
        
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
                if (currentImage) {
                    currentImage.style.opacity = '0.5';
                }
            }
            reader.readAsDataURL(file);
        }
    }
    </script>
</body>
</html>