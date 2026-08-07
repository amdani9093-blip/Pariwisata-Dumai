@extends('layouts.app')
@section('body-class', 'page-destinasi-detail')
@section('title', $destinasi->nama . ' - Detail Destinasi')

@section('content')

    {{-- External Stylesheet --}}
    <link rel="stylesheet" href="{{ asset('css/destinasi-detail.css') }}">

    {{-- Style kecil khusus warna harga tiket, tombol edit, dan kartu atraksi.
         Tidak menimpa class apa pun dari destinasi-detail.css --}}
    <style>
        .price-tag {
            display: inline-flex;
            align-items: center;
            font-weight: 700;
            color: #f4a300;
        }
        .price-tag.gratis {
            color: #28a745;
        }

        .action-btn.btn-edit {
            color: #fff;
            background: linear-gradient(135deg, #f4a300, #ffb52e);
        }
        .action-btn.btn-edit:hover {
            color: #212529;
            box-shadow: 0 8px 20px rgba(244,163,0,.35);
        }
        .action-btn.btn-edit:hover i {
            transform: rotate(-8deg);
        }

        /* ===== Section Atraksi ===== */
        .detail-atraksi .section-title {
            position: relative;
            padding-bottom: .5rem;
            margin-bottom: 1.5rem;
            font-weight: 700;
        }
        .detail-atraksi .section-title::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: 0;
            width: 48px;
            height: 3px;
            border-radius: 3px;
            background: linear-gradient(135deg, #f4a300, #ffb52e);
        }

        .atraksi-card {
            border: none;
            border-radius: 14px;
            overflow: hidden;
            background: #fff;
            box-shadow: 0 2px 10px rgba(0,0,0,.06);
            transition: transform .25s ease, box-shadow .25s ease;
        }
        .atraksi-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 24px rgba(0,0,0,.12);
        }

        .atraksi-card .atraksi-img-wrap {
            position: relative;
            width: 100%;
            aspect-ratio: 4 / 3;
            overflow: hidden;
            background: #f1f1f1;
        }
        .atraksi-card .atraksi-img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .4s ease;
        }
        .atraksi-card:hover .atraksi-img-wrap img {
            transform: scale(1.08);
        }

        .atraksi-card .card-body {
            padding: 1rem 1.1rem 1.2rem;
        }
        .atraksi-card .card-title {
            font-weight: 600;
            font-size: 1rem;
            margin-bottom: .5rem;
            color: #212529;
        }
        .atraksi-card .badge-kategori {
            display: inline-block;
            padding: .35em .75em;
            font-size: .75rem;
            font-weight: 500;
            border-radius: 50px;
            background: #fff4e0;
            color: #b5760a;
        }

        .atraksi-empty {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: .5rem;
            padding: 2.5rem 1rem;
            width: 100%;
            border: 1px dashed #dee2e6;
            border-radius: 14px;
            color: #6c757d;
            background: #fafafa;
        }
        .atraksi-empty i {
            font-size: 1.75rem;
            color: #adb5bd;
        }
    </style>

    <div class="container py-5">

        {{-- ===================== BREADCRUMB ===================== --}}
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('beranda') }}">Beranda</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('destinasi') }}">Destinasi</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    {{ $destinasi->nama }}
                </li>
            </ol>
        </nav>

        {{-- ===================== KONTEN UTAMA ===================== --}}
        <div class="row g-4">

            {{-- Gambar destinasi --}}
            <div class="col-md-6">
                <div class="detail-image-wrap">
                    <span class="badge-status">
                        <span class="dot"></span>Sedang Buka
                    </span>
                    <img src="{{ asset('images/' . $destinasi->gambar) }}"
                         alt="{{ $destinasi->nama }}">
                </div>
            </div>

            {{-- Informasi destinasi --}}
            <div class="col-md-6">
                <h1 class="mb-3">{{ $destinasi->nama }}</h1>

                <p class="lead">{{ $destinasi->deskripsi }}</p>

                <ul class="list-group list-group-flush info-list mb-4">
                    <li class="list-group-item">
                        <span class="info-icon"><i class="bi bi-clock"></i></span>
                        <span>
                            <strong>Jam Operasional:</strong>
                            {{ $destinasi->jam_buka }} - {{ $destinasi->jam_tutup }}
                        </span>
                    </li>
                    <li class="list-group-item">
                        <span class="info-icon"><i class="bi bi-geo-alt"></i></span>
                        <span>
                            <strong>Lokasi:</strong> {{ $destinasi->lokasi }}
                        </span>
                    </li>
                    <li class="list-group-item">
                        <span class="info-icon"><i class="bi bi-ticket-perforated"></i></span>
                        <span>
                            <strong>Harga Tiket:</strong>
                            <span class="price-tag {{ $destinasi->harga_tiket == 0 ? 'gratis' : '' }}">
                                {{ $destinasi->harga_tiket == 0 ? 'Gratis' : 'Rp ' . number_format($destinasi->harga_tiket, 0, ',', '.') }}
                            </span>
                        </span>
                    </li>
                </ul>

                <div class="d-flex flex-wrap gap-2 align-items-center">
                    <a href="{{ route('destinasi') }}" class="action-btn btn-back">
                        <i class="bi bi-arrow-left"></i> Kembali ke Destinasi
                    </a>

                    <a href="{{ route('beranda') }}#kontak" class="action-btn btn-contact">
                        <i class="bi bi-chat-dots"></i> Hubungi Kami
                    </a>

                    <a href="{{ route('destinasi.edit', $destinasi->id) }}" class="action-btn btn-edit">
                        <i class="bi bi-pencil-square"></i> Edit
                    </a>

                    <form action="{{ route('destinasi.destroy', $destinasi->id) }}"
                          method="POST"
                          class="d-inline"
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

        {{-- ===================== ATRAKSI ===================== --}}
        <div class="detail-atraksi">
            <h2 class="section-title">Atraksi di Destinasi Ini</h2>

            <div class="row g-4">
                @forelse ($destinasi->atraksi as $atraksi)
                    <div class="col-6 col-md-4">
                        <div class="atraksi-card card h-100">
                            <div class="atraksi-img-wrap">
                                <img src="{{ asset('images/' . $atraksi->gambar) }}"
                                     alt="{{ $atraksi->nama }}"
                                     loading="lazy">
                            </div>
                            <div class="card-body">
                                <h6 class="card-title">{{ $atraksi->nama }}</h6>
                                <span class="badge-kategori">{{ $atraksi->kategori }}</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="atraksi-empty">
                        <i class="bi bi-emoji-frown"></i>
                        <span>Belum ada atraksi untuk destinasi ini.</span>
                    </div>
                @endforelse
            </div>
        </div>

    </div>

@endsection