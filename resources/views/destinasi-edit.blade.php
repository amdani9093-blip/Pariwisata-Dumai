{{--
    TEMPLATE FORM EDIT DESTINASI
    - Full Bootstrap 5, TIDAK ada CSS custom sama sekali
    - Setelah paham alurnya, silakan re-desain halaman ini sendiri (boleh dibantu AI)
    - Yang TIDAK BOLEH diubah: name="...", value="{{ $destinasi->... }}",
      @method('PUT'), dan action route
--}}

@extends('layouts.app')

@section('title', 'Edit ' . $destinasi->nama)

@section('content')
<div class="container my-5">

    {{-- Breadcrumb navigasi (komponen bawaan Bootstrap) --}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('beranda') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('destinasi') }}">Destinasi</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit {{ $destinasi->nama }}</li>
        </ol>
    </nav>

    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card shadow-sm">
                <div class="card-body p-4">

                    <h2 class="card-title mb-4">Edit Destinasi</h2>

                    {{-- Tampilkan pesan error validasi kalau ada --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('destinasi.update', $destinasi->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Destinasi</label>
                            <input
                                type="text"
                                class="form-control"
                                id="nama"
                                name="nama"
                                value="{{ old('nama', $destinasi->nama) }}"
                                required
                            >
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            {{-- Perhatikan: isi textarea ditaruh DI ANTARA tag, bukan di value --}}
                            <textarea
                                class="form-control"
                                id="deskripsi"
                                name="deskripsi"
                                rows="4"
                                required
                            >{{ old('deskripsi', $destinasi->deskripsi) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="gambar" class="form-label">Nama File Gambar</label>
                            <input
                                type="text"
                                class="form-control"
                                id="gambar"
                                name="gambar"
                                value="{{ old('gambar', $destinasi->gambar) }}"
                                required
                            >
                            <div class="form-text">
                                Nama file gambar yang tersimpan di folder public/images.
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="jam_buka" class="form-label">Jam Buka</label>
                                <input
                                    type="time"
                                    class="form-control"
                                    id="jam_buka"
                                    name="jam_buka"
                                    value="{{ old('jam_buka', $destinasi->jam_buka) }}"
                                    required
                                >
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="jam_tutup" class="form-label">Jam Tutup</label>
                                <input
                                    type="time"
                                    class="form-control"
                                    id="jam_tutup"
                                    name="jam_tutup"
                                    value="{{ old('jam_tutup', $destinasi->jam_tutup) }}"
                                    required
                                >
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="lokasi" class="form-label">Lokasi</label>
                            <input
                                type="text"
                                class="form-control"
                                id="lokasi"
                                name="lokasi"
                                value="{{ old('lokasi', $destinasi->lokasi) }}"
                            >
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                Simpan Perubahan
                            </button>
                            <a href="{{ route('destinasi.detail', $destinasi->id) }}" class="btn btn-outline-secondary">
                                Batal
                            </a>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

</div>
@endsection
