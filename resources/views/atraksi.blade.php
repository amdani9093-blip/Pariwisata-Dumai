@extends('layouts.app')
@section('body-class', 'page-atraksi-index')
@section('title', 'Daftar Atraksi')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/atraksi-index.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css">
@endpush

@section('content')
<div class="container my-5">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('beranda') }}">Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">Atraksi</li>
        </ol>
    </nav>

    <!-- Hero header -->
    <div class="atraksi-hero mb-4">
        <div class="position-relative d-flex flex-wrap justify-content-between align-items-center gap-3" style="z-index:1;">
            <div>
                <span class="badge bg-white text-primary mb-2"><i class="bi bi-stars"></i> Kelola Atraksi</span>
                <h2 class="fw-bold mb-1">Daftar Atraksi Wisata</h2>
                <p class="mb-0 opacity-75">Tambah, ubah, dan kelola seluruh atraksi yang ditampilkan ke pengunjung.</p>
            </div>
            <div class="hero-stat text-center">
                <div class="fs-4 fw-bold">{{ $atraksiList->count() ?? 0 }}</div>
                <div class="small opacity-75">Total Atraksi</div>
            </div>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success d-flex align-items-center gap-2" role="alert">
            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
        </div>
    @endif

    <div class="row g-4">
        <!-- KONTEN UTAMA -->
        <div class="col-lg-8">

            <!-- Toolbar -->
            <div class="card toolbar-card mb-4">
                <div class="card-body p-3">
                    <form action="{{ route('atraksi') }}" method="GET" class="row g-2 align-items-center">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0"><i class="bi bi-search"></i></span>
                                <input type="text" name="cari" class="form-control border-start-0"
                                       placeholder="Cari nama atraksi..."
                                       value="{{ request('cari') }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <select name="kategori" class="form-select" onchange="this.form.submit()">
                                <option value="">Semua Kategori</option>
                                <option value="Budaya" {{ request('kategori') == 'Budaya' ? 'selected' : '' }}>Budaya</option>
                                <option value="Alam" {{ request('kategori') == 'Alam' ? 'selected' : '' }}>Alam</option>
                                <option value="Kuliner" {{ request('kategori') == 'Kuliner' ? 'selected' : '' }}>Kuliner</option>
                            </select>
                        </div>
                        <div class="col-md-3 d-flex gap-2">
                            <button type="submit" class="btn btn-outline-primary flex-grow-1">
                                <i class="bi bi-funnel"></i> Filter
                            </button>
                            <a href="{{ route('atraksi.create') }}" class="btn btn-primary flex-grow-1">
                                <i class="bi bi-plus-lg"></i> Tambah
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Grid Atraksi -->
            @forelse ($atraksiList as $atraksi)
                @if ($loop->first)
                    <div class="row g-4">
                @endif

                <div class="col-md-6">
                    <div class="card atraksi-card">
                        <div class="card-img-wrap">
                            @if ($atraksi->gambar)
                                <img src="{{ asset('storage/' . $atraksi->gambar) }}" alt="{{ $atraksi->nama }}">
                            @else
                                <div class="card-img-placeholder">
                                    <i class="bi bi-image"></i>
                                </div>
                            @endif

                            @php
                                $badgeClass = match($atraksi->kategori) {
                                    'Budaya' => 'badge-budaya',
                                    'Alam' => 'badge-alam',
                                    'Kuliner' => 'badge-kuliner',
                                    default => 'badge-budaya',
                                };
                            @endphp
                            <span class="kategori-badge {{ $badgeClass }}">{{ $atraksi->kategori }}</span>
                        </div>

                        <div class="card-body p-3">
                            <h5 class="card-title mb-1">{{ $atraksi->nama }}</h5>
                            <p class="card-desc mb-2">{{ $atraksi->deskripsi }}</p>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="card-price">Rp {{ number_format($atraksi->harga, 0, ',', '.') }}</span>
                            </div>

                            <div class="d-flex gap-2">
                                <a href="{{ route('atraksi.edit', $atraksi->id) }}" class="btn btn-outline-primary btn-icon-sm flex-grow-1">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <form action="{{ route('atraksi.destroy', $atraksi->id) }}" method="POST" class="flex-grow-1"
                                      onsubmit="return confirm('Yakin ingin menghapus {{ $atraksi->nama }}?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-icon-sm w-100">
                                        <i class="bi bi-trash3"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                @if ($loop->last)
                    </div>
                @endif
            @empty
                <div class="empty-state">
                    <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                    <h5 class="fw-bold">Belum Ada Atraksi</h5>
                    <p class="mb-3">Data atraksi masih kosong atau tidak ditemukan sesuai pencarian.</p>
                    <a href="{{ route('atraksi.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-lg"></i> Tambah Atraksi Pertama
                    </a>
                </div>
            @endforelse

            <!-- Pagination (opsional, jika suatu saat controller diubah ke paginate()) -->
            @if (method_exists($atraksiList, 'links'))
                <div class="mt-4">
                    {{ $atraksiList->links() }}
                </div>
            @endif

        </div>

        <!-- PANDUAN PENGGUNAAN -->
        <div class="col-lg-4">
            <div class="card guide-card sticky-top" style="top: 1.5rem;">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-1"><i class="bi bi-compass text-primary"></i> Panduan Penggunaan</h5>
                    <p class="text-muted small mb-3">Ikuti langkah berikut untuk mengelola daftar atraksi.</p>

                    <div class="guide-step">
                        <div class="guide-step-number">1</div>
                        <div>
                            <strong class="d-block">Cari &amp; Filter</strong>
                            <span class="text-muted small">Gunakan kolom pencarian untuk menemukan atraksi tertentu, atau filter berdasarkan kategori.</span>
                        </div>
                    </div>
                    <div class="guide-step">
                        <div class="guide-step-number">2</div>
                        <div>
                            <strong class="d-block">Tambah Atraksi</strong>
                            <span class="text-muted small">Klik tombol <em>Tambah</em> di pojok kanan toolbar untuk menambahkan atraksi baru.</span>
                        </div>
                    </div>
                    <div class="guide-step">
                        <div class="guide-step-number">3</div>
                        <div>
                            <strong class="d-block">Edit Data</strong>
                            <span class="text-muted small">Klik ikon <i class="bi bi-pencil-square"></i> pada kartu atraksi untuk mengubah informasinya.</span>
                        </div>
                    </div>
                    <div class="guide-step">
                        <div class="guide-step-number">4</div>
                        <div>
                            <strong class="d-block">Hapus Data</strong>
                            <span class="text-muted small">Klik ikon <i class="bi bi-trash3"></i> untuk menghapus. Sistem akan meminta konfirmasi terlebih dahulu.</span>
                        </div>
                    </div>
                    <div class="guide-step">
                        <div class="guide-step-number">5</div>
                        <div>
                            <strong class="d-block">Kategori Warna</strong>
                            <span class="text-muted small">
                                <span class="badge" style="background:#d97706;">Budaya</span>
                                <span class="badge" style="background:#198754;">Alam</span>
                                <span class="badge" style="background:#dc3545;">Kuliner</span>
                                — label warna membantu membedakan jenis atraksi secara cepat.
                            </span>
                        </div>
                    </div>

                    <div class="alert alert-info small mt-3 mb-0 d-flex gap-2">
                        <i class="bi bi-shield-check mt-1"></i>
                        <div>Data yang dihapus tidak dapat dikembalikan, pastikan sudah yakin sebelum konfirmasi.</div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection