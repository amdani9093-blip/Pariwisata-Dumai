@extends('layouts.app')

@section('title', 'Tentang Kota Dumai - Sejarah, Budaya, Agama & Wisata')

@section('content')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;800&family=Nunito+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>
    :root {
        --ocean-deep:   #052E3E;
        --ocean:       #0B4F6C;
        --sea-teal:     #148B9C;
        --sand-gold:   #E3A23B;
        --sand-gold-d: #C9860F;
        --foam:         #F3F9FA;
        --ink:         #12313C;
        --ink-soft:     #5C7681;
        --font-display: 'Poppins', sans-serif;
        --font-body: 'Nunito Sans', sans-serif;
    }

    body { font-family: var(--font-body); color: var(--ink); background-color: #fafcfd; }

    /* ================= HERO SECTION ================= */
    .hero-page {
        position: relative;
        min-height: 80vh;
        display: flex;
        align-items: center;
        color: #fff;
        overflow: hidden;
        background-image:
            linear-gradient(180deg, rgba(255, 251, 0, 0.85) 0%, rgba(0, 179, 255, 0.7) 50%, rgba(5,46,62,.95) 100%),
            url('{{ asset('images/2384ab08-a6b2-42fe-9217-dbcc34b17694.png') }}');">
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
    }

    @supports (-webkit-touch-callout: none) {
        .hero-page { background-attachment: scroll; }
    }

    .hero-page .container { position: relative; z-index: 2; text-align: center; }

    .hero-page .eyebrow {
        display: inline-block;
        font-family: var(--font-body);
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        font-size: .8rem;
        color: var(--sand-gold);
        background: rgba(255,255,255,.1);
        border: 1px solid rgba(255,255,255,.25);
        padding: 6px 20px;
        border-radius: 30px;
        margin-bottom: 20px;
        backdrop-filter: blur(4px);
        opacity: 0;
        animation: heroFadeUp .8s ease .1s forwards;
    }

    .hero-page h1 {
        font-family: var(--font-display);
        font-weight: 800;
        font-size: clamp(2.2rem, 5vw, 3.8rem);
        letter-spacing: .5px;
        text-shadow: 0 4px 20px rgba(0,0,0,.3);
        opacity: 0;
        animation: heroFadeUp .8s ease .28s forwards;
    }

    .hero-page p {
        max-width: 680px;
        margin: 18px auto 0;
        font-size: 1.1rem;
        line-height: 1.75;
        opacity: 0;
        animation: heroFadeUp .8s ease .46s forwards;
    }

    @keyframes heroFadeUp {
        from { opacity: 0; transform: translateY(18px); }
        to   { opacity: .97; transform: translateY(0); }
    }
    .hero-page h1.is-animated,
    .hero-page p.is-animated { opacity: .97; }

    .wave-divider {
        position: absolute;
        left: 0; right: 0; bottom: -1px;
        line-height: 0;
        z-index: 2;
    }
    .wave-divider svg { width: 100%; height: 60px; display: block; fill: #fafcfd; }

    .scroll-cue {
        position: absolute;
        left: 50%; bottom: 78px;
        transform: translateX(-50%);
        z-index: 3;
        color: #fff;
        opacity: .8;
        font-size: 1.3rem;
        text-decoration: none;
        animation: cueBounce 2.2s ease-in-out infinite;
    }
    .scroll-cue:hover { color: var(--sand-gold); opacity: 1; }
    @keyframes cueBounce {
        0%, 100% { transform: translate(-50%, 0); }
        50%      { transform: translate(-50%, 8px); }
    }

    /* ================= QUICK NAV ================= */
    .quicknav-wrap {
        position: sticky;
        top: 0;
        z-index: 40;
        background: rgba(250,252,253,.92);
        backdrop-filter: blur(8px);
        border-bottom: 1px solid #e7eef1;
        box-shadow: 0 4px 18px rgba(5,46,62,.05);
    }
    .quicknav {
        display: flex;
        gap: 10px;
        overflow-x: auto;
        padding: 14px 4px;
        scrollbar-width: thin;
    }
    .quicknav::-webkit-scrollbar { height: 4px; }
    .quicknav::-webkit-scrollbar-thumb { background: #d7e3e7; border-radius: 4px; }
    .quicknav a {
        flex: 0 0 auto;
        display: inline-flex;
        align-items: center;
        gap: 7px;
        font-family: var(--font-body);
        font-weight: 700;
        font-size: .85rem;
        color: var(--ocean);
        background: #fff;
        border: 1px solid #dfe9ec;
        padding: 8px 18px;
        border-radius: 30px;
        text-decoration: none;
        transition: all .2s ease;
    }
    .quicknav a i { font-size: .78rem; color: var(--sea-teal); }
    .quicknav a:hover { border-color: var(--sea-teal); color: var(--ocean-deep); }
    .quicknav a.is-active {
        background: linear-gradient(135deg, var(--ocean-deep), var(--sea-teal));
        border-color: transparent;
        color: #fff;
    }
    .quicknav a.is-active i { color: var(--sand-gold); }

    /* ================= SECTION TITLE ================= */
    .section-title { margin-bottom: 25px; }
    .section-title .eyebrow-line {
        display: flex;
        align-items: center;
        gap: 10px;
        color: var(--sea-teal);
        font-weight: 700;
        font-size: .85rem;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        margin-bottom: 8px;
    }
    .section-title .eyebrow-line::before {
        content: "";
        width: 30px; height: 3px;
        background: var(--sand-gold);
        border-radius: 2px;
        display: inline-block;
    }
    .section-title h2 {
        font-family: var(--font-display);
        font-weight: 700;
        color: var(--ocean-deep);
        font-size: 2.1rem;
        margin-bottom: 8px;
    }
    .section-title.text-center .eyebrow-line { justify-content: center; }
    .section-title.text-center .eyebrow-line::before { display: none; }

    /* ================= CARDS & IMAGES ================= */
    .content-card {
        background: #fff;
        border-radius: 18px;
        padding: 35px;
        border: 1px solid #eef4f6;
        box-shadow: 0 10px 30px rgba(5,46,62,.04);
        height: 100%;
    }
    .content-card p { color: var(--ink-soft); line-height: 1.85; font-size: 1.02rem; }
    .content-card strong { color: var(--ocean-deep); }

    .img-wrapper {
        position: relative;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 15px 35px rgba(5,46,62,.12);
        height: 100%;
        min-height: 280px;
    }
    .img-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform .5s ease;
    }
    .img-wrapper:hover img {
        transform: scale(1.04);
    }
    .img-caption {
        position: absolute;
        bottom: 0; left: 0; right: 0;
        padding: 20px;
        background: linear-gradient(0deg, rgba(5,46,62,.9) 0%, transparent 100%);
        color: #fff;
        font-size: .88rem;
    }

    /* ================= KULINER CHECKLIST ================= */
    .kuliner-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 8px 0;
        color: var(--ink-soft);
        font-size: .95rem;
    }
    .kuliner-item i { color: var(--sea-teal); font-size: 1rem; flex-shrink: 0; }
    .kuliner-item strong { color: var(--ink); }

    /* ================= FEATURE CARDS ================= */
    .feature-box {
        background: #fff;
        border-radius: 18px;
        padding: 30px 22px;
        text-align: center;
        height: 100%;
        box-shadow: 0 6px 20px rgba(5,46,62,.05);
        transition: transform .3s ease, box-shadow .3s ease;
        border: 1px solid #eef2f4;
    }
    .feature-box:hover {
        transform: translateY(-6px);
        box-shadow: 0 18px 32px rgba(5,46,62,.1);
    }
    .icon-circle {
        width: 62px; height: 62px;
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 16px;
        font-size: 1.4rem;
        color: #fff;
    }
    .icon-circle.bg-teal   { background: linear-gradient(135deg,var(--sea-teal),var(--ocean)); }
    .icon-circle.bg-green  { background: linear-gradient(135deg,#2FA36B,#1F7A4D); }
    .icon-circle.bg-orange { background: linear-gradient(135deg,var(--sand-gold),var(--sand-gold-d)); }
    .icon-circle.bg-blue   { background: linear-gradient(135deg,var(--ocean),var(--ocean-deep)); }

    .feature-box h4 { font-family: var(--font-display); font-weight: 600; font-size: 1.1rem; margin-bottom: 8px; color: var(--ink); }
    .feature-box p { color: var(--ink-soft); font-size: .93rem; margin-bottom: 0; line-height: 1.6; }

    /* ================= STATISTIK / MANIFES DERMAGA ================= */
    .manifest-panel {
        position: relative;
        background: linear-gradient(120deg, var(--ocean-deep) 0%, var(--ocean) 55%, var(--sea-teal) 100%);
        border-radius: 22px;
        padding: 46px 30px;
        color: #fff;
        overflow: hidden;
        box-shadow: 0 20px 45px rgba(5,46,62,.18);
    }
    .manifest-panel::before {
        content: "";
        position: absolute;
        inset: 0;
        background-image: repeating-linear-gradient(45deg, rgba(255,255,255,.035) 0 2px, transparent 2px 14px);
        pointer-events: none;
    }
    .manifest-head {
        display: flex;
        align-items: center;
        gap: 12px;
        justify-content: center;
        margin-bottom: 34px;
        position: relative;
        z-index: 1;
    }
    .manifest-head i { color: var(--sand-gold); font-size: 1.2rem; }
    .manifest-head span {
        font-family: var(--font-body);
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        font-size: .8rem;
        color: rgba(255,255,255,.85);
    }
    .manifest-grid {
        position: relative;
        z-index: 1;
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 10px;
    }
    .manifest-item { text-align: center; padding: 6px 10px; border-left: 1px dashed rgba(255,255,255,.22); }
    .manifest-item:first-child { border-left: none; }
    .manifest-num {
        font-family: var(--font-display);
        font-weight: 800;
        font-size: clamp(1.5rem, 3vw, 2.3rem);
        color: var(--sand-gold);
        line-height: 1;
    }
    .manifest-label {
        display: block;
        margin-top: 8px;
        font-size: .8rem;
        color: rgba(255,255,255,.85);
        line-height: 1.4;
    }
    .manifest-foot {
        position: relative;
        z-index: 1;
        text-align: center;
        margin-top: 28px;
        font-size: .78rem;
        color: rgba(255,255,255,.55);
    }
    @media (max-width: 767px) {
        .manifest-grid { grid-template-columns: repeat(2, 1fr); row-gap: 26px; }
        .manifest-item:nth-child(3) { border-left: none; }
    }

    /* ================= GALERI ================= */
    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        grid-auto-rows: 160px;
        gap: 14px;
    }
    .gallery-item {
        position: relative;
        grid-column: span 1;
        grid-row: span 1;
        border-radius: 16px;
        overflow: hidden;
        display: block;
        box-shadow: 0 8px 20px rgba(5,46,62,.08);
    }
    .gallery-item.is-wide { grid-column: span 2; grid-row: span 2; }
    .gallery-item img {
        width: 100%; height: 100%;
        object-fit: cover;
        transition: transform .5s ease;
    }
    .gallery-item:hover img { transform: scale(1.08); }
    .gallery-item .gal-tag {
        position: absolute;
        left: 0; right: 0; bottom: 0;
        padding: 12px 14px;
        background: linear-gradient(0deg, rgba(5,46,62,.88) 0%, transparent 100%);
        color: #fff;
        font-size: .8rem;
        font-weight: 600;
        opacity: 0;
        transform: translateY(6px);
        transition: all .3s ease;
    }
    .gallery-item:hover .gal-tag { opacity: 1; transform: translateY(0); }
    @media (max-width: 767px) {
        .gallery-grid { grid-template-columns: repeat(2, 1fr); grid-auto-rows: 140px; }
        .gallery-item.is-wide { grid-column: span 2; grid-row: span 1; }
    }

    /* ================= DESTINASI CARDS WITH IMAGES ================= */
    .destination-card {
        background: #fff;
        border-radius: 18px;
        overflow: hidden;
        border: 1px solid #eef4f6;
        box-shadow: 0 8px 25px rgba(5,46,62,.06);
        height: 100%;
        transition: transform .3s ease;
    }
    .destination-card:hover { transform: translateY(-5px); }
    .destination-card .img-box { height: 200px; width: 100%; overflow: hidden; }
    .destination-card .img-box img { width: 100%; height: 100%; object-fit: cover; }
    .destination-card .body-box { padding: 22px; }
    .destination-card h4 { font-family: var(--font-display); font-weight: 700; color: var(--ocean-deep); font-size: 1.15rem; }
    .destination-card p { color: var(--ink-soft); font-size: .92rem; line-height: 1.6; margin-bottom: 0; }

    /* ================= TESTIMONI ================= */
    .testi-card {
        position: relative;
        background: #fff;
        border-radius: 18px;
        padding: 30px 26px 26px;
        border: 1px solid #eef4f6;
        box-shadow: 0 10px 26px rgba(5,46,62,.05);
        height: 100%;
    }
    .testi-quote { color: var(--sand-gold); font-size: 1.4rem; margin-bottom: 10px; display: block; }
    .testi-card p.testi-text { color: var(--ink-soft); font-size: .96rem; line-height: 1.75; font-style: italic; }
    .testi-who { display: flex; align-items: center; gap: 12px; margin-top: 18px; }
    .testi-avatar {
        width: 42px; height: 42px; border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        background: linear-gradient(135deg, var(--sea-teal), var(--ocean));
        color: #fff; font-family: var(--font-display); font-weight: 700; font-size: .95rem;
        flex-shrink: 0;
    }
    .testi-who strong { display: block; color: var(--ink); font-size: .92rem; }
    .testi-who span { display: block; color: var(--ink-soft); font-size: .8rem; }
    .testi-stamp {
        position: absolute;
        top: 22px; right: 22px;
        color: #e7eef1;
        font-size: 1.6rem;
        transform: rotate(8deg);
    }

    /* ================= CTA ================= */
    .cta-box {
        background: linear-gradient(135deg, var(--ocean-deep), var(--sea-teal));
        border-radius: 22px;
        padding: 60px 30px;
        color: #fff;
        box-shadow: 0 15px 35px rgba(5,46,62,.2);
    }
    .cta-box h2 { font-family: var(--font-display); font-weight: 700; }
    .cta-box p { max-width: 650px; margin: 15px auto 28px; opacity: .92; }
    .cta-box .btn-cta {
        background: var(--sand-gold);
        color: var(--ocean-deep);
        font-weight: 700;
        border: none;
        padding: 12px 34px;
        border-radius: 30px;
        transition: all .2s ease;
    }
    .cta-box .btn-cta:hover { background: #ffb84d; transform: translateY(-2px); }

    /* ================= BACK TO TOP ================= */
    .back-to-top {
        position: fixed;
        right: 22px; bottom: 22px;
        width: 46px; height: 46px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--ocean-deep), var(--sea-teal));
        color: #fff;
        display: flex; align-items: center; justify-content: center;
        box-shadow: 0 10px 24px rgba(5,46,62,.3);
        text-decoration: none;
        font-size: 1rem;
        z-index: 60;
        opacity: 0;
        visibility: hidden;
        transform: translateY(10px);
        transition: all .3s ease;
    }
    .back-to-top.is-visible { opacity: 1; visibility: visible; transform: translateY(0); }
    .back-to-top:hover { background: linear-gradient(135deg, var(--sea-teal), var(--ocean-deep)); }

    /* ================= SCROLL REVEAL ================= */
    .reveal { opacity: 0; transform: translateY(26px); transition: opacity .7s ease, transform .7s ease; }
    .reveal.is-visible { opacity: 1; transform: translateY(0); }
    .reveal-delay-1 { transition-delay: .1s; }
    .reveal-delay-2 { transition-delay: .2s; }

    a:focus-visible, button:focus-visible {
        outline: 2px solid var(--sand-gold);
        outline-offset: 3px;
    }

    @media (prefers-reduced-motion: reduce) {
        .hero-page .eyebrow, .hero-page h1, .hero-page p { animation: none !important; opacity: .97 !important; }
        .scroll-cue { animation: none !important; }
        .reveal { opacity: 1 !important; transform: none !important; transition: none !important; }
        .img-wrapper img, .gallery-item img { transition: none !important; }
    }

    @media (max-width: 767px) {
        .hero-page { min-height: 65vh; }
        .content-card { padding: 25px; }
    }
</style>

<!-- ================= HERO SECTION ================= -->
<section class="hero-page" id="hero">
    <div class="container">
        <span class="eyebrow">Kota Pelabuhan &amp; Mutiara Pesisir Riau</span>
        <h1>Mengenal Kota Dumai</h1>
        <p>
            Eksplorasi warisan sejarah, kehangatan budaya Melayu, harmonisasi keberagaman suku dan agama, serta pesona destinasi pesisir di tepi Selat Malaka.
        </p>
    </div>
    <a href="#sejarah" class="scroll-cue" aria-label="Gulir ke bawah untuk membaca selengkapnya">
        <i class="fas fa-chevron-down"></i>
    </a>
    <div class="wave-divider">
        <svg viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V120H0V0C49.07,1.21,99.28,11.14,147,26.2,210.76,46.23,264.08,64.44,321.39,56.44Z"></path>
        </svg>
    </div>
</section>

<!-- ================= QUICK NAV ================= -->
<div class="quicknav-wrap">
    <div class="container">
        <nav class="quicknav" id="quicknav" aria-label="Navigasi cepat halaman">
            <a href="#sejarah" data-target="sejarah"><i class="fas fa-scroll"></i> Sejarah</a>
            <a href="#statistik" data-target="statistik"><i class="fas fa-anchor"></i> Dumai dalam Angka</a>
            <a href="#budaya" data-target="budaya"><i class="fas fa-drum"></i> Budaya</a>
            <a href="#masyarakat" data-target="masyarakat"><i class="fas fa-users"></i> Masyarakat</a>
            <a href="#kuliner" data-target="kuliner"><i class="fas fa-utensils"></i> Kuliner</a>
            <a href="#galeri" data-target="galeri"><i class="fas fa-images"></i> Galeri</a>
            <a href="#festival" data-target="festival"><i class="fas fa-calendar-check"></i> Festival</a>
        </nav>
    </div>
</div>

<!-- ================= 1. SEJARAH KOTA DUMAI ================= -->
<section class="container mt-5 pt-3" id="sejarah">
    <div class="row g-4 align-items-center">
        <div class="col-lg-6 reveal">
            <div class="content-card">
                <div class="section-title">
                    <div class="eyebrow-line">Napak Tilas</div>
                    <h2>Sejarah Kota Dumai</h2>
                </div>
                <p>
                    Nama <strong>Dumai</strong> diyakini berasal dari cerita rakyat legenda <em>Putri Tujuh</em>, terkait kata <em>"Duma"</em> (dusun nelayan yang damai). Awalnya, Dumai merupakan sebuah dusun nelayan kecil di pesisir timur Pulau Sumatera di bawah naungan Kerajaan Siak Sri Indrapura.
                </p>
                <p>
                    Perkembangan pesat Dumai dimulai pada era 1950-an ketika wilayah ini dijadikan terminal ekspor minyak bumi oleh perusahaan minyak internasional, berkat perairan lautnya yang dalam alami.
                </p>
                <p>
                    Secara administratif, Dumai berkembang dari status Kecamatan (1959), Kota Administratif (1979), hingga akhirnya resmi berdiri mandiri sebagai <strong>Kota Otonom pada 20 April 1999</strong> berdasarkan UU No. 16 Tahun 1999. Kini Dumai dikenal sebagai kota kilang dan pelabuhan ekspor terkemuka di Indonesia.
                </p>
            </div>
        </div>
        <div class="col-lg-6 reveal reveal-delay-1">
            <div class="img-wrapper">
                <img src="{{ asset('images/Kota Dumai Gambar.jpg') }}" alt="Kota Dumai" loading="lazy">
                <div class="img-caption">
                    <strong>Kota Dumai:</strong> Merupakan kota dengan status kotamadya terluas kedua di Indonesia setelah Palangka Raya.
                    Berawal dari dusun nelayan kecil yang berkembang pesat berkat sektor minyak, pelabuhan, dan perdagangan bebas.
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ================= 2. DUMAI DALAM ANGKA (MANIFES) ================= -->
<section class="container mt-5" id="statistik">
    <div class="manifest-panel reveal">
        <div class="manifest-head">
            <i class="fas fa-anchor"></i>
            <span>Manifes Singkat Kota Dumai</span>
        </div>
        <div class="manifest-grid">
            <div class="manifest-item">
                <span class="manifest-num" data-count="1999" data-suffix="">0</span>
                <span class="manifest-label">Berdiri Sebagai<br>Kota Otonom</span>
            </div>
            <div class="manifest-item">
                <span class="manifest-num" data-count="1727" data-suffix=" km²">0</span>
                <span class="manifest-label">Luas Wilayah<br>Daratan</span>
            </div>
            <div class="manifest-item">
                <span class="manifest-num" data-count="7" data-suffix="">0</span>
                <span class="manifest-label">Kecamatan di<br>Kota Dumai</span>
            </div>
            <div class="manifest-item">
                <span class="manifest-num" data-count="300" data-suffix="rb+">0</span>
                <span class="manifest-label">Jiwa Penduduk<br>yang Hidup Rukun</span>
            </div>
            <div class="manifest-item">
                <span class="manifest-num" data-count="6" data-suffix="+">0</span>
                <span class="manifest-label">Suku Besar<br>Berdampingan</span>
            </div>
        </div>
        <p class="manifest-foot">*Angka diolah dari data BPS &amp; Pemerintah Kota Dumai, dibulatkan untuk kemudahan pembacaan.</p>
    </div>
</section>

<!-- ================= 3. SEJARAH BUDAYA & TRADISI MELAYU ================= -->
<section class="container mt-5" id="budaya">
    <div class="row g-4 align-items-center flex-row-reverse">
        <div class="col-lg-6 reveal">
            <div class="content-card">
                <div class="section-title">
                    <div class="eyebrow-line">Kearifan Lokal</div>
                    <h2>Sejarah Budaya Melayu</h2>
                </div>
                <p>
                    Kebudayaan Dumai berakar kuat dari <strong>Suku Melayu Pesisir</strong>. Identitas budaya Melayu terikat erat dengan adat istiadat yang memegang teguh filsafat <em>"Adat Bersendi Syarak, Syarak Bersendi Kitabullah"</em>.
                </p>
                <p>
                    Seni tutur seperti <strong>Pantun Melayu</strong> dan syair menjadi bagian penting dari interaksi sosial. Seni pertunjukan seperti <em>Tari Zapin</em>, <em>Tari Persembahan (Makan Sirih)</em>, serta musik dengan instrumen gambus dan gambang terus diwariskan turun-temurun.
                </p>
                <p>
                    Arsitektur tradisional Melayu dengan ukiran khas seperti <em>Selembayung</em> pada bumbung bangunan menjadi simbol kejujuran, kerendahan hati, dan ketauhidan masyarakat lokal.
                </p>
            </div>
        </div>
        <div class="col-lg-6 reveal reveal-delay-1">
            <div class="img-wrapper">
                <img src="{{ asset('images/budaya.jpg') }}" alt="Budaya Melayu Dumai" loading="lazy">
                <div class="img-caption">
                    <strong>Seni &amp; Tradisi:</strong> Seni Zapin dan pakaian adat Teluk Belanga / Kain Songket menjadi identitas kebudayaan Melayu Dumai.
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ================= 4. SUKU & AGAMA (HETEROGENITAS) ================= -->
<section class="container mt-5" id="masyarakat">
    <div class="section-title text-center reveal">
        <div class="eyebrow-line">Demografi &amp; Harmoni</div>
        <h2>Suku dan Keagamaan</h2>
        <p>Dumai adalah cerminan "Miniatur Indonesia" di pesisir Riau yang hidup rukun dan damai.</p>
    </div>

    <div class="row g-4 mt-1">
        <div class="col-md-6 reveal">
            <div class="content-card">
                <h4><i class="fas fa-users text-primary me-2"></i> Keberagaman Suku</h4>
                <p>
                    Sebagai kota industri dan pelabuhan, Dumai menarik banyak pendatang. Suku <strong>Melayu</strong> bertindak sebagai suku asli dan tuan rumah kultural.
                </p>
                <p>
                    Masyarakat dari suku <strong>Jawa, Minangkabau, Batak, Tionghoa, Bugis, dan Sunda</strong> hidup berdampingan secara harmonis. Akulturasi ini memperkaya tradisi, seni, hingga keanekaragaman kuliner di Dumai.
                </p>
            </div>
        </div>
        <div class="col-md-6 reveal reveal-delay-1">
            <div class="content-card">
                <h4><i class="fas fa-place-of-worship text-success me-2"></i> Keharmonisan Agama</h4>
                <p>
                    Mayoritas penduduk Kota Dumai memeluk agama <strong>Islam</strong>, yang mewarnai hampir seluruh aspek budaya Melayu setempat.
                </p>
                <p>
                    Sikap toleransi yang tinggi terlihat dari berdirinya rumah ibadah berbagai agama. Agama <strong>Kristen, Katolik, Buddha, dan Hindu</strong> berkembang dengan aman, menjadikan Dumai kota yang sangat kondusif dan ramah bagi siapa saja.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- ================= 5. WISATA KULINER MELAYU ================= -->
<section class="container mt-5" id="kuliner">
    <div class="content-card reveal">
        <div class="row align-items-center g-4">
            <div class="col-lg-7">
                <div class="section-title">
                    <div class="eyebrow-line">Cita Rasa Pesisir</div>
                    <h2>Kuliner Khas Dumai</h2>
                </div>
                <p>Kekayaan olahan laut dan pengaruh bumbu khas Melayu menjadikan hidangan Dumai sangat diminati para wisatawan.</p>

                <div class="row g-2 mt-2">
                    <div class="col-6">
                        <div class="kuliner-item"><i class="fas fa-check-circle"></i> <strong>Gulai Ikan Patin / Senangin</strong></div>
                    </div>
                    <div class="col-6">
                        <div class="kuliner-item"><i class="fas fa-check-circle"></i> <strong>Lakse Melayu</strong></div>
                    </div>
                    <div class="col-6">
                        <div class="kuliner-item"><i class="fas fa-check-circle"></i> <strong>Asam Pedas Fish Seafood</strong></div>
                    </div>
                    <div class="col-6">
                        <div class="kuliner-item"><i class="fas fa-check-circle"></i> <strong>Mie Sagu Khas Riau</strong></div>
                    </div>
                    <div class="col-6">
                        <div class="kuliner-item"><i class="fas fa-check-circle"></i> <strong>Kerupuk Cabai Dumai</strong></div>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="img-wrapper" style="min-height: 220px;">
                    <img src="{{ asset('images/kuliner.jpg') }}" alt="Kuliner Khas Dumai" loading="lazy">
                    <div class="img-caption">
                        Segarnya hidangan laut berpadu dengan rempah autentik Melayu.
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ================= 6. GALERI MOMEN DUMAI ================= -->
<section class="container mt-5" id="galeri">
    <div class="section-title text-center reveal">
        <div class="eyebrow-line">Sekilas Pandang</div>
        <h2>Galeri Momen Dumai</h2>
        <p>Sekilas suasana kota, budaya, dan cita rasa yang menanti untuk dijelajahi.</p>
    </div>

    <div class="gallery-grid reveal">
        <a href="{{ asset('images/Kota Dumai Gambar.jpg') }}" target="_blank" rel="noopener" class="gallery-item is-wide">
            <img src="{{ asset('images/Kota Dumai Gambar.jpg') }}" alt="Suasana Kota Dumai" loading="lazy">
            <span class="gal-tag">Wajah Kota Dumai</span>
        </a>
        <a href="{{ asset('images/budaya.jpg') }}" target="_blank" rel="noopener" class="gallery-item">
            <img src="{{ asset('images/budaya.jpg') }}" alt="Budaya Melayu" loading="lazy">
            <span class="gal-tag">Tari Zapin</span>
        </a>
        <a href="{{ asset('images/kuliner.jpg') }}" target="_blank" rel="noopener" class="gallery-item">
            <img src="{{ asset('images/kuliner.jpg') }}" alt="Kuliner Dumai" loading="lazy">
            <span class="gal-tag">Cita Rasa Pesisir</span>
        </a>
        <a href="{{ asset('images/Pelabuhan Dumai.jpg') }}" target="_blank" rel="noopener" class="gallery-item">
            <img src="{{ asset('images/Pelabuhan Dumai.jpg') }}" alt="Pelabuhan Dumai" loading="lazy">
            <span class="gal-tag">Pelabuhan Dumai</span>
        </a>
        <a href="{{ asset('images/Pantai Dumai.jpg') }}" target="_blank" rel="noopener" class="gallery-item">
            <img src="{{ asset('images/Pantai Dumai.jpg') }}" alt="Pantai Dumai" loading="lazy">
            <span class="gal-tag">Pesona Pesisir</span>
        </a>
    </div>
</section>

<!-- ================= 7. EVENT & FESTIVAL TAHUNAN ================= -->
<section class="container mt-5" id="festival">
    <div class="section-title text-center reveal">
        <div class="eyebrow-line">Atraksi</div>
        <h2>Festival &amp; Agenda Tahunan</h2>
    </div>

    <div class="row g-4 mt-1">
        <div class="col-md-4 reveal">
            <div class="feature-box">
                <div class="icon-circle bg-orange"><i class="fas fa-drum"></i></div>
                <h4>Festival Budaya Melayu</h4>
                <p>Pertunjukan musik Melayu, lomba pantun, dan pentas tarian Zapin antar sanggar seni.</p>
            </div>
        </div>
        <div class="col-md-4 reveal reveal-delay-1">
            <div class="feature-box">
                <div class="icon-circle bg-teal"><i class="fas fa-umbrella-beach"></i></div>
                <h4>Festival Pantai Pesisir</h4>
                <p>Perlombaan olahraga air, hiburan masyarakat, dan bazar produk kerajinan UMKM lokal.</p>
            </div>
        </div>
        <div class="col-md-4 reveal reveal-delay-2">
            <div class="feature-box">
                <div class="icon-circle bg-blue"><i class="fas fa-calendar-check"></i></div>
                <h4>HUT Kota Dumai (April)</h4>
                <p>Pawai budaya multietnis, pameran pembangunan industri, dan pesta rakyat tahunan.</p>
            </div>
        </div>
    </div>
</section>

<!-- ================= 8. KATA PENGUNJUNG ================= -->
<section class="container mt-5" id="testimoni">
    <div class="section-title text-center reveal">
        <div class="eyebrow-line">Cerita Mereka</div>
        <h2>Kata Para Pengunjung</h2>
    </div>

    <div class="row g-4 mt-1">
        <div class="col-md-4 reveal">
            <div class="testi-card">
                <i class="fas fa-quote-right testi-stamp"></i>
                <i class="fas fa-quote-left testi-quote"></i>
                <p class="testi-text">Menyaksikan Tari Zapin langsung saat Festival Budaya Melayu jadi pengalaman yang tak terlupakan. Ramah dan sarat makna.</p>
                <div class="testi-who">
                    <div class="testi-avatar">RA</div>
                    <div>
                        <strong>Rani A.</strong>
                        <span>Wisatawan asal Pekanbaru</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 reveal reveal-delay-1">
            <div class="testi-card">
                <i class="fas fa-quote-right testi-stamp"></i>
                <i class="fas fa-quote-left testi-quote"></i>
                <p class="testi-text">Gulai ikan patin di tepi pelabuhan sambil melihat kapal berlabuh — kombinasi rasa dan suasana yang sulit dilupakan.</p>
                <div class="testi-who">
                    <div class="testi-avatar">DH</div>
                    <div>
                        <strong>Doni H.</strong>
                        <span>Pelancong kuliner</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 reveal reveal-delay-2">
            <div class="testi-card">
                <i class="fas fa-quote-right testi-stamp"></i>
                <i class="fas fa-quote-left testi-quote"></i>
                <p class="testi-text">Yang paling berkesan adalah keramahan warganya yang datang dari berbagai suku dan agama, namun tetap akur dan hangat.</p>
                <div class="testi-who">
                    <div class="testi-avatar">SN</div>
                    <div>
                        <strong>Siti N.</strong>
                        <span>Peneliti budaya</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ================= VISI / CTA ================= -->
<section class="container mt-5 mb-5 pt-3">
    <div class="cta-box text-center reveal">
        <h2>Ayo Kunjungi Dumai!</h2>
        <p>
            Nikmati kombinasi keindahan alam pesisir, keramahan budaya Melayu, serta cita rasa kuliner laut yang tak terlupakan.
        </p>
        <a href="{{ route('destinasi') ?? '#' }}" class="btn btn-cta">Jelajahi Seluruh Destinasi</a>
    </div>
</section>

<!-- ================= BACK TO TOP ================= -->
<a href="#hero" class="back-to-top" id="backToTop" aria-label="Kembali ke atas">
    <i class="fas fa-arrow-up"></i>
</a>

<script>
(function () {
    var prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    /* Scroll reveal */
    var revealEls = document.querySelectorAll('.reveal');
    if (prefersReducedMotion || !('IntersectionObserver' in window)) {
        revealEls.forEach(function (el) { el.classList.add('is-visible'); });
    } else {
        var revealObserver = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    revealObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.15 });
        revealEls.forEach(function (el) { revealObserver.observe(el); });
    }

    /* Count-up statistik */
    var manifestPanel = document.querySelector('.manifest-panel');
    if (manifestPanel) {
        var runCount = function () {
            document.querySelectorAll('.manifest-num').forEach(function (el) {
                var target = parseInt(el.getAttribute('data-count'), 10) || 0;
                var suffix = el.getAttribute('data-suffix') || '';
                if (prefersReducedMotion) {
                    el.textContent = target.toLocaleString('id-ID') + suffix;
                    return;
                }
                var start = 0;
                var duration = 1200;
                var startTime = null;
                function step(ts) {
                    if (!startTime) startTime = ts;
                    var progress = Math.min((ts - startTime) / duration, 1);
                    var current = Math.floor(progress * target);
                    el.textContent = current.toLocaleString('id-ID') + suffix;
                    if (progress < 1) requestAnimationFrame(step);
                    else el.textContent = target.toLocaleString('id-ID') + suffix;
                }
                requestAnimationFrame(step);
            });
        };
        if ('IntersectionObserver' in window) {
            var countObserver = new IntersectionObserver(function (entries) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        runCount();
                        countObserver.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.3 });
            countObserver.observe(manifestPanel);
        } else {
            runCount();
        }
    }

    /* Scrollspy untuk quick nav */
    var navLinks = document.querySelectorAll('#quicknav a[data-target]');
    var sections = Array.prototype.map.call(navLinks, function (link) {
        return document.getElementById(link.getAttribute('data-target'));
    }).filter(Boolean);

    if (sections.length && 'IntersectionObserver' in window) {
        var spy = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                var link = document.querySelector('#quicknav a[data-target="' + entry.target.id + '"]');
                if (!link) return;
                if (entry.isIntersecting) {
                    navLinks.forEach(function (l) { l.classList.remove('is-active'); });
                    link.classList.add('is-active');
                }
            });
        }, { rootMargin: '-45% 0px -45% 0px' });
        sections.forEach(function (s) { spy.observe(s); });
    }

    /* Tombol kembali ke atas */
    var backToTop = document.getElementById('backToTop');
    if (backToTop) {
        window.addEventListener('scroll', function () {
            if (window.scrollY > 500) backToTop.classList.add('is-visible');
            else backToTop.classList.remove('is-visible');
        });
    }
})();
</script>


@endsection