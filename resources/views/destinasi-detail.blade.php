@extends('layouts.app')
@section('body-class', 'page-destinasi-detail')
@section('title', $destinasi->nama . ' - Detail Destinasi')

@section('content')

    {{-- External Stylesheet --}}
    <link rel="stylesheet" href="{{ asset('css/destinasi-detail.css') }}">

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
                </ul>

                <div class="d-flex flex-wrap gap-2 align-items-center">
                    <a href="{{ route('destinasi') }}" class="action-btn btn-back">
                        <i class="bi bi-arrow-left"></i> Kembali ke Destinasi
                    </a>

                    <a href="{{ route('beranda') }}#kontak" class="action-btn btn-contact">
                        <i class="bi bi-chat-dots"></i> Hubungi Kami
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

    </div>

@endsection