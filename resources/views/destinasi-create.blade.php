{{--
    TEMPLATE FORM TAMBAH DESTINASI
    - Sudah dipercantik dengan tema warna hijau laut & biru awan
    - Yang TIDAK diubah: name="..." di setiap input, action route, @csrf
--}}

@extends('layouts.app')

@section('title', 'Tambah Destinasi')

@section('content')

<style>
    :root {
        --sea-green: #0d9488;
        --sea-green-dark: #0f766e;
        --sky-blue: #38bdf8;
        --sky-blue-dark: #0ea5e9;
    }

    .form-page-header {
        background: linear-gradient(135deg, var(--sea-green) 0%, var(--sky-blue) 100%);
        border-radius: 18px;
        padding: 40px 35px;
        color: #fff;
        margin-bottom: -60px;
        position: relative;
        z-index: 1;
    }
    .form-page-header h2 { font-weight: 700; margin-bottom: 4px; }
    .form-page-header p { opacity: .9; margin-bottom: 0; }

    .form-card {
        position: relative;
        z-index: 2;
        border: none;
        border-radius: 18px;
        box-shadow: 0 10px 35px rgba(13,148,136,.12);
    }

    .form-section-label {
        font-size: .8rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .5px;
        color: var(--sea-green-dark);
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .form-section-label::after {
        content: "";
        flex: 1;
        height: 1px;
        background: #e9ecef;
    }

    .form-label { font-weight: 600; color: #343a40; }

    .input-group-text {
        background: #eefbfa;
        border-right: none;
        color: var(--sea-green-dark);
    }
    .form-control, .form-select {
        border-left: none;
    }
    .form-control:focus, .form-select:focus {
        box-shadow: 0 0 0 .2rem rgba(56,189,248,.2);
        border-color: var(--sky-blue-dark);
    }
    .input-group:focus-within .input-group-text {
        border-color: var(--sky-blue-dark);
        color: var(--sea-green-dark);
    }
    textarea.form-control { border-left: 1px solid #ced4da; }

    .form-text { font-size: .8rem; }

    .btn-save {
        background: linear-gradient(135deg, var(--sea-green) 0%, var(--sky-blue-dark) 100%);
        border: none;
        color: #fff;
        font-weight: 600;
        padding: 10px 28px;
        border-radius: 10px;
        transition: opacity .2s ease, box-shadow .2s ease;
    }
    .btn-save:hover {
        opacity: .95;
        color: #fff;
        box-shadow: 0 8px 20px rgba(13,148,136,.35);
    }

    .btn-cancel {
        border-radius: 10px;
        font-weight: 600;
        padding: 10px 24px;
    }

    /* ===== Kotak info penghapusan ===== */
    .delete-info-box {
        background: #f0fdfa;
        border: 1px dashed var(--sea-green);
        border-radius: 14px;
        padding: 18px 20px;
        display: flex;
        gap: 14px;
        align-items: flex-start;
        margin-top: 28px;
    }
    .delete-info-box .info-icon {
        width: 40px; height: 40px;
        flex-shrink: 0;
        border-radius: 10px;
        background: linear-gradient(135deg, var(--sea-green), var(--sky-blue));
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
    }
    .delete-info-box h6 {
        font-weight: 700;
        color: var(--sea-green-dark);
        margin-bottom: 4px;
    }
    .delete-info-box p {
        color: #495057;
        font-size: .87rem;
        margin-bottom: 0;
        line-height: 1.6;
    }
</style>

<div class="container my-5">

    {{-- Breadcrumb navigasi --}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('beranda') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('destinasi') }}">Destinasi</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah Destinasi</li>
        </ol>
    </nav>

    <div class="row justify-content-center">
        <div class="col-lg-8">

            {{-- Header gradasi di belakang card --}}
            <div class="form-page-header">
                <h2><i class="bi bi-signpost-2"></i> Tambah Destinasi Baru</h2>
                <p>Lengkapi informasi destinasi wisata di bawah ini.</p>
            </div>

            <div class="card form-card">
                <div class="card-body p-4 p-md-5">

                    {{-- Pesan error validasi --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('destinasi.store') }}" method="POST">
                        @csrf

                        <p class="form-section-label">Informasi Utama</p>

                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Destinasi</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-geo"></i></span>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="nama"
                                    name="nama"
                                    value="{{ old('nama') }}"
                                    placeholder="contoh: Istana Siak Sri Indrapura"
                                    required
                                >
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-card-text"></i></span>
                                <textarea
                                    class="form-control"
                                    id="deskripsi"
                                    name="deskripsi"
                                    rows="4"
                                    placeholder="Ceritakan tentang destinasi ini..."
                                    required
                                >{{ old('deskripsi') }}</textarea>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="gambar" class="form-label">Nama File Gambar</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-image"></i></span>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="gambar"
                                    name="gambar"
                                    value="{{ old('gambar') }}"
                                    placeholder="contoh: istana-siak.jpg"
                                    required
                                >
                            </div>
                            <div class="form-text">
                                Sementara isi nama file gambar yang sudah tersedia di folder public/images.
                            </div>
                        </div>

                        <p class="form-section-label">Jadwal &amp; Lokasi</p>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="jam_buka" class="form-label">Jam Buka</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-clock"></i></span>
                                    <input
                                        type="time"
                                        class="form-control"
                                        id="jam_buka"
                                        name="jam_buka"
                                        value="{{ old('jam_buka') }}"
                                        required
                                    >
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="jam_tutup" class="form-label">Jam Tutup</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-clock-history"></i></span>
                                    <input
                                        type="time"
                                        class="form-control"
                                        id="jam_tutup"
                                        name="jam_tutup"
                                        value="{{ old('jam_tutup') }}"
                                        required
                                    >
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="lokasi" class="form-label">Lokasi</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-pin-map"></i></span>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="lokasi"
                                    name="lokasi"
                                    value="{{ old('lokasi') }}"
                                    placeholder="contoh: Kecamatan Siak, Kabupaten Siak"
                                >
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-save">
                                <i class="bi bi-check2-circle"></i> Simpan Destinasi
                            </button>
                            <a href="{{ route('destinasi') }}" class="btn btn-outline-secondary btn-cancel">
                                Batal
                            </a>
                        </div>

                    </form>

                    {{-- ===== Info penghapusan ===== --}}
                    <div class="delete-info-box">
                        <div class="info-icon"><i class="bi bi-info-circle"></i></div>
                        <div>
                            <h6>Tentang Penghapusan Destinasi</h6>
                            <p>
                                Destinasi yang sudah disimpan dapat dihapus kapan saja lewat halaman detail
                                destinasi tersebut. Menghapus destinasi akan menghapus datanya secara permanen,
                                jadi pastikan file gambar yang kamu masukkan namanya di atas juga sudah benar
                                sebelum disimpan.
                            </p>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

</div>
@endsection