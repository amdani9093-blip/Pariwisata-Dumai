@extends('layouts.app')

@section('body-class', 'page-destinasi-detail')
@section('title', ($destinasi->nama ?? 'Destinasi') . ' - Visit Dumai')

@section('content')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<link rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<link rel="stylesheet"
      href="{{ asset('css/destinasi-detail.css') }}">

@php

    /*
    |--------------------------------------------------------------------------
    | STATUS DESTINASI
    |--------------------------------------------------------------------------
    */

    date_default_timezone_set('Asia/Jakarta');

    $jamSekarang = now()->format('H:i:s');

    $jamBuka  = $destinasi->jam_buka ?? null;
    $jamTutup = $destinasi->jam_tutup ?? null;

    $statusBuka = false;

    if ($jamBuka && $jamTutup) {

        // Normal
        if ($jamBuka <= $jamTutup) {
            $statusBuka =
                $jamSekarang >= $jamBuka &&
                $jamSekarang <= $jamTutup;
        }

        // Jika jam operasional melewati tengah malam
        else {
            $statusBuka =
                $jamSekarang >= $jamBuka ||
                $jamSekarang <= $jamTutup;
        }
    }

    $namaKategori =
        optional($destinasi->kategori)->nama_kategori ?? 'Wisata';

    $gambarDestinasi = !empty($destinasi->gambar)
        ? asset('storage/' . $destinasi->gambar)
        : asset('images/no-image.jpg');

@endphp


<div class="vd-detail-page">

    {{-- =========================================================
         TOP NAVIGATION
    ========================================================== --}}

    <div class="vd-container">

        <nav class="vd-breadcrumb">

            <a href="{{ route('beranda') }}">
                <i class="bi bi-house-door-fill"></i>
                <span>Beranda</span>
            </a>

            <i class="bi bi-chevron-right"></i>

            <a href="{{ route('destinasi') }}">
                <span>Destinasi</span>
            </a>

            <i class="bi bi-chevron-right"></i>

            <span class="current">
                {{ $destinasi->nama }}
            </span>

        </nav>


        {{-- =========================================================
             HERO DESTINASI
        ========================================================== --}}

        <section class="vd-hero-card">

            {{-- FOTO --}}
            <div class="vd-hero-image">

                <img
                    src="{{ $gambarDestinasi }}"
                    alt="Foto {{ $destinasi->nama }}"
                    loading="eager"
                >

                <div class="vd-image-overlay"></div>

                {{-- Ornamen --}}
                <div class="vd-image-ornament">
                    <span></span>
                    <i class="bi bi-stars"></i>
                    <span></span>
                </div>

                {{-- Status --}}
                <div class="vd-status {{ $statusBuka ? 'open' : 'closed' }}">

                    <span class="vd-status-dot"></span>

                    <span>
                        {{ $statusBuka ? 'Sedang Buka' : 'Sudah Tutup' }}
                    </span>

                </div>

                {{-- Lokasi --}}
                <div class="vd-image-location">

                    <i class="bi bi-geo-alt-fill"></i>

                    <span>
                        {{ $destinasi->lokasi ?? 'Kota Dumai' }}
                    </span>

                </div>

            </div>


            {{-- INFORMASI --}}
            <div class="vd-hero-content">

                <div class="vd-category">

                    <i class="bi bi-tag-fill"></i>

                    {{ $namaKategori }}

                </div>


                <span class="vd-eyebrow">
                    ✦ DESTINASI WISATA KOTA DUMAI
                </span>


                <h1 class="vd-title">
                    {{ $destinasi->nama }}
                </h1>


                <div class="vd-title-decoration">
                    <span></span>
                    <i class="bi bi-diamond-fill"></i>
                    <span></span>
                </div>


                <div class="vd-description">

                    @if(!empty($destinasi->deskripsi))

                        <p>
                            {{ $destinasi->deskripsi }}
                        </p>

                    @else

                        <p class="muted">
                            Informasi mengenai destinasi ini belum tersedia.
                        </p>

                    @endif

                </div>


                {{-- =================================================
                     INFO CARDS
                ================================================== --}}

                <div class="vd-info-grid">

                    {{-- JAM --}}
                    <div class="vd-info-card">

                        <div class="vd-info-icon blue">
                            <i class="bi bi-clock-fill"></i>
                        </div>

                        <div class="vd-info-text">

                            <span>Jam Operasional</span>

                            <strong>
                                @if($jamBuka && $jamTutup)
                                    {{ $jamBuka }} - {{ $jamTutup }} WIB
                                @else
                                    Belum tersedia
                                @endif
                            </strong>

                        </div>

                    </div>


                    {{-- LOKASI --}}
                    <div class="vd-info-card">

                        <div class="vd-info-icon green">
                            <i class="bi bi-geo-alt-fill"></i>
                        </div>

                        <div class="vd-info-text">

                            <span>Lokasi</span>

                            <strong>
                                {{ $destinasi->lokasi ?? 'Belum tersedia' }}
                            </strong>

                        </div>

                    </div>


                    {{-- HARGA --}}
                    <div class="vd-info-card">

                        <div class="vd-info-icon gold">
                            <i class="bi bi-ticket-perforated-fill"></i>
                        </div>

                        <div class="vd-info-text">

                            <span>Harga Tiket</span>

                            @if(($destinasi->harga_tiket ?? 0) == 0)

                                <strong class="free">
                                    Gratis
                                </strong>

                            @else

                                <strong>
                                    Rp {{ number_format($destinasi->harga_tiket, 0, ',', '.') }}
                                </strong>

                            @endif

                        </div>

                    </div>

                </div>


                {{-- =================================================
                     ACTION BUTTON
                ================================================== --}}

                <div class="vd-actions">

                    <a
                        href="{{ route('destinasi') }}"
                        class="vd-btn vd-btn-light"
                    >
                        <i class="bi bi-arrow-left"></i>
                        <span>Kembali</span>
                    </a>


                    @if(!empty($destinasi->lokasi))

                        <a
                            href="https://www.google.com/maps/search/?api=1&query={{ urlencode($destinasi->lokasi) }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="vd-btn vd-btn-map"
                        >
                            <i class="bi bi-map-fill"></i>
                            <span>Lihat Maps</span>
                        </a>

                    @endif


                    <a
                        href="{{ route('kontak') }}"
                        class="vd-btn vd-btn-contact"
                    >
                        <i class="bi bi-chat-dots-fill"></i>
                        <span>Hubungi Kami</span>
                    </a>


                    {{-- ADMIN --}}
                    @if(Auth::check() && Auth::user()->role === 'admin')

                        <a
                            href="{{ route('destinasi.edit', $destinasi->id) }}"
                            class="vd-btn vd-btn-edit"
                        >
                            <i class="bi bi-pencil-square"></i>
                            <span>Edit</span>
                        </a>


                        <form
                            action="{{ route('destinasi.destroy', $destinasi->id) }}"
                            method="POST"
                            class="vd-delete-form"
                            onsubmit="return confirm('Yakin ingin menghapus {{ $destinasi->nama }}? Data yang dihapus tidak dapat dikembalikan.')"
                        >

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="vd-btn vd-btn-delete"
                            >
                                <i class="bi bi-trash3-fill"></i>
                                <span>Hapus</span>
                            </button>

                        </form>

                    @endif

                </div>

            </div>

        </section>


        {{-- =========================================================
             HIGHLIGHT INFO
        ========================================================== --}}

        <section class="vd-highlight-grid">

            <div class="vd-highlight-card">

                <div class="vd-highlight-icon">
                    <i class="bi bi-compass-fill"></i>
                </div>

                <div>
                    <strong>Jelajahi Dumai</strong>
                    <span>Temukan destinasi menarik</span>
                </div>

            </div>


            <div class="vd-highlight-card">

                <div class="vd-highlight-icon">
                    <i class="bi bi-heart-fill"></i>
                </div>

                <div>
                    <strong>Wisata Pilihan</strong>
                    <span>Pengalaman wisata terbaik</span>
                </div>

            </div>


            <div class="vd-highlight-card">

                <div class="vd-highlight-icon">
                    <i class="bi bi-camera-fill"></i>
                </div>

                <div>
                    <strong>Spot Menarik</strong>
                    <span>Abadikan momen perjalanan</span>
                </div>

            </div>


            <div class="vd-highlight-card">

                <div class="vd-highlight-icon">
                    <i class="bi bi-people-fill"></i>
                </div>

                <div>
                    <strong>Ramah Pengunjung</strong>
                    <span>Nyaman untuk keluarga</span>
                </div>

            </div>

        </section>


        {{-- =========================================================
             ATRAKSI
        ========================================================== --}}

        <section class="vd-section">

            <div class="vd-section-heading">

                <div>

                    <span class="vd-section-eyebrow">
                        ✦ PENGALAMAN WISATA
                    </span>

                    <h2>
                        Atraksi di Destinasi Ini
                    </h2>

                    <p>
                        Temukan berbagai pengalaman dan aktivitas menarik
                        yang dapat dinikmati oleh pengunjung.
                    </p>

                </div>

                <div class="vd-heading-icon">
                    <i class="bi bi-stars"></i>
                </div>

            </div>


            <div class="vd-attraction-grid">

                @forelse($destinasi->atraksi ?? [] as $atraksi)

                    <article class="vd-attraction-card">

                        <div class="vd-attraction-image">

                            @if(!empty($atraksi->gambar))

                                <img
                                    src="{{ asset('storage/' . $atraksi->gambar) }}"
                                    alt="{{ $atraksi->nama }}"
                                    loading="lazy"
                                >

                            @else

                                <img
                                    src="{{ asset('images/no-image.jpg') }}"
                                    alt="Gambar tidak tersedia"
                                    loading="lazy"
                                >

                            @endif

                            <span class="vd-attraction-number">
                                <i class="bi bi-stars"></i>
                            </span>

                        </div>


                        <div class="vd-attraction-content">

                            @if(!empty($atraksi->kategori))

                                <span class="vd-attraction-category">

                                    <i class="bi bi-tag-fill"></i>

                                    {{ $atraksi->kategori }}

                                </span>

                            @endif


                            <h3>
                                {{ $atraksi->nama }}
                            </h3>


                            @if(!empty($atraksi->deskripsi))

                                <p>
                                    {{ \Illuminate\Support\Str::limit(strip_tags($atraksi->deskripsi), 110) }}
                                </p>

                            @else

                                <p class="muted">
                                    Informasi atraksi belum tersedia.
                                </p>

                            @endif


                            <div class="vd-attraction-footer">

                                @if(isset($atraksi->harga))

                                    <div class="vd-attraction-price">

                                        <small>
                                            <i class="bi bi-ticket-perforated"></i>
                                            Tiket
                                        </small>

                                        @if($atraksi->harga == 0)

                                            <strong class="free">
                                                Gratis
                                            </strong>

                                        @else

                                            <strong>
                                                Rp {{ number_format($atraksi->harga, 0, ',', '.') }}
                                            </strong>

                                        @endif

                                    </div>

                                @endif


                                <button
                                    type="button"
                                    class="vd-detail-btn"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalAtraksi{{ $atraksi->id }}"
                                >
                                    Detail
                                    <i class="bi bi-arrow-right"></i>
                                </button>

                            </div>

                        </div>

                    </article>


                    {{-- MODAL --}}
                    <div
                        class="modal fade vd-modal"
                        id="modalAtraksi{{ $atraksi->id }}"
                        tabindex="-1"
                        aria-hidden="true"
                    >

                        <div class="modal-dialog modal-dialog-centered modal-lg">

                            <div class="modal-content">

                                <div class="modal-header">

                                    <div>

                                        <small>
                                            <i class="bi bi-stars"></i>
                                            ATRAKSI DESTINASI
                                        </small>

                                        <h5 class="modal-title">
                                            {{ $atraksi->nama }}
                                        </h5>

                                    </div>

                                    <button
                                        type="button"
                                        class="btn-close"
                                        data-bs-dismiss="modal"
                                    ></button>

                                </div>


                                <div class="modal-body">

                                    @if(!empty($atraksi->gambar))

                                        <img
                                            src="{{ asset('storage/' . $atraksi->gambar) }}"
                                            class="vd-modal-image"
                                            alt="{{ $atraksi->nama }}"
                                        >

                                    @endif


                                    <div class="vd-modal-meta">

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


                                    <div class="vd-modal-description">

                                        @if(!empty($atraksi->deskripsi))

                                            {!! nl2br(e($atraksi->deskripsi)) !!}

                                        @else

                                            <span class="muted">
                                                Deskripsi atraksi belum tersedia.
                                            </span>

                                        @endif

                                    </div>

                                </div>


                                <div class="modal-footer">

                                    <button
                                        type="button"
                                        class="vd-modal-close"
                                        data-bs-dismiss="modal"
                                    >
                                        <i class="bi bi-x-lg"></i>
                                        Tutup
                                    </button>

                                </div>

                            </div>

                        </div>

                    </div>

                @empty

                    <div class="vd-empty">

                        <div class="vd-empty-icon">
                            <i class="bi bi-compass"></i>
                        </div>

                        <h3>
                            Belum Ada Atraksi
                        </h3>

                        <p>
                            Belum ada atraksi yang tersedia pada destinasi ini.
                        </p>

                    </div>

                @endforelse

            </div>

        </section>


        {{-- =========================================================
             ULASAN
        ========================================================== --}}

        <section class="vd-section vd-review-section">

            @php
                $jumlahUlasan = $destinasi->ulasan
                    ? $destinasi->ulasan->count()
                    : 0;

                $rataRating = $jumlahUlasan > 0
                    ? $destinasi->ulasan->avg('rating')
                    : 0;
            @endphp


            <div class="vd-review-header">

                <div>

                    <span class="vd-section-eyebrow">
                        ✧ KATA PENGUNJUNG
                    </span>

                    <h2>
                        Ulasan Pengunjung
                    </h2>

                    <p>
                        Pengalaman dan cerita dari pengunjung yang telah
                        menikmati destinasi ini.
                    </p>

                </div>


                @if($jumlahUlasan > 0)

                    <div class="vd-rating-summary">

                        <strong>
                            {{ number_format($rataRating, 1) }}
                        </strong>

                        <div>

                            <div class="vd-stars">

                                @for($i = 1; $i <= 5; $i++)

                                    <i class="bi
                                        {{ $i <= round($rataRating)
                                            ? 'bi-star-fill'
                                            : 'bi-star' }}">
                                    </i>

                                @endfor

                            </div>

                            <small>
                                {{ $jumlahUlasan }}
                                {{ $jumlahUlasan == 1 ? 'ulasan' : 'ulasan' }}
                            </small>

                        </div>

                    </div>

                @endif

            </div>


            <div class="vd-review-list">

                @forelse($destinasi->ulasan ?? [] as $ulasan)

                    @php

                        $namaUser =
                            optional($ulasan->user)->name
                            ?? 'Pengunjung';

                        $initial =
                            strtoupper(substr($namaUser, 0, 1));

                    @endphp


                    <article class="vd-review-card">

                        <div class="vd-avatar">

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


                        <div class="vd-review-content">

                            <div class="vd-review-top">

                                <div>

                                    <h3>
                                        {{ $namaUser }}
                                    </h3>

                                    <div class="vd-stars">

                                        @for($i = 1; $i <= 5; $i++)

                                            <i class="bi
                                                {{ $i <= $ulasan->rating
                                                    ? 'bi-star-fill'
                                                    : 'bi-star' }}">
                                            </i>

                                        @endfor

                                    </div>

                                </div>


                                @if($ulasan->created_at)

                                    <time>
                                        {{ $ulasan->created_at->format('d M Y') }}
                                    </time>

                                @endif

                            </div>


                            @if(!empty($ulasan->komentar))

                                <p class="vd-review-text">
                                    “{{ $ulasan->komentar }}”
                                </p>

                            @else

                                <p class="vd-review-text muted">
                                    Pengunjung tidak memberikan komentar.
                                </p>

                            @endif

                        </div>

                    </article>

                @empty

                    <div class="vd-empty">

                        <div class="vd-empty-icon">
                            <i class="bi bi-chat-square-heart"></i>
                        </div>

                        <h3>
                            Belum Ada Ulasan
                        </h3>

                        <p>
                            Jadilah pengunjung pertama yang memberikan ulasan.
                        </p>

                    </div>

                @endforelse

            </div>


            <a
                href="{{ route('ulasan.create', $destinasi->id) }}"
                class="vd-review-button"
            >
                <i class="bi bi-pencil-square"></i>
                Tulis Ulasan
            </a>

        </section>


        {{-- =========================================================
             FASILITAS
        ========================================================== --}}

        <section class="vd-section">

            <div class="vd-section-heading">

                <div>

                    <span class="vd-section-eyebrow">
                        ✦ KENYAMANAN PENGUNJUNG
                    </span>

                    <h2>
                        Fasilitas Tersedia
                    </h2>

                    <p>
                        Fasilitas yang dapat membantu membuat perjalanan
                        Anda lebih nyaman.
                    </p>

                </div>

            </div>


            <div class="vd-facility-grid">

                <div class="vd-facility-card">

                    <div class="vd-facility-icon">
                        <i class="bi bi-p-circle-fill"></i>
                    </div>

                    <div>
                        <strong>Area Parkir</strong>
                        <span>Parkir kendaraan pengunjung</span>
                    </div>

                </div>


                <div class="vd-facility-card">

                    <div class="vd-facility-icon">
                        <i class="bi bi-house-door-fill"></i>
                    </div>

                    <div>
                        <strong>Toilet Umum</strong>
                        <span>Fasilitas toilet pengunjung</span>
                    </div>

                </div>


                <div class="vd-facility-card">

                    <div class="vd-facility-icon">
                        <i class="bi bi-shop"></i>
                    </div>

                    <div>
                        <strong>Warung / Kios</strong>
                        <span>Kebutuhan dan makanan</span>
                    </div>

                </div>


                <div class="vd-facility-card">

                    <div class="vd-facility-icon">
                        <i class="bi bi-camera-fill"></i>
                    </div>

                    <div>
                        <strong>Spot Foto</strong>
                        <span>Abadikan momen perjalanan</span>
                    </div>

                </div>


                <div class="vd-facility-card">

                    <div class="vd-facility-icon">
                        <i class="bi bi-wifi"></i>
                    </div>

                    <div>
                        <strong>Akses Internet</strong>
                        <span>Koneksi untuk pengunjung</span>
                    </div>

                </div>


                <div class="vd-facility-card">

                    <div class="vd-facility-icon">
                        <i class="bi bi-cup-hot-fill"></i>
                    </div>

                    <div>
                        <strong>Kuliner</strong>
                        <span>Menikmati makanan lokal</span>
                    </div>

                </div>

            </div>

        </section>


        {{-- =========================================================
             FOOTER ORNAMENT
        ========================================================== --}}

        <div class="vd-bottom-ornament">

            <span></span>

            <div>
                <i class="bi bi-diamond-fill"></i>
                <strong>VISIT DUMAI</strong>
                <small>Bumi Melayu Pesisir</small>
            </div>

            <span></span>

        </div>

    </div>

</div>

@endsection