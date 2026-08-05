@extends('layouts.app')
@section('body-class', 'page-destinasi')
@section('title', 'Destinasi Wisata Kota Dumai')

@section('content')

<!-- External Fonts & Stylesheet -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;800&family=Nunito+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">

<!-- ================= HERO ================= -->
<section class="hero-page-destinasi">
    <div class="container">
        <div class="hero-content text-center">
            <span class="hero-eyebrow">Destinasi &middot; Wisata Kota Dumai</span>
            <h1>Selamat Datang di Wisata Kota Dumai</h1>
            <p>
                Jelajahi keindahan pantai, taman kota, hutan mangrove,
                dan berbagai tempat wisata menarik di Kota Dumai.
            </p>

            <form action="{{ route('destinasi') }}" method="GET" class="search-box mt-4">
                <i class="fas fa-search"></i>
                <input
                    type="text"
                    name="cari"
                    placeholder="Cari destinasi wisata..."
                    value="{{ $keyword ?? '' }}"
                >
                <button type="submit">Cari</button>
            </form>
        </div>
    </div>
    <div class="wave-divider">
        <svg viewBox="0 0 1440 70" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0,32 C240,70 480,0 720,20 C960,40 1200,70 1440,28 L1440,70 L0,70 Z" fill="#F3F9FA"/>
        </svg>
    </div>
</section>

<!-- ================= DESTINASI ================= -->
<section class="container mt-5 mb-5">

    <!-- Wrapper Khusus Pagination Samping -->
    <div class="destinasi-pagination-container">

        <!-- Tombol Prev (Samping Kiri) -->
        @if ($destinasiList->onFirstPage())
            <span class="nav-arrow nav-prev disabled" aria-disabled="true">
                <i class="fas fa-chevron-left"></i>
            </span>
        @else
            <a href="{{ $destinasiList->previousPageUrl() }}" class="nav-arrow nav-prev" title="Halaman Sebelumnya">
                <i class="fas fa-chevron-left"></i>
            </a>
        @endif

        <!-- Grid Kartu Destinasi -->
        <div class="card-grid">
            @forelse ($destinasiList as $destinasi)

                <!-- CARD -->
                <div class="destination-card filter-item">
                    <div class="card-media">
                        <img src="{{ asset('images/' . $destinasi->gambar) }}" alt="Foto {{ $destinasi->nama }}">
                    </div>

                    <div class="card-body">
                        <h3>{{ $destinasi->nama }}</h3>
                        <p>{{ $destinasi->deskripsi }}</p>

                        <ul class="info-list">
                            <li>📍 {{ $destinasi->lokasi }}</li>
                            <li>🕗 {{ $destinasi->jam_buka }} - {{ $destinasi->jam_tutup }} WIB</li>
                        </ul>

                        <div class="card-action">
                            <a href="{{ route('destinasi.detail', $destinasi->id) }}" class="btn-primary">Detail</a>
                            <a href="https://maps.google.com" target="_blank" rel="noopener" class="btn-secondary">Maps</a>
                        </div>
                    </div>
                </div>

            @empty

                <div class="empty-state">
                    <i class="fas fa-map-marked-alt"></i>
                    <p class="mb-0">
                        @if(!empty($keyword))
                            Tidak ada destinasi yang cocok dengan "{{ $keyword }}".
                        @else
                            Belum ada destinasi yang ditambahkan.
                        @endif
                    </p>
                </div>

            @endforelse
        </div>

        <!-- Tombol Next (Samping Kanan) -->
        @if ($destinasiList->hasMorePages())
            <a href="{{ $destinasiList->nextPageUrl() }}" class="nav-arrow nav-next" title="Halaman Selanjutnya">
                <i class="fas fa-chevron-right"></i>
            </a>
        @else
            <span class="nav-arrow nav-next disabled" aria-disabled="true">
                <i class="fas fa-chevron-right"></i>
            </span>
        @endif

    </div>

    <!-- Indicator Angka Halaman di Bawah Tengah -->
    <div class="page-indicator mt-4 text-center">
        <span>Halaman <strong>{{ $destinasiList->currentPage() }}</strong> dari <strong>{{ $destinasiList->lastPage() }}</strong></span>
    </div>

</section>

<!-- ================= SCRIPT ================= -->
<script>
function filterSelection(category){
    let items = document.getElementsByClassName("filter-item");

    if(category === "all") category = "";

    for(let i = 0; i < items.length; i++){
        items[i].style.display = "none";

        if(items[i].className.indexOf(category) > -1){
            items[i].style.display = "block";
        }
    }
}

filterSelection("all");

// Animasi reveal: setiap kartu muncul dengan efek fade + geser
// saat mulai terlihat di layar (scroll reveal), dengan jeda bertahap antar kartu.
document.addEventListener("DOMContentLoaded", function () {
    let cards = document.querySelectorAll(".destination-card");

    let observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry, index) {
            if (entry.isIntersecting) {
                setTimeout(function () {
                    entry.target.classList.add("in-view");
                }, index * 100);
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.15 });

    cards.forEach(function (card) {
        observer.observe(card);
    });
});
</script>

@endsection