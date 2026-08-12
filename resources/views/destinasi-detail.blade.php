@extends('layouts.app')
@section('body-class', 'page-destinasi-detail')
@section('title', $destinasi->nama . ' - Detail Destinasi')

@section('content')

    {{-- External Stylesheet --}}
    <link rel="stylesheet" href="{{ asset('css/destinasi-detail.css') }}">
    <link rel="stylesheet" href="{{ asset('css/destinasi-detail-tambahan.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@1,700&display=swap" rel="stylesheet">

    <div class="container py-5">


        
        {{-- ===================== BREADCRUMB ===================== --}}
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('beranda') }}">Beranda</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('destinasi') }}">Destinasi</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    {{ $destinasi->nama }}
                </li>
            </ol>
        </nav>



        {{-- ===================== KONTEN UTAMA ===================== --}}
        <div class="row g-4">

            {{-- Gambar destinasi --}}
            <div class="col-md-6">
                <div class="detail-image-wrap">
                    <span class="badge-status">
                        <span class="dot"></span>Sedang Buka
                    </span>
                    <img src="{{ asset('storage/' . $destinasi->gambar) }}"
                         alt="{{ $destinasi->nama }}">
                </div>
            </div>


            {{-- Pengaturan Informasi destinasi --}}
            <div class="col-md-6">
                <h1 class="mb-3">{{ $destinasi->nama }}</h1>

                <p class="lead">{{ $destinasi->deskripsi }}</p>

                <ul class="list-group list-group-flush info-list mb-4">
                    <li class="list-group-item">
                        <span class="info-icon"><i class="bi bi-clock"></i></span>
                        <span>
                            <strong>Jam Operasional:</strong>
                            {{ $destinasi->jam_buka }} - {{ $destinasi->jam_tutup }}
                        </span>
                    </li>
                    <li class="list-group-item">
                        <span class="info-icon"><i class="bi bi-geo-alt"></i></span>
                        <span>
                            <strong>Lokasi:</strong> {{ $destinasi->lokasi }}
                        </span>
                    </li>
                    <li class="list-group-item">
                        <span class="info-icon"><i class="bi bi-ticket-perforated"></i></span>
                        <span>
                            <strong>Harga Tiket:</strong>
                            <span class="price-tag {{ $destinasi->harga_tiket == 0 ? 'gratis' : '' }}">
                                {{ $destinasi->harga_tiket == 0 ? 'Gratis' : 'Rp ' . number_format($destinasi->harga_tiket, 0, ',', '.') }}
                            </span>
                        </span>
                    </li>
                </ul>

                <div class="d-flex flex-wrap gap-2 align-items-center">
                    <a href="{{ route('destinasi') }}" class="action-btn btn-back">
                        <i class="bi bi-arrow-left"></i> Kembali ke Destinasi
                    </a>

                    <a href="{{ route('beranda') }}#kontak" class="action-btn btn-contact">
                        <i class="bi bi-chat-dots"></i> Hubungi Kami
                    </a>
            @if(Auth::check() && Auth::user()->role === 'admin')
                    <a href="{{ route('destinasi.edit', $destinasi->id) }}" class="action-btn btn-edit">
                        <i class="bi bi-pencil-square"></i> Edit
                    </a>
@endif

                    <form action="{{ route('destinasi.destroy', $destinasi->id) }}"
                          method="POST"
                          class="d-inline"
                          onsubmit="return confirm('Yakin ingin menghapus {{ $destinasi->nama }} beserta gambarnya? Tindakan ini tidak bisa dibatalkan.')">
                        @csrf
                        @method('DELETE')
                        @if(Auth::check() && Auth::user()->role === 'admin')
                        <button type="submit" class="btn-delete">
                            <i class="bi bi-trash"></i> Hapus
                        </button>
                        @endif
                    </form>
                </div>
            </div>
        </div>

        <hr class="my-5">

        

        {{-- ===================== PENGATURAN FASILITAS ===================== --}}
        <h5 class="mb-3">Fasilitas Tersedia</h5>
        <div class="row row-cols-2 row-cols-md-4 g-3">
            <div class="col">
                <div class="facility-box">
                    <i class="bi bi-p-circle"></i>
                    Area Parkir
                </div>
            </div>
            <div class="col">
                <div class="facility-box">
                    <i class="bi bi-house-door"></i>
                    Toilet Umum
                </div>
            </div>
            <div class="col">
                <div class="facility-box">
                    <i class="bi bi-shop"></i>
                    Warung/Kios
                </div>
            </div>
            <div class="col">
                <div class="facility-box">
                    <i class="bi bi-camera"></i>
                    Spot Foto
                </div>
            </div>
        </div>

        <hr class="my-5">

        {{-- ===================== PENGATURAN ULASAN (gaya testimoni elegan) ===================== --}}
        <div class="detail-ulasan mb-5">
            <div class="d-flex flex-wrap align-items-end justify-content-between gap-3 mb-4">
                <div>
                    <span class="ulasan-elegant-eyebrow">&#9670; Kata Pengunjung</span>
                    <h2 class="ulasan-elegant-title">Ulasan Pengunjung</h2>
                </div>

                @if ($destinasi->ulasan->count() > 0)
                    @php
                        $rataRating = $destinasi->ulasan->avg('rating');
                        $totalUlasan = $destinasi->ulasan->count();
                    @endphp
                    <div class="ulasan-summary">
                        <span class="ulasan-summary-score">{{ number_format($rataRating, 1) }}</span>
                        <div class="ulasan-summary-meta">
                            <div class="ulasan-summary-stars">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="bi {{ $i <= round($rataRating) ? 'bi-star-fill' : 'bi-star' }}"></i>
                                @endfor
                            </div>
                            <small>{{ $totalUlasan }} ulasan</small>
                        </div>
                    </div>
                @endif
            </div>

            @forelse ($destinasi->ulasan as $ulasan)
                <div class="ulasan-elegant-card">
                    <div class="ulasan-elegant-photo">
                        @if (!empty($ulasan->foto))
                            <img src="{{ asset('images/' . $ulasan->foto) }}" alt="{{ $ulasan->user->name }}">
                        @elseif (!empty($ulasan->user->foto))
                            <img src="{{ asset('images/' . $ulasan->user->foto) }}" alt="{{ $ulasan->user->name }}">
                        @else
                            {{ strtoupper(substr($ulasan->user->name, 0, 1)) }}
                        @endif
                    </div>
                    <div class="ulasan-elegant-content">
                        <div class="ulasan-elegant-name">{{ $ulasan->user->name }}</div>
                        <div class="ulasan-elegant-stars">
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="bi {{ $i <= $ulasan->rating ? 'bi-star-fill' : 'bi-star' }}"></i>
                            @endfor
                        </div>
                        <p class="ulasan-elegant-quote">{{ $ulasan->komentar }}</p>
                        @if (!empty($ulasan->created_at))
                            <span class="ulasan-elegant-date">{{ $ulasan->created_at->format('d M Y') }}</span>
                        @endif
                        <span class="ulasan-elegant-mark">&rdquo;</span>
                    </div>
                </div>
            @empty
                <div class="ulasan-empty">
                    <i class="bi bi-chat-square-heart"></i>
                    <span>Belum ada ulasan untuk destinasi ini. Jadilah yang pertama berbagi pengalaman!</span>
                </div>
            @endforelse

            <a href="{{ route('ulasan.create', $destinasi->id) }}" class="action-btn btn-tulis-ulasan mt-3">
                <i class="bi bi-pencil-square"></i> Tulis Ulasan
            </a>
        </div>

        <hr class="my-5">

        {{-- ===================== PENGATURAN ATRAKSI ===================== --}}
        <div class="detail-atraksi">
            <h2 class="section-title">Atraksi di Destinasi Ini</h2>

            <div class="row g-4">
                @forelse ($destinasi->atraksi as $atraksi)
                    <div class="col-6 col-md-4">
                        <div class="atraksi-card card h-100">
                            <div class="atraksi-img-wrap">
                                <img src="{{ asset('storage/' . $atraksi->gambar) }}"
                                     alt="{{ $atraksi->nama }}"
                                     loading="lazy">
                            </div>
                            <div class="card-body">
                                <h6 class="card-title">{{ $atraksi->nama }}</h6>
                                <span class="badge-kategori">{{ $atraksi->kategori }}</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="atraksi-empty">
                        <i class="bi bi-emoji-frown"></i>
                        <span>Belum ada atraksi untuk destinasi ini.</span>
                    </div>
                @endforelse
            </div>
        </div>

    </div>


    
@endsection