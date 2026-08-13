@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')

@php
    /*
    |--------------------------------------------------------------------------
    | DATA STATISTIK
    |--------------------------------------------------------------------------
    */
    $totalDestinasi = $totalDestinasi ?? 0;
    $totalAtraksi   = $totalAtraksi ?? 0;
    $totalUser      = $totalUser ?? 0;
    $totalUlasan    = $totalUlasan ?? 0;

    /*
    |--------------------------------------------------------------------------
    | ROUTE AMAN
    |--------------------------------------------------------------------------
    */
    $destinasiUrl = Route::has('destinasi')
        ? route('destinasi')
        : '#';

    $atraksiUrl = Route::has('atraksi')
        ? route('atraksi')
        : '#';

    $settingsUrl = Route::has('admin.settings.index')
        ? route('admin.settings.index')
        : '#';
@endphp


<style>

/* =========================================================
   ROOT
========================================================= */

:root {
    --melayu-green: #0d3b36;
    --melayu-green-2: #176b5b;
    --melayu-green-3: #23836d;

    --melayu-gold: #d6a84f;
    --melayu-gold-dark: #b78320;

    --melayu-cream: #fffaf0;
    --melayu-bg: #f4f7f5;

    --text-dark: #24332f;
    --text-muted: #7d8985;

    --border: #e7ece9;

    --shadow: 0 10px 30px rgba(20, 53, 47, .08);
    --shadow-hover: 0 18px 40px rgba(20, 53, 47, .14);
}


/* =========================================================
   WRAPPER
========================================================= */

.dashboard-wrapper {
    padding-bottom: 45px;
}


/* =========================================================
   HERO DASHBOARD
========================================================= */

.dashboard-hero {
    position: relative;
    overflow: hidden;
    min-height: 210px;
    padding: 32px;
    margin-bottom: 28px;
    border-radius: 24px;
    color: #fff;

    background:
        /* gold rosette, left (tetap linework) */
        url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 300 300'%3E%3Cg fill='none' stroke='rgba(214,168,79,0.4)' stroke-width='1.5'%3E%3Ccircle cx='150' cy='150' r='140'/%3E%3Ccircle cx='150' cy='150' r='105'/%3E%3Ccircle cx='150' cy='150' r='70'/%3E%3Cpath d='M150,10 L150,290 M10,150 L290,150 M45,45 L255,255 M255,45 L45,255'/%3E%3Cpolygon points='150,45 175,120 255,120 190,165 215,240 150,195 85,240 110,165 45,120 125,120'/%3E%3C/g%3E%3C/svg%3E")
            no-repeat left center,
        /* gradasi gelap kiri->kanan supaya teks di kiri tetap terbaca di atas foto */
        linear-gradient(90deg,
            rgba(8, 54, 48, .95) 0%,
            rgba(8, 54, 48, .8) 35%,
            rgba(8, 54, 48, .35) 62%,
            rgba(8, 54, 48, .05) 85%),
        /* FOTO ASLI — ganti nama file ini sesuai punyamu */
        url("{{ asset('images/hero-rumah-melayu.jpg') }}")
            no-repeat right center,
        /* warna dasar cadangan kalau foto gagal dimuat */
        linear-gradient(135deg, rgba(8, 54, 48, .98), rgba(20, 105, 88, .94));
    background-size: 260px 260px, cover, cover, cover;

    box-shadow: 0 15px 40px rgba(13, 59, 54, .18);
}


/* Lingkaran dekorasi */

.dashboard-hero::before {
    content: "";
    position: absolute;
    width: 280px;
    height: 280px;
    right: -100px;
    top: -130px;
    border: 35px solid rgba(214, 168, 79, .12);
    border-radius: 50%;
}


.dashboard-hero::after {
    content: "";
    position: absolute;
    width: 170px;
    height: 170px;
    right: 100px;
    bottom: -120px;
    border: 25px solid rgba(255, 255, 255, .06);
    border-radius: 50%;
}


/* Baris atas hero: teks + motto berdampingan */

.hero-top {
    position: relative;
    z-index: 2;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 32px;
    flex-wrap: wrap;
}


.hero-content {
    flex: 1 1 320px;
    max-width: 480px;
}


.hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 7px 13px;
    margin-bottom: 14px;
    border-radius: 30px;
    background: rgba(255, 255, 255, .11);
    border: 1px solid rgba(255, 255, 255, .14);
    font-size: 11px;
    font-weight: 600;
    letter-spacing: .4px;
    text-transform: uppercase;
    backdrop-filter: blur(8px);
}


.hero-badge i {
    color: var(--melayu-gold);
}


.dashboard-hero h2 {
    margin: 0;
    font-size: 29px;
    font-weight: 800;
    letter-spacing: -.4px;
}


.dashboard-hero h2 span {
    color: #f0ca73;
}


.dashboard-hero p {
    margin: 9px 0 0;
    max-width: 620px;
    font-size: 13px;
    line-height: 1.7;
    color: rgba(255, 255, 255, .78);
}


/* Date */

.hero-date {
    position: absolute;
    right: 30px;
    top: 30px;
    z-index: 3;
    display: flex;
    align-items: center;
    gap: 9px;
    padding: 10px 14px;
    border-radius: 12px;
    background: rgba(255, 255, 255, .10);
    border: 1px solid rgba(255, 255, 255, .14);
    font-size: 11px;
    backdrop-filter: blur(10px);
}


/* =========================================================
   MOTTO MELAYU
========================================================= */

.melayu-motto {
    flex: 1 1 320px;
    text-align: center;
    padding-top: 6px;
}


.melayu-motto-jawi {
    font-family: 'Traditional Arabic', 'Scheherazade New', 'Amiri', serif;
    font-size: 26px;
    font-weight: 600;
    line-height: 1.5;
    color: #f0ca73;
    direction: rtl;
}


.melayu-motto-latin {
    margin-top: 8px;
    font-size: 13.5px;
    font-style: italic;
    color: rgba(255, 255, 255, .85);
}


.melayu-motto-decoration {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    margin-top: 14px;
    color: var(--melayu-gold);
    font-size: 13px;
}


.melayu-motto-decoration span {
    flex: 1;
    max-width: 90px;
    height: 1px;
    background: linear-gradient(90deg, transparent, rgba(214, 168, 79, .6), transparent);
}


/* =========================================================
   ORNAMEN MELAYU (pembatas antar section)
========================================================= */

.melayu-divider {
    display: flex;
    align-items: center;
    gap: 12px;
    margin: 5px 0 25px;
}


.melayu-divider::before,
.melayu-divider::after {
    content: "";
    height: 1px;
    flex: 1;
    background: linear-gradient(90deg, transparent, rgba(214, 168, 79, .6));
}


.melayu-divider span {
    color: var(--melayu-gold);
    font-size: 18px;
}


/* =========================================================
   SECTION HEADER
========================================================= */

.section-heading {
    margin-bottom: 18px;
}


.section-heading h5 {
    margin: 0;
    color: var(--text-dark);
    font-size: 16px;
    font-weight: 800;
}


.section-heading h5 i {
    color: var(--melayu-gold-dark);
    margin-right: 8px;
}


.section-heading p {
    margin: 5px 0 0;
    color: var(--text-muted);
    font-size: 11px;
}


/* =========================================================
   STATISTIC CARD
========================================================= */

.stat-card {
    position: relative;
    overflow: hidden;
    height: 100%;
    border: 1px solid var(--border);
    border-radius: 20px;
    background: #fff;
    box-shadow: var(--shadow);
    transition: transform .3s ease, box-shadow .3s ease;
}


.stat-card:hover {
    transform: translateY(-6px);
    box-shadow: var(--shadow-hover);
}


.stat-card::before {
    content: "";
    position: absolute;
    width: 100px;
    height: 100px;
    right: -35px;
    top: -35px;
    border-radius: 50%;
    background: rgba(13, 59, 54, .035);
}


.stat-card::after {
    content: "❖";
    position: absolute;
    right: 17px;
    bottom: 12px;
    color: rgba(214, 168, 79, .18);
    font-size: 25px;
}


.stat-body {
    position: relative;
    z-index: 2;
    padding: 22px;
}


.stat-top {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
}


.stat-icon {
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 15px;
    font-size: 20px;
}


.stat-icon.green {
    color: var(--melayu-green);
    background: rgba(13, 59, 54, .10);
}


.stat-icon.gold {
    color: var(--melayu-gold-dark);
    background: rgba(214, 168, 79, .14);
}


.stat-icon.blue {
    color: #2779a8;
    background: rgba(39, 121, 168, .11);
}


.stat-icon.purple {
    color: #7053a5;
    background: rgba(112, 83, 165, .11);
}


.stat-mini {
    font-size: 10px;
    color: var(--text-muted);
    background: #f5f8f6;
    padding: 5px 8px;
    border-radius: 8px;
}


.stat-label {
    margin-top: 17px;
    color: var(--text-muted);
    font-size: 12px;
}


.stat-number {
    margin-top: 3px;
    color: var(--melayu-green);
    font-size: 31px;
    font-weight: 800;
    line-height: 1.1;
}


.stat-description {
    margin-top: 8px;
    color: #9ba5a2;
    font-size: 10px;
}


/* =========================================================
   CARD UMUM
========================================================= */

.dashboard-card {
    height: 100%;
    padding: 23px;
    background: #fff;
    border: 1px solid var(--border);
    border-radius: 20px;
    box-shadow: var(--shadow);
}


/* =========================================================
   CARD HEADER
========================================================= */

.card-heading {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 15px;
    margin-bottom: 20px;
}


.card-heading h5 {
    margin: 0;
    color: var(--text-dark);
    font-size: 15px;
    font-weight: 800;
}


.card-heading p {
    margin: 5px 0 0;
    color: var(--text-muted);
    font-size: 11px;
}


.card-heading-icon {
    width: 38px;
    height: 38px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 11px;
    color: var(--melayu-green);
    background: rgba(13, 59, 54, .08);
}


/* =========================================================
   QUICK MENU
========================================================= */

.quick-menu-card {
    display: flex;
    align-items: center;
    gap: 12px;
    height: 100%;
    padding: 15px;
    text-decoration: none;
    border: 1px solid var(--border);
    border-radius: 15px;
    background: #fff;
    transition: transform .25s ease, box-shadow .25s ease, border-color .25s ease;
}


.quick-menu-card:hover {
    text-decoration: none;
    transform: translateY(-4px);
    border-color: rgba(214, 168, 79, .5);
    box-shadow: 0 12px 28px rgba(20, 53, 47, .10);
}


.quick-menu-card.disabled {
    opacity: .55;
    cursor: not-allowed;
}


.quick-icon {
    width: 44px;
    height: 44px;
    min-width: 44px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 13px;
    font-size: 17px;
}


.quick-icon.green {
    color: var(--melayu-green);
    background: rgba(13, 59, 54, .10);
}


.quick-icon.gold {
    color: var(--melayu-gold-dark);
    background: rgba(214, 168, 79, .14);
}


.quick-icon.blue {
    color: #2779a8;
    background: rgba(39, 121, 168, .11);
}


.quick-icon.purple {
    color: #7053a5;
    background: rgba(112, 83, 165, .11);
}


.quick-icon.gray {
    color: #687570;
    background: rgba(108, 117, 125, .11);
}


.quick-content strong {
    display: block;
    color: var(--text-dark);
    font-size: 12px;
    font-weight: 700;
}


.quick-content span {
    display: block;
    margin-top: 3px;
    color: var(--text-muted);
    font-size: 10px;
}


/* =========================================================
   ONLINE BADGE
========================================================= */

.online-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 10px;
    border-radius: 20px;
    color: #198754;
    background: rgba(25, 135, 84, .09);
    font-size: 10px;
    font-weight: 700;
}


.online-badge span {
    width: 7px;
    height: 7px;
    border-radius: 50%;
    background: #198754;
    box-shadow: 0 0 0 4px rgba(25, 135, 84, .08);
}


/* =========================================================
   CHAT
========================================================= */

.chat-item {
    display: flex;
    gap: 12px;
    padding: 14px 0;
    border-bottom: 1px solid #edf1ef;
}


.chat-item:last-child {
    border-bottom: 0;
}


.chat-avatar {
    width: 42px;
    height: 42px;
    min-width: 42px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    color: #fff;
    background: linear-gradient(135deg, var(--melayu-green), var(--melayu-green-2));
    font-size: 11px;
    font-weight: 800;
}


.chat-avatar.gold {
    background: var(--melayu-gold-dark);
}


.chat-avatar.blue {
    background: #2779a8;
}


.chat-content {
    flex: 1;
    min-width: 0;
}


.chat-top {
    display: flex;
    justify-content: space-between;
    gap: 10px;
}


.chat-top strong {
    color: var(--text-dark);
    font-size: 12px;
}


.chat-top small {
    color: #a0aaa6;
    font-size: 10px;
}


.chat-message {
    margin: 5px 0 8px;
    color: #687570;
    font-size: 11px;
    line-height: 1.6;
}


.chat-actions {
    display: flex;
    gap: 7px;
}


.chat-actions button {
    border: 0;
    border-radius: 8px;
    padding: 5px 9px;
    color: var(--melayu-green);
    background: #f3f7f5;
    font-size: 10px;
    transition: .2s ease;
}


.chat-actions button:hover {
    background: rgba(13, 59, 54, .10);
}


/* =========================================================
   ACTIVITY
========================================================= */

.activity-item {
    display: flex;
    gap: 12px;
    padding: 14px 0;
    border-bottom: 1px solid #edf1ef;
}


.activity-item:last-child {
    border-bottom: 0;
}


.activity-icon {
    width: 40px;
    height: 40px;
    min-width: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 12px;
}


.activity-icon.green {
    color: var(--melayu-green);
    background: rgba(13, 59, 54, .10);
}


.activity-icon.gold {
    color: var(--melayu-gold-dark);
    background: rgba(214, 168, 79, .14);
}


.activity-icon.blue {
    color: #2779a8;
    background: rgba(39, 121, 168, .11);
}


.activity-icon.purple {
    color: #7053a5;
    background: rgba(112, 83, 165, .11);
}


.activity-content {
    flex: 1;
}


.activity-content strong {
    display: block;
    color: var(--text-dark);
    font-size: 12px;
}


.activity-content span {
    display: block;
    margin-top: 3px;
    color: var(--text-muted);
    font-size: 10px;
}


.activity-content small {
    display: block;
    margin-top: 4px;
    color: #a2aaa7;
    font-size: 9px;
}


/* =========================================================
   CHART
========================================================= */

.chart-container {
    position: relative;
    height: 280px;
}


.chart-menu {
    width: 34px;
    height: 34px;
    border: 0;
    border-radius: 9px;
    color: var(--melayu-green);
    background: #f4f7f5;
}


/* =========================================================
   INFO ITEM
========================================================= */

.info-item {
    display: flex;
    align-items: center;
    gap: 13px;
    padding: 14px 0;
    border-bottom: 1px solid #edf1ef;
}


.info-item:last-child {
    border-bottom: 0;
}


.info-icon {
    width: 43px;
    height: 43px;
    min-width: 43px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 12px;
    color: var(--melayu-green);
    background: rgba(13, 59, 54, .08);
}


.info-item strong {
    display: block;
    color: var(--text-dark);
    font-size: 13px;
}


.info-item span {
    display: block;
    margin-top: 3px;
    color: var(--text-muted);
    font-size: 10px;
}


/* =========================================================
   VIEW ALL
========================================================= */

.view-all {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 9px 14px;
    border-radius: 10px;
    color: var(--melayu-green);
    background: #f3f7f5;
    text-decoration: none;
    font-size: 10px;
    font-weight: 700;
    transition: .2s ease;
}


.view-all:hover {
    color: var(--melayu-green);
    background: rgba(13, 59, 54, .10);
    text-decoration: none;
}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 992px) {
    .hero-date {
        position: static;
        display: inline-flex;
        margin-top: 20px;
    }

    .melayu-motto {
        text-align: left;
    }

    .melayu-motto-decoration {
        justify-content: flex-start;
    }
}


@media (max-width: 768px) {
    .dashboard-hero {
        padding: 24px;
        min-height: auto;
    }

    .dashboard-hero h2 {
        font-size: 22px;
    }

    .dashboard-hero p {
        font-size: 12px;
    }

    .stat-number {
        font-size: 26px;
    }

    .dashboard-card {
        padding: 18px;
    }

    .chart-container {
        height: 240px;
    }

    .chat-top {
        flex-direction: column;
        gap: 3px;
    }
}


@media (max-width: 480px) {
    .dashboard-hero {
        border-radius: 18px;
        padding: 20px;
    }

    .dashboard-hero h2 {
        font-size: 20px;
    }

    .stat-body {
        padding: 18px;
    }

    .stat-icon {
        width: 44px;
        height: 44px;
    }
}

</style>


<div class="dashboard-wrapper">

    {{-- =====================================================
         HERO
    ====================================================== --}}

    <div class="dashboard-hero">

        <div class="hero-top">

            <div class="hero-content">

                <span class="hero-badge">
                    <i class="fas fa-shield-halved"></i>
                    Panel Administrator
                </span>

                <h2>
                    Selamat Datang di
                    <span>Visit Dumai</span>
                </h2>

                <p>
                    Kelola informasi destinasi, atraksi wisata,
                    pengguna, dan ulasan pengunjung melalui
                    pusat administrasi wisata Kota Dumai.
                </p>

            </div>

            {{-- MOTTO MELAYU --}}
            <div class="melayu-motto">
                <div class="melayu-motto-jawi">
                    د مانا بومي دڤيجق، د سيتو لاڠيت دجونجوڠ
                </div>

                <div class="melayu-motto-latin">
                    &ldquo;Di mana bumi dipijak, di situ langit dijunjung&rdquo;
                </div>

                <div class="melayu-motto-decoration">
                    <span></span>
                    ❖
                    <span></span>
                </div>
            </div>

        </div>

        <div class="hero-date">
            <i class="far fa-calendar-alt"></i>
            {{ now()->locale('id')->translatedFormat('l, d F Y') }}
        </div>

    </div>


    {{-- =====================================================
         STATISTIK
    ====================================================== --}}

    <div class="section-heading">
        <h5>
            <i class="fas fa-chart-line"></i>
            Ringkasan Website
        </h5>
        <p>
            Statistik utama sistem Visit Dumai
        </p>
    </div>


    <div class="row g-4 mb-4">

        {{-- DESTINASI --}}
        <div class="col-xl-3 col-md-6">
            <div class="stat-card">
                <div class="stat-body">
                    <div class="stat-top">
                        <div class="stat-icon green">
                            <i class="fas fa-map-marked-alt"></i>
                        </div>
                        <span class="stat-mini">Wisata</span>
                    </div>
                    <div class="stat-label">Total Destinasi</div>
                    <div class="stat-number">{{ number_format($totalDestinasi) }}</div>
                    <div class="stat-description">Destinasi wisata terdaftar</div>
                </div>
            </div>
        </div>

        {{-- ATRAKSI --}}
        <div class="col-xl-3 col-md-6">
            <div class="stat-card">
                <div class="stat-body">
                    <div class="stat-top">
                        <div class="stat-icon gold">
                            <i class="fas fa-camera-retro"></i>
                        </div>
                        <span class="stat-mini">Atraksi</span>
                    </div>
                    <div class="stat-label">Total Atraksi</div>
                    <div class="stat-number">{{ number_format($totalAtraksi) }}</div>
                    <div class="stat-description">Atraksi wisata tersedia</div>
                </div>
            </div>
        </div>

        {{-- USER --}}
        <div class="col-xl-3 col-md-6">
            <div class="stat-card">
                <div class="stat-body">
                    <div class="stat-top">
                        <div class="stat-icon blue">
                            <i class="fas fa-users"></i>
                        </div>
                        <span class="stat-mini">Member</span>
                    </div>
                    <div class="stat-label">Total Pengguna</div>
                    <div class="stat-number">{{ number_format($totalUser) }}</div>
                    <div class="stat-description">Pengguna terdaftar</div>
                </div>
            </div>
        </div>

        {{-- ULASAN --}}
        <div class="col-xl-3 col-md-6">
            <div class="stat-card">
                <div class="stat-body">
                    <div class="stat-top">
                        <div class="stat-icon purple">
                            <i class="fas fa-comments"></i>
                        </div>
                        <span class="stat-mini">Review</span>
                    </div>
                    <div class="stat-label">Total Ulasan</div>
                    <div class="stat-number">{{ number_format($totalUlasan) }}</div>
                    <div class="stat-description">Ulasan dari pengunjung</div>
                </div>
            </div>
        </div>

    </div>


    {{-- =====================================================
         ORNAMEN
    ====================================================== --}}

    <div class="melayu-divider">
        <span>❖</span>
    </div>


    {{-- =====================================================
         MENU CEPAT
    ====================================================== --}}

    <div class="dashboard-card mb-4">

        <div class="card-heading">
            <div>
                <h5>
                    <i class="fas fa-th-large" style="color:#D6A84F;"></i>
                    Menu Cepat
                </h5>
                <p>
                    Akses cepat untuk mengelola website
                    Visit Dumai
                </p>
            </div>
            <div class="card-heading-icon">
                <i class="fas fa-bolt"></i>
            </div>
        </div>

        <div class="row g-3">

            {{-- DESTINASI --}}
            <div class="col-xl-3 col-md-6 col-12">
                <a
                    href="{{ $destinasiUrl }}"
                    class="quick-menu-card {{ $destinasiUrl === '#' ? 'disabled' : '' }}"
                    @if($destinasiUrl === '#') onclick="return false;" @endif
                >
                    <div class="quick-icon green">
                        <i class="fas fa-map-marked-alt"></i>
                    </div>
                    <div class="quick-content">
                        <strong>Destinasi</strong>
                        <span>Kelola wisata</span>
                    </div>
                </a>
            </div>

            {{-- ATRAKSI --}}
            <div class="col-xl-3 col-md-6 col-12">
                <a
                    href="{{ $atraksiUrl }}"
                    class="quick-menu-card {{ $atraksiUrl === '#' ? 'disabled' : '' }}"
                    @if($atraksiUrl === '#') onclick="return false;" @endif
                >
                    <div class="quick-icon gold">
                        <i class="fas fa-camera-retro"></i>
                    </div>
                    <div class="quick-content">
                        <strong>Atraksi</strong>
                        <span>Kelola atraksi</span>
                    </div>
                </a>
            </div>

            {{-- PENGATURAN --}}
            <div class="col-xl-3 col-md-6 col-12">
                <a
                    href="{{ $settingsUrl }}"
                    class="quick-menu-card {{ $settingsUrl === '#' ? 'disabled' : '' }}"
                    @if($settingsUrl === '#') onclick="return false;" @endif
                >
                    <div class="quick-icon gray">
                        <i class="fas fa-cog"></i>
                    </div>
                    <div class="quick-content">
                        <strong>Pengaturan</strong>
                        <span>Kelola akun admin</span>
                    </div>
                </a>
            </div>

            {{-- ULASAN --}}
            <div class="col-xl-3 col-md-6 col-12">
                <a href="#" class="quick-menu-card disabled" onclick="return false;">
                    <div class="quick-icon purple">
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="quick-content">
                        <strong>Ulasan</strong>
                        <span>Kelola komentar</span>
                    </div>
                </a>
            </div>

        </div>

    </div>


    {{-- =====================================================
         CHAT & AKTIVITAS
    ====================================================== --}}

    <div class="row g-4 mb-4">

        {{-- CHAT --}}
        <div class="col-xl-7">
            <div class="dashboard-card">

                <div class="card-heading">
                    <div>
                        <h5>
                            <i class="fas fa-comments" style="color:#0E3B36;"></i>
                            Chat & Komentar Terbaru
                        </h5>
                        <p>Interaksi terbaru dari pengunjung</p>
                    </div>
                    <div class="online-badge">
                        <span></span>
                        Online
                    </div>
                </div>

                {{-- KOMENTAR 1 --}}
                <div class="chat-item">
                    <div class="chat-avatar">AD</div>
                    <div class="chat-content">
                        <div class="chat-top">
                            <strong>Andi</strong>
                            <small>5 menit lalu</small>
                        </div>
                        <div class="chat-message">
                            Tempat wisata di Dumai sangat bagus,
                            terutama Pantai Purnama.
                        </div>
                        <div class="chat-actions">
                            <button type="button"><i class="fas fa-reply"></i> Balas</button>
                            <button type="button"><i class="fas fa-check"></i> Tandai</button>
                        </div>
                    </div>
                </div>

                {{-- KOMENTAR 2 --}}
                <div class="chat-item">
                    <div class="chat-avatar gold">RS</div>
                    <div class="chat-content">
                        <div class="chat-top">
                            <strong>Rizky Saputra</strong>
                            <small>20 menit lalu</small>
                        </div>
                        <div class="chat-message">
                            Apakah informasi jam buka destinasi
                            sudah diperbarui?
                        </div>
                        <div class="chat-actions">
                            <button type="button"><i class="fas fa-reply"></i> Balas</button>
                            <button type="button"><i class="fas fa-check"></i> Tandai</button>
                        </div>
                    </div>
                </div>

                {{-- KOMENTAR 3 --}}
                <div class="chat-item">
                    <div class="chat-avatar blue">FM</div>
                    <div class="chat-content">
                        <div class="chat-top">
                            <strong>Fauzan</strong>
                            <small>1 jam lalu</small>
                        </div>
                        <div class="chat-message">
                            Mie sagu yang ditampilkan di halaman
                            kuliner terlihat menarik.
                        </div>
                        <div class="chat-actions">
                            <button type="button"><i class="fas fa-reply"></i> Balas</button>
                            <button type="button"><i class="fas fa-check"></i> Tandai</button>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-3">
                    <a href="#" class="view-all" onclick="return false;">
                        Lihat Semua Komentar
                        <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                </div>

            </div>
        </div>

        {{-- AKTIVITAS --}}
        <div class="col-xl-5">
            <div class="dashboard-card">

                <div class="card-heading">
                    <div>
                        <h5>
                            <i class="fas fa-history" style="color:#D6A84F;"></i>
                            Aktivitas Terbaru
                        </h5>
                        <p>Aktivitas administrasi website</p>
                    </div>
                </div>

                <div class="activity-item">
                    <div class="activity-icon green">
                        <i class="fas fa-plus"></i>
                    </div>
                    <div class="activity-content">
                        <strong>Destinasi baru ditambahkan</strong>
                        <span>Pantai Puak</span>
                        <small>10 menit lalu</small>
                    </div>
                </div>

                <div class="activity-item">
                    <div class="activity-icon gold">
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="activity-content">
                        <strong>Ulasan baru diterima</strong>
                        <span>Rating 5 dari pengunjung</span>
                        <small>25 menit lalu</small>
                    </div>
                </div>

                <div class="activity-item">
                    <div class="activity-icon blue">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <div class="activity-content">
                        <strong>Pengguna baru terdaftar</strong>
                        <span>Member baru bergabung</span>
                        <small>1 jam lalu</small>
                    </div>
                </div>

                <div class="activity-item">
                    <div class="activity-icon purple">
                        <i class="fas fa-edit"></i>
                    </div>
                    <div class="activity-content">
                        <strong>Data atraksi diperbarui</strong>
                        <span>Informasi atraksi berhasil diperbarui</span>
                        <small>2 jam lalu</small>
                    </div>
                </div>

            </div>
        </div>

    </div>


    {{-- =====================================================
         GRAFIK
    ====================================================== --}}

    <div class="melayu-divider">
        <span>❖</span>
    </div>


    <div class="row g-4 mb-4">

        {{-- BAR CHART --}}
        <div class="col-xl-8">
            <div class="dashboard-card">
                <div class="card-heading">
                    <div>
                        <h5>
                            <i class="fas fa-chart-bar"></i>
                            Statistik Konten
                        </h5>
                        <p>Perbandingan data website Visit Dumai</p>
                    </div>
                    <button type="button" class="chart-menu">
                        <i class="fas fa-ellipsis-v"></i>
                    </button>
                </div>
                <div class="chart-container">
                    <canvas id="contentChart"></canvas>
                </div>
            </div>
        </div>

        {{-- DOUGHNUT --}}
        <div class="col-xl-4">
            <div class="dashboard-card">
                <div class="card-heading">
                    <div>
                        <h5>
                            <i class="fas fa-chart-pie"></i>
                            Komposisi Data
                        </h5>
                        <p>Distribusi data website</p>
                    </div>
                </div>
                <div class="chart-container">
                    <canvas id="compositionChart"></canvas>
                </div>
            </div>
        </div>

    </div>


    {{-- =====================================================
         RINGKASAN + INFORMASI
    ====================================================== --}}

    <div class="row g-4">

        {{-- LINE CHART --}}
        <div class="col-xl-7">
            <div class="dashboard-card">
                <div class="card-heading">
                    <div>
                        <h5>
                            <i class="fas fa-chart-line"></i>
                            Ringkasan Data
                        </h5>
                        <p>Statistik utama sistem Visit Dumai</p>
                    </div>
                </div>
                <div class="chart-container">
                    <canvas id="summaryChart"></canvas>
                </div>
            </div>
        </div>

        {{-- INFORMASI --}}
        <div class="col-xl-5">
            <div class="dashboard-card">
                <div class="card-heading">
                    <div>
                        <h5>
                            <i class="fas fa-info-circle"></i>
                            Ringkasan Dashboard
                        </h5>
                        <p>Informasi data website saat ini</p>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-map-marked-alt"></i>
                    </div>
                    <div>
                        <strong>{{ number_format($totalDestinasi) }} Destinasi</strong>
                        <span>Destinasi wisata telah terdaftar</span>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-camera-retro"></i>
                    </div>
                    <div>
                        <strong>{{ number_format($totalAtraksi) }} Atraksi</strong>
                        <span>Atraksi wisata tersedia</span>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div>
                        <strong>{{ number_format($totalUser) }} Pengguna</strong>
                        <span>Pengguna yang terdaftar</span>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-star"></i>
                    </div>
                    <div>
                        <strong>{{ number_format($totalUlasan) }} Ulasan</strong>
                        <span>Ulasan dari pengunjung</span>
                    </div>
                </div>

            </div>
        </div>

    </div>

</div>


{{-- =========================================================
     CHART.JS
========================================================= --}}

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

document.addEventListener('DOMContentLoaded', function () {

    const totalDestinasi = Number(@json($totalDestinasi));
    const totalAtraksi   = Number(@json($totalAtraksi));
    const totalUser      = Number(@json($totalUser));
    const totalUlasan    = Number(@json($totalUlasan));

    const labels = ['Destinasi', 'Atraksi', 'Pengguna', 'Ulasan'];
    const values = [totalDestinasi, totalAtraksi, totalUser, totalUlasan];

    /*
    |--------------------------------------------------------------------------
    | BAR CHART
    |--------------------------------------------------------------------------
    */
    const contentCanvas = document.getElementById('contentChart');

    if (contentCanvas && typeof Chart !== 'undefined') {
        new Chart(contentCanvas, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Jumlah Data',
                    data: values,
                    backgroundColor: ['#0E3B36', '#D6A84F', '#2980B9', '#7053A5'],
                    borderRadius: 10,
                    borderSkipped: false
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { precision: 0 },
                        grid: { color: 'rgba(13,59,54,.06)' }
                    },
                    x: { grid: { display: false } }
                }
            }
        });
    }

    /*
    |--------------------------------------------------------------------------
    | DOUGHNUT
    |--------------------------------------------------------------------------
    */
    const compositionCanvas = document.getElementById('compositionChart');

    if (compositionCanvas && typeof Chart !== 'undefined') {
        new Chart(compositionCanvas, {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    data: values,
                    backgroundColor: ['#0E3B36', '#D6A84F', '#2980B9', '#7053A5'],
                    borderWidth: 0,
                    hoverOffset: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: { usePointStyle: true, padding: 15, font: { size: 10 } }
                    }
                }
            }
        });
    }

    /*
    |--------------------------------------------------------------------------
    | LINE CHART
    |--------------------------------------------------------------------------
    */
    const summaryCanvas = document.getElementById('summaryChart');

    if (summaryCanvas && typeof Chart !== 'undefined') {
        new Chart(summaryCanvas, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Total Data',
                    data: values,
                    borderColor: '#0E3B36',
                    backgroundColor: 'rgba(13,59,54,.08)',
                    borderWidth: 3,
                    pointRadius: 5,
                    pointHoverRadius: 8,
                    pointBackgroundColor: '#D6A84F',
                    fill: true,
                    tension: .4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { precision: 0 },
                        grid: { color: 'rgba(13,59,54,.06)' }
                    },
                    x: { grid: { display: false } }
                }
            }
        });
    }

});

</script>

@endsection