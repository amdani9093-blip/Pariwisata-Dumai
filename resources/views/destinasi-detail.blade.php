@extends('layouts.app')

@section('body-class', 'page-destinasi-detail')
@section('title', ($destinasi->nama ?? 'Destinasi') . ' - Detail Destinasi')

@section('content')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@1,700&family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<link rel="stylesheet" href="{{ asset('css/destinasi-detail.css') }}">

<div class="destination-detail-page">

    <div class="destination-container">

        {{-- BREADCRUMB --}}
        <nav class="destination-breadcrumb" aria-label="breadcrumb">
            <a href="{{ route('beranda') }}">
                <i class="bi bi-house-door-fill"></i>
                Beranda
            </a>
            <i class="bi bi-chevron-right"></i>
            <a href="{{ route('destinasi') }}">Destinasi</a>
            <i class="bi bi-chevron-right"></i>
            <span>{{ $destinasi->nama }}</span>
        </nav>

        {{-- DETAIL UTAMA --}}
        <section class="destination-hero-card">

            <div class="destination-hero-grid">

                {{-- FOTO --}}
                <div class="destination-photo-column">
                    <div class="destination-main-photo">

                        <div class="destination-photo-shine"></div>

                        <span class="destination-open-badge">
                            <span class="destination-status-dot"></span>
                            Sedang Buka
                        </span>

                        @if(!empty($destinasi->gambar))
                            <img
                                src="{{ asset('storage/' . $destinasi->gambar) }}"
                                alt="Foto {{ $destinasi->nama }}"
                                loading="eager"
                            >
                        @else
                            <img
                                src="{{ asset('images/no-image.jpg') }}"
                                alt="Gambar {{ $destinasi->nama }} tidak tersedia"
                                loading="eager"
                            >
                        @endif

                        <div class="destination-photo-caption">
                            <i class="bi bi-geo-alt-fill"></i>
                            <span>{{ $destinasi->lokasi ?? 'Kota Dumai' }}</span>
                        </div>
                    </div>
                </div>

                {{-- INFORMASI --}}
                <div class="destination-info-column">

                    @if(!empty($destinasi->kategori))
                        <span class="destination-category">
                            <i class="bi bi-tag-fill"></i>
                            {{ $destinasi->kategori->nama_kategori }}
                        </span>
                    @endif

                    <span class="destination-eyebrow">
                        ✦ DESTINASI WISATA DUMAI
                    </span>

                    <h1 class="destination-title">
                        {{ $destinasi->nama }}
                    </h1>

                    <div class="destination-title-line"></div>

                    <div class="destination-description">
                        @if(!empty($destinasi->deskripsi))
                            <p>{{ $destinasi->deskripsi }}</p>
                        @else
                            <p class="is-muted">Deskripsi destinasi belum tersedia.</p>
                        @endif
                    </div>

                    <div class="destination-info-grid">

                        <div class="destination-info-box">
                            <span class="destination-info-icon">
                                <i class="bi bi-clock-fill"></i>
                            </span>
                            <div>
                                <small>Jam Operasional</small>
                                <strong>
                                    @if(!empty($destinasi->jam_buka) || !empty($destinasi->jam_tutup))
                                        {{ $destinasi->jam_buka ?? '-' }} – {{ $destinasi->jam_tutup ?? '-' }}
                                    @else
                                        Belum tersedia
                                    @endif
                                </strong>
                            </div>
                        </div>

                        <div class="destination-info-box">
                            <span class="destination-info-icon">
                                <i class="bi bi-geo-alt-fill"></i>
                            </span>
                            <div>
                                <small>Lokasi</small>
                                <strong>{{ $destinasi->lokasi ?? 'Lokasi belum tersedia' }}</strong>
                            </div>
                        </div>

                        <div class="destination-info-box">
                            <span class="destination-info-icon">
                                <i class="bi bi-ticket-perforated-fill"></i>
                            </span>
                            <div>
                                <small>Harga Tiket</small>
                                @if(($destinasi->harga_tiket ?? 0) == 0)
                                    <strong class="price-free">Gratis</strong>
                                @else
                                    <strong class="price-normal">
                                        Rp {{ number_format($destinasi->harga_tiket, 0, ',', '.') }}
                                    </strong>
                                @endif
                            </div>
                        </div>

                    </div>

                    <div class="destination-actions">

                        <a href="{{ route('destinasi') }}" class="destination-action destination-action-back">
                            <i class="bi bi-arrow-left"></i>
                            Kembali
                        </a>

                        <a href="{{ route('beranda') }}#kontak" class="destination-action destination-action-contact">
                            <i class="bi bi-chat-dots-fill"></i>
                            Hubungi Kami
                        </a>

                        @if(!empty($destinasi->lokasi))
                            <a
                                href="https://www.google.com/maps/search/?api=1&query={{ urlencode($destinasi->lokasi) }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="destination-action destination-action-map"
                            >
                                <i class="bi bi-map-fill"></i>
                                Lihat Maps
                            </a>
                        @endif

                        @if(Auth::check() && Auth::user()->role === 'admin')

                            <a
                                href="{{ route('destinasi.edit', $destinasi->id) }}"
                                class="destination-action destination-action-edit"
                            >
                                <i class="bi bi-pencil-square"></i>
                                Edit
                            </a>

                            <form
                                action="{{ route('destinasi.destroy', $destinasi->id) }}"
                                method="POST"
                                class="destination-delete-form"
                                onsubmit="return confirm('Yakin ingin menghapus {{ $destinasi->nama }} beserta gambarnya? Tindakan ini tidak bisa dibatalkan.')"
                            >
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="destination-action destination-action-delete">
                                    <i class="bi bi-trash3-fill"></i>
                                    Hapus
                                </button>
                            </form>

                        @endif

                    </div>

                </div>
            </div>

        </section>

        {{-- ATRAKSI --}}
        <section class="destination-section destination-attraction-section">

            <div class="destination-section-heading">
                <div>
                    <span class="destination-section-eyebrow">✦ JELAJAHI LEBIH BANYAK</span>
                    <h2>Atraksi di Destinasi Ini</h2>
                    <p>Nikmati berbagai atraksi dan pengalaman menarik yang tersedia di destinasi ini.</p>
                </div>
            </div>

            <div class="destination-attraction-grid">

                @forelse($destinasi->atraksi ?? [] as $atraksi)

                    <article class="destination-attraction-card">

                        <div class="destination-attraction-image">

                            @if(!empty($atraksi->gambar))
                                <img
                                    src="{{ asset('storage/' . $atraksi->gambar) }}"
                                    alt="{{ $atraksi->nama }}"
                                    loading="lazy"
                                >
                            @else
                                <img
                                    src="{{ asset('images/no-image.jpg') }}"
                                    alt="Gambar {{ $atraksi->nama }} tidak tersedia"
                                    loading="lazy"
                                >
                            @endif

                        </div>

                        <div class="destination-attraction-body">

                            @if(!empty($atraksi->kategori))
                                <span class="destination-attraction-category">
                                    ✦ {{ $atraksi->kategori }}
                                </span>
                            @endif

                            <h3>{{ $atraksi->nama }}</h3>

                            @if(!empty($atraksi->deskripsi))
                                <p>
                                    {{ \Illuminate\Support\Str::limit(strip_tags($atraksi->deskripsi), 100) }}
                                </p>
                            @endif

                            @if(isset($atraksi->harga))
                                <div class="destination-attraction-price">
                                    <small>Harga</small>
                                    @if($atraksi->harga == 0)
                                        <strong class="price-free">Gratis</strong>
                                    @else
                                        <strong>Rp {{ number_format($atraksi->harga, 0, ',', '.') }}</strong>
                                    @endif
                                </div>
                            @endif

                            <button
                                type="button"
                                class="destination-detail-button"
                                data-bs-toggle="modal"
                                data-bs-target="#modalAtraksi{{ $atraksi->id }}"
                            >
                                <span>Lihat Detail</span>
                                <i class="bi bi-arrow-right"></i>
                            </button>

                        </div>

                    </article>

                    {{-- MODAL ATRAKSI --}}
                    <div
                        class="modal fade destination-modal"
                        id="modalAtraksi{{ $atraksi->id }}"
                        tabindex="-1"
                        aria-labelledby="modalAtraksiLabel{{ $atraksi->id }}"
                        aria-hidden="true"
                    >
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <div>
                                        <small>ATRAKSI DESTINASI</small>
                                        <h5 class="modal-title" id="modalAtraksiLabel{{ $atraksi->id }}">
                                            {{ $atraksi->nama }}
                                        </h5>
                                    </div>

                                    <button
                                        type="button"
                                        class="btn-close"
                                        data-bs-dismiss="modal"
                                        aria-label="Tutup"
                                    ></button>
                                </div>

                                <div class="modal-body">

                                    @if(!empty($atraksi->gambar))
                                        <img
                                            src="{{ asset('storage/' . $atraksi->gambar) }}"
                                            class="destination-modal-image"
                                            alt="{{ $atraksi->nama }}"
                                        >
                                    @endif

                                    <div class="destination-modal-meta">

                                        @if(!empty($atraksi->kategori))
                                            <span>
                                                <i class="bi bi-tag-fill"></i>
                                                {{ $atraksi->kategori }}
                                            </span>
                                        @endif

                                        @if(isset($atraksi->harga))
                                            <span>
                                                <i class="bi bi-ticket-perforated-fill"></i>
                                                @if($atraksi->harga == 0)
                                                    Gratis
                                                @else
                                                    Rp {{ number_format($atraksi->harga, 0, ',', '.') }}
                                                @endif
                                            </span>
                                        @endif

                                    </div>

                                    @if(!empty($atraksi->deskripsi))
                                        <div class="destination-modal-description">
                                            {!! nl2br(e($atraksi->deskripsi)) !!}
                                        </div>
                                    @else
                                        <p class="is-muted">Deskripsi atraksi belum tersedia.</p>
                                    @endif

                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="destination-modal-close" data-bs-dismiss="modal">
                                        Tutup
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>

                @empty

                    <div class="destination-empty-state">
                        <div class="destination-empty-icon">
                            <i class="bi bi-compass"></i>
                        </div>
                        <div>
                            <h3>Belum Ada Atraksi</h3>
                            <p>Belum ada atraksi untuk destinasi ini. Nantikan informasi menarik lainnya.</p>
                        </div>
                    </div>

                @endforelse

            </div>

        </section>

        {{-- ULASAN --}}
        <section class="destination-section destination-review-section">

            <div class="destination-review-heading">

                <div>
                    <span class="destination-section-eyebrow">✧ KATA PENGUNJUNG</span>
                    <h2>Ulasan Pengunjung</h2>
                </div>

                @if($destinasi->ulasan && $destinasi->ulasan->count() > 0)

                    @php
                        $rataRating = $destinasi->ulasan->avg('rating');
                        $totalUlasan = $destinasi->ulasan->count();
                    @endphp

                    <div class="destination-rating-summary">
                        <strong>{{ number_format($rataRating, 1) }}</strong>

                        <div>
                            <div class="destination-stars">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="bi {{ $i <= round($rataRating) ? 'bi-star-fill' : 'bi-star' }}"></i>
                                @endfor
                            </div>
                            <small>{{ $totalUlasan }} {{ $totalUlasan == 1 ? 'ulasan' : 'ulasan' }}</small>
                        </div>
                    </div>

                @endif

            </div>

            <div class="destination-review-list">

                @forelse($destinasi->ulasan ?? [] as $ulasan)

                    @php
                        $namaUser = optional($ulasan->user)->name ?? 'Pengunjung';
                        $initial = strtoupper(substr($namaUser, 0, 1));
                    @endphp

                    <article class="destination-review-card">

                        <div class="destination-review-avatar">

                            @if(!empty($ulasan->foto))
                                <img
                                    src="{{ asset('images/' . $ulasan->foto) }}"
                                    alt="{{ $namaUser }}"
                                    loading="lazy"
                                >
                            @elseif(!empty(optional($ulasan->user)->foto))
                                <img
                                    src="{{ asset('images/' . $ulasan->user->foto) }}"
                                    alt="{{ $namaUser }}"
                                    loading="lazy"
                                >
                            @else
                                {{ $initial }}
                            @endif

                        </div>

                        <div class="destination-review-content">

                            <div class="destination-review-top">
                                <div>
                                    <h3>{{ $namaUser }}</h3>

                                    <div class="destination-stars">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="bi {{ $i <= $ulasan->rating ? 'bi-star-fill' : 'bi-star' }}"></i>
                                        @endfor
                                    </div>
                                </div>

                                @if(!empty($ulasan->created_at))
                                    <time datetime="{{ $ulasan->created_at->toDateString() }}">
                                        {{ $ulasan->created_at->format('d M Y') }}
                                    </time>
                                @endif
                            </div>

                            @if(!empty($ulasan->komentar))
                                <p class="destination-review-quote">
                                    “{{ $ulasan->komentar }}”
                                </p>
                            @else
                                <p class="destination-review-quote is-muted">
                                    Pengunjung tidak memberikan komentar.
                                </p>
                            @endif

                        </div>

                    </article>

                @empty

                    <div class="destination-empty-state">
                        <div class="destination-empty-icon">
                            <i class="bi bi-chat-square-heart"></i>
                        </div>
                        <div>
                            <h3>Belum Ada Ulasan</h3>
                            <p>Jadilah yang pertama berbagi pengalaman berkunjung ke destinasi ini.</p>
                        </div>
                    </div>

                @endforelse

            </div>

            <a href="{{ route('ulasan.create', $destinasi->id) }}" class="destination-write-review">
                <i class="bi bi-pencil-square"></i>
                Tulis Ulasan
            </a>

        </section>

        {{-- FASILITAS --}}
        <section class="destination-section destination-facility-section">

            <div class="destination-section-heading">
                <div>
                    <span class="destination-section-eyebrow">✦ KENYAMANAN PENGUNJUNG</span>
                    <h2>Fasilitas Tersedia</h2>
                    <p>Berbagai fasilitas untuk mendukung kenyamanan Anda selama berkunjung.</p>
                </div>
            </div>

            <div class="destination-facility-grid">

                <div class="destination-facility-card">
                    <span><i class="bi bi-p-circle-fill"></i></span>
                    <strong>Area Parkir</strong>
                    <small>Parkir pengunjung</small>
                </div>

                <div class="destination-facility-card">
                    <span><i class="bi bi-house-door-fill"></i></span>
                    <strong>Toilet Umum</strong>
                    <small>Fasilitas umum</small>
                </div>

                <div class="destination-facility-card">
                    <span><i class="bi bi-shop"></i></span>
                    <strong>Warung / Kios</strong>
                    <small>Kebutuhan pengunjung</small>
                </div>

                <div class="destination-facility-card">
                    <span><i class="bi bi-camera-fill"></i></span>
                    <strong>Spot Foto</strong>
                    <small>Abadikan momen</small>
                </div>

            </div>

        </section>

        <div class="destination-bottom-ornament" aria-hidden="true">
            <span></span>
            <b>VISIT DUMAI</b>
            <span></span>
        </div>

    </div>
</div>

@endsection