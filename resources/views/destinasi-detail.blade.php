@extends('layouts.app')

@section('title', $destinasi->nama . ' - Detail Destinasi')

@section('content')

<style>
    /* ===== Gambar & badge status ===== */
    .detail-image-wrap {
        position: relative;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 12px 35px rgba(0,0,0,.12);
    }
    .detail-image-wrap img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform .5s ease;
    }
    .detail-image-wrap:hover img { transform: scale(1.06); }
    .detail-image-wrap .badge-status {
        position: absolute;
        top: 16px; left: 16px;
        background: #28a745;
        color: #fff;
        padding: 6px 14px;
        border-radius: 30px;
        font-size: .8rem;
        font-weight: 600;
        box-shadow: 0 4px 12px rgba(40,167,69,.4);
    }
    .badge-status .dot {
        display: inline-block;
        width: 8px; height: 8px;
        border-radius: 50%;
        background: #fff;
        margin-right: 6px;
        animation: pulse-dot 1.4s infinite;
    }
    @keyframes pulse-dot {
        0%   { box-shadow: 0 0 0 0 rgba(255,255,255,.7); }
        70%  { box-shadow: 0 0 0 6px rgba(255,255,255,0); }
        100% { box-shadow: 0 0 0 0 rgba(255,255,255,0); }
    }

    /* ===== Info list ===== */
    .info-list .list-group-item {
        border: none;
        border-bottom: 1px solid #f0f0f0;
        padding: 14px 4px;
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .info-list .info-icon {
        width: 38px; height: 38px;
        border-radius: 10px;
        background: #eaf4fa;
        color: #0a5c8a;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    /* ===== Tombol aksi animasi (kembali & hubungi) ===== */
    .action-btn {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 12px 22px;
        border-radius: 12px;
        font-weight: 600;
        text-decoration: none;
        transition: all .25s ease;
        overflow: hidden;
        position: relative;
    }
    .action-btn i { font-size: 1.15rem; transition: transform .3s ease; }

    .action-btn.btn-back {
        color: #0a5c8a;
        background: #eaf4fa;
    }
    .action-btn.btn-back:hover {
        background: #0a5c8a;
        color: #fff;
    }
    .action-btn.btn-back:hover i { transform: translateX(-5px); }

    .action-btn.btn-contact {
        color: #fff;
        background: linear-gradient(135deg, #0a5c8a, #17a2b8);
    }
    .action-btn.btn-contact:hover {
        color: #fff;
        box-shadow: 0 8px 20px rgba(10,92,138,.35);
    }
    .action-btn.btn-contact:hover i { transform: translateY(-3px) rotate(-8deg); }

    /* ===== Fasilitas ===== */
    .facility-box {
        text-align: center;
        padding: 22px 10px;
        border-radius: 14px;
        background: #fff;
        border: 1px solid #f0f0f0;
        transition: transform .25s ease, box-shadow .25s ease;
    }
    .facility-box:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 24px rgba(0,0,0,.08);
    }
    .facility-box i {
        font-size: 1.6rem;
        color: #0a5c8a;
        display: block;
        margin-bottom: 8px;
        transition: transform .3s ease;
    }
    .facility-box:hover i { transform: scale(1.2) rotate(6deg); }

    /* ===== Zona hapus ===== */
    .danger-zone {
        border: 1px dashed #f1aeb5;
        background: #fff8f8;
        border-radius: 14px;
    }
    .btn-delete {
        display: flex;
        align-items: center;
        gap: 8px;
        background: #dc3545;
        color: #fff;
        border: none;
        padding: 10px 22px;
        border-radius: 10px;
        font-weight: 600;
        transition: background .2s ease;
    }
    .btn-delete i { transition: transform .3s ease; }
    .btn-delete:hover { background: #bb2d3b; color: #fff; }
    .btn-delete:hover i { animation: shake-trash .5s ease; }
    @keyframes shake-trash {
        0%, 100% { transform: rotate(0); }
        25%      { transform: rotate(-12deg); }
        50%      { transform: rotate(10deg); }
        75%      { transform: rotate(-6deg); }
    }
</style>

<div class="container py-5">

    {{-- ===================== BREADCRUMB ===================== --}}
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('beranda') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('destinasi') }}">Destinasi</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $destinasi->nama }}</li>
        </ol>
    </nav>

    {{-- ===================== KONTEN UTAMA ===================== --}}
    <div class="row g-4">

        {{-- Gambar destinasi --}}
        <div class="col-md-6">
            <div class="detail-image-wrap" style="height: 100%; min-height: 320px;">
                <span class="badge-status"><span class="dot"></span>Sedang Buka</span>
                <img src="{{ asset('images/' . $destinasi->gambar) }}" alt="{{ $destinasi->nama }}">
            </div>
        </div>

        {{-- Informasi destinasi --}}
        <div class="col-md-6">
            <h1 class="mb-3">{{ $destinasi->nama }}</h1>

            <p class="lead">
                {{ $destinasi->deskripsi }}
            </p>

            <ul class="list-group list-group-flush info-list mb-4">
                <li class="list-group-item">
                    <span class="info-icon"><i class="bi bi-clock"></i></span>
                    <span><strong>Jam Operasional:</strong> {{ $destinasi->jam_buka . ' - ' . $destinasi->jam_tutup }}</span>
                </li>
                <li class="list-group-item">
                    <span class="info-icon"><i class="bi bi-geo-alt"></i></span>
                    <span><strong>Lokasi:</strong> {{ $destinasi->lokasi }}</span>
                </li>
            </ul>

            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('destinasi') }}" class="action-btn btn-back">
                    <i class="bi bi-arrow-left"></i> Kembali ke Destinasi
                </a>
                <a href="{{ route('beranda') }}#kontak" class="action-btn btn-contact">
                    <i class="bi bi-chat-dots"></i> Hubungi Kami
                </a>
        <form action="{{ route('destinasi.destroy', $destinasi->id) }}"
              method="POST"
              onsubmit="return confirm('Yakin ingin menghapus {{ $destinasi->nama }} beserta gambarnya? Tindakan ini tidak bisa dibatalkan.')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-delete">
                <i class="bi bi-trash"></i> Hapus
            </button>
        </form>
            </div>
        </div>
    </div>

    <hr class="my-5">

    {{-- ===================== FASILITAS ===================== --}}
    <h5 class="mb-3">Fasilitas Tersedia</h5>
    <div class="row row-cols-2 row-cols-md-4 g-3">
        <div class="col">
            <div class="facility-box">
                <i class="bi bi-p-circle"></i>
                Area Parkir
            </div>
        </div>
        <div class="col">
            <div class="facility-box">
                <i class="bi bi-house-door"></i>
                Toilet Umum
            </div>
        </div>
        <div class="col">
            <div class="facility-box">
                <i class="bi bi-shop"></i>
                Warung/Kios
            </div>
        </div>
        <div class="col">
            <div class="facility-box">
                <i class="bi bi-camera"></i>
                Spot Foto
            </div>
        </div>
    </div>

    <hr class="my-5">

</div>

@endsection