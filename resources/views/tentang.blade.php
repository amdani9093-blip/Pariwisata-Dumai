@extends('layouts.app')

@section('body-class', 'page-tentang')
@section('title', 'Tentang Kota Dumai - Sejarah, Budaya & Wisata')

@section('content')

{{-- ============================================================
    FONT & ICON
============================================================ --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700;800&family=Nunito+Sans:wght@400;500;600;700;800&display=swap"
    rel="stylesheet"
>

<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
>


<style>
/* ============================================================
   VARIABLES
============================================================ */
.page-tentang {
    --dumai-dark: #063746;
    --dumai-blue: #087f9c;
    --dumai-teal: #10a6a6;
    --dumai-gold: #dca83d;
    --dumai-gold-dark: #b97d16;
    --dumai-cream: #f8f5ed;
    --dumai-soft: #f3f8f9;
    --dumai-text: #17343d;
    --dumai-muted: #6b7d84;

    font-family: 'Nunito Sans', sans-serif;
    color: var(--dumai-text);
    background: #f8fbfc;
}


/* ============================================================
   HERO
============================================================ */
.about-hero {
    position: relative;
    min-height: 78vh;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;

    background:
        linear-gradient(
            135deg,
            rgba(3, 38, 50, .90),
            rgba(0, 111, 137, .68)
        ),
        url('{{ asset('images/Kota Dumai Gambar.jpg') }}');

    background-size: cover;
    background-position: center;
    background-attachment: fixed;

    color: #fff;
}

.about-hero::before {
    content: "";
    position: absolute;
    inset: 0;

    background:
        radial-gradient(
            circle at 15% 25%,
            rgba(220,168,61,.20),
            transparent 28%
        ),
        radial-gradient(
            circle at 85% 70%,
            rgba(16,166,166,.20),
            transparent 30%
        );

    pointer-events: none;
}

.about-hero-content {
    position: relative;
    z-index: 2;
    max-width: 850px;
    padding: 40px 20px;
    text-align: center;
}

.about-eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 9px;

    padding: 9px 18px;
    margin-bottom: 22px;

    border: 1px solid rgba(255,255,255,.3);
    border-radius: 50px;

    background: rgba(255,255,255,.10);
    backdrop-filter: blur(10px);

    font-size: .82rem;
    font-weight: 800;
    letter-spacing: 1.5px;
    text-transform: uppercase;
}

.about-eyebrow i {
    color: #f1c866;
}

.about-hero h1 {
    font-family: 'Poppins', sans-serif;
    font-size: clamp(2.5rem, 6vw, 5rem);
    line-height: 1.05;
    font-weight: 800;
    margin: 0 0 20px;

    text-shadow: 0 8px 30px rgba(0,0,0,.35);
}

.about-hero h1 span {
    color: #f3c75d;
}

.about-hero p {
    max-width: 760px;
    margin: auto;

    font-size: clamp(1rem, 2vw, 1.2rem);
    line-height: 1.8;
    color: rgba(255,255,255,.92);
}

.hero-buttons {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 12px;
    margin-top: 30px;
}

.hero-btn {
    display: inline-flex;
    align-items: center;
    gap: 9px;

    padding: 13px 22px;
    border-radius: 50px;

    text-decoration: none;
    font-weight: 800;

    transition: .3s ease;
}

.hero-btn-primary {
    background: #fff;
    color: var(--dumai-dark);
}

.hero-btn-primary:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 30px rgba(0,0,0,.2);
}

.hero-btn-outline {
    border: 1px solid rgba(255,255,255,.55);
    color: #fff;
    background: rgba(255,255,255,.08);
    backdrop-filter: blur(8px);
}

.hero-btn-outline:hover {
    background: #fff;
    color: var(--dumai-dark);
}


/* ============================================================
   WAVE
============================================================ */
.about-wave {
    position: absolute;
    left: 0;
    bottom: -1px;
    width: 100%;
    z-index: 3;
}

.about-wave svg {
    width: 100%;
    height: 100px;
    display: block;
}


/* ============================================================
   QUICK NAV
============================================================ */
.about-nav-wrap {
    position: sticky;
    top: 70px;
    z-index: 50;

    background: rgba(255,255,255,.94);
    backdrop-filter: blur(15px);

    border-bottom: 1px solid #e7eef0;
    box-shadow: 0 5px 20px rgba(0,0,0,.04);
}

.about-nav {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 6px;

    padding: 12px 0;

    overflow-x: auto;
    scrollbar-width: none;
}

.about-nav::-webkit-scrollbar {
    display: none;
}

.about-nav a {
    flex: 0 0 auto;

    display: inline-flex;
    align-items: center;
    gap: 7px;

    padding: 9px 14px;

    border-radius: 30px;

    color: #60757c;
    text-decoration: none;

    font-size: .82rem;
    font-weight: 800;

    transition: .25s ease;
}

.about-nav a i {
    color: var(--dumai-teal);
}

.about-nav a:hover,
.about-nav a.active {
    background: var(--dumai-dark);
    color: #fff;
}

.about-nav a:hover i,
.about-nav a.active i {
    color: #f1c866;
}


/* ============================================================
   GENERAL SECTION
============================================================ */
.about-section {
    padding-top: 75px;
    scroll-margin-top: 130px;
}

.section-heading {
    margin-bottom: 35px;
}

.section-heading.center {
    text-align: center;
}

.section-kicker {
    display: inline-flex;
    align-items: center;
    gap: 8px;

    color: var(--dumai-teal);
    font-size: .8rem;
    font-weight: 800;

    text-transform: uppercase;
    letter-spacing: 1.8px;

    margin-bottom: 8px;
}

.section-kicker::before {
    content: "";
    width: 28px;
    height: 3px;
    border-radius: 20px;
    background: var(--dumai-gold);
}

.section-heading.center .section-kicker::before {
    display: none;
}

.section-heading h2 {
    margin: 0;

    font-family: 'Poppins', sans-serif;
    font-size: clamp(1.8rem, 4vw, 2.7rem);
    font-weight: 800;

    color: var(--dumai-dark);
}

.section-heading p {
    max-width: 700px;
    margin: 10px auto 0;

    color: var(--dumai-muted);
    line-height: 1.7;
}


/* ============================================================
   CONTENT CARD
============================================================ */
.about-card {
    height: 100%;

    background: #fff;

    border: 1px solid #e8f0f2;
    border-radius: 24px;

    padding: 35px;

    box-shadow:
        0 12px 35px rgba(5,46,62,.055);

    transition: .3s ease;
}

.about-card:hover {
    transform: translateY(-5px);

    box-shadow:
        0 20px 45px rgba(5,46,62,.10);
}

.about-card p {
    color: var(--dumai-muted);
    font-size: 1rem;
    line-height: 1.9;
}

.about-card strong {
    color: var(--dumai-dark);
}


/* ============================================================
   IMAGE
============================================================ */
.about-image {
    position: relative;

    min-height: 390px;

    overflow: hidden;
    border-radius: 26px;

    box-shadow:
        0 18px 45px rgba(5,46,62,.13);
}

.about-image img {
    width: 100%;
    height: 100%;
    min-height: 390px;

    object-fit: cover;

    transition: transform .6s ease;
}

.about-image:hover img {
    transform: scale(1.05);
}

.about-image::after {
    content: "";

    position: absolute;
    inset: 0;

    background:
        linear-gradient(
            to top,
            rgba(3,38,50,.85),
            transparent 45%
        );
}

.image-caption {
    position: absolute;
    z-index: 2;

    bottom: 0;
    left: 0;
    right: 0;

    padding: 25px;

    color: #fff;
}

.image-caption strong {
    display: block;

    margin-bottom: 5px;

    color: #fff;
    font-family: 'Poppins', sans-serif;
}

.image-caption span {
    font-size: .9rem;
    color: rgba(255,255,255,.85);
}


/* ============================================================
   STATISTICS
============================================================ */
.stats-panel {
    position: relative;

    overflow: hidden;

    padding: 45px 30px;

    border-radius: 28px;

    background:
        linear-gradient(
            135deg,
            #063746,
            #087f9c
        );

    color: #fff;

    box-shadow:
        0 20px 45px rgba(5,46,62,.15);
}

.stats-panel::before {
    content: "DUMAI";

    position: absolute;

    right: -30px;
    top: -45px;

    font-family: 'Poppins', sans-serif;
    font-size: 8rem;
    font-weight: 800;

    color: rgba(255,255,255,.04);
}

.stats-title {
    position: relative;
    z-index: 2;

    text-align: center;
    margin-bottom: 35px;
}

.stats-title i {
    color: #f1c866;
    margin-right: 8px;
}

.stats-title h3 {
    display: inline;

    font-family: 'Poppins', sans-serif;
    font-weight: 800;
}

.stats-grid {
    position: relative;
    z-index: 2;

    display: grid;
    grid-template-columns: repeat(5,1fr);
}

.stat-item {
    text-align: center;

    padding: 10px 15px;

    border-right: 1px solid rgba(255,255,255,.15);
}

.stat-item:last-child {
    border-right: none;
}

.stat-number {
    display: block;

    font-family: 'Poppins', sans-serif;
    font-size: clamp(1.8rem,4vw,2.7rem);
    font-weight: 800;

    color: #f1c866;
}

.stat-label {
    display: block;

    margin-top: 7px;

    font-size: .8rem;
    line-height: 1.5;

    color: rgba(255,255,255,.82);
}

.stats-note {
    position: relative;
    z-index: 2;

    margin: 30px 0 0;

    text-align: center;

    font-size: .75rem;
    color: rgba(255,255,255,.6);
}


/* ============================================================
   CULTURE CARDS
============================================================ */
.icon-box {
    width: 60px;
    height: 60px;

    display: flex;
    align-items: center;
    justify-content: center;

    margin-bottom: 18px;

    border-radius: 18px;

    background:
        linear-gradient(
            135deg,
            var(--dumai-dark),
            var(--dumai-teal)
        );

    color: #fff;

    font-size: 1.35rem;
}

.about-card h3,
.about-card h4 {
    font-family: 'Poppins', sans-serif;
    font-weight: 800;
    color: var(--dumai-dark);
}


/* ============================================================
   FOOD LIST
============================================================ */
.food-list {
    display: grid;
    grid-template-columns: repeat(2,1fr);
    gap: 12px;

    margin-top: 25px;
}

.food-item {
    display: flex;
    align-items: center;
    gap: 10px;

    padding: 13px 15px;

    border-radius: 13px;

    background: var(--dumai-soft);

    color: var(--dumai-text);

    font-size: .9rem;
    font-weight: 700;

    transition: .25s ease;
}

.food-item:hover {
    transform: translateX(4px);
    background: #e5f3f4;
}

.food-item i {
    color: var(--dumai-teal);
}


/* ============================================================
   FEATURE
============================================================ */
.feature-card {
    height: 100%;

    padding: 30px 24px;

    text-align: center;

    background: #fff;

    border: 1px solid #e8f0f2;
    border-radius: 22px;

    box-shadow: 0 10px 30px rgba(5,46,62,.05);

    transition: .3s ease;
}

.feature-card:hover {
    transform: translateY(-7px);
    box-shadow: 0 20px 40px rgba(5,46,62,.10);
}

.feature-icon {
    width: 65px;
    height: 65px;

    display: flex;
    align-items: center;
    justify-content: center;

    margin: 0 auto 18px;

    border-radius: 50%;

    background: linear-gradient(
        135deg,
        var(--dumai-dark),
        var(--dumai-teal)
    );

    color: #fff;

    font-size: 1.35rem;
}

.feature-card h4 {
    font-family: 'Poppins', sans-serif;
    font-weight: 800;

    color: var(--dumai-dark);
}

.feature-card p {
    color: var(--dumai-muted);
    line-height: 1.7;
    font-size: .92rem;
}


/* ============================================================
   GALLERY
============================================================ */
.about-gallery {
    display: grid;

    grid-template-columns: repeat(4,1fr);

    grid-auto-rows: 180px;

    gap: 15px;
}

.gallery-item {
    position: relative;

    overflow: hidden;

    border-radius: 20px;

    box-shadow: 0 10px 25px rgba(5,46,62,.08);
}

.gallery-item.large {
    grid-column: span 2;
    grid-row: span 2;
}

.gallery-item img {
    width: 100%;
    height: 100%;

    object-fit: cover;

    transition: transform .5s ease;
}

.gallery-item:hover img {
    transform: scale(1.08);
}

.gallery-overlay {
    position: absolute;
    inset: auto 0 0;

    padding: 25px 15px 15px;

    color: #fff;

    background:
        linear-gradient(
            transparent,
            rgba(3,38,50,.9)
        );
}

.gallery-overlay span {
    font-size: .82rem;
    font-weight: 800;
}


/* ============================================================
   TESTIMONIAL
============================================================ */
.testimonial-card {
    position: relative;

    height: 100%;

    padding: 30px;

    border-radius: 22px;

    background: #fff;

    border: 1px solid #e8f0f2;

    box-shadow: 0 10px 30px rgba(5,46,62,.05);
}

.testimonial-card::before {
    content: "\f10d";

    position: absolute;

    right: 22px;
    top: 15px;

    font-family: "Font Awesome 6 Free";
    font-weight: 900;

    font-size: 2.8rem;

    color: #edf5f6;
}

.testimonial-text {
    position: relative;
    z-index: 2;

    color: var(--dumai-muted);

    line-height: 1.8;
}

.testimonial-user {
    display: flex;
    align-items: center;
    gap: 12px;

    margin-top: 22px;
}

.testimonial-avatar {
    width: 45px;
    height: 45px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 50%;

    background:
        linear-gradient(
            135deg,
            var(--dumai-dark),
            var(--dumai-teal)
        );

    color: #fff;

    font-weight: 800;
}

.testimonial-user strong {
    display: block;
    color: var(--dumai-dark);
}

.testimonial-user span {
    font-size: .78rem;
    color: var(--dumai-muted);
}


/* ============================================================
   CTA
============================================================ */
.about-cta {
    position: relative;

    overflow: hidden;

    padding: 65px 30px;

    border-radius: 30px;

    background:
        linear-gradient(
            135deg,
            rgba(3,38,50,.96),
            rgba(8,127,156,.92)
        ),
        url('{{ asset('images/Pantai Dumai.jpg') }}');

    background-size: cover;
    background-position: center;

    color: #fff;

    text-align: center;

    box-shadow: 0 20px 45px rgba(5,46,62,.15);
}

.about-cta h2 {
    font-family: 'Poppins', sans-serif;

    font-size: clamp(2rem,4vw,3rem);

    font-weight: 800;

    margin-bottom: 12px;
}

.about-cta p {
    max-width: 680px;

    margin: auto;

    color: rgba(255,255,255,.85);

    line-height: 1.8;
}

.cta-button {
    display: inline-flex;
    align-items: center;
    gap: 9px;

    margin-top: 25px;

    padding: 14px 25px;

    border-radius: 50px;

    background: #fff;
    color: var(--dumai-dark);

    text-decoration: none;

    font-weight: 800;

    transition: .3s ease;
}

.cta-button:hover {
    transform: translateY(-4px);

    color: var(--dumai-dark);

    box-shadow: 0 15px 30px rgba(0,0,0,.2);
}


/* ============================================================
   BACK TO TOP
============================================================ */
.back-top {
    position: fixed;

    right: 22px;
    bottom: 22px;

    width: 48px;
    height: 48px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 50%;

    background: var(--dumai-dark);
    color: #fff;

    text-decoration: none;

    opacity: 0;
    visibility: hidden;

    transform: translateY(15px);

    transition: .3s ease;

    z-index: 100;
}

.back-top.show {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

.back-top:hover {
    background: var(--dumai-teal);
    color: #fff;
}


/* ============================================================
   REVEAL
============================================================ */
.reveal {
    opacity: 0;
    transform: translateY(25px);

    transition:
        opacity .7s ease,
        transform .7s ease;
}

.reveal.show {
    opacity: 1;
    transform: translateY(0);
}


/* ============================================================
   RESPONSIVE
============================================================ */
@media (max-width: 991px) {

    .stats-grid {
        grid-template-columns: repeat(3,1fr);
        row-gap: 25px;
    }

    .stat-item:nth-child(3) {
        border-right: none;
    }

    .about-gallery {
        grid-template-columns: repeat(2,1fr);
    }
}

@media (max-width: 767px) {

    .about-hero {
        min-height: 70vh;
        background-attachment: scroll;
    }

    .about-hero h1 {
        font-size: 2.35rem;
    }

    .about-hero p {
        font-size: .95rem;
    }

    .about-nav-wrap {
        top: 0;
    }

    .about-nav {
        justify-content: flex-start;
    }

    .about-section {
        padding-top: 55px;
    }

    .about-card {
        padding: 25px;
    }

    .about-image,
    .about-image img {
        min-height: 300px;
    }

    .stats-grid {
        grid-template-columns: repeat(2,1fr);
    }

    .stat-item {
        border-right: none;
        border-bottom: 1px solid rgba(255,255,255,.12);
        padding-bottom: 20px;
    }

    .stat-item:last-child {
        border-bottom: none;
    }

    .food-list {
        grid-template-columns: 1fr;
    }

    .about-gallery {
        grid-template-columns: repeat(2,1fr);
        grid-auto-rows: 140px;
    }

    .gallery-item.large {
        grid-column: span 2;
        grid-row: span 1;
    }
}

@media (prefers-reduced-motion: reduce) {

    *,
    *::before,
    *::after {
        scroll-behavior: auto !important;
        animation: none !important;
        transition: none !important;
    }

    .reveal {
        opacity: 1;
        transform: none;
    }
}
</style>


{{-- ============================================================
    HERO
============================================================ --}}
<section class="about-hero" id="hero">

    <div class="about-hero-content">

        <span class="about-eyebrow">
            <i class="fas fa-compass"></i>
            Kota Pelabuhan & Mutiara Pesisir Riau
        </span>

        <h1>
            Mengenal <span>Kota Dumai</span>
        </h1>

        <p>
            Jelajahi sejarah, budaya Melayu, keberagaman masyarakat,
            kuliner khas, serta pesona wisata pesisir Kota Dumai.
        </p>

        <div class="hero-buttons">

            <a href="#sejarah" class="hero-btn hero-btn-primary">
                <i class="fas fa-book-open"></i>
                Kenali Dumai
            </a>

            <a href="{{ route('destinasi') }}" class="hero-btn hero-btn-outline">
                <i class="fas fa-map-location-dot"></i>
                Jelajahi Destinasi
            </a>

        </div>

    </div>

    <div class="about-wave">
        <svg viewBox="0 0 1440 110" preserveAspectRatio="none">
            <path
                d="M0,70 C250,110 450,15 720,45 C980,75 1180,115 1440,55 L1440,110 L0,110 Z"
                fill="#f8fbfc">
            </path>
        </svg>
    </div>

</section>


{{-- ============================================================
    QUICK NAV
============================================================ --}}
<div class="about-nav-wrap">

    <div class="container">

        <nav class="about-nav" id="aboutNav">

            <a href="#sejarah">
                <i class="fas fa-scroll"></i>
                Sejarah
            </a>

            <a href="#statistik">
                <i class="fas fa-chart-simple"></i>
                Statistik
            </a>

            <a href="#budaya">
                <i class="fas fa-drum"></i>
                Budaya
            </a>

            <a href="#masyarakat">
                <i class="fas fa-users"></i>
                Masyarakat
            </a>

            <a href="#kuliner">
                <i class="fas fa-utensils"></i>
                Kuliner
            </a>

            <a href="#galeri">
                <i class="fas fa-images"></i>
                Galeri
            </a>

            <a href="#festival">
                <i class="fas fa-calendar-days"></i>
                Festival
            </a>

        </nav>

    </div>

</div>


{{-- ============================================================
    SEJARAH
============================================================ --}}
<section class="container about-section" id="sejarah">

    <div class="row g-4 align-items-center">

        <div class="col-lg-6 reveal">

            <div class="about-card">

                <div class="section-heading">

                    <span class="section-kicker">
                        Napak Tilas
                    </span>

                    <h2>
                        Sejarah Kota Dumai
                    </h2>

                </div>

                <p>
                    Nama <strong>Dumai</strong> memiliki kaitan dengan
                    cerita rakyat dan legenda <strong>Putri Tujuh</strong>.
                    Pada masa awal, Dumai dikenal sebagai kawasan pesisir
                    yang dihuni masyarakat nelayan dan berada dalam
                    pengaruh Kerajaan Siak Sri Indrapura.
                </p>

                <p>
                    Perkembangan Dumai semakin pesat karena posisi
                    geografisnya yang strategis di pesisir timur Sumatera.
                    Aktivitas pelabuhan, perdagangan, dan industri minyak
                    kemudian menjadi bagian penting dalam pertumbuhan kota.
                </p>

                <p>
                    Dumai akhirnya berkembang menjadi kota otonom pada
                    <strong>20 April 1999</strong> berdasarkan
                    Undang-Undang Nomor 16 Tahun 1999.
                </p>

            </div>

        </div>


        <div class="col-lg-6 reveal">

            <div class="about-image">

                <img
                    src="{{ asset('images/Kota Dumai Gambar.jpg') }}"
                    alt="Pemandangan Kota Dumai"
                    loading="lazy"
                >

                <div class="image-caption">

                    <strong>Dumai, Kota Pesisir Riau</strong>

                    <span>
                        Kota yang tumbuh dari kawasan pesisir
                        menjadi pusat pelabuhan, industri dan perdagangan.
                    </span>

                </div>

            </div>

        </div>

    </div>

</section>


{{-- ============================================================
    STATISTIK
============================================================ --}}
<section class="container about-section" id="statistik">

    <div class="stats-panel reveal">

        <div class="stats-title">

            <i class="fas fa-anchor"></i>

            <h3>
                Dumai dalam Sekilas Angka
            </h3>

        </div>


        <div class="stats-grid">

            <div class="stat-item">
                <span class="stat-number">1999</span>
                <span class="stat-label">
                    Berdiri sebagai<br>Kota Otonom
                </span>
            </div>

            <div class="stat-item">
                <span class="stat-number">1.727</span>
                <span class="stat-label">
                    Km² luas<br>wilayah daratan
                </span>
            </div>

            <div class="stat-item">
                <span class="stat-number">7</span>
                <span class="stat-label">
                    Kecamatan<br>di Kota Dumai
                </span>
            </div>

            <div class="stat-item">
                <span class="stat-number">300rb+</span>
                <span class="stat-label">
                    Penduduk<br>beragam
                </span>
            </div>

            <div class="stat-item">
                <span class="stat-number">6+</span>
                <span class="stat-label">
                    Kelompok suku<br>berdampingan
                </span>
            </div>

        </div>

        <p class="stats-note">
            Data ditampilkan sebagai informasi ringkas dan dapat disesuaikan
            dengan data terbaru Pemerintah Kota Dumai/BPS.
        </p>

    </div>

</section>


{{-- ============================================================
    BUDAYA
============================================================ --}}
<section class="container about-section" id="budaya">

    <div class="row g-4 align-items-center">

        <div class="col-lg-6 order-lg-2 reveal">

            <div class="about-card">

                <div class="icon-box">
                    <i class="fas fa-masks-theater"></i>
                </div>

                <div class="section-heading">

                    <span class="section-kicker">
                        Kearifan Lokal
                    </span>

                    <h2>
                        Budaya Melayu Dumai
                    </h2>

                </div>

                <p>
                    Kebudayaan Dumai memiliki hubungan erat dengan
                    <strong>budaya Melayu pesisir</strong>. Nilai adat,
                    kesopanan, gotong royong dan kehidupan bermasyarakat
                    menjadi bagian penting dari identitas daerah.
                </p>

                <p>
                    Seni tradisional seperti <strong>Tari Zapin</strong>,
                    Tari Persembahan, pantun, syair, gambus dan berbagai
                    bentuk kesenian Melayu terus menjadi bagian dari
                    kehidupan budaya masyarakat.
                </p>

                <p>
                    Salah satu ciri visual arsitektur Melayu adalah
                    penggunaan ornamen khas seperti
                    <strong>Selembayung</strong> yang banyak ditemukan
                    pada bangunan bernuansa Melayu.
                </p>

            </div>

        </div>


        <div class="col-lg-6 order-lg-1 reveal">

            <div class="about-image">

                <img
                    src="{{ asset('images/budaya.jpg') }}"
                    alt="Budaya Melayu Kota Dumai"
                    loading="lazy"
                >

                <div class="image-caption">

                    <strong>Seni dan Tradisi Melayu</strong>

                    <span>
                        Warisan budaya yang terus dijaga dan diwariskan
                        dari generasi ke generasi.
                    </span>

                </div>

            </div>

        </div>

    </div>

</section>


{{-- ============================================================
    MASYARAKAT
============================================================ --}}
<section class="container about-section" id="masyarakat">

    <div class="section-heading center reveal">

        <span class="section-kicker">
            Demografi & Harmoni
        </span>

        <h2>
            Keberagaman Masyarakat
        </h2>

        <p>
            Dumai merupakan kota yang dihuni oleh masyarakat
            dengan latar belakang suku dan budaya yang beragam.
        </p>

    </div>


    <div class="row g-4">

        <div class="col-md-6 reveal">

            <div class="about-card">

                <div class="icon-box">
                    <i class="fas fa-users"></i>
                </div>

                <h3>
                    Keberagaman Suku
                </h3>

                <p>
                    Sebagai kota industri dan pelabuhan, Dumai menjadi
                    tempat bertemunya berbagai kelompok masyarakat.
                    Budaya Melayu menjadi salah satu unsur penting
                    dalam kehidupan masyarakat setempat.
                </p>

                <p>
                    Masyarakat dari berbagai latar belakang seperti
                    Jawa, Minangkabau, Batak, Tionghoa, Bugis,
                    Sunda dan lainnya hidup berdampingan.
                </p>

            </div>

        </div>


        <div class="col-md-6 reveal">

            <div class="about-card">

                <div class="icon-box">
                    <i class="fas fa-hands-holding-circle"></i>
                </div>

                <h3>
                    Harmoni & Toleransi
                </h3>

                <p>
                    Kehidupan masyarakat Dumai ditandai dengan
                    semangat kebersamaan dan saling menghargai.
                    Berbagai komunitas dapat menjalankan aktivitas
                    sosial dan keagamaan secara berdampingan.
                </p>

                <p>
                    Keragaman tersebut menjadi salah satu kekuatan
                    yang membuat Dumai terasa ramah bagi masyarakat
                    maupun wisatawan.
                </p>

            </div>

        </div>

    </div>

</section>


{{-- ============================================================
    KULINER
============================================================ --}}
<section class="container about-section" id="kuliner">

    <div class="about-card reveal">

        <div class="row g-4 align-items-center">

            <div class="col-lg-7">

                <div class="section-heading">

                    <span class="section-kicker">
                        Cita Rasa Pesisir
                    </span>

                    <h2>
                        Kuliner Khas Dumai
                    </h2>

                </div>

                <p>
                    Sebagai kota pesisir, Dumai memiliki kekayaan kuliner
                    yang dipengaruhi hasil laut dan cita rasa Melayu.
                    Rempah yang kuat membuat hidangan khas daerah
                    memiliki karakter tersendiri.
                </p>


                <div class="food-list">

                    <div class="food-item">
                        <i class="fas fa-circle-check"></i>
                        Gulai Ikan Patin
                    </div>

                    <div class="food-item">
                        <i class="fas fa-circle-check"></i>
                        Lakse Melayu
                    </div>

                    <div class="food-item">
                        <i class="fas fa-circle-check"></i>
                        Asam Pedas Seafood
                    </div>

                    <div class="food-item">
                        <i class="fas fa-circle-check"></i>
                        Mie Sagu
                    </div>

                    <div class="food-item">
                        <i class="fas fa-circle-check"></i>
                        Mie Lendir
                    </div>

                    <div class="food-item">
                        <i class="fas fa-circle-check"></i>
                        Kerupuk Cabai
                    </div>

                </div>

            </div>


            <div class="col-lg-5">

                <div class="about-image">

                    <img
                        src="{{ asset('images/kuliner.jpg') }}"
                        alt="Kuliner khas Kota Dumai"
                        loading="lazy"
                    >

                    <div class="image-caption">

                        <strong>Cita Rasa Melayu Pesisir</strong>

                        <span>
                            Perpaduan hasil laut dan rempah khas Melayu.
                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>


{{-- ============================================================
    GALERI
============================================================ --}}
<section class="container about-section" id="galeri">

    <div class="section-heading center reveal">

        <span class="section-kicker">
            Sekilas Pandang
        </span>

        <h2>
            Galeri Kota Dumai
        </h2>

        <p>
            Lihat berbagai sisi Kota Dumai, mulai dari kota,
            budaya, kuliner hingga pesona pesisir.
        </p>

    </div>


    <div class="about-gallery reveal">

        <a
            href="{{ asset('images/Kota Dumai Gambar.jpg') }}"
            target="_blank"
            class="gallery-item large"
        >

            <img
                src="{{ asset('images/Kota Dumai Gambar.jpg') }}"
                alt="Kota Dumai"
                loading="lazy"
            >

            <div class="gallery-overlay">
                <span>Wajah Kota Dumai</span>
            </div>

        </a>


        <a
            href="{{ asset('images/budaya.jpg') }}"
            target="_blank"
            class="gallery-item"
        >

            <img
                src="{{ asset('images/budaya.jpg') }}"
                alt="Budaya Melayu"
                loading="lazy"
            >

            <div class="gallery-overlay">
                <span>Budaya Melayu</span>
            </div>

        </a>


        <a
            href="{{ asset('images/kuliner.jpg') }}"
            target="_blank"
            class="gallery-item"
        >

            <img
                src="{{ asset('images/kuliner.jpg') }}"
                alt="Kuliner Dumai"
                loading="lazy"
            >

            <div class="gallery-overlay">
                <span>Kuliner Khas</span>
            </div>

        </a>


        <a
            href="{{ asset('images/port-dumai.jpg') }}"
            target="_blank"
            class="gallery-item"
        >

            <img
                src="{{ asset('images/port-dumai.jpg') }}"
                alt="Pelabuhan Dumai"
                loading="lazy"
            >

            <div class="gallery-overlay">
                <span>Pelabuhan Dumai</span>
            </div>

        </a>


        <a
            href="{{ asset('images/Pantai Dumai.jpg') }}"
            target="_blank"
            class="gallery-item"
        >

            <img
                src="{{ asset('images/Pantai Dumai.jpg') }}"
                alt="Pantai Dumai"
                loading="lazy"
            >

            <div class="gallery-overlay">
                <span>Pesona Pesisir</span>
            </div>

        </a>

    </div>

</section>


{{-- ============================================================
    FESTIVAL
============================================================ --}}
<section class="container about-section" id="festival">

    <div class="section-heading center reveal">

        <span class="section-kicker">
            Atraksi & Agenda
        </span>

        <h2>
            Festival & Kegiatan
        </h2>

        <p>
            Berbagai kegiatan masyarakat menjadi daya tarik
            tersendiri bagi wisatawan yang berkunjung ke Dumai.
        </p>

    </div>


    <div class="row g-4">

        <div class="col-md-4 reveal">

            <div class="feature-card">

                <div class="feature-icon">
                    <i class="fas fa-drum"></i>
                </div>

                <h4>
                    Festival Budaya Melayu
                </h4>

                <p>
                    Pertunjukan seni, musik Melayu, pantun,
                    tari tradisional dan kegiatan budaya masyarakat.
                </p>

            </div>

        </div>


        <div class="col-md-4 reveal">

            <div class="feature-card">

                <div class="feature-icon">
                    <i class="fas fa-umbrella-beach"></i>
                </div>

                <h4>
                    Festival Pesisir
                </h4>

                <p>
                    Berbagai kegiatan masyarakat, hiburan,
                    olahraga dan aktivitas wisata di kawasan pesisir.
                </p>

            </div>

        </div>


        <div class="col-md-4 reveal">

            <div class="feature-card">

                <div class="feature-icon">
                    <i class="fas fa-calendar-days"></i>
                </div>

                <h4>
                    Hari Jadi Kota Dumai
                </h4>

                <p>
                    Momentum tahunan yang diisi dengan berbagai
                    kegiatan masyarakat dan perayaan kota.
                </p>

            </div>

        </div>

    </div>

</section>


{{-- ============================================================
    TESTIMONI
============================================================ --}}
<section class="container about-section" id="testimoni">

    <div class="section-heading center reveal">

        <span class="section-kicker">
            Cerita Wisata
        </span>

        <h2>
            Pengalaman Berkunjung
        </h2>

    </div>


    <div class="row g-4">

        <div class="col-md-4 reveal">

            <div class="testimonial-card">

                <p class="testimonial-text">
                    "Dumai memiliki suasana pesisir yang menarik.
                    Budayanya juga terasa kuat dan masyarakatnya ramah."
                </p>

                <div class="testimonial-user">

                    <div class="testimonial-avatar">
                        RA
                    </div>

                    <div>
                        <strong>Rani A.</strong>
                        <span>Wisatawan</span>
                    </div>

                </div>

            </div>

        </div>


        <div class="col-md-4 reveal">

            <div class="testimonial-card">

                <p class="testimonial-text">
                    "Kuliner Melayu dan makanan lautnya menjadi
                    salah satu pengalaman yang paling menarik."
                </p>

                <div class="testimonial-user">

                    <div class="testimonial-avatar">
                        DH
                    </div>

                    <div>
                        <strong>Doni H.</strong>
                        <span>Wisatawan Kuliner</span>
                    </div>

                </div>

            </div>

        </div>


        <div class="col-md-4 reveal">

            <div class="testimonial-card">

                <p class="testimonial-text">
                    "Keberagaman masyarakatnya membuat suasana
                    kota terasa hangat dan bersahabat."
                </p>

                <div class="testimonial-user">

                    <div class="testimonial-avatar">
                        SN
                    </div>

                    <div>
                        <strong>Siti N.</strong>
                        <span>Pengunjung</span>
                    </div>

                </div>

            </div>

        </div>

    </div>

</section>


{{-- ============================================================
    CTA
============================================================ --}}
<section class="container about-section mb-5">

    <div class="about-cta reveal">

        <h2>
            Ayo Jelajahi Kota Dumai
        </h2>

        <p>
            Temukan destinasi wisata, kuliner khas, budaya Melayu,
            serta berbagai pengalaman menarik di Kota Dumai.
        </p>

        <a
            href="{{ route('destinasi') }}"
            class="cta-button"
        >
            <i class="fas fa-map-location-dot"></i>
            Lihat Destinasi Wisata
        </a>

    </div>

</section>


{{-- ============================================================
    BACK TO TOP
============================================================ --}}
<a
    href="#hero"
    class="back-top"
    id="backTop"
    aria-label="Kembali ke atas"
>
    <i class="fas fa-arrow-up"></i>
</a>


{{-- ============================================================
    JAVASCRIPT
============================================================ --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

    /* ============================================================
       SCROLL REVEAL
    ============================================================ */

    const revealElements =
        document.querySelectorAll('.reveal');

    if ('IntersectionObserver' in window) {

        const observer =
            new IntersectionObserver(function (entries) {

                entries.forEach(function (entry) {

                    if (entry.isIntersecting) {

                        entry.target.classList.add('show');

                        observer.unobserve(entry.target);

                    }

                });

            }, {
                threshold: 0.12
            });


        revealElements.forEach(function (element) {
            observer.observe(element);
        });

    } else {

        revealElements.forEach(function (element) {
            element.classList.add('show');
        });

    }


    /* ============================================================
       BACK TO TOP
    ============================================================ */

    const backTop =
        document.getElementById('backTop');

    window.addEventListener('scroll', function () {

        if (window.scrollY > 500) {

            backTop.classList.add('show');

        } else {

            backTop.classList.remove('show');

        }

    });


    /* ============================================================
       ACTIVE QUICK NAV
    ============================================================ */

    const navLinks =
        document.querySelectorAll('#aboutNav a');

    const sections = [];

    navLinks.forEach(function (link) {

        const target =
            document.querySelector(
                link.getAttribute('href')
            );

        if (target) {
            sections.push({
                link: link,
                section: target
            });
        }

    });


    window.addEventListener('scroll', function () {

        let current = '';

        sections.forEach(function (item) {

            const top =
                item.section.getBoundingClientRect().top;

            if (top <= 180) {
                current = item;
            }

        });


        navLinks.forEach(function (link) {
            link.classList.remove('active');
        });


        if (current) {
            current.link.classList.add('active');
        }

    });

});
</script>

@endsection