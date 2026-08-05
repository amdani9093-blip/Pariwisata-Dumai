@extends('layouts.app')
@section('body-class', 'page-kontak')
@section('title', 'Hubungi Kami - Wisata Kota Dumai')

@section('content')

<!-- External Stylesheet -->
<link rel="stylesheet" href="{{ asset('css/kontak.css') }}">

<!-- ================= HERO HEADER ================= -->
<section class="contact-hero text-center mb-5">
    <div class="container">
        <span class="badge bg-white text-dark px-3 py-2 rounded-pill fw-bold text-uppercase mb-3" style="font-size: 0.75rem; letter-spacing: 1px;">Pusat Bantuan &amp; Layanan</span>
        <h1 class="fw-bold display-5">Hubungi Kami</h1>
        <p class="lead mx-auto" style="max-width: 650px; opacity: 0.9;">
            Punya pertanyaan seputar tempat wisata, agenda festival, atau saran untuk Kota Dumai? Tim kami siap membantu Anda.
        </p>
    </div>
</section>

<div class="container pb-5">

    {{-- ===================== INFORMASI KONTAK ===================== --}}
    <div class="row g-4 mb-5">
        {{-- Card Alamat Kantor --}}
        <div class="col-md-4">
            <a href="#lokasi-kantor" class="text-decoration-none text-dark">
                <div class="contact-info-card h-100 position-relative" style="cursor: pointer;">
                    <div class="contact-icon-box">
                        <i class="bi bi-geo-alt-fill"></i>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <h5 class="fw-bold mb-0">Alamat Kantor</h5>
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
            <a href="https://wa.me/6285278776696" target="_blank" rel="noopener noreferrer" class="text-decoration-none text-dark">
                <div class="contact-info-card h-100 position-relative" style="cursor: pointer;">
                    <div class="contact-icon-box">
                        <i class="bi bi-whatsapp"></i>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <h5 class="fw-bold mb-0">WhatsApp &amp; Telepon</h5>
                        <span class="badge bg-light text-success border small">
                            <i class="bi bi-chat-dots me-1"></i> Chat
                        </span>
                    </div>
                    <p class="text-muted small mb-1 fw-bold text-dark">+62 852-7877-6696</p>
                    <p class="text-muted small mb-0">Senin - Minggu: 08:00 - 18:00 WIB</p>
                </div>
            </a>
        </div>

        {{-- Card Email --}}
        <div class="col-md-4">
            <a href="mailto:amdani9093@gmail.com" class="text-decoration-none text-dark">
                <div class="contact-info-card h-100 position-relative" style="cursor: pointer;">
                    <div class="contact-icon-box">
                        <i class="bi bi-envelope-paper-fill"></i>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <h5 class="fw-bold mb-0">Email Resmi</h5>
                        <span class="badge bg-light text-danger border small">
                            <i class="bi bi-send me-1"></i> Kirim
                        </span>
                    </div>
                    <p class="text-muted small mb-1 fw-bold text-dark">amdani9093@gmail.com</p>
                    <p class="text-muted small mb-0">Respons cepat dalam 1x24 jam kerja.</p>
                </div>
            </a>
        </div>
    </div>

    {{-- ===================== FORM PESAN & FAQ ===================== --}}
    <div class="row g-4 mb-5">
        {{-- Formulir Pesan --}}
        <div class="col-lg-7">
            <div class="form-card">
                <h3 class="fw-bold mb-1">Kirim Pesan Anda</h3>
                <p class="text-muted mb-4 small">Isi formulir di bawah ini dan kami akan membalas secepatnya.</p>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form action="#" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control" placeholder="Masukkan nama Anda" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Alamat Email</label>
                            <input type="email" name="email" class="form-control" placeholder="nama@email.com" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold small">Kategori Pertanyaan</label>
                            <select name="kategori" class="form-select" required>
                                <option value="" selected disabled>Pilih Kategori...</option>
                                <option value="Informasi Wisata">Informasi Tempat Wisata</option>
                                <option value="Agenda Festival">Agenda Festival / Acara</option>
                                <option value="Kemitraan & Kerjasama">Kemitraan &amp; Kerjasama</option>
                                <option value="Kritik & Saran">Kritik &amp; Saran</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold small">Pesan Anda</label>
                            <textarea name="pesan" rows="4" class="form-control" placeholder="Tuliskan pertanyaan atau pesan Anda di sini..." required></textarea>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn-submit-modern w-100">
                                <i class="bi bi-send-fill"></i> Kirim Pesan Sekarang
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- FAQ Singkat --}}
        <div class="col-lg-5">
            <div class="contact-info-card">
                <h5 class="fw-bold mb-3"><i class="bi bi-question-circle text-primary me-2"></i>Pertanyaan Umum</h5>
                <div class="accordion accordion-flush" id="faqAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-semibold small" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                Apakah destinasi wisata Dumai buka setiap hari?
                            </button>
                        </h2>
                        <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted small">
                                Sebagian besar tempat wisata buka setiap hari dari jam 08:00 - 18:00 WIB. Rincian jam dapat dilihat pada halaman detail destinasi.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-semibold small" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                Bagaimana cara mendaftarkan UMKM / Kuliner lokal?
                            </button>
                        </h2>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted small">
                                Anda dapat mengontak kami via WhatsApp atau mengisi formulir kontak dengan memilih kategori "Kemitraan &amp; Kerjasama".
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ===================== GOOGLE MAPS EMBED ===================== --}}
    <div id="lokasi-kantor">
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h4 class="fw-bold mb-0"><i class="bi bi-map-fill text-primary me-2"></i>Lokasi Kantor Layanan</h4>
            <a href="https://maps.google.com/?q=Jl.+HR.+Soebrantas+No.+12,+Teluk+Binjai,+Kec.+Dumai+Timur,+Kota+Dumai,+Riau+28815" 
               target="_blank" 
               class="btn btn-outline-primary btn-sm rounded-pill">
                <i class="bi bi-compass me-1"></i> Petunjuk Arah Google Maps
            </a>
        </div>
        <div class="map-container">
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