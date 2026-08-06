{{--
    TEMPLATE FORM EDIT DESTINASI
    - Full Bootstrap 5, TIDAK ada CSS custom sama sekali
    - Setelah paham alurnya, silakan re-desain halaman ini sendiri (boleh dibantu AI)
    - Yang TIDAK BOLEH diubah: name="...", value="{{ $destinasi->... }}",
      @method('PUT'), dan action route
    - Jam buka/tutup diganti dari <input type="time"> menjadi <select> dropdown
      berisi pilihan waktu per 30 menit, supaya user tinggal pilih dari daftar,
      tidak perlu klik jam & menit satu-satu di time picker bawaan browser.
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

                            {{-- Preview gambar yang sedang aktif, supaya kelihatan
                                 file mana yang sedang dipakai sebelum diganti --}}
                            @if(!empty($destinasi->gambar))
                                <div class="mb-2">
                                    <img
                                        src="{{ asset('images/' . $destinasi->gambar) }}"
                                        alt="Gambar saat ini: {{ $destinasi->nama }}"
                                        class="rounded border"
                                        style="width: 160px; height: 110px; object-fit: cover;"
                                        onerror="this.onerror=null; this.replaceWith(Object.assign(document.createElement('div'), {className:'small text-danger border rounded p-2', innerText:'File \'{{ $destinasi->gambar }}\' tidak ditemukan di folder public/images.'}));"
                                    >
                                </div>
                            @endif

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
                            <div class="input-group">
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