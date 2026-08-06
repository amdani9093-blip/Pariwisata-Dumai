@extends('layouts.app')
@section('body-class', 'page-kontak')
@section('title', 'Hubungi Kami - Wisata Kota Dumai')

@section('content')

<!-- External Stylesheet -->
<link rel="stylesheet" href="{{ asset('css/kontak.css') }}">

{{-- Style kecil khusus ikon kartu kontak, tidak menimpa class apa pun
     dari kontak.css --}}
<style>
    .contact-icon-box {
        width: 56px;
        height: 56px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 16px !important;
        transition: transform .3s ease, border-radius .3s ease;
    }
    .contact-info-card:hover .contact-icon-box {
        transform: scale(1.1) rotate(-6deg);
        border-radius: 40% 60% 55% 45% / 50% 45% 55% 50%; /* efek blob halus saat hover */
    }

    .contact-icon-box.icon-alamat {
        background: linear-gradient(135deg, rgba(10,92,138,.12), rgba(23,162,184,.12));
    }
    .contact-icon-box.icon-whatsapp {
        background: linear-gradient(135deg, rgba(52,211,153,.15), rgba(13,148,136,.15));
    }
    .contact-icon-box.icon-email {
        background: linear-gradient(135deg, rgba(255,122,89,.14), rgba(244,163,0,.14));
    }

    .contact-info-card {
        transition: transform .25s ease, box-shadow .25s ease;
    }
    .contact-info-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 16px 34px rgba(0,0,0,.1) !important;
    }
</style>

<!-- ================= HERO HEADER ================= -->
<section class="contact-hero text-center py-5 mb-5">
    <div class="container py-4">
        <span class="badge bg-white text-dark px-3 py-2 rounded-pill fw-bold text-uppercase shadow-sm mb-3" style="font-size: 0.75rem; letter-spacing: 1px;">
            <i class="bi bi-headset text-primary me-1"></i> Pusat Bantuan &amp; Layanan
        </span>
        <h1 class="fw-bold display-5 mb-3">Hubungi Kami</h1>
        <p class="lead mx-auto text-muted" style="max-width: 650px;">
            Punya pertanyaan seputar tempat wisata, agenda festival, atau saran untuk Kota Dumai? Tim kami siap membantu Anda.
        </p>
    </div>
</section>

<div class="container pb-5">

    {{-- ===================== INFORMASI KONTAK ===================== --}}
    <div class="row g-4 mb-5">
        {{-- Card Alamat Kantor --}}
        <div class="col-md-4">
            <a href="#lokasi-kantor" class="text-decoration-none">
                <div class="contact-info-card h-100 p-4 border rounded-4 shadow-sm bg-white transition-hover">
                    <div class="contact-icon-box icon-alamat">
                        <svg viewBox="0 0 48 48" width="30" height="30" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M24 4C15.72 4 9 10.72 9 19c0 11.25 13.2 23.94 14.4 25.02.35.32.85.32 1.2 0C25.8 42.94 39 30.25 39 19c0-8.28-6.72-15-15-15Z" fill="#ffffff"/>
                            <circle cx="24" cy="19" r="7.5" fill="url(#pinGrad)"/>
                            <defs>
                                <linearGradient id="pinGrad" x1="16.5" y1="11.5" x2="31.5" y2="26.5" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#17a2b8"/>
                                    <stop offset="1" stop-color="#0a5c8a"/>
                                </linearGradient>
                            </defs>
                        </svg>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <h5 class="fw-bold mb-0 text-dark">Alamat Kantor</h5>
                        <span class="badge bg-light text-primary border small">
                            <i class="bi bi-box-arrow-up-right me-1"></i> Buka Peta
                        </span>
                    </div>
                    <p class="text-muted small mb-0">
                        Jl. HR. Soebrantas No. 12, Teluk Binjai, Kec. Dumai Timur, Kota Dumai, Riau 28815
                    </p>
                </div>
            </a>
        </div>

        {{-- Card WhatsApp --}}
        <div class="col-md-4">
            <a href="https://wa.me/6285278776696" target="_blank" rel="noopener noreferrer" class="text-decoration-none">
                <div class="contact-info-card h-100 p-4 border rounded-4 shadow-sm bg-white transition-hover">
                    <div class="contact-icon-box icon-whatsapp">
                        <svg viewBox="0 0 48 48" width="30" height="30" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="24" cy="24" r="20" fill="#ffffff"/>
                            <path d="M24 8c-9.4 0-17 7.6-17 17 0 3 .78 5.82 2.15 8.26L7 41l8-2.09A16.9 16.9 0 0 0 24 41c9.4 0 17-7.6 17-17S33.4 8 24 8Z" fill="url(#waGrad)"/>
                            <path d="M18.1 15.7c-.42-.93-.86-.95-1.26-.97-.33-.02-.7-.02-1.08-.02-.38 0-.99.14-1.51.7-.52.56-1.98 1.94-1.98 4.72 0 2.79 2.03 5.48 2.31 5.86.28.38 3.9 6.25 9.63 8.51 4.76 1.88 5.73 1.5 6.77 1.41 1.03-.09 3.34-1.37 3.81-2.69.47-1.32.47-2.45.33-2.69-.14-.23-.52-.37-1.08-.65-.56-.28-3.34-1.65-3.86-1.84-.52-.19-.89-.28-1.27.28-.38.56-1.45 1.84-1.78 2.22-.33.37-.66.42-1.22.14-.56-.28-2.36-.87-4.5-2.78-1.66-1.48-2.79-3.32-3.11-3.88-.33-.56-.03-.87.25-1.14.25-.25.56-.65.84-.98.28-.32.37-.56.56-.93.19-.37.09-.7-.05-.98-.14-.28-1.24-3.14-1.74-4.29Z" fill="#ffffff"/>
                            <defs>
                                <linearGradient id="waGrad" x1="7" y1="8" x2="41" y2="41" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#34d399"/>
                                    <stop offset="1" stop-color="#0d9488"/>
                                </linearGradient>
                            </defs>
                        </svg>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <h5 class="fw-bold mb-0 text-dark">WhatsApp &amp; Telepon</h5>
                        <span class="badge bg-light text-success border small">
                            <i class="bi bi-chat-dots me-1"></i> Chat
                        </span>
                    </div>
                    <p class="text-dark small mb-1 fw-bold">+62 852-7877-6696</p>
                    <p class="text-muted small mb-0">Senin - Minggu: 08:00 - 18:00 WIB</p>
                </div>
            </a>
        </div>

        {{-- Card Email --}}
        <div class="col-md-4">
            <a href="mailto:amdani9093@gmail.com" class="text-decoration-none">
                <div class="contact-info-card h-100 p-4 border rounded-4 shadow-sm bg-white transition-hover">
                    <div class="contact-icon-box icon-email">
                        <svg viewBox="0 0 48 48" width="30" height="30" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="6" y="12" width="36" height="26" rx="5" fill="#ffffff"/>
                            <rect x="6" y="12" width="36" height="26" rx="5" fill="url(#mailGrad)" fill-opacity=".12"/>
                            <path d="M9 15.5 24 27l15-11.5" stroke="url(#mailGrad)" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
                            <rect x="6" y="12" width="36" height="26" rx="5" stroke="url(#mailGrad)" stroke-width="2"/>
                            <defs>
                                <linearGradient id="mailGrad" x1="6" y1="12" x2="42" y2="38" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#ff7a59"/>
                                    <stop offset="1" stop-color="#f4a300"/>
                                </linearGradient>
                            </defs>
                        </svg>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <h5 class="fw-bold mb-0 text-dark">Email Resmi</h5>
                        <span class="badge bg-light text-danger border small">
                            <i class="bi bi-send me-1"></i> Kirim
                        </span>
                    </div>
                    <p class="text-dark small mb-1 fw-bold">amdani9093@gmail.com</p>
                    <p class="text-muted small mb-0">Respons cepat dalam 1x24 jam kerja.</p>
                </div>
            </a>
        </div>
    </div>

    {{-- ===================== FORM PESAN & FAQ ===================== --}}
    <div class="row g-4 mb-5">
        {{-- Formulir Pesan --}}
        <div class="col-lg-7">
            <div class="form-card p-4 p-md-5 border rounded-4 shadow-sm bg-white h-100">
                <h3 class="fw-bold mb-1">Kirim Pesan Anda</h3>
                <p class="text-muted mb-4 small">Isi formulir di bawah ini dan tim kami akan membalas secepatnya.</p>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger rounded-3">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('kontak.store') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Nama Lengkap</label>
                            <input type="text" name="nama" value="{{ old('nama') }}" class="form-control py-2" placeholder="Masukkan nama Anda" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Alamat Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control py-2" placeholder="nama@email.com" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold small">Kategori Pertanyaan</label>
                            <select name="kategori" class="form-select py-2" required>
                                <option value="" selected disabled>Pilih Kategori...</option>
                                <option value="Informasi Wisata" @selected(old('kategori') == 'Informasi Wisata')>Informasi Tempat Wisata</option>
                                <option value="Agenda Festival" @selected(old('kategori') == 'Agenda Festival')>Agenda Festival / Acara</option>
                                <option value="Kemitraan & Kerjasama" @selected(old('kategori') == 'Kemitraan & Kerjasama')>Kemitraan &amp; Kerjasama</option>
                                <option value="Kritik & Saran" @selected(old('kategori') == 'Kritik & Saran')>Kritik &amp; Saran</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold small">Pesan Anda</label>
                            <textarea name="pesan" rows="4" class="form-control" placeholder="Tuliskan pertanyaan atau pesan Anda di sini..." required>{{ old('pesan') }}</textarea>
                        </div>
                        <div class="col-12 pt-2">
                            <button type="submit" class="btn btn-primary btn-submit-modern w-100 py-2 fw-semibold shadow-sm">
                                <i class="bi bi-send-fill me-2"></i> Kirim Pesan Sekarang
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- FAQ Singkat --}}
        <div class="col-lg-5">
            <div class="contact-info-card p-4 p-md-5 border rounded-4 shadow-sm bg-white h-100">
                <h5 class="fw-bold mb-4"><i class="bi bi-question-circle text-primary me-2"></i>Pertanyaan Umum</h5>

                <div class="accordion accordion-flush" id="faqAccordion">
                    {{-- FAQ 1 --}}
                    <div class="accordion-item border-bottom mb-2">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-semibold small px-0 shadow-none bg-transparent"
                                    type="button"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#faq1"
                                    aria-expanded="false"
                                    aria-controls="faq1">
                                Apakah destinasi wisata Dumai buka setiap hari?
                            </button>
                        </h2>
                        <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted small px-0 pb-3">
                                Sebagian besar tempat wisata di Dumai buka setiap hari dari jam 08:00 - 18:00 WIB, namun jam operasional dapat bervariasi tergantung pada jenis tempat wisata dan kebijakan pengelola.
                            </div>
                        </div>
                    </div>

                    {{-- FAQ 2 --}}
                    <div class="accordion-item border-bottom mb-2">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-semibold small px-0 shadow-none bg-transparent"
                                    type="button"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#faq2"
                                    aria-expanded="false"
                                    aria-controls="faq2">
                                Bagaimana cara mendaftarkan UMKM / Kuliner lokal?
                            </button>
                        </h2>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted small px-0 pb-3">
                                Anda dapat menghubungi kami via WhatsApp atau mengisi formulir kontak dengan memilih kategori "Kemitraan &amp; Kerjasama" agar tim kami segera memproses pendaftaran Anda.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ===================== GOOGLE MAPS EMBED ===================== --}}
    <div id="lokasi-kantor" class="p-4 border rounded-4 shadow-sm bg-white">
        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-3">
            <h4 class="fw-bold mb-0 fs-5"><i class="bi bi-map-fill text-primary me-2"></i>Lokasi Kantor Layanan</h4>
            <a href="https://maps.google.com/?q=Jl.+HR.+Soebrantas+No.+12,+Teluk+Binjai,+Kec.+Dumai+Timur,+Kota+Dumai,+Riau+28815"
               target="_blank"
               rel="noopener noreferrer"
               class="btn btn-outline-primary btn-sm rounded-pill px-3 py-2">
                <i class="bi bi-compass me-1"></i> Petunjuk Arah Google Maps
            </a>
        </div>
        <div class="map-container overflow-hidden rounded-3 border">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63820.61208922248!2d101.40871145!3d1.6740878!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d3a95be759ec11%3A0xb302dd39b9bc8f42!2sKota%20Dumai%2C%20Riau!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid"
                width="100%"
                height="380"
                style="border:0;"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </div>

</div>

@endsection