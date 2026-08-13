@extends('layouts.app')

@section('body-class', 'page-destinasi')
@section('title', 'Destinasi Wisata Kota Dumai')

@section('content')

    {{-- ============================================================
        FONT & CSS
    ============================================================= --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;800&family=Nunito+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet"
    >

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    >


    {{-- ============================================================
        HERO
    ============================================================= --}}
    <section class="hero-page-destinasi">

        <div class="container">
            <div class="hero-content text-center">

                {{-- Judul kecil --}}
                <span class="hero-eyebrow">
                    Destinasi &middot; Wisata Kota Dumai
                </span>

                {{-- Judul utama --}}
                <h1>
                    Selamat Datang di Wisata Kota Dumai
                </h1>

                {{-- Deskripsi --}}
                <p>
                    Jelajahi keindahan pantai, taman kota, hutan mangrove,
                    dan berbagai tempat wisata menarik di Kota Dumai.
                </p>


                {{-- ====================================================
                    SEARCH
                ===================================================== --}}
                <form
                    action="{{ route('destinasi') }}"
                    method="GET"
                    class="search-box mt-4"
                >

                    <i class="fas fa-search" aria-hidden="true"></i>

                    <input
                        type="text"
                        name="cari"
                        placeholder="Cari destinasi wisata..."
                        value="{{ $keyword ?? request('cari') }}"
                        aria-label="Cari destinasi wisata"
                    >

                    {{-- Pertahankan kategori saat melakukan pencarian --}}
                    @if(!empty($kategoriId))
                        <input
                            type="hidden"
                            name="kategori"
                            value="{{ $kategoriId }}"
                        >
                    @endif

                    <button type="submit">
                        <i class="fas fa-search"></i>
                        Cari
                    </button>

                </form>

            </div>
        </div>


        {{-- ============================================================
            WAVE
        ============================================================= --}}
        <div class="wave-divider">
            <svg
                viewBox="0 0 1440 70"
                preserveAspectRatio="none"
                xmlns="http://www.w3.org/2000/svg"
                aria-hidden="true"
            >
                <path
                    d="M0,32 C240,70 480,0 720,20 C960,40 1200,70 1440,28 L1440,70 L0,70 Z"
                    fill="#F3F9FA"
                />
            </svg>
        </div>

    </section>


    {{-- ============================================================
        FILTER KATEGORI
    ============================================================= --}}
    <section class="container mt-4">

        <div class="destination-filter">

            {{-- Judul filter --}}
            <div class="filter-title">
                <i class="fas fa-filter" aria-hidden="true"></i>
                <span>Filter Kategori</span>
            </div>


            {{-- Tombol kategori --}}
            <div class="filter-buttons">

                {{-- Semua destinasi --}}
                <a
                    href="{{ route('destinasi', array_filter([
                        'cari' => $keyword ?? null,
                    ])) }}"
                    class="filter-btn {{ empty($kategoriId) ? 'active' : '' }}"
                >
                    <i class="fas fa-layer-group" aria-hidden="true"></i>
                    Semua
                </a>


                {{-- Daftar kategori --}}
                @foreach($kategoriList ?? [] as $kategori)

                    <a
                        href="{{ route('destinasi', array_filter([
                            'cari' => $keyword ?? null,
                            'kategori' => $kategori->id,
                        ])) }}"
                        class="filter-btn {{ (string) ($kategoriId ?? '') === (string) $kategori->id ? 'active' : '' }}"
                    >
                        <i class="fas fa-location-dot" aria-hidden="true"></i>

                        {{ $kategori->nama_kategori }}

                    </a>

                @endforeach

            </div>

        </div>

    </section>


    {{-- ============================================================
        DESTINASI
    ============================================================= --}}
    <section class="container mt-5 mb-5">

        {{-- ========================================================
            HEADER SECTION
        ========================================================= --}}
        <div class="destination-section-header">

            <div>

                <span class="section-label">
                    <i class="fas fa-compass" aria-hidden="true"></i>
                    Jelajahi
                </span>

                <h2>
                    Destinasi Wisata
                </h2>

            </div>


            {{-- Jumlah destinasi --}}
            @if($destinasiList->total() > 0)

                <div class="destination-count">

                    <strong>
                        {{ $destinasiList->total() }}
                    </strong>

                    destinasi tersedia

                </div>

            @endif

        </div>


        {{-- ========================================================
            PAGINATION + CARD
        ========================================================= --}}
        <div class="destinasi-pagination-container">


            {{-- ====================================================
                PREVIOUS
            ===================================================== --}}
            @if($destinasiList->onFirstPage())

                <span
                    class="nav-arrow nav-prev disabled"
                    aria-disabled="true"
                    title="Halaman Sebelumnya"
                >
                    <i class="fas fa-chevron-left"></i>
                </span>

            @else

                <a
                    href="{{ $destinasiList->previousPageUrl() }}"
                    class="nav-arrow nav-prev"
                    title="Halaman Sebelumnya"
                    aria-label="Halaman Sebelumnya"
                >
                    <i class="fas fa-chevron-left"></i>
                </a>

            @endif


            {{-- ====================================================
                GRID DESTINASI
            ===================================================== --}}
            <div class="card-grid">

                @forelse($destinasiList as $destinasi)

                    <article class="destination-card filter-item">

                        {{-- =================================================
                            GAMBAR
                        ================================================== --}}
                        <div class="card-media">

                            @if(!empty($destinasi->gambar))

                                <img
                                    src="{{ asset('storage/' . $destinasi->gambar) }}"
                                    alt="Foto {{ $destinasi->nama }}"
                                    loading="lazy"
                                >

                            @else

                                <img
                                    src="{{ asset('images/no-image.jpg') }}"
                                    alt="Gambar tidak tersedia"
                                    loading="lazy"
                                >

                            @endif


                            {{-- Overlay --}}
                            <div class="card-media-overlay"></div>


                            {{-- Kategori --}}
                            @if(!empty($destinasi->kategori))

                                <span class="destination-category">

                                    <i class="fas fa-tag" aria-hidden="true"></i>

                                    {{ $destinasi->kategori->nama_kategori }}

                                </span>

                            @endif

                        </div>


                        {{-- =================================================
                            CARD BODY
                        ================================================== --}}
                        <div class="card-body">

                            {{-- Nama destinasi --}}
                            <h3>
                                {{ $destinasi->nama }}
                            </h3>


                            {{-- Deskripsi --}}
                            <p class="destination-description">

                                {{ \Illuminate\Support\Str::limit(
                                    strip_tags($destinasi->deskripsi ?? 'Deskripsi belum tersedia.'),
                                    120
                                ) }}

                            </p>


                            {{-- =================================================
                                INFORMASI DESTINASI
                            ================================================== --}}
                            <ul class="info-list">

                                {{-- Lokasi --}}
                                <li>

                                    <i
                                        class="fas fa-location-dot"
                                        aria-hidden="true"
                                    ></i>

                                    <span>
                                        {{ $destinasi->lokasi ?? 'Lokasi belum tersedia' }}
                                    </span>

                                </li>


                                {{-- Jam buka --}}
                                <li>

                                    <i
                                        class="far fa-clock"
                                        aria-hidden="true"
                                    ></i>

                                    <span>

                                        @if(
                                            !empty($destinasi->jam_buka) ||
                                            !empty($destinasi->jam_tutup)
                                        )

                                            {{ $destinasi->jam_buka ?? '-' }}
                                            -
                                            {{ $destinasi->jam_tutup ?? '-' }}
                                            WIB

                                        @else

                                            Jam operasional belum tersedia

                                        @endif

                                    </span>

                                </li>

                            </ul>


                            {{-- =================================================
                                ACTION BUTTON
                            ================================================== --}}
                            <div class="card-action">

                                {{-- Detail --}}
                                <a
                                    href="{{ route('destinasi.detail', $destinasi->id) }}"
                                    class="btn-primary"
                                >
                                    <i
                                        class="fas fa-circle-info"
                                        aria-hidden="true"
                                    ></i>

                                    Detail
                                </a>


                                {{-- Google Maps --}}
                                <a
                                    href="https://www.google.com/maps/search/?api=1&query={{ urlencode($destinasi->lokasi ?? $destinasi->nama) }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="btn-secondary"
                                    aria-label="Lihat {{ $destinasi->nama }} di Google Maps"
                                >
                                    <i
                                        class="fas fa-map-location-dot"
                                        aria-hidden="true"
                                    ></i>

                                    Maps
                                </a>

                            </div>

                        </div>

                    </article>


                @empty

                    {{-- =================================================
                        EMPTY STATE
                    ================================================== --}}
                    <div class="empty-state">

                        <div class="empty-icon">
                            <i
                                class="fas fa-map-marked-alt"
                                aria-hidden="true"
                            ></i>
                        </div>


                        <h3>
                            Destinasi Tidak Ditemukan
                        </h3>


                        <p>

                            @if(!empty($keyword))

                                Tidak ada destinasi yang cocok dengan
                                "<strong>{{ $keyword }}</strong>".

                            @else

                                Belum ada destinasi yang ditambahkan.

                            @endif

                        </p>


                        {{-- Tombol kembali --}}
                        @if(!empty($keyword) || !empty($kategoriId))

                            <a
                                href="{{ route('destinasi') }}"
                                class="btn-primary"
                            >
                                <i
                                    class="fas fa-rotate-left"
                                    aria-hidden="true"
                                ></i>

                                Tampilkan Semua
                            </a>

                        @endif

                    </div>

                @endforelse

            </div>


            {{-- ====================================================
                NEXT
            ===================================================== --}}
            @if($destinasiList->hasMorePages())

                <a
                    href="{{ $destinasiList->nextPageUrl() }}"
                    class="nav-arrow nav-next"
                    title="Halaman Selanjutnya"
                    aria-label="Halaman Selanjutnya"
                >
                    <i class="fas fa-chevron-right"></i>
                </a>

            @else

                <span
                    class="nav-arrow nav-next disabled"
                    aria-disabled="true"
                    title="Tidak ada halaman berikutnya"
                >
                    <i class="fas fa-chevron-right"></i>
                </span>

            @endif

        </div>


        {{-- ========================================================
            PAGE INDICATOR
        ========================================================= --}}
        @if($destinasiList->lastPage() > 1)

            <div class="page-indicator mt-4 text-center">

                <span>

                    <i
                        class="far fa-file-lines"
                        aria-hidden="true"
                    ></i>

                    Halaman

                    <strong>
                        {{ $destinasiList->currentPage() }}
                    </strong>

                    dari

                    <strong>
                        {{ $destinasiList->lastPage() }}
                    </strong>

                </span>

            </div>

        @endif

    </section>


    {{-- ============================================================
        JAVASCRIPT
    ============================================================= --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const cards = document.querySelectorAll('.destination-card');

            // Jika tidak ada card, hentikan script
            if (!cards.length) {
                return;
            }


            // Cek dukungan IntersectionObserver
            if ('IntersectionObserver' in window) {

                const observer = new IntersectionObserver(
                    function (entries) {

                        entries.forEach(function (entry) {

                            if (entry.isIntersecting) {

                                entry.target.classList.add('in-view');

                                observer.unobserve(entry.target);

                            }

                        });

                    },
                    {
                        threshold: 0.15
                    }
                );


                // Amati semua card
                cards.forEach(function (card) {
                    observer.observe(card);
                });

            } else {

                // Fallback untuk browser lama
                cards.forEach(function (card) {
                    card.classList.add('in-view');
                });

            }

        });
    </script>

@endsection