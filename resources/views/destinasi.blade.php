@extends('layouts.app')

@section('title', 'Destinasi Wisata Kota Dumai')

@section('content')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;800&family=Nunito+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    :root {
        --ocean-deep:  #052E3E;
        --ocean:       #0B4F6C;
        --sea-teal:    #148B9C;
        --sand-gold:   #E3A23B;
        --sand-gold-d: #C9860F;
        --foam:        #F3F9FA;
        --ink:         #12313C;
        --ink-soft:    #5C7681;
        --font-display: 'Poppins', sans-serif;
        --font-body: 'Nunito Sans', sans-serif;
    }

    body { font-family: var(--font-body); color: var(--ink); background: var(--foam); }

    /* ================= HERO — pantai fixed background ================= */
    .hero-page {
        position: relative;
        min-height: 62vh;
        display: flex;
        align-items: center;
        color: #fff;
        overflow: hidden;
        background-image:
            linear-gradient(180deg, rgba(5,46,62,.78) 0%, rgba(11,79,108,.6) 50%, rgba(5,46,62,.92) 100%),
            url('{{ asset("images/pantai-dumai.jpg") }}');
        background-size: cover;
        background-position: center;
        background-attachment: fixed; /* efek "screensaver" saat scroll */
    }
    @supports (-webkit-touch-callout: none) {
        .hero-page { background-attachment: scroll; }
    }
    .hero-page .container { position: relative; z-index: 2; }
    .hero-content { max-width: 700px; margin: 0 auto; }
    .hero-eyebrow {
        display: inline-block;
        font-weight: 600;
        letter-spacing: 2px;
        text-transform: uppercase;
        font-size: .78rem;
        color: var(--sand-gold);
        background: rgba(255,255,255,.08);
        border: 1px solid rgba(255,255,255,.25);
        padding: 6px 18px;
        border-radius: 30px;
        margin-bottom: 22px;
    }
    .hero-content h1 {
        font-family: var(--font-display);
        font-weight: 800;
        font-size: clamp(1.9rem, 4.2vw, 3rem);
        letter-spacing: .3px;
        text-shadow: 0 2px 18px rgba(0,0,0,.25);
    }
    .hero-content > p {
        font-size: 1.06rem;
        line-height: 1.75;
        opacity: .95;
        margin: 16px auto 0;
    }

    .search-box { max-width: 460px; margin: 0 auto; position: relative; }
    .search-box::before {
        content: "\f002";
        font-family: "Font Awesome 5 Free";
        font-weight: 900;
        position: absolute;
        left: 22px; top: 50%;
        transform: translateY(-50%);
        color: var(--ink-soft);
        font-size: .92rem;
    }
    .search-box input {
        width: 100%;
        border: none;
        border-radius: 40px;
        padding: 15px 22px 15px 50px;
        font-size: .98rem;
        font-family: var(--font-body);
        color: var(--ink);
        box-shadow: 0 14px 34px rgba(5,46,62,.28);
        outline: none;
        transition: box-shadow .2s ease;
    }
    .search-box input:focus { box-shadow: 0 14px 34px rgba(5,46,62,.28), 0 0 0 3px var(--sand-gold); }

    .wave-divider {
        position: absolute;
        left: 0; right: 0; bottom: -1px;
        line-height: 0;
        z-index: 2;
    }
    .wave-divider svg { width: 100%; height: 70px; display: block; }

    /* ================= DESTINASI CARDS ================= */
    .card-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(270px, 1fr));
        gap: 30px;
    }

    .destination-card {
        background: #fff;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 8px 26px rgba(5,46,62,.08);
        border: 1px solid #eef2f4;
        display: flex;
        flex-direction: column;
        opacity: 0;
        transform: translateY(26px) scale(.98);
        transition: opacity .6s ease, transform .6s ease, box-shadow .25s ease;
    }
    .destination-card.in-view { opacity: 1; transform: translateY(0) scale(1); }
    .destination-card:hover {
        box-shadow: 0 20px 40px rgba(5,46,62,.16);
        transform: translateY(-6px);
    }
    .destination-card.in-view:hover { transform: translateY(-6px) scale(1); }

    .card-media { position: relative; height: 210px; overflow: hidden; background: var(--foam); }
    .card-media img {
        width: 100%; height: 100%;
        object-fit: cover;
        transition: transform .4s ease;
    }
    .destination-card:hover .card-media img { transform: scale(1.06); }

    .card-body { padding: 22px 24px 26px; display: flex; flex-direction: column; flex: 1; }
    .card-body h3 {
        font-family: var(--font-display);
        font-weight: 700;
        font-size: 1.16rem;
        color: var(--ocean-deep);
        margin-bottom: 8px;
    }
    .card-body > p {
        color: var(--ink-soft);
        font-size: .94rem;
        line-height: 1.65;
        margin-bottom: 16px;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .info-list {
        list-style: none;
        padding: 14px 0 0;
        margin: 0 0 20px;
        border-top: 1px dashed #e3eaec;
    }
    .info-list li {
        font-size: .88rem;
        color: var(--ink-soft);
        margin-bottom: 7px;
    }
    .info-list li:last-child { margin-bottom: 0; }
    .info-list .status.open { color: #1E8E5A; font-weight: 600; }
    .info-list .status.closed { color: #C0392B; font-weight: 600; }

    .card-action {
        margin-top: auto;
        display: flex;
        gap: 10px;
    }
    .card-action .btn-primary,
    .card-action .btn-secondary {
        flex: 1;
        text-align: center;
        font-weight: 700;
        font-size: .9rem;
        padding: 10px 0;
        border-radius: 30px;
        text-decoration: none;
        border: 1px solid transparent;
        transition: background .2s ease, color .2s ease, border-color .2s ease;
    }
    .card-action .btn-primary {
        background: linear-gradient(135deg, var(--ocean), var(--sea-teal));
        color: #fff;
    }
    .card-action .btn-primary:hover { filter: brightness(1.08); color: #fff; }
    .card-action .btn-secondary {
        background: var(--foam);
        color: var(--ocean);
        border-color: #dcecef;
    }
    .card-action .btn-secondary:hover { background: var(--ocean); color: #fff; }

    /* ================= EMPTY STATE ================= */
    .empty-state {
        grid-column: 1 / -1;
        text-align: center;
        padding: 60px 20px;
        color: var(--ink-soft);
    }
    .empty-state i { font-size: 2.4rem; color: #cfdadd; margin-bottom: 14px; display: block; }

    @media (max-width: 767px) {
        .hero-page { min-height: 54vh; }
        .card-action { flex-direction: column; }
    }

    @media (prefers-reduced-motion: reduce) {
        .destination-card, .card-media img, .card-action a { transition: none; }
    }
</style>

<!-- ================= HERO ================= -->
<section class="hero-page">
    <div class="container">
        <div class="hero-content text-center">
            <span class="hero-eyebrow">Destinasi &middot; Wisata Kota Dumai</span>
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
            <path d="M0,32 C240,70 480,0 720,20 C960,40 1200,70 1440,28 L1440,70 L0,70 Z" fill="#F3F9FA"/>
        </svg>
    </div>
</section>

<!-- ================= DESTINASI ================= -->

<section class="container mt-5 mb-5">

    <div class="card-grid">

        @forelse ($destinasiList as $destinasi)

            <!-- CARD -->
            <div class="destination-card filter-item">

                <div class="card-media">
                    <img src="{{ asset('images/' . $destinasi->gambar) }}" alt="Foto {{ $destinasi->nama }}">
                </div>

                <div class="card-body">

                    <h3>{{ $destinasi->nama }}</h3>

                    <p>
                        {{ $destinasi->deskripsi }}
                    </p>

                    <ul class="info-list">

                        <li>
                            📍 {{ $destinasi->lokasi }}
                        </li>

                        <li>
                            🕗 {{ $destinasi->jam_buka }} - {{ $destinasi->jam_tutup }} WIB
                        </li>
@php
    date_default_timezone_set('Asia/Jakarta');

    $jamSekarang = date('H:i');

    $statusBuka = (
        $jamSekarang >= substr($destinasi->jam_buka, 0, 5) &&
        $jamSekarang <= substr($destinasi->jam_tutup, 0, 5)
    );
@endphp

                    </ul>

                    <div class="card-action">

                        <a href="{{ route('destinasi.detail', $destinasi->id) }}"
                           class="btn-primary">
                            Detail
                        </a>

                        <a href="https://maps.google.com"
                           target="_blank"
                           rel="noopener"
                           class="btn-secondary">
                            Maps
                        </a>

                    </div>

                </div>

            </div>

        @empty

            <div class="empty-state">
                <i class="fas fa-map-marked-alt"></i>
                <p class="mb-0">Belum ada destinasi yang ditambahkan.</p>
            </div>

        @endforelse

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

document.getElementById("searchInput")
.addEventListener("keyup", function(){

    let value = this.value.toLowerCase();

    let cards = document.querySelectorAll(".destination-card");

    cards.forEach(function(card){

        let title = card.querySelector("h3").textContent.toLowerCase();

        card.style.display = title.includes(value) ? "" : "none";

    });

});

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