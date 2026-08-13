{{--
    TEMPLATE FORM EDIT DESTINASI
    - Yang TIDAK BOLEH diubah: name="...", value="{{ $destinasi->... }}",
      @method('PUT'), dan action route
    - Jam buka/tutup pakai <select> dropdown berisi pilihan waktu per 30 menit
--}}

@extends('layouts.app')

@section('title', 'Edit ' . $destinasi->nama)

@section('content')

{{-- Bootstrap Icons dibutuhkan untuk ikon di halaman ini.
     Kalau layouts.app Anda SUDAH memuat Bootstrap Icons, baris ini boleh dihapus. --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
<link rel="stylesheet" href="{{ asset('css/destinasi-edit.css') }}">

<div class="container my-5">

    {{-- Breadcrumb navigasi --}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('beranda') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('destinasi') }}">Destinasi</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit {{ $destinasi->nama }}</li>
        </ol>
    </nav>

    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card edit-destinasi-card shadow-sm">

                <div class="edit-destinasi-header">
                    <div class="icon-circle">
                        <i class="bi bi-pencil-square"></i>
                    </div>
                    <h2 class="fw-bold h4 mb-1">Edit Destinasi</h2>
                    <p class="mb-0 small opacity-75">Perbarui informasi untuk {{ $destinasi->nama }}.</p>
                </div>

                <div class="edit-destinasi-body">

                    {{-- Tampilkan pesan error validasi kalau ada --}}
                    @if ($errors->any())
                        <div class="alert alert-danger rounded-3">
                            <div class="fw-semibold mb-1">
                                <i class="bi bi-exclamation-triangle-fill me-1"></i>
                                Terjadi kesalahan, mohon periksa kembali isian Anda:
                            </div>
                            <ul class="mb-0 small">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('destinasi.update', $destinasi->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- ===== Informasi Utama ===== --}}
                        <div class="form-section-label">
                            <i class="bi bi-info-circle"></i> Informasi Utama
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Kategori</label>
                            <select name="kategori_id" class="form-select @error('kategori_id') is-invalid @enderror">
                                <option value="" selected disabled>-- Pilih Kategori --</option>
                                @foreach ($kategoriList as $kategori)
                                    <option value="{{ $kategori->id }}"
                                        {{ old('kategori_id', $destinasi->kategori_id) == $kategori->id ? 'selected' : '' }}>
                                        {{ $kategori->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="text-muted">Biarkan seperti semula jika tidak ingin mengubah kategori.</small>
                            @error('kategori_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

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

                        {{-- ===== Foto Destinasi ===== --}}
                        <div class="form-section-label">
                            <i class="bi bi-image"></i> Foto Destinasi
                        </div>

                        <div class="mb-3">
                            <div class="gambar-edit-wrap">
                                {{-- Preview gambar yang sedang aktif, supaya kelihatan
                                     file mana yang sedang dipakai sebelum diganti --}}
                                <div class="gambar-preview-box @if(empty($destinasi->gambar)) no-image @endif" id="gambarPreviewBox">
                                    @if(!empty($destinasi->gambar))
                                        <img
                                            id="gambarPreviewImg"
                                            src="{{ asset('storage/' . $destinasi->gambar) }}"
                                            alt="Gambar saat ini: {{ $destinasi->nama }}"
                                            onerror="this.onerror=null; this.closest('.gambar-preview-box').classList.add('no-image'); this.replaceWith(Object.assign(document.createElement('div'), {className:'small text-danger p-2 text-center', innerText:'File tidak ditemukan'}));"
                                        >
                                    @else
                                        <i class="bi bi-image" id="gambarPreviewIcon"></i>
                                    @endif
                                    <div class="gambar-preview-overlay">
                                        <i class="bi bi-camera-fill"></i> Ganti Foto
                                    </div>
                                </div>

                                <div class="gambar-upload-col">
                                    <label for="gambar" class="form-label">Ganti Gambar (opsional)</label>
                                    <input
                                        type="file"
                                        name="gambar"
                                        id="gambar"
                                        class="form-control"
                                        accept="image/*"
                                        onchange="previewGambarDestinasi(this)"
                                    >
                                    <div class="gambar-upload-hint">
                                        Biarkan kosong kalau tidak ingin mengganti gambar. Format JPG/PNG, disimpan di folder <code>public/images</code>.
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- ===== Jam Operasional ===== --}}
                        <div class="form-section-label">
                            <i class="bi bi-clock"></i> Jam Operasional
                        </div>

                        @php
                            $jamOptions = [];
                            for ($h = 0; $h < 24; $h++) {
                                foreach ([0, 30] as $m) {
                                    $val = sprintf('%02d:%02d', $h, $m);
                                    $jamOptions[] = $val;
                                }
                            }

                            $jamBukaSelected  = old('jam_buka', $destinasi->jam_buka);
                            $jamTutupSelected = old('jam_tutup', $destinasi->jam_tutup);

                            // Format H:i:s dari database (mis. "08:00:00") disamakan jadi "08:00"
                            // supaya cocok dengan value di <option>.
                            if ($jamBukaSelected) {
                                $jamBukaSelected = \Illuminate\Support\Str::of($jamBukaSelected)->substr(0, 5);
                            }
                            if ($jamTutupSelected) {
                                $jamTutupSelected = \Illuminate\Support\Str::of($jamTutupSelected)->substr(0, 5);
                            }
                        @endphp

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="jam_buka" class="form-label">Jam Buka</label>
                                <select
                                    class="form-select"
                                    id="jam_buka"
                                    name="jam_buka"
                                    required
                                >
                                    <option value="" disabled {{ !$jamBukaSelected ? 'selected' : '' }}>
                                        Pilih jam buka
                                    </option>
                                    @foreach ($jamOptions as $jam)
                                        <option
                                            value="{{ $jam }}"
                                            {{ (string) $jamBukaSelected === $jam ? 'selected' : '' }}
                                        >
                                            {{ $jam }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="jam_tutup" class="form-label">Jam Tutup</label>
                                <select
                                    class="form-select"
                                    id="jam_tutup"
                                    name="jam_tutup"
                                    required
                                >
                                    <option value="" disabled {{ !$jamTutupSelected ? 'selected' : '' }}>
                                        Pilih jam tutup
                                    </option>
                                    @foreach ($jamOptions as $jam)
                                        <option
                                            value="{{ $jam }}"
                                            {{ (string) $jamTutupSelected === $jam ? 'selected' : '' }}
                                        >
                                            {{ $jam }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="form-text">
                                    Jam tutup harus lebih besar dari jam buka.
                                </div>
                            </div>
                        </div>

                        {{-- ===== Lokasi & Harga ===== --}}
                        <div class="form-section-label">
                            <i class="bi bi-geo-alt"></i> Lokasi &amp; Harga
                        </div>

                        <div class="mb-3">
                            <label for="lokasi" class="form-label">Lokasi</label>
                            <input
                                type="text"
                                class="form-control"
                                id="lokasi"
                                name="lokasi"
                                value="{{ old('lokasi', $destinasi->lokasi) }}"
                            >
                        </div>

                        <div class="mb-4">
                            <label for="harga_tiket" class="form-label">Harga Tiket</label>
                            <div class="input-group harga-input-group">
                                <span class="input-group-text">Rp</span>
                                <input
                                    type="number"
                                    class="form-control"
                                    id="harga_tiket"
                                    name="harga_tiket"
                                    value="{{ old('harga_tiket', $destinasi->harga_tiket) }}"
                                    min="0"
                                >
                            </div>
                            <div class="form-text">
                                Isi 0 kalau destinasi ini gratis.
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-submit-destinasi px-4">
                                <i class="bi bi-check-lg me-1"></i> Simpan Perubahan
                            </button>
                            <a href="{{ route('destinasi.detail', $destinasi->id) }}" class="btn btn-cancel-destinasi px-4">
                                Batal
                            </a>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

</div>

<script>
    function previewGambarDestinasi(input) {
        const box = document.getElementById('gambarPreviewBox');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                box.classList.remove('no-image');
                box.innerHTML = `
                    <img id="gambarPreviewImg" src="${e.target.result}" alt="Preview gambar baru">
                    <div class="gambar-preview-overlay"><i class="bi bi-camera-fill"></i> Ganti Foto</div>
                `;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

@endsection