@extends('layouts.app')
@section('body-class', 'page-beranda')
@section('title', 'Wisata Kota Dumai - Bumi Melayu Pesisir')

@section('content')

<!-- External Stylesheet -->
<link rel="stylesheet" href="{{ asset('css/beranda.css') }}">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;800&family=Nunito+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<!-- ================= HERO & FILTER UTAMA TERPADU ================= -->
<section class="hero-page text-center">
    <div class="container">
        <div class="hero-content">
            <div class="melayu-ornament-top">
                <i class="fas fa-landmark"></i>
            </div>

            <span class="hero-eyebrow mb-2">
                <i class="fas fa-gem me-1 text-warning"></i> Wisata Kota Dumai &middot; Negeri Melayu Pesisir
            </span>

            <h1 class="fw-bold display-6">Eksplorasi <span class="gold-text">Wisata Kota Dumai</span></h1>
            <p class="lead mx-auto mb-4" style="max-width: 600px; font-size: 0.98rem; opacity: 0.95;">
                Temukan keindahan pantai, hutan mangrove, taman rekreasi, dan warisan budaya Melayu Pesisir.
            </p>

            <!-- Search Box & Widget Info Cepat -->
            <div class="search-box mb-3">
                <input type="text" id="searchInput" placeholder="Cari destinasi, pantai, taman, atau lokasi...">
            </div>

            <div class="d-flex justify-content-center gap-2 flex-wrap">
                <div class="widget-pill"><i class="fas fa-sun text-warning me-1"></i> Cuaca: <strong>29°C Cerah</strong></div>
                <div class="widget-pill"><i class="fas fa-clock text-info me-1"></i> Jam: <strong id="liveClock">00:00:00 WIB</strong></div>
                <div class="widget-pill"><i class="fas fa-map-marker-alt text-danger me-1"></i> Total: <strong>{{ count($destinasiList ?? []) }} Destinasi</strong></div>
            </div>
        </div>
    </div>
    <div class="wave-divider">
        <svg viewBox="0 0 1440 70" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0,32 C240,70 480,0 720,20 C960,40 1200,70 1440,28 L1440,70 L0,70 Z" fill="#F4F8F5"/>
        </svg>
    </div>
</section>

<!-- ================= TAMPILAN KATALOG & KALKULATOR RUTE ================= -->
<div class="container pb-5">

    <<!-- ================= FILTER DESTINASI ================= -->
<div class="filter-toolbar shadow-sm rounded-4 p-4 mb-5">

    <div class="row align-items-center">

        <!-- Judul -->
        <div class="col-lg-4 mb-3 mb-lg-0">
            <h4 class="fw-bold mb-1">
                <i class="fas fa-map-marked-alt text-warning me-2"></i>
                Jelajahi Destinasi Unggulan
            </h4>

            <small class="text-muted">
                Temukan destinasi wisata terbaik di Kota Dumai
            </small>
        </div>

        <!-- Filter -->
        <div class="col-lg-5">

            <div class="filter-menu">

                <button class="filter-btn active"
                        onclick="filterSelection('all', this)">
                    <i class="fas fa-border-all"></i>
                    Semua
                

            </div>

        </div>

        <!-- Status -->
        <div class="col-lg-3">

            <div class="only-open-box">

                <input
                    class="form-check-input"
                    type="checkbox"
                    id="onlyOpenCheck"
                    onchange="toggleOnlyOpen(this)">

                <label
                    class="form-check-label"
                    for="onlyOpenCheck">

                    <i class="fas fa-door-open text-success me-2"></i>

                    Sedang Buka

                </label>

            </div>

        </div>

    </div>

</div>

    <!-- Grid Destinasi Wisata -->
    <div class="card-grid mb-5" id="destinasiGrid">
        @forelse ($destinasiList as $destinasi)
            @php
                date_default_timezone_set('Asia/Jakarta');
                $jamSekarang = now()->format('H:i:s');
                $statusBuka = ($jamSekarang >= $destinasi->jam_buka && $jamSekarang <= $destinasi->jam_tutup);
                $kategoriSlug = strtolower($destinasi->kategori ?? 'umum');
            @endphp

            <div class="destination-card filter-item {{ $kategoriSlug }}" data-status="{{ $statusBuka ? 'open' : 'closed' }}">
                <div class="card-media">
                    @if(!empty($destinasi->gambar))
                        <img src="{{ asset('images/' . $destinasi->gambar) }}" alt="{{ $destinasi->nama }}" loading="lazy">
                    @else
                        <img src="{{ asset('images/no-image.jpg') }}" alt="Tidak Ada Gambar" loading="lazy">
                    @endif
                    <span class="badge">{{ $destinasi->kategori ?? 'Wisata' }}</span>
                </div>

                <div class="card-body">
                    <h3>{{ $destinasi->nama }}</h3>
                    <div class="rating">⭐⭐⭐⭐⭐ <span class="small text-muted">(4.8)</span></div>
                    <p>{{ \Illuminate\Support\Str::limit($destinasi->deskripsi, 90) }}</p>

                    <ul class="info-list">
                        <li><i class="fas fa-map-marker-alt text-danger me-1"></i> {{ $destinasi->lokasi }}</li>
                        <li><i class="fas fa-clock text-primary me-1"></i> {{ $destinasi->jam_buka }} - {{ $destinasi->jam_tutup }} WIB</li>
                        <li class="status mt-1">
                            <span class="status-badge {{ $statusBuka ? 'open' : 'closed' }}">
                                <i class="fas {{ $statusBuka ? 'fa-door-open' : 'fa-lock' }}"></i>
                                {{ $statusBuka ? 'Sedang Buka' : 'Sudah Tutup' }}
                            </span>
                        </li>
                    </ul>

                    @if(!empty($destinasi->maps))
                        <div class="card-action d-flex align-items-center justify-content-end gap-2 mt-3 pt-2 border-top">
                            <a href="{{ $destinasi->maps }}" target="_blank" class="btn-secondary">
                                <i class="fas fa-directions me-1"></i> Maps
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        @empty
            <div class="empty-state text-center py-5">
                <i class="fas fa-map-marked-alt fa-3x mb-3"></i>
                <h4>Belum Ada Destinasi</h4>
                <p>Data destinasi wisata belum tersedia saat ini.</p>
            </div>
        @endforelse
    </div>

    <!-- Panel Estimasi Rute Cepat -->
    <section class="trip-calculator-card">
        <div class="row align-items-center g-3">
            <div class="col-lg-5">
                <span class="badge bg-warning text-dark rounded-pill fw-bold text-uppercase mb-2">Panduan Rute</span>
                <h4 class="fw-bold mb-2"><i class="fas fa-calculator text-warning me-2"></i>Estimasi Waktu Perjalanan</h4>
                <p class="text-white-50 small mb-0">Hitung perkiraan waktu dan jarak tempuh dari lokasi Anda ke tempat wisata tujuan.</p>
            </div>
            <div class="col-lg-7">
                <div class="bg-white p-3 rounded-4 text-dark shadow-sm">
                    <div class="row g-2">
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-muted mb-1">Titik Awal</label>
                            <select id="startPointSelect" class="form-select form-select-sm">
                                <option value="Bandara Pinang Kampai Dumai">Bandara Pinang Kampai</option>
                                <option value="Pelabuhan Bandar Sri Junjungan">Pelabuhan Bandar Sri Junjungan</option>
                                <option value="Terminal Bus AKAP Dumai">Terminal Bus AKAP Dumai</option>
                                <option value="Pusat Kota Dumai">Pusat Kota Dumai</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small text-muted mb-1">Tujuan</label>
                            <select id="destinationSelect" class="form-select form-select-sm">
                                @foreach($destinasiList as $d)
                                    <option value="{{ $d->nama }}">{{ $d->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 mt-2">
                            <button type="button" class="btn btn-primary btn-sm w-100 rounded-3 fw-bold" onclick="calculateTrip()">
                                <i class="fas fa-search-location me-1"></i> Hitung Estimasi
                            </button>
                        </div>
                    </div>

                    <div id="tripResultBox" class="mt-2 p-2 bg-light rounded-3 d-none">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div><strong id="tripTitleResult">-</strong></div>
                            <div class="text-end">
                                <span class="fw-bold text-primary" id="tripTimeResult">0 Menit</span>
                                <span class="text-muted ms-1" id="tripDistResult">(~0 km)</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>

<!-- ================= SCRIPT RINGKAS ================= -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    // 1. Jam Digital Live
    function updateClock() {
        const now = new Date();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');
        const clockElem = document.getElementById('liveClock');
        if(clockElem) clockElem.innerText = `${hours}:${minutes}:${seconds} WIB`;
    }
    setInterval(updateClock, 1000);
    updateClock();

    // 2. Pencarian Input Realtime
    const searchInput = document.getElementById("searchInput");
    if(searchInput) {
        searchInput.addEventListener("keyup", function () {
            let value = this.value.toLowerCase();
            let cards = document.querySelectorAll(".destination-card");

            cards.forEach(function (card) {
                let title = card.querySelector("h3").textContent.toLowerCase();
                let loc = card.querySelector(".info-list").textContent.toLowerCase();
                card.style.display = (title.includes(value) || loc.includes(value)) ? "" : "none";
            });
        });
    }

    // 3. Scroll Reveal Animation
    let cards = document.querySelectorAll(".destination-card");
    let observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry, index) {
            if (entry.isIntersecting) {
                setTimeout(function () {
                    entry.target.classList.add("in-view");
                }, index * 80);
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });

    cards.forEach(function (card) { observer.observe(card); });
});

// 4. Filter Kategori
function filterSelection(category, btn) {
    let items = document.getElementsByClassName("filter-item");
    let buttons = document.getElementsByClassName("filter-btn");
    let target = category === "all" ? "" : category;

    for (let i = 0; i < items.length; i++) {
        let classes = items[i].className.split(" ");
        items[i].style.display = (target === "" || classes.indexOf(target) > -1) ? "" : "none";
    }

    for (let i = 0; i < buttons.length; i++) { buttons[i].classList.remove("active"); }
    if (btn) btn.classList.add("active");
}

// 5. Toggle Filter Hanya Buka
function toggleOnlyOpen(checkbox) {
    let items = document.querySelectorAll(".destination-card");
    items.forEach(function (card) {
        let status = card.getAttribute("data-status");
        card.style.display = (checkbox.checked && status !== "open") ? "none" : "";
    });
}

// 6. Estimasi Perjalanan Sederhana
function calculateTrip() {
    let start = document.getElementById("startPointSelect").value;
    let dest = document.getElementById("destinationSelect").value;
    let resultBox = document.getElementById("tripResultBox");

    let randomDist = (Math.random() * 15 + 3).toFixed(1);
    let randomTime = Math.round(randomDist * 2.5);

    document.getElementById("tripTitleResult").innerText = `${start} ➔ ${dest}`;
    document.getElementById("tripTimeResult").innerText = `~${randomTime} Menit`;
    document.getElementById("tripDistResult").innerText = `(~${randomDist} km)`;

    resultBox.classList.remove("d-none");
}
</script>

@endsection