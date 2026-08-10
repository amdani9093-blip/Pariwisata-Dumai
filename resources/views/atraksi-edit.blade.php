@extends('layouts.app')
@section('body-class', 'page-atraksi-edit')
@section('title', 'Edit ' . $atraksi->nama)

@push('styles')
<link rel="stylesheet" href="{{ asset('css/atraksi-edit.css') }}">
@endpush

@section('content')
<div class="container my-5">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('beranda') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('atraksi') }}">Atraksi</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit {{ $atraksi->nama }}</li>
        </ol>
    </nav>

    <!-- Hero header -->
    <div class="edit-hero mb-4">
        <div class="position-relative" style="z-index:1;">
            <span class="badge bg-white text-primary mb-2"><i class="bi bi-pencil-square"></i> Mode Edit</span>
            <h2 class="fw-bold mb-1">{{ $atraksi->nama }}</h2>
            <p class="mb-0 opacity-75">Perbarui informasi atraksi agar tetap akurat dan menarik bagi pengunjung.</p>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger d-flex align-items-start gap-2" role="alert">
            <i class="bi bi-exclamation-triangle-fill mt-1"></i>
            <div>
                <strong>Periksa kembali isian Anda.</strong>
                <ul class="mb-0 mt-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <div class="row g-4">
        <!-- FORM -->
        <div class="col-lg-8">
            <div class="card form-card">
                <div class="card-body p-4 p-md-5">

                    <form action="{{ route('atraksi.update', $atraksi->id) }}" method="POST" id="formEditAtraksi">
                        @csrf
                        @method('PUT')

                        <!-- Informasi Umum -->
                        <div class="form-section-title"><i class="bi bi-info-circle"></i> Informasi Umum</div>
<select name="destinasi_id" class="form-select @error('destinasi_id') is-invalid @enderror">
    <option value="" selected disabled>-- Pilih Destinasi --</option>
    @foreach ($destinasiList as $destinasi)
        <option value="{{ $destinasi->id }}"
    {{ old('destinasi_id', $atraksi->destinasi_id) == $destinasi->id ? 'selected' : '' }}>
    {{ $destinasi->nama }}
</option>

    @endforeach
</select>


                        <div class="form-floating mb-3">
                            <input type="text" name="nama" id="nama"
                                   class="form-control @error('nama') is-invalid @enderror"
                                   placeholder="Nama Atraksi"
                                   value="{{ old('nama', $atraksi->nama) }}">
                            <label for="nama">Nama Atraksi</label>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-floating mb-4">
                            <textarea name="deskripsi" id="deskripsi" rows="5"
                                      style="height: 130px"
                                      class="form-control @error('deskripsi') is-invalid @enderror"
                                      placeholder="Deskripsi">{{ old('deskripsi', $atraksi->deskripsi) }}</textarea>
                            <label for="deskripsi">Deskripsi</label>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text"><i class="bi bi-lightbulb"></i> Tulis deskripsi singkat namun menggambarkan daya tarik utama atraksi.</div>
                        </div>

                        <!-- Detail & Harga -->
                        <div class="form-section-title mt-2"><i class="bi bi-tags"></i> Detail &amp; Harga</div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select name="kategori" id="kategori"
                                            class="form-select @error('kategori') is-invalid @enderror">
                                        <option value="Budaya" {{ old('kategori', $atraksi->kategori) == 'Budaya' ? 'selected' : '' }}>Budaya</option>
                                        <option value="Alam" {{ old('kategori', $atraksi->kategori) == 'Alam' ? 'selected' : '' }}>Alam</option>
                                        <option value="Kuliner" {{ old('kategori', $atraksi->kategori) == 'Kuliner' ? 'selected' : '' }}>Kuliner</option>
                                    </select>
                                    <label for="kategori">Kategori</label>
                                    @error('kategori')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="number" name="harga" id="harga" min="0"
                                           class="form-control @error('harga') is-invalid @enderror"
                                           placeholder="Harga"
                                           value="{{ old('harga', $atraksi->harga) }}">
                                    <label for="harga">Harga (Rp)</label>
                                    @error('harga')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Gambar -->
                        <div class="form-section-title"><i class="bi bi-image"></i> Gambar</div>

                        <div class="row g-3 align-items-start mb-2">
                            <div class="col-md-7">
                                <div class="form-floating">
                                    <input type="text" name="gambar" id="gambar"
                                           class="form-control @error('gambar') is-invalid @enderror"
                                           placeholder="Nama File Gambar"
                                           value="{{ old('gambar', $atraksi->gambar) }}">
                                    <label for="gambar">Nama File Gambar</label>
                                    @error('gambar')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-text"><i class="bi bi-folder2-open"></i> Contoh: <code>pantai-koneng.jpg</code>. File harus sudah ada di folder <code>public/images/atraksi</code>.</div>
                            </div>
                            <div class="col-md-5">
                                <div class="preview-box" id="previewBox">
                                    @if($atraksi->gambar)
                                        <img src="{{ asset('storage/atraksi/' . $atraksi->gambar) }}" alt="{{ $atraksi->nama }}" id="previewImg">
                                    @else
                                        <span id="previewPlaceholder"><i class="bi bi-image d-block fs-3 mb-1"></i>Pratinjau gambar</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="sticky-actions d-flex flex-wrap justify-content-between align-items-center gap-2">
                            <a href="{{ route('atraksi') }}" class="btn btn-outline-secondary btn-save">
                                <i class="bi bi-arrow-left"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-primary btn-save">
                                <i class="bi bi-check2-circle"></i> Simpan Perubahan
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>

        <!-- PANDUAN PENGGUNAAN -->
        <div class="col-lg-4">
            <div class="card guide-card sticky-top" style="top: 1.5rem;">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-1"><i class="bi bi-compass text-primary"></i> Panduan Pengisian</h5>
                    <p class="text-muted small mb-3">Ikuti langkah berikut agar data atraksi tersimpan dengan rapi.</p>

                    <div class="guide-step">
                        <div class="guide-step-number">1</div>
                        <div>
                            <strong class="d-block">Nama &amp; Deskripsi</strong>
                            <span class="text-muted small">Gunakan nama yang jelas dan deskripsi yang menonjolkan keunikan atraksi.</span>
                        </div>
                    </div>
                    <div class="guide-step">
                        <div class="guide-step-number">2</div>
                        <div>
                            <strong class="d-block">Kategori</strong>
                            <span class="text-muted small">Pilih salah satu: Budaya, Alam, atau Kuliner sesuai jenis atraksi.</span>
                        </div>
                    </div>
                    <div class="guide-step">
                        <div class="guide-step-number">3</div>
                        <div>
                            <strong class="d-block">Harga</strong>
                            <span class="text-muted small">Masukkan harga tiket dalam angka tanpa titik atau simbol Rp.</span>
                        </div>
                    </div>
                    <div class="guide-step">
                        <div class="guide-step-number">4</div>
                        <div>
                            <strong class="d-block">Gambar</strong>
                            <span class="text-muted small">Pastikan nama file sesuai dengan file yang tersimpan di server, lalu cek pratinjau di sebelah kanan.</span>
                        </div>
                    </div>
                    <div class="guide-step">
                        <div class="guide-step-number">5</div>
                        <div>
                            <strong class="d-block">Simpan</strong>
                            <span class="text-muted small">Klik <em>Simpan Perubahan</em> setelah semua data diperiksa kembali.</span>
                        </div>
                    </div>

                    <div class="alert alert-info small mt-3 mb-0 d-flex gap-2">
                        <i class="bi bi-shield-check mt-1"></i>
                        <div>Perubahan akan langsung tampil di halaman Atraksi setelah disimpan.</div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Bootstrap Icons (jika belum ada di layout utama) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css">

@push('scripts')
<script>
    // Pratinjau otomatis saat nama file gambar diubah
    document.getElementById('gambar').addEventListener('input', function () {
        const box = document.getElementById('previewBox');
        const filename = this.value.trim();
        if (!filename) {
            box.innerHTML = '<span><i class="bi bi-image d-block fs-3 mb-1"></i>Pratinjau gambar</span>';
            return;
        }
        box.innerHTML = `<img src="/images/atraksi/${filename}" alt="Pratinjau" onerror="this.parentElement.innerHTML='<span><i class=\\'bi bi-exclamation-circle d-block fs-3 mb-1\\'></i>File tidak ditemukan</span>'">`;
    });
</script>
@endpush
@endsection