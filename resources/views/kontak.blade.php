@extends('layouts.app')

@section('body-class', 'page-kontak')
@section('title', 'Hubungi Kami - Wisata Kota Dumai')

@section('content')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<link rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<link rel="stylesheet" href="{{ asset('css/kontak.css') }}">


<div class="contact-page">

    {{-- =====================================================
        HERO
    ====================================================== --}}
    <section class="contact-hero">

        <div class="contact-hero-decoration decoration-left"></div>
        <div class="contact-hero-decoration decoration-right"></div>

        <div class="contact-wrapper">

            <div class="contact-hero-content">

                <div class="contact-hero-icon">
                    <i class="bi bi-headset"></i>
                </div>

                <span class="contact-hero-badge">
                    <i class="bi bi-stars"></i>
                    PUSAT BANTUAN & LAYANAN
                </span>

                <h1>
                    Hubungi <span>Kami</span>
                </h1>

                <p>
                    Kami siap membantu memberikan informasi seputar
                    wisata, kuliner, budaya, dan kegiatan menarik
                    di Kota Dumai.
                </p>

                <div class="contact-hero-features">

                    <span>
                        <i class="bi bi-shield-check"></i>
                        Layanan Terpercaya
                    </span>

                    <span>
                        <i class="bi bi-clock"></i>
                        Respon Cepat
                    </span>

                    <span>
                        <i class="bi bi-heart-fill"></i>
                        Sepenuh Hati
                    </span>

                </div>

            </div>

        </div>

        <div class="contact-wave">
            <svg viewBox="0 0 1440 80"
                 preserveAspectRatio="none"
                 xmlns="http://www.w3.org/2000/svg">

                <path d="
                    M0 42
                    C220 70 420 18 650 35
                    C850 50 1060 70 1250 48
                    C1340 38 1390 35 1440 28
                    L1440 80
                    L0 80
                    Z">
                </path>

            </svg>
        </div>

    </section>


    {{-- =====================================================
        MAIN
    ====================================================== --}}
    <main class="contact-main">

        <div class="contact-wrapper">


            {{-- =================================================
                SECTION TITLE
            ================================================== --}}
            <div class="contact-section-heading">

                <span>
                    <i class="bi bi-chat-square-heart-fill"></i>
                    INFORMASI KONTAK
                </span>

                <h2>
                    Ada yang Bisa Kami Bantu?
                </h2>

                <p>
                    Hubungi kami melalui salah satu layanan berikut.
                </p>

            </div>


            {{-- =================================================
                CONTACT CARDS
            ================================================== --}}
            <div class="contact-cards">


                {{-- ALAMAT --}}
                <a href="#lokasi-kantor"
                   class="contact-card">

                    <div class="contact-card-icon location">
                        <i class="bi bi-geo-alt-fill"></i>
                    </div>

                    <div class="contact-card-content">

                        <span class="contact-card-label">
                            LOKASI
                        </span>

                        <h3>
                            Alamat Kantor
                        </h3>

                        <p>
                            Jl. HR. Soebrantas No. 12,
                            Teluk Binjai, Dumai Timur,
                            Kota Dumai, Riau.
                        </p>

                    </div>

                    <div class="contact-card-link">
                        Lihat Lokasi
                        <i class="bi bi-arrow-right"></i>
                    </div>

                </a>


                {{-- WHATSAPP --}}
                <a href="https://wa.me/6285278776696"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="contact-card">

                    <div class="contact-card-icon whatsapp">
                        <i class="bi bi-whatsapp"></i>
                    </div>

                    <div class="contact-card-content">

                        <span class="contact-card-label">
                            CHAT LANGSUNG
                        </span>

                        <h3>
                            WhatsApp
                        </h3>

                        <p class="contact-number">
                            +62 852-7877-6696
                        </p>

                        <small>
                            <i class="bi bi-clock"></i>
                            08:00 – 18:00 WIB
                        </small>

                    </div>

                    <div class="contact-card-link whatsapp-link">
                        Mulai Percakapan
                        <i class="bi bi-arrow-right"></i>
                    </div>

                </a>


                {{-- EMAIL --}}
                <a href="mailto:amdani9093@gmail.com"
                   class="contact-card">

                    <div class="contact-card-icon email">
                        <i class="bi bi-envelope-fill"></i>
                    </div>

                    <div class="contact-card-content">

                        <span class="contact-card-label">
                            SURAT ELEKTRONIK
                        </span>

                        <h3>
                            Email Resmi
                        </h3>

                        <p class="contact-number email-text">
                            amdani9093@gmail.com
                        </p>

                        <small>
                            <i class="bi bi-reply"></i>
                            Respons maksimal 1x24 jam
                        </small>

                    </div>

                    <div class="contact-card-link email-link">
                        Kirim Email
                        <i class="bi bi-arrow-right"></i>
                    </div>

                </a>

            </div>


            {{-- =================================================
                FORM + HELP
            ================================================== --}}
            <div class="contact-grid">


                {{-- FORM --}}
                <section class="contact-form-card">

                    <div class="contact-form-heading">

                        <div class="contact-form-icon">
                            <i class="bi bi-envelope-paper-fill"></i>
                        </div>

                        <div>

                            <span>
                                FORMULIR KONTAK
                            </span>

                            <h2>
                                Kirim Pesan
                            </h2>

                            <p>
                                Sampaikan pertanyaan, kritik,
                                saran, atau informasi kepada kami.
                            </p>

                        </div>

                    </div>


                    {{-- SUCCESS --}}
                    @if(session('success'))

                        <div class="contact-alert success">

                            <i class="bi bi-check-circle-fill"></i>

                            <div>
                                <strong>Pesan berhasil dikirim</strong>
                                <p>{{ session('success') }}</p>
                            </div>

                        </div>

                    @endif


                    {{-- ERROR --}}
                    @if($errors->any())

                        <div class="contact-alert error">

                            <i class="bi bi-exclamation-circle-fill"></i>

                            <div>

                                <strong>
                                    Periksa kembali formulir
                                </strong>

                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>

                            </div>

                        </div>

                    @endif


                    @if(Route::has('kontak.send'))

                        <form action="{{ route('kontak.send') }}"
                              method="POST">

                            @csrf

                            <div class="contact-form-row">


                                {{-- NAMA --}}
                                <div class="contact-field">

                                    <label for="nama">
                                        <i class="bi bi-person-fill"></i>
                                        Nama Lengkap
                                    </label>

                                    <div class="contact-input">

                                        <i class="bi bi-person"></i>

                                        <input
                                            type="text"
                                            id="nama"
                                            name="nama"
                                            value="{{ old('nama') }}"
                                            placeholder="Masukkan nama Anda"
                                            required
                                        >

                                    </div>

                                </div>


                                {{-- EMAIL --}}
                                <div class="contact-field">

                                    <label for="email">
                                        <i class="bi bi-envelope-fill"></i>
                                        Email
                                    </label>

                                    <div class="contact-input">

                                        <i class="bi bi-envelope"></i>

                                        <input
                                            type="email"
                                            id="email"
                                            name="email"
                                            value="{{ old('email') }}"
                                            placeholder="nama@email.com"
                                            required
                                        >

                                    </div>

                                </div>


                                {{-- KATEGORI --}}
                                <div class="contact-field full">

                                    <label for="kategori">
                                        <i class="bi bi-tags-fill"></i>
                                        Kategori Pertanyaan
                                    </label>

                                    <div class="contact-input">

                                        <i class="bi bi-list-check"></i>

                                        <select
                                            id="kategori"
                                            name="kategori"
                                            required
                                        >

                                            <option value="">
                                                Pilih kategori...
                                            </option>

                                            <option value="Informasi Wisata"
                                                {{ old('kategori') == 'Informasi Wisata' ? 'selected' : '' }}>
                                                Informasi Tempat Wisata
                                            </option>

                                            <option value="Agenda Festival"
                                                {{ old('kategori') == 'Agenda Festival' ? 'selected' : '' }}>
                                                Agenda Festival / Acara
                                            </option>

                                            <option value="Kemitraan & Kerjasama"
                                                {{ old('kategori') == 'Kemitraan & Kerjasama' ? 'selected' : '' }}>
                                                Kemitraan & Kerjasama
                                            </option>

                                            <option value="Kritik & Saran"
                                                {{ old('kategori') == 'Kritik & Saran' ? 'selected' : '' }}>
                                                Kritik & Saran
                                            </option>

                                        </select>

                                        <i class="bi bi-chevron-down select-icon"></i>

                                    </div>

                                </div>


                                {{-- PESAN --}}
                                <div class="contact-field full">

                                    <label for="pesan">
                                        <i class="bi bi-chat-left-text-fill"></i>
                                        Pesan
                                    </label>

                                    <div class="contact-textarea">

                                        <i class="bi bi-chat-left-dots"></i>

                                        <textarea
                                            id="pesan"
                                            name="pesan"
                                            rows="5"
                                            maxlength="2000"
                                            placeholder="Tuliskan pertanyaan atau pesan Anda..."
                                            required
                                        >{{ old('pesan') }}</textarea>

                                    </div>

                                </div>


                                {{-- BUTTON --}}
                                <div class="contact-submit full">

                                    <button type="submit">

                                        <span>
                                            <i class="bi bi-send-fill"></i>
                                        </span>

                                        Kirim Pesan

                                        <i class="bi bi-arrow-right"></i>

                                    </button>

                                </div>

                            </div>

                        </form>

                    @else

                        <div class="contact-alert warning">

                            <i class="bi bi-exclamation-triangle-fill"></i>

                            <div>

                                <strong>
                                    Form belum aktif
                                </strong>

                                <p>
                                    Route <code>kontak.send</code>
                                    belum tersedia.
                                </p>

                            </div>

                        </div>

                    @endif


                    <div class="contact-security">

                        <i class="bi bi-shield-check"></i>

                        Informasi yang Anda kirim digunakan
                        hanya untuk pelayanan dan komunikasi.

                    </div>

                </section>


                {{-- =================================================
                    HELP CARD
                ================================================== --}}
                <aside class="contact-help-card">

                    <div class="help-icon">
                        <i class="bi bi-chat-heart-fill"></i>
                    </div>

                    <span class="help-label">
                        VISIT DUMAI
                    </span>

                    <h2>
                        Kami Siap
                        <span>Membantu Anda</span>
                    </h2>

                    <p>
                        Bingung memilih destinasi?
                        Ingin mengetahui agenda wisata?
                        Silakan hubungi kami.
                    </p>


                    <div class="help-list">

                        <div>
                            <i class="bi bi-check-lg"></i>
                            Informasi destinasi wisata
                        </div>

                        <div>
                            <i class="bi bi-check-lg"></i>
                            Informasi kuliner khas Dumai
                        </div>

                        <div>
                            <i class="bi bi-check-lg"></i>
                            Agenda dan festival
                        </div>

                        <div>
                            <i class="bi bi-check-lg"></i>
                            Kritik dan saran
                        </div>

                    </div>


                    <a href="https://wa.me/6285278776696"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="help-whatsapp">

                        <i class="bi bi-whatsapp"></i>

                        <span>
                            <small>Hubungi kami melalui</small>
                            WhatsApp
                        </span>

                        <i class="bi bi-arrow-up-right"></i>

                    </a>

                </aside>

            </div>


            {{-- =================================================
                LOCATION
            ================================================== --}}
            <section id="lokasi-kantor"
                     class="location-card">

                <div class="location-icon">
                    <i class="bi bi-geo-alt-fill"></i>
                </div>

                <div class="location-content">

                    <span>
                        <i class="bi bi-pin-map-fill"></i>
                        LOKASI KANTOR
                    </span>

                    <h2>
                        Kunjungi Kami
                    </h2>

                    <p>
                        Jl. HR. Soebrantas No. 12,
                        Teluk Binjai, Kec. Dumai Timur,
                        Kota Dumai, Riau 28815
                    </p>

                </div>

                <a href="https://www.google.com/maps/search/?api=1&query=Jl.+HR.+Soebrantas+No.+12,+Dumai"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="location-button">

                    <i class="bi bi-map-fill"></i>
                    Buka Maps
                    <i class="bi bi-arrow-up-right"></i>

                </a>

            </section>


        </div>

    </main>

</div>

@endsection