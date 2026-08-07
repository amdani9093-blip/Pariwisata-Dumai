@extends('layouts.app')
@section('body-class', 'page-atraksi-create')
@section('title', 'Tambah Atraksi')

@push('styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@700;800&family=Inter:wght@400;500;600;700&family=IBM+Plex+Mono:wght@500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/atraksi-form.css') }}">
@endpush

@section('content')

<div class="form-atraksi-wrapper atraksi-scope">
    <div class="container">

        <div class="breadcrumb-wrapper">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('beranda') }}"><i class="bi bi-house-door me-1"></i>Beranda</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('atraksi') }}">Atraksi</a></li>
                    <li class="breadcrumb-item active text-muted" aria-current="page">Tambah Atraksi</li>
                </ol>
            </nav>
        </div>

        <div class="page-header">
            <div>
                <span class="badge-new"><i class="bi bi-plus-lg"></i>Entri Baru</span>
                <h1>Tambah Atraksi</h1>
                <p>Lengkapi informasi di bawah untuk menambahkan atraksi wisata baru ke katalog.</p>
            </div>
        </div>

        <div class="atraksi-grid">

            {{-- ==================== FORM ==================== --}}
            <div class="form-atraksi-card">
                <form action="{{ route('atraksi.store') }}" method="POST" id="form-atraksi">
                    @csrf

                    {{-- Bagian 1: Informasi Dasar --}}
                    <div class="form-section">
                        <div class="section-marker">
                            <div class="section-num">1</div>
                            <div class="section-line"></div>
                        </div>
                        <div class="section-body">
                            <h2>Informasi Dasar</h2>
                            <p class="section-desc">Nama dan deskripsi singkat atraksi.</p>

                <select name="destinasi_id" class="form-select @error('destinasi_id') is-invalid @enderror">
                <option value="" selected disabled>-- Pilih Destinasi --</option>
                @foreach ($destinasiList as $destinasi)
                <option value="{{ $destinasi->id }}"
                {{ old('destinasi_id', $atraksi->destinasi_id) == $destinasi->id ? 'selected' : '' }}>
                {{ $destinasi->nama }}
                </option>

                @endforeach
                </select>

                            <div class="field-block">
                                <label for="nama" class="form-label">Nama Atraksi <span class="req">*</span></label>
                                <input type="text" name="nama" id="nama" data-track
                                       class="form-control @error('nama') is-invalid @enderror"
                                       value="{{ old('nama') }}"
                                       placeholder="Contoh: Air Terjun Batu Dinding"
                                       autocomplete="off">
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="field-block">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea name="deskripsi" id="deskripsi" rows="4" data-track
                                          class="form-control @error('deskripsi') is-invalid @enderror"
                                          placeholder="Tuliskan deskripsi singkat mengenai atraksi ini...">{{ old('deskripsi') }}</textarea>
                                @error('deskripsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Bagian 2: Kategori & Harga --}}
                    <div class="form-section">
                        <div class="section-marker">
                            <div class="section-num">2</div>
                            <div class="section-line"></div>
                        </div>
                        <div class="section-body">
                            <h2>Kategori &amp; Harga</h2>
                            <p class="section-desc">Klasifikasi atraksi dan biaya masuk.</p>

                            <div class="field-block">
                                <label class="form-label">Kategori <span class="req">*</span></label>
                                <div class="kategori-segmented">
                                    <label class="seg-option">
                                        <input type="radio" name="kategori" value="Budaya" data-track {{ old('kategori') == 'Budaya' ? 'checked' : '' }}>
                                        <span class="seg-face"><i class="bi bi-mask"></i>Budaya</span>
                                    </label>
                                    <label class="seg-option">
                                        <input type="radio" name="kategori" value="Alam" data-track {{ old('kategori') == 'Alam' ? 'checked' : '' }}>
                                        <span class="seg-face"><i class="bi bi-tree"></i>Alam</span>
                                    </label>
                                    <label class="seg-option">
                                        <input type="radio" name="kategori" value="Kuliner" data-track {{ old('kategori') == 'Kuliner' ? 'checked' : '' }}>
                                        <span class="seg-face"><i class="bi bi-cup-hot"></i>Kuliner</span>
                                    </label>
                                </div>
                                @error('kategori')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="field-block">
                                <label for="harga" class="form-label">Harga</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" name="harga" id="harga" data-track
                                           class="form-control @error('harga') is-invalid @enderror"
                                           value="{{ old('harga') }}"
                                           placeholder="0" min="0">
                                </div>
                                <div class="form-text">Isi 0 kalau gratis.</div>
                                @error('harga')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Bagian 3: Media --}}
                    <div class="form-section">
                        <div class="section-marker">
                            <div class="section-num">3</div>
                        </div>
                        <div class="section-body">
                            <h2>Media</h2>
                            <p class="section-desc">Gambar yang mewakili atraksi ini.</p>

                            <div class="field-block">
                                <label for="gambar" class="form-label">Nama File Gambar</label>
                                <input type="text" name="gambar" id="gambar" data-track
                                       class="form-control @error('gambar') is-invalid @enderror"
                                       value="{{ old('gambar') }}"
                                       placeholder="contoh: tari-zapin.jpg"
                                       autocomplete="off">
                                <div class="form-text">Gunakan nama file yang sudah diunggah ke folder <code>images/atraksi</code> di server.</div>
                                @error('gambar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-simpan text-white">
                            <i class="bi bi-check2-circle me-1"></i>Simpan Atraksi
                        </button>
                        <a href="{{ route('atraksi') }}" class="btn btn-batal">
                            <i class="bi bi-x-circle me-1"></i>Batal
                        </a>
                    </div>

                </form>
            </div>

            {{-- ==================== SIDEBAR: PROGRES & PANDUAN ==================== --}}
            <div class="side-col">

                <div class="side-card">
                    <div class="progress-summary">
                        <h3>Kelengkapan Formulir</h3>
                        <span class="count"><span id="progress-count">0</span>/5</span>
                    </div>
                    <div class="progress-track">
                        <div class="progress-fill" id="progress-fill"></div>
                    </div>
                    <ul class="checklist">
                        <li data-check="nama"><span class="check-dot"><i class="bi bi-check-lg"></i></span>Nama atraksi</li>
                        <li data-check="deskripsi"><span class="check-dot"><i class="bi bi-check-lg"></i></span>Deskripsi</li>
                        <li data-check="kategori"><span class="check-dot"><i class="bi bi-check-lg"></i></span>Kategori</li>
                        <li data-check="harga"><span class="check-dot"><i class="bi bi-check-lg"></i></span>Harga</li>
                        <li data-check="gambar"><span class="check-dot"><i class="bi bi-check-lg"></i></span>Nama file gambar</li>
                    </ul>
                </div>

                <div class="side-card guide-card">
                    <h3>Panduan Pengisian</h3>
                    <p class="guide-intro">Ikuti panduan singkat ini agar data atraksi konsisten dan enak dilihat pengunjung.</p>
                    <ul class="guide-list">
                        <li>
                            <span class="guide-icon"><i class="bi bi-tag"></i></span>
                            <span class="guide-text">
                                <strong>Nama</strong>
                                <span>Gunakan nama spesifik yang mudah dikenali, misalnya nama tempat aslinya.</span>
                            </span>
                        </li>
                        <li>
                            <span class="guide-icon"><i class="bi bi-text-paragraph"></i></span>
                            <span class="guide-text">
                                <strong>Deskripsi</strong>
                                <span>Cukup 1&ndash;2 kalimat yang menonjolkan keunikan atraksi ini.</span>
                            </span>
                        </li>
                        <li>
                            <span class="guide-icon"><i class="bi bi-grid"></i></span>
                            <span class="guide-text">
                                <strong>Kategori</strong>
                                <span>Pilih salah satu yang paling sesuai: Budaya, Alam, atau Kuliner.</span>
                            </span>
                        </li>
                        <li>
                            <span class="guide-icon"><i class="bi bi-cash-coin"></i></span>
                            <span class="guide-text">
                                <strong>Harga</strong>
                                <span>Isi biaya masuk dalam Rupiah, atau 0 jika atraksi ini gratis.</span>
                            </span>
                        </li>
                        <li>
                            <span class="guide-icon"><i class="bi bi-image"></i></span>
                            <span class="guide-text">
                                <strong>Gambar</strong>
                                <span>Unggah dulu file-nya ke server, lalu tuliskan nama file-nya di sini (jpg/png).</span>
                            </span>
                        </li>
                    </ul>
                </div>

            </div>

        </div>

    </div>
</div>

<script>
    (function () {
        var trackedFields = ['nama', 'deskripsi', 'kategori', 'harga', 'gambar'];
        var progressFill = document.getElementById('progress-fill');
        var progressCount = document.getElementById('progress-count');

        function isFilled(field) {
            if (field === 'kategori') {
                return !!document.querySelector('input[name="kategori"]:checked');
            }
            var el = document.getElementById(field);
            return el && el.value.trim().length > 0;
        }

        function updateProgress() {
            var done = 0;
            trackedFields.forEach(function (field) {
                var filled = isFilled(field);
                var item = document.querySelector('.checklist li[data-check="' + field + '"]');
                if (item) {
                    item.classList.toggle('is-done', filled);
                }
                if (filled) done++;
            });
            progressCount.textContent = done;
            progressFill.style.width = (done / trackedFields.length * 100) + '%';
        }

        document.querySelectorAll('[data-track]').forEach(function (el) {
            var evt = (el.tagName === 'SELECT' || el.type === 'radio') ? 'change' : 'input';
            el.addEventListener(evt, updateProgress);
        });

        updateProgress();
    })();
</script>
@endsection