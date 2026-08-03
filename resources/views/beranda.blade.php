@extends('layouts.app')

@section('title', 'Selamat Datang di Wisata Kota Dumai')

@section('content')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;800&family=Nunito+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>
    :root {
        --ocean-deep:  #052E3E;
        --ocean:       #0B4F6C;
        --sea-teal:    #148B9C;
        --leaf:        #2F9E44;
        --leaf-deep:   #1B6E33;
        --sand-gold:   #E3A23B;
        --sand-gold-d: #C9860F;
        --foam:        #F3F9F4;
        --ink:         #12312B;
        --ink-soft:    #5C7368;
        --font-display: 'Poppins', sans-serif;
        --font-body: 'Nunito Sans', sans-serif;
    }

    body { font-family: var(--font-body); color: var(--ink); background: var(--foam); }

    /* ================= HERO ================= */
    .hero-page {
        position: relative;
        min-height: 72vh;
        display: flex;
        align-items: center;
        color: #fff;
        overflow: hidden;
        background-image:
            radial-gradient(circle at 50% 30%, rgba(27,110,51,.15), transparent 60%),
            linear-gradient(180deg, rgba(5,46,62,.8) 0%, rgba(11,79,108,.45) 45%, rgba(27,110,51,.5) 75%, rgba(5,46,62,.94) 100%),
            url('{{ asset("images/hutan-wisata-dumai.jpg") }}');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        padding: 60px 0 90px;
    }
    @supports (-webkit-touch-callout: none) {
        .hero-page { background-attachment: scroll; }
    }
    .hero-content { position: relative; z-index: 2; }
    .hero-eyebrow {
        display: inline-block;
        font-weight: 600;
        letter-spacing: 2px;
        text-transform: uppercase;
        font-size: .78rem;
        color: var(--sand-gold);
        background: rgba(255,255,255,.1);
        border: 1px solid rgba(255,255,255,.28);
        padding: 6px 18px;
        border-radius: 30px;
        margin-bottom: 22px;
    }
    .hero-content h1 {
        font-family: var(--font-display);
        font-weight: 800;
        font-size: clamp(2rem, 4.4vw, 3.2rem);
        letter-spacing: .3px;
        text-shadow: 0 2px 18px rgba(0,0,0,.3);
    }
    .hero-content p {
        max-width: 640px;
        margin: 16px auto 0;
        font-size: 1.06rem;
        line-height: 1.75;
        opacity: .95;
    }

    .search-box {
        max-width: 480px;
        margin: 0 auto;
        position: relative;
    }
    .search-box::before {
        content: "\f002";
        font-family: "Font Awesome 6 Free";
        font-weight: 900;
        position: absolute;
        left: 22px; top: 50%;
        transform: translateY(-50%);
        color: var(--ink-soft);
        font-size: .95rem;
    }
    .search-box input {
        width: 100%;
        padding: 16px 22px 16px 50px;
        border-radius: 40px;
        border: none;
        font-family: var(--font-body);
        font-size: .98rem;
        color: var(--ink);
        background: #fff;
        box-shadow: 0 12px 30px rgba(5,46,62,.25);
        outline: none;
        transition: box-shadow .2s ease;
    }
    .search-box input:focus { box-shadow: 0 12px 30px rgba(47,158,68,.35); }
    .search-box input::placeholder { color: var(--ink-soft); }

    .wave-divider {
        position: absolute;
        left: 0; right: 0; bottom: -1px;
        line-height: 0;
        z-index: 2;
    }
    .wave-divider svg { width: 100%; height: 70px; display: block; }

    /* ================= FILTER ================= */
    .filter-menu {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 12px;
        margin-top: -34px;
        position: relative;
        z-index: 3;
        background: #fff;
        padding: 16px;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(5,46,62,.1);
    }
    .filter-btn {
        border: none;
        background: var(--foam);
        color: var(--ink-soft);
        font-family: var(--font-body);
        font-weight: 700;
        font-size: .92rem;
        padding: 10px 24px;
        border-radius: 30px;
        cursor: pointer;
        transition: all .2s ease;
    }
    .filter-btn:hover { background: #e4f3e7; color: var(--leaf-deep); }
    .filter-btn.active {
        background: linear-gradient(135deg, var(--leaf), var(--sea-teal));
        color: #fff;
        box-shadow: 0 8px 18px rgba(47,158,68,.35);
    }

    /* ================= BANNER HUTAN WISATA ================= */
    .forest-banner {
        position: relative;
        margin: 50px 0;
        border-radius: 26px;
        overflow: hidden;
        min-height: 320px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: #fff;
        background-image:
            linear-gradient(160deg, rgba(5,46,62,.55) 0%, rgba(27,110,51,.72) 100%),
            url('{{ asset("images/hutan-wisata-dumai-2.jpg") }}');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        box-shadow: 0 14px 40px rgba(5,46,62,.18);
    }
    @supports (-webkit-touch-callout: none) {
        .forest-banner { background-attachment: scroll; }
    }
    .forest-banner .forest-banner-inner {
        position: relative;
        z-index: 2;
        padding: 50px 30px;
        max-width: 640px;
    }
    .forest-banner i.fa-leaf {
        font-size: 1.8rem;
        color: var(--sand-gold);
        margin-bottom: 16px;
    }
    .forest-banner h2 {
        font-family: var(--font-display);
        font-weight: 700;
        font-size: clamp(1.4rem, 3vw, 2rem);
        margin-bottom: 14px;
        text-shadow: 0 2px 14px rgba(0,0,0,.3);
    }
    .forest-banner p {
        opacity: .95;
        line-height: 1.75;
        font-size: 1rem;
    }
    @media (max-width: 767px) {
        .forest-banner { background-attachment: scroll; min-height: 260px; }
    }

    /* ================= SECTION TITLE ================= */
    .section-title h2 {
        font-family: var(--font-display);
        font-weight: 700;
        color: var(--ocean-deep);
        margin-bottom: 8px;
    }
    .section-title p { color: var(--ink-soft); }

    /* ================= DESTINASI GRID ================= */
    .card-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 30px;
    }

    .destination-card {
        background: #fff;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 8px 26px rgba(5,46,62,.08);
        border: 1px solid #e9f1ea;
        display: block;
        text-decoration: none;
        color: inherit;
        opacity: 0;
        transform: translateY(24px);
        transition: transform .25s ease, box-shadow .25s ease, opacity .5s ease;
    }
    .destination-card.in-view { opacity: 1; transform: translateY(0); }
    .destination-card:hover {
        box-shadow: 0 20px 40px rgba(5,46,62,.16);
        transform: translateY(-6px);
        color: inherit;
        text-decoration: none;
    }

    .card-media { position: relative; height: 210px; overflow: hidden; }
    .card-media img {
        width: 100%; height: 100%;
        object-fit: cover;
        transition: transform .4s ease;
    }
    .destination-card:hover .card-media img { transform: scale(1.08); }
    .card-media .badge {
        position: absolute;
        top: 14px; left: 14px;
        background: linear-gradient(135deg, var(--leaf), var(--sea-teal));
        color: #fff;
        font-size: .72rem;
        font-weight: 700;
        letter-spacing: .4px;
        text-transform: uppercase;
        padding: 5px 14px;
        border-radius: 20px;
    }

    .card-body { padding: 22px 24px 26px; }
    .card-body h3 {
        font-family: var(--font-display);
        font-weight: 700;
        font-size: 1.16rem;
        color: var(--ocean-deep);
        margin-bottom: 6px;
    }
    .rating { color: var(--sand-gold-d); font-size: .9rem; margin-bottom: 10px; }
    .card-body p { color: var(--ink-soft); font-size: .94rem; line-height: 1.65; margin-bottom: 14px; }

    .info-list { list-style: none; padding: 0; margin: 0 0 14px; }
    .info-list li {
        font-size: .88rem;
        color: var(--ink-soft);
        margin-bottom: 6px;
    }
    .info-list li.status { margin-top: 4px; }
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 14px;
        border-radius: 30px;
        font-size: .8rem;
        font-weight: 700;
    }
    .status-badge i { font-size: .78rem; }
    .status-badge.open { background: #e4f3e7; color: var(--leaf-deep); }
    .status-badge.closed { background: #fdeaea; color: #C0392B; }

    .card-action .btn-secondary {
        display: inline-block;
        background: var(--foam);
        color: var(--leaf-deep);
        font-weight: 700;
        font-size: .86rem;
        padding: 8px 20px;
        border-radius: 30px;
        text-decoration: none;
        border: 1px solid #d4ecd8;
        transition: background .2s ease;
    }
    .card-action .btn-secondary:hover { background: #e4f3e7; color: var(--leaf-deep); }

    /* ================= EMPTY STATE ================= */
    .empty-state {
        grid-column: 1 / -1;
        color: var(--ink-soft);
    }
    .empty-state i { color: var(--sea-teal); }
    .empty-state h4 { color: var(--ocean-deep); font-family: var(--font-display); font-weight: 700; }

    @media (max-width: 767px) {
        .hero-page { min-height: 58vh; padding: 50px 0 80px; }
        .filter-menu { margin-top: -26px; }
    }

    @media (prefers-reduced-motion: reduce) {
        .destination-card, .card-media img { transition: none; }
    }
</style>



<!-- ================= HERO / DATA DASBOR BERANDA/PEMBUKA================= -->
<section class="hero-page">
    <div class="container">
        <div class="hero-content text-center">
            <span class="hero-eyebrow">Wisata Kota Dumai &middot; Pesisir Riau</span>
            <h1>Selamat Datang di Wisata Kota Dumai</h1>
            <p>
                Jelajahi keindahan pantai, taman kota, hutan mangrove,
                dan berbagai tempat wisata menarik di Kota Dumai.
            </p>

            <div class="search-box mt-4">
                <input
                    type="text"
                    id="searchInput"
                    placeholder="Cari destinasi wisata..."
                >
            </div>
        </div>
    </div>
    <div class="wave-divider">
        <svg viewBox="0 0 1440 70" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0,32 C240,70 480,0 720,20 C960,40 1200,70 1440,28 L1440,70 L0,70 Z" fill="#F3F9F4"/>
        </svg>
    </div>
</section>



<!-- ================= BANNER HUTAN WISATA ================= -->
<section class="container">
    <div class="forest-banner">
        <div class="forest-banner-inner">
            <i class="fas fa-leaf"></i>
            <h2>Menyatu dengan Hijaunya Alam Dumai</h2>
            <p>
                Dari rimbun hutan mangrove hingga taman kota yang teduh, Dumai
                menyimpan sisi alami yang menenangkan — sempurna untuk melepas penat
                sejenak dari rutinitas.
            </p>
        </div>
    </div>
</section>

<!-- ================= DESTINASI ================= -->
<section class="container mt-5 mb-5">

    <div class="section-title text-center mb-5">
        <h2>Destinasi Wisata Kota Dumai</h2>
        <p>Temukan berbagai destinasi wisata terbaik di Kota Dumai.</p>
    </div>

    <div class="card-grid">

        @forelse ($destinasiList as $destinasi)

            @php
                date_default_timezone_set('Asia/Jakarta');
                $jamSekarang = now()->format('H:i:s');

                $status = ($jamSekarang >= $destinasi->jam_buka &&
                           $jamSekarang <= $destinasi->jam_tutup);
            @endphp

            <a href="{{ route('destinasi') }}" class="destination-card filter-item {{ strtolower($destinasi->kategori) }}">

                <!-- Gambar -->
                <div class="card-media">

                    @if($destinasi->gambar)
                        <img src="{{ asset('images/' . $destinasi->gambar) }}"
                             alt="{{ $destinasi->nama }}" loading="lazy">
                    @else
                        <img src="{{ asset('images/no-image.jpg') }}"
                             alt="Tidak Ada Gambar" loading="lazy">
                    @endif

                    <span class="badge">
                        {{ $destinasi->kategori }}
                    </span>

                </div>

                <!-- Isi -->
                <div class="card-body">

                    <h3>{{ $destinasi->nama }}</h3>

                    <div class="rating">
                        ⭐⭐⭐⭐⭐
                    </div>

                    <p>
                        {{ \Illuminate\Support\Str::limit($destinasi->deskripsi,120) }}
                    </p>

                    <ul class="info-list">

                        <li>
                            📍 {{ $destinasi->lokasi }}
                        </li>

                        <li>
                            🕗 {{ $destinasi->jam_buka }}
                            -
                            {{ $destinasi->jam_tutup }} WIB
                        </li>

                        <li class="status">
                            <span class="status-badge {{ $status ? 'open' : 'closed' }}">
                                <i class="fas {{ $status ? 'fa-door-open' : 'fa-lock' }}"></i>
                                {{ $status ? 'Sedang Buka' : 'Sudah Tutup' }}
                            </span>
                        </li>

                    </ul>

                    <div class="card-action">

                        @if(!empty($destinasi->maps))
                            <a href="{{ $destinasi->maps }}"
                               target="_blank"
                               class="btn-secondary mt-2"
                               onclick="event.stopPropagation()">
                                Maps
                            </a>
                        @endif

                    </div>

                </div>

            </a>

        @empty

            <div class="empty-state text-center py-5">
                <i class="fas fa-map-marked-alt fa-3x mb-3"></i>
                <h4>Belum Ada Destinasi</h4>
                <p>Data destinasi wisata belum tersedia.</p>
            </div>

        @endforelse

    </div>

</section>

<!-- ================= SCRIPT ================= -->
<script>

function filterSelection(category, btn){

    let items = document.getElementsByClassName("filter-item");
    let buttons = document.getElementsByClassName("filter-btn");

    let target = category === "all" ? "" : category;

    for(let i=0; i<items.length; i++){
        let classes = items[i].className.split(" ");
        items[i].style.display = (target === "" || classes.indexOf(target) > -1) ? "" : "none";
    }

    for(let i=0; i<buttons.length; i++){
        buttons[i].classList.remove("active");
    }
    if(btn) btn.classList.add("active");

}

document.getElementById("searchInput")
.addEventListener("keyup", function(){

    let value = this.value.toLowerCase();
    let cards = document.querySelectorAll(".destination-card");

    cards.forEach(function(card){
        let title = card.querySelector("h3").textContent.toLowerCase();
        card.style.display = title.includes(value) ? "" : "none";
    });

});

// Animasi reveal: setiap gambar/kartu muncul dengan efek fade + geser
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