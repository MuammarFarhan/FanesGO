@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-1">Tambah Produk Baru</h4>
            <p class="text-muted mb-0">Isi form di bawah untuk menambah produk</p>
        </div>
        <a href="{{ route('produk.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Oops! Ada yang salah:</strong>
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Nama Produk -->
                        <div class="mb-4">
                            <label for="nama_produk" class="form-label fw-semibold">
                                Nama Produk <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control form-control-lg @error('nama_produk') is-invalid @enderror" 
                                   id="nama_produk" 
                                   name="nama_produk" 
                                   value="{{ old('nama_produk') }}"
                                   placeholder="Contoh: Sepatu Nike Air Max"
                                   required>
                            @error('nama_produk')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Kategori -->
                        <div class="mb-4">
                            <label for="kategori_id" class="form-label fw-semibold">
                                Kategori <span class="text-danger">*</span>
                            </label>
                            <select class="form-select form-select-lg @error('kategori_id') is-invalid @enderror" 
                                    id="kategori_id" 
                                    name="kategori_id" 
                                    required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}" 
                                            {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                        {{ $kategori->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kategori_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Harga & Stok -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="harga" class="form-label fw-semibold">
                                    Harga <span class="text-danger">*</span>
                                </label>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" 
                                           class="form-control @error('harga') is-invalid @enderror" 
                                           id="harga" 
                                           name="harga" 
                                           value="{{ old('harga') }}"
                                           placeholder="0"
                                           min="0"
                                           step="1000"
                                           required>
                                </div>
                                @error('harga')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="stok" class="form-label fw-semibold">
                                    Stok <span class="text-danger">*</span>
                                </label>
                                <input type="number" 
                                       class="form-control form-control-lg @error('stok') is-invalid @enderror" 
                                       id="stok" 
                                       name="stok" 
                                       value="{{ old('stok') }}"
                                       placeholder="0"
                                       min="0"
                                       required>
                                @error('stok')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Deskripsi -->
                        <div class="mb-4">
                            <label for="deskripsi" class="form-label fw-semibold">Deskripsi Produk</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                      id="deskripsi" 
                                      name="deskripsi" 
                                      rows="4"
                                      placeholder="Jelaskan detail produk Anda...">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Upload Gambar -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Gambar Produk</label>
                            <div class="border rounded-3 p-4 text-center" style="background-color: #f8f9fa;">
                                <input type="file" 
                                       class="form-control d-none" 
                                       id="gambar" 
                                       name="gambar"
                                       accept="image/*"
                                       onchange="previewImage(event)">
                                
                                <div id="preview-container" style="display: none;">
                                    <img id="preview" src="" alt="Preview" class="img-fluid rounded mb-3" style="max-height: 300px;">
                                    <br>
                                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeImage()">
                                        <i class="bi bi-trash"></i> Hapus Gambar
                                    </button>
                                </div>
                                
                                <div id="upload-placeholder">
                                    <i class="bi bi-cloud-upload" style="font-size: 3rem; color: #6c757d;"></i>
                                    <p class="mb-2 mt-3">Klik tombol di bawah untuk upload gambar</p>
                                    <label for="gambar" class="btn btn-success">
                                        <i class="bi bi-upload"></i> Pilih Gambar
                                    </label>
                                    <p class="text-muted small mb-0 mt-2">Format: JPG, PNG, GIF (Max 2MB)</p>
                                </div>
                            </div>
                            @error('gambar')
                                <div class="text-danger small mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex gap-2 justify-content-end pt-3 border-top">
                            <a href="{{ route('produk.index') }}" class="btn btn-lg btn-light px-4">
                                Batal
                            </a>
                            <button type="submit" class="btn btn-lg btn-success px-4">
                                <i class="bi bi-check-circle"></i> Simpan Produk
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Side Info -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="fw-semibold mb-3">📝 Tips Menambah Produk</h6>
                    <ul class="small text-muted mb-0">
                        <li class="mb-2">Gunakan nama produk yang jelas dan menarik</li>
                        <li class="mb-2">Pilih kategori yang sesuai</li>
                        <li class="mb-2">Cantumkan harga yang kompetitif</li>
                        <li class="mb-2">Upload gambar berkualitas tinggi</li>
                        <li>Tulis deskripsi lengkap dan informatif</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function previewImage(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview').src = e.target.result;
            document.getElementById('preview-container').style.display = 'block';
            document.getElementById('upload-placeholder').style.display = 'none';
        }
        reader.readAsDataURL(file);
    }
}

function removeImage() {
    document.getElementById('gambar').value = '';
    document.getElementById('preview-container').style.display = 'none';
    document.getElementById('upload-placeholder').style.display = 'block';
}
</script>
@endsection