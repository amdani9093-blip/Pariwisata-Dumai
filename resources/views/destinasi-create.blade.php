{{--
    TEMPLATE FORM TAMBAH DESTINASI
    - Sudah dipercantik dengan tema warna hijau laut & biru awan
    - Yang TIDAK diubah: name="..." di setiap input, action route, @csrf
--}}

@extends('layouts.app')

@section('title', 'Tambah Destinasi')

@section('content')



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

                    <form action="{{ route('destinasi.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <p class="form-section-label">Informasi Utama</p>

<div class="mb-3">
    <label class="form-label">Kategori <span class="text-danger">*</span></label>
    <select name="kategori_id" class="form-select @error('kategori_id') is-invalid @enderror">
        <option value="" selected disabled>-- Pilih Kategori --</option>
        @foreach ($kategoriList as $kategori)
            <option value="{{ $kategori->id }}"
                {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                {{ $kategori->nama_kategori }}
            </option>
        @endforeach
    </select>
    @error('kategori_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>


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
                               <input type="file" name="gambar" class="form-control" accept="image/*" required>
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
                        /*daftar harga tiket*/
                    <div class="mb-4">
                        <label class="form-label">Harga Tiket (Rp)</label>
                        <input type="number" name="harga_tiket" class="form-control"
                            placeholder="contoh: 10000" min="0">
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