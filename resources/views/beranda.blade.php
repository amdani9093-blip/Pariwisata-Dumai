@extends('layouts.app')

@section('body-class', 'page-beranda')
@section('title', 'Visit Dumai - Wisata & Kuliner Pesisir Riau')

@section('content')

<link rel="stylesheet" href="{{ asset('css/beranda.css') }}">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700;800&family=Nunito+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">


@php

    /*
    |--------------------------------------------------------------------------
    | DATA DASAR
    |--------------------------------------------------------------------------
    */

    $destinasiData = collect($destinasiList ?? []);

    $totalDestinasi = $destinasiData->count();

    $kategoriUntukFilter = collect($kategoriList ?? [])
        ->map(fn ($k) => $k->nama_kategori ?? null)
        ->filter()
        ->unique();

    if ($kategoriUntukFilter->isEmpty()) {

        $kategoriUntukFilter = $destinasiData
            ->map(fn ($d) => $d->kategori->nama_kategori ?? null)
            ->filter()
            ->unique();
    }

@endphp


{{-- =========================================================
     HERO SECTION
========================================================= --}}

<section class="vd-hero">

    <div class="vd-hero-overlay"></div>

    <div class="container position-relative">

        <div class="vd-hero-content">

            {{-- Ornamen --}}
            <div class="vd-hero-ornament">
                <span></span>
                <i class="fa-solid fa-landmark"></i>
                <span></span>
            </div>


            {{-- Eyebrow --}}
            <div class="vd-eyebrow">

                <i class="fa-solid fa-gem"></i>

                Dumai Negeri Melayu Pesisir

            </div>


            {{-- Judul --}}
            <h1 class="vd-hero-title">

                Jelajahi Keindahan

                <span>Kota Dumai</span>

            </h1>


            <p class="vd-hero-description">

                Temukan pantai, hutan mangrove, wisata religi,
                taman rekreasi, kuliner khas, dan pesona budaya
                Melayu Pesisir di Kota Dumai.

            </p>


            {{-- SEARCH --}}
            <div class="vd-search">

                <div class="vd-search-icon">

                    <i class="fa-solid fa-magnifying-glass"></i>

                </div>

                <input
                    type="search"
                    id="searchInput"
                    placeholder="Cari destinasi, pantai, taman, atau lokasi..."
                    autocomplete="off"
                >

                <button
                    type="button"
                    onclick="clearSearch()"
                    id="clearSearch"
                    title="Hapus pencarian"
                >

                    <i class="fa-solid fa-xmark"></i>

                </button>

            </div>


            {{-- QUICK INFO --}}
            <div class="vd-quick-info">

                <div class="vd-info-pill">

                    <i class="fa-solid fa-location-dot"></i>

                    <div>

                        <small>Destinasi</small>

                        <strong>
                            {{ $totalDestinasi }}
                        </strong>

                    </div>

                </div>


                <div class="vd-info-pill">

                    <i class="fa-solid fa-compass"></i>

                    <div>

                        <small>Wilayah</small>

                        <strong>Dumai</strong>

                    </div>

                </div>


                <div class="vd-info-pill">

                    <i class="fa-solid fa-clock"></i>

                    <div>

                        <small>Waktu</small>

                        <strong id="liveClock">
                            00:00:00 WIB
                        </strong>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- Wave --}}
    <div class="vd-wave">

        <svg viewBox="0 0 1440 100"
             preserveAspectRatio="none">

            <path
                d="M0,45 C180,95 360,10 540,45 C720,80 900,95 1080,45 C1260,5 1350,35 1440,55 L1440,100 L0,100 Z"
            />

        </svg>

    </div>

</section>



{{-- =========================================================
     STATISTIK
========================================================= --}}

<section class="vd-stat-section">

    <div class="container">

        <div class="vd-stat-grid">

            <div class="vd-stat-card">

                <div class="vd-stat-icon blue">

                    <i class="fa-solid fa-map-location-dot"></i>

                </div>

                <div>

                    <strong>{{ $totalDestinasi }}</strong>

                    <span>Destinasi Wisata</span>

                </div>

            </div>


            <div class="vd-stat-card">

                <div class="vd-stat-icon gold">

                    <i class="fa-solid fa-layer-group"></i>

                </div>

                <div>

                    <strong>{{ $kategoriUntukFilter->count() }}</strong>

                    <span>Kategori Wisata</span>

                </div>

            </div>


            <div class="vd-stat-card">

                <div class="vd-stat-icon green">

                    <i class="fa-solid fa-tree"></i>

                </div>

                <div>

                    <strong>Alam</strong>

                    <span>Wisata Pesisir</span>

                </div>

            </div>


            <div class="vd-stat-card">

                <div class="vd-stat-icon orange">

                    <i class="fa-solid fa-heart"></i>

                </div>

                <div>

                    <strong>100%</strong>

                    <span>Pesona Dumai</span>

                </div>

            </div>

        </div>

    </div>

</section>



<div class="container vd-main-container">


{{-- =========================================================
     SECTION TITLE
========================================================= --}}

<div class="vd-section-heading">

    <div>

        <span class="vd-section-label">

            <i class="fa-solid fa-compass"></i>

            EXPLORE DUMAI

        </span>

        <h2>

            Jelajahi Destinasi Pilihan

        </h2>

        <p>

            Temukan tempat terbaik untuk menikmati alam,
            budaya, religi, dan keindahan pesisir Kota Dumai.

        </p>

    </div>

    <div class="vd-section-decoration">

        <i class="fa-solid fa-location-dot"></i>

    </div>

</div>



{{-- =========================================================
     FILTER TOOLBAR
========================================================= --}}

<div class="vd-filter-box">

    <div class="vd-filter-left">

        <span class="vd-filter-title">

            <i class="fa-solid fa-filter"></i>

            Filter Destinasi

        </span>


        <div class="vd-category-list">

            <button
                type="button"
                class="vd-category active"
                data-category="all"
                onclick="filterSelection('all', this)"
            >

                <i class="fa-solid fa-border-all"></i>

                Semua

            </button>


            @foreach($kategoriUntukFilter as $namaKategori)

                <button
                    type="button"
                    class="vd-category"
                    data-category="{{ \Illuminate\Support\Str::slug($namaKategori) }}"
                    onclick="filterSelection('{{ \Illuminate\Support\Str::slug($namaKategori) }}', this)"
                >

                    <i class="fa-solid fa-location-dot"></i>

                    {{ $namaKategori }}

                </button>

            @endforeach

        </div>

    </div>


    <button
        type="button"
        class="vd-open-filter"
        id="onlyOpenChip"
        onclick="toggleOnlyOpen(this)"
    >

        <i class="fa-solid fa-door-open"></i>

        Sedang Buka

    </button>

</div>



{{-- =========================================================
     HASIL PENCARIAN
========================================================= --}}

<div class="vd-result-info">

    <span>

        <i class="fa-solid fa-map-location-dot"></i>

        Menampilkan
        <strong id="resultCount">
            {{ $totalDestinasi }}
        </strong>
        destinasi

    </span>

    <span id="searchResultText"></span>

</div>



{{-- =========================================================
     DESTINATION GRID
========================================================= --}}

<div
    class="vd-destination-grid"
    id="destinasiGrid"
>

@forelse($destinasiData as $destinasi)

    @php

        $namaKategori =
            $destinasi->kategori->nama_kategori
            ?? 'Umum';

        $kategoriSlug =
            \Illuminate\Support\Str::slug($namaKategori);

        /*
        |--------------------------------------------------------------------------
        | Waktu
        |--------------------------------------------------------------------------
        */

        $statusBuka = false;

        if ($destinasi->jam_buka && $destinasi->jam_tutup) {

            try {

                $jamSekarang = now('Asia/Jakarta')->format('H:i:s');

                $statusBuka =
                    $jamSekarang >= $destinasi->jam_buka
                    &&
                    $jamSekarang <= $destinasi->jam_tutup;

            } catch (\Exception $e) {

                $statusBuka = false;

            }

        }

    @endphp


    <article
        class="vd-destination-card filter-item {{ $kategoriSlug }}"
        data-status="{{ $statusBuka ? 'open' : 'closed' }}"
        data-search="{{ strtolower($destinasi->nama . ' ' . ($destinasi->lokasi ?? '') . ' ' . $namaKategori) }}"
    >


        {{-- IMAGE --}}
        <div class="vd-card-image">

            @if(!empty($destinasi->gambar))

                <img
                    src="{{ asset('storage/' . $destinasi->gambar) }}"
                    alt="{{ $destinasi->nama }}"
                    loading="lazy"
                >

            @else

                <img
                    src="{{ asset('images/no-image.jpg') }}"
                    alt="Tidak ada gambar"
                    loading="lazy"
                >

            @endif


            {{-- Category --}}
            <span class="vd-card-category">

                <i class="fa-solid fa-location-dot"></i>

                {{ $namaKategori }}

            </span>


            {{-- Status --}}
            <span class="vd-card-status {{ $statusBuka ? 'open' : 'closed' }}">

                <i class="fa-solid {{ $statusBuka ? 'fa-circle-check' : 'fa-circle-xmark' }}"></i>

                {{ $statusBuka ? 'Buka' : 'Tutup' }}

            </span>

        </div>


        {{-- CONTENT --}}
        <div class="vd-card-content">

            <div class="vd-card-title-row">

                <h3>
                    {{ $destinasi->nama }}
                </h3>

                <div class="vd-rating">

                    <i class="fa-solid fa-star"></i>

                    <span>4.8</span>

                </div>

            </div>


            <p class="vd-card-description">

                {{ \Illuminate\Support\Str::limit($destinasi->deskripsi ?? 'Nikmati keindahan destinasi wisata Kota Dumai.', 100) }}

            </p>


            <div class="vd-card-meta">

                <div>

                    <i class="fa-solid fa-location-dot"></i>

                    <span>
                        {{ \Illuminate\Support\Str::limit($destinasi->lokasi ?? 'Kota Dumai', 50) }}
                    </span>

                </div>


                <div>

                    <i class="fa-regular fa-clock"></i>

                    <span>

                        {{ $destinasi->jam_buka ?? '--:--' }}

                        -

                        {{ $destinasi->jam_tutup ?? '--:--' }}

                        WIB

                    </span>

                </div>

            </div>


            {{-- ACTION --}}
            <div class="vd-card-footer">

                @if(!empty($destinasi->maps))

                    <a
                        href="{{ $destinasi->maps }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="vd-map-button"
                    >

                        <i class="fa-solid fa-diamond-turn-right"></i>

                        Petunjuk Arah

                    </a>

                @else

                    <span class="vd-no-map">

                        <i class="fa-solid fa-location-dot"></i>

                        Lokasi tersedia

                    </span>

                @endif


                <span class="vd-explore-icon">

                    <i class="fa-solid fa-arrow-right"></i>

                </span>

            </div>

        </div>

    </article>


@empty

    <div class="vd-empty-state">

        <div class="vd-empty-icon">

            <i class="fa-solid fa-map-location-dot"></i>

        </div>

        <h3>Belum Ada Destinasi</h3>

        <p>
            Data destinasi wisata belum tersedia saat ini.
        </p>

    </div>

@endforelse

</div>



{{-- =========================================================
     NO SEARCH RESULT
========================================================= --}}

<div
    id="noSearchResult"
    class="vd-empty-state d-none"
>

    <div class="vd-empty-icon">

        <i class="fa-solid fa-magnifying-glass"></i>

    </div>

    <h3>Destinasi Tidak Ditemukan</h3>

    <p>
        Coba gunakan kata kunci pencarian yang berbeda.
    </p>

    <button
        type="button"
        onclick="clearSearch()"
        class="vd-reset-button"
    >

        <i class="fa-solid fa-rotate-left"></i>

        Reset Pencarian

    </button>

</div>



{{-- =========================================================
     TRIP CALCULATOR
========================================================= --}}

<section class="vd-trip-card">

    <div class="vd-trip-decoration">

        <i class="fa-solid fa-route"></i>

    </div>


    <div class="row align-items-center g-4 position-relative">

        <div class="col-lg-5">

            <span class="vd-trip-label">

                <i class="fa-solid fa-compass"></i>

                PANDUAN PERJALANAN

            </span>


            <h2>

                Rencanakan Perjalanan Anda

            </h2>


            <p>

                Pilih titik keberangkatan dan destinasi
                untuk mendapatkan estimasi perjalanan.

            </p>

        </div>


        <div class="col-lg-7">

            <div class="vd-trip-form">

                <div class="row g-3">

                    <div class="col-md-6">

                        <label>

                            <i class="fa-solid fa-location-dot"></i>

                            Titik Awal

                        </label>

                        <select
                            id="startPointSelect"
                            class="form-select"
                        >

                            <option value="Bandara Pinang Kampai">
                                Bandara Pinang Kampai
                            </option>

                            <option value="Pelabuhan Bandar Sri Junjungan">
                                Pelabuhan Bandar Sri Junjungan
                            </option>

                            <option value="Terminal Bus AKAP Dumai">
                                Terminal Bus AKAP Dumai
                            </option>

                            <option value="Pusat Kota Dumai">
                                Pusat Kota Dumai
                            </option>

                        </select>

                    </div>


                    <div class="col-md-6">

                        <label>

                            <i class="fa-solid fa-flag-checkered"></i>

                            Tujuan

                        </label>

                        <select
                            id="destinationSelect"
                            class="form-select"
                        >

                            @foreach($destinasiData as $d)

                                <option value="{{ $d->nama }}">
                                    {{ $d->nama }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    <div class="col-12">

                        <button
                            type="button"
                            onclick="calculateTrip()"
                            class="vd-trip-button"
                        >

                            <i class="fa-solid fa-route"></i>

                            Hitung Estimasi Perjalanan

                        </button>

                    </div>

                </div>


                {{-- RESULT --}}
                <div
                    id="tripResultBox"
                    class="vd-trip-result d-none"
                >

                    <div class="vd-trip-result-icon">

                        <i class="fa-solid fa-car-side"></i>

                    </div>

                    <div>

                        <small>Rute perjalanan</small>

                        <strong id="tripTitleResult">
                            -
                        </strong>

                    </div>

                    <div class="vd-trip-result-value">

                        <strong id="tripTimeResult">
                            0 Menit
                        </strong>

                        <span id="tripDistResult">
                            (~0 km)
                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>



{{-- =========================================================
     CTA
========================================================= --}}

<section class="vd-bottom-cta">

    <div class="vd-cta-icon">

        <i class="fa-solid fa-heart"></i>

    </div>

    <div>

        <span>
            PESONA MELAYU PESISIR
        </span>

        <h3>
            Mari Jelajahi Dumai
        </h3>

        <p>
            Nikmati alam, budaya, kuliner, dan keramahan
            masyarakat Melayu Pesisir.
        </p>

    </div>

</section>


</div>



{{-- =========================================================
     JAVASCRIPT
========================================================= --}}

<script>

document.addEventListener('DOMContentLoaded', function () {

    /*
    |--------------------------------------------------------------------------
    | JAM DIGITAL
    |--------------------------------------------------------------------------
    */

    function updateClock() {

        const now = new Date();

        const clock =
            document.getElementById('liveClock');

        if (!clock) return;

        const time =
            new Intl.DateTimeFormat('id-ID', {
                timeZone: 'Asia/Jakarta',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: false
            }).format(now);

        clock.textContent =
            time.replace(/\./g, ':') + ' WIB';
    }

    updateClock();

    setInterval(updateClock, 1000);



    /*
    |--------------------------------------------------------------------------
    | SEARCH
    |--------------------------------------------------------------------------
    */

    const searchInput =
        document.getElementById('searchInput');

    const clearButton =
        document.getElementById('clearSearch');

    const cards =
        document.querySelectorAll('.vd-destination-card');

    const resultCount =
        document.getElementById('resultCount');

    const noSearchResult =
        document.getElementById('noSearchResult');

    const searchResultText =
        document.getElementById('searchResultText');


    function performSearch() {

        const keyword =
            searchInput.value
                .toLowerCase()
                .trim();

        let visibleCount = 0;


        cards.forEach(card => {

            const searchData =
                card.dataset.search || '';

            const match =
                searchData.includes(keyword);

            /*
            |--------------------------------------------------------------------------
            | Jangan langsung sembunyikan berdasarkan search saja.
            | Simpan status hasil pencarian.
            |--------------------------------------------------------------------------
            */

            card.dataset.searchMatch =
                match ? 'yes' : 'no';

        });


        applyAllFilters();


        if (keyword) {

            searchResultText.innerHTML =
                `<i class="fa-solid fa-magnifying-glass"></i>
                 Pencarian: "<strong>${escapeHtml(keyword)}</strong>"`;

        } else {

            searchResultText.innerHTML = '';

        }

    }


    searchInput.addEventListener(
        'input',
        performSearch
    );


    clearButton.addEventListener(
        'click',
        clearSearch
    );



    /*
    |--------------------------------------------------------------------------
    | FILTER GABUNGAN
    |--------------------------------------------------------------------------
    */

    window.currentCategory = 'all';
    window.onlyOpen = false;


    window.applyAllFilters = function () {

        let visibleCount = 0;

        cards.forEach(card => {

            const categoryMatch =
                window.currentCategory === 'all'
                ||
                card.classList.contains(
                    window.currentCategory
                );

            const openMatch =
                !window.onlyOpen
                ||
                card.dataset.status === 'open';

            const keyword =
                searchInput.value
                    .toLowerCase()
                    .trim();

            const searchData =
                card.dataset.search || '';

            const searchMatch =
                !keyword
                ||
                searchData.includes(keyword);


            const visible =
                categoryMatch
                &&
                openMatch
                &&
                searchMatch;


            card.style.display =
                visible ? '' : 'none';


            if (visible) {

                visibleCount++;

            }

        });


        resultCount.textContent =
            visibleCount;


        noSearchResult.classList.toggle(
            'd-none',
            visibleCount > 0
        );

    };



    /*
    |--------------------------------------------------------------------------
    | ANIMASI CARD
    |--------------------------------------------------------------------------
    */

    const observer =
        new IntersectionObserver(
            entries => {

                entries.forEach(entry => {

                    if (entry.isIntersecting) {

                        entry.target.classList.add(
                            'vd-card-visible'
                        );

                        observer.unobserve(
                            entry.target
                        );

                    }

                });

            },
            {
                threshold: 0.1
            }
        );


    cards.forEach(card => {

        observer.observe(card);

    });

});



/*
|--------------------------------------------------------------------------
| FILTER KATEGORI
|--------------------------------------------------------------------------
*/

function filterSelection(category, button) {

    window.currentCategory =
        category;

    document
        .querySelectorAll('.vd-category')
        .forEach(item => {

            item.classList.remove(
                'active'
            );

        });


    if (button) {

        button.classList.add(
            'active'
        );

    }


    applyAllFilters();

}



/*
|--------------------------------------------------------------------------
| FILTER SEDANG BUKA
|--------------------------------------------------------------------------
*/

function toggleOnlyOpen(button) {

    button.classList.toggle(
        'active'
    );

    window.onlyOpen =
        button.classList.contains(
            'active'
        );


    applyAllFilters();

}



/*
|--------------------------------------------------------------------------
| CLEAR SEARCH
|--------------------------------------------------------------------------
*/

function clearSearch() {

    const input =
        document.getElementById(
            'searchInput'
        );

    if (!input) return;

    input.value = '';

    document.getElementById(
        'searchResultText'
    ).innerHTML = '';

    applyAllFilters();

    input.focus();

}



/*
|--------------------------------------------------------------------------
| ESTIMASI PERJALANAN
|--------------------------------------------------------------------------
*/

function calculateTrip() {

    const start =
        document.getElementById(
            'startPointSelect'
        ).value;

    const dest =
        document.getElementById(
            'destinationSelect'
        ).value;

    const resultBox =
        document.getElementById(
            'tripResultBox'
        );


    /*
    |--------------------------------------------------------------------------
    | Estimasi sederhana.
    | Bukan navigasi GPS real-time.
    |--------------------------------------------------------------------------
    */

    const routes = {

        'Bandara Pinang Kampai': {
            time: 20,
            distance: 12
        },

        'Pelabuhan Bandar Sri Junjungan': {
            time: 15,
            distance: 8
        },

        'Terminal Bus AKAP Dumai': {
            time: 12,
            distance: 6
        },

        'Pusat Kota Dumai': {
            time: 10,
            distance: 5
        }

    };


    const route =
        routes[start]
        ||
        {
            time: 15,
            distance: 7
        };


    document.getElementById(
        'tripTitleResult'
    ).textContent =
        `${start} → ${dest}`;


    document.getElementById(
        'tripTimeResult'
    ).textContent =
        `~${route.time} Menit`;


    document.getElementById(
        'tripDistResult'
    ).textContent =
        `~${route.distance} km`;


    resultBox.classList.remove(
        'd-none'
    );

}



/*
|--------------------------------------------------------------------------
| Escape HTML
|--------------------------------------------------------------------------
*/

function escapeHtml(text) {

    const div =
        document.createElement('div');

    div.textContent =
        text;

    return div.innerHTML;

}

</script>

@endsection