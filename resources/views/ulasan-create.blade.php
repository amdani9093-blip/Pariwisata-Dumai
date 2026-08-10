@extends('layouts.app')

@section('title', 'Tulis Ulasan - ' . $destinasi->nama)

@section('content')

{{-- Bootstrap Icons dibutuhkan untuk ikon & bintang rating di halaman ini.
     Kalau layouts.app Anda SUDAH memuat Bootstrap Icons, baris ini boleh dihapus. --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<style>
    .review-form-card {
        border: none;
        border-radius: 1.25rem;
        overflow: hidden;
    }
    .review-form-header {
        background: linear-gradient(135deg, #0a5c8a, #17a2b8);
        color: #fff;
        padding: 2rem 2rem 1.5rem;
    }
    .review-form-header .icon-circle {
        width: 52px;
        height: 52px;
        border-radius: 50%;
        background: rgba(255,255,255,.18);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        margin-bottom: .75rem;
    }
    .review-form-body {
        padding: 2rem;
    }
    .review-form-body .form-control,
    .review-form-body .form-select {
        border-color: #dfe6ea;
        padding: .6rem .9rem;
        transition: border-color .2s ease, box-shadow .2s ease;
    }
    .review-form-body .form-control:focus,
    .review-form-body .form-select:focus {
        border-color: #17a2b8;
        box-shadow: 0 0 0 .2rem rgba(23,162,184,.15);
    }
    .form-label {
        font-weight: 600;
        font-size: .9rem;
    }
    .btn-submit-review {
        background: linear-gradient(135deg, #0a5c8a, #17a2b8);
        border: none;
        color: #fff;
        transition: transform .2s ease, box-shadow .2s ease;
    }
    .btn-submit-review:hover {
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(10,92,138,.25);
    }

    /* ===================== RATING BINTANG (CSS murni, tanpa JS) ===================== */
    .star-rating {
        display: flex;
        flex-direction: row-reverse; /* dibalik supaya trik ~ (sibling setelahnya) bisa menyorot bintang sebelah kiri saat hover */
        justify-content: flex-end;
        gap: .15rem;
    }
    .star-rating input {
        position: absolute;
        opacity: 0;
        width: 0;
        height: 0;
    }
    .star-rating label {
        cursor: pointer;
        font-size: 2.1rem;
        line-height: 1;
        color: #dee2e6;
        transition: color .15s ease, transform .15s ease;
    }
    .star-rating label:hover {
        transform: scale(1.12);
    }
    .star-rating input:checked ~ label,
    .star-rating label:hover,
    .star-rating label:hover ~ label {
        color: #ffc107;
    }
    .star-rating-row {
        display: flex;
        align-items: center;
        gap: .75rem;
        flex-wrap: wrap;
    }
    .star-rating-value {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 2.75rem;
        padding: .3rem .65rem;
        border-radius: 999px;
        background: #fff8e1;
        color: #b8860b;
        font-weight: 700;
        font-size: .95rem;
        border: 1px solid #ffe4a1;
    }
    .star-rating-caption {
        font-size: .85rem;
        color: #6c757d;
        margin-top: .35rem;
    }
</style>

<div class="container my-5">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('beranda') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('destinasi.detail', $destinasi->id) }}">{{ $destinasi->nama }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tulis Ulasan</li>
        </ol>
    </nav>

    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card review-form-card shadow-sm">

                <div class="review-form-header">
                    <div class="icon-circle">
                        <i class="bi bi-chat-square-heart-fill"></i>
                    </div>
                    <h2 class="fw-bold h4 mb-1">Tulis Ulasan</h2>
                    <p class="mb-0 small opacity-75">Bagikan pengalaman Anda tentang {{ $destinasi->nama }}</p>
                </div>

                <div class="review-form-body">

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

                    <form action="{{ route('ulasan.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="destinasi_id" value="{{ $destinasi->id }}">

                        <div class="mb-3">
                            <label class="form-label">
                                <i class="bi bi-person-fill me-1"></i> Menulis sebagai
                            </label>
                            <select name="user_id" class="form-select @error('user_id') is-invalid @enderror">
                                <option value="" selected disabled>-- Pilih Nama --</option>
                                @foreach ($userList as $user)
                                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">
                                <i class="bi bi-star-fill me-1 text-warning"></i> Rating
                            </label>

                            <div class="star-rating-row">
                                <div class="star-rating" id="starRatingGroup">
                                    <input type="radio" id="star5" name="rating" value="5" required {{ old('rating') == 5 ? 'checked' : '' }}>
                                    <label for="star5" title="5 - Sangat Bagus"><i class="bi bi-star-fill"></i></label>

                                    <input type="radio" id="star4" name="rating" value="4" required {{ old('rating') == 4 ? 'checked' : '' }}>
                                    <label for="star4" title="4 - Bagus"><i class="bi bi-star-fill"></i></label>

                                    <input type="radio" id="star3" name="rating" value="3" required {{ old('rating') == 3 ? 'checked' : '' }}>
                                    <label for="star3" title="3 - Cukup"><i class="bi bi-star-fill"></i></label>

                                    <input type="radio" id="star2" name="rating" value="2" required {{ old('rating') == 2 ? 'checked' : '' }}>
                                    <label for="star2" title="2 - Kurang"><i class="bi bi-star-fill"></i></label>

                                    <input type="radio" id="star1" name="rating" value="1" required {{ old('rating') == 1 ? 'checked' : '' }}>
                                    <label for="star1" title="1 - Buruk"><i class="bi bi-star-fill"></i></label>
                                </div>

                                {{-- Badge angka yang mengikuti bintang yang dipilih --}}
                                <span id="starRatingValue" class="star-rating-value">
                                    {{ old('rating') ? old('rating') . ' / 5' : '- / 5' }}
                                </span>
                            </div>
                            <div class="star-rating-caption">Klik bintang untuk memberi nilai (1 - 5).</div>

                            @error('rating')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label">
                                <i class="bi bi-chat-left-text-fill me-1"></i> Komentar
                            </label>
                            <textarea name="komentar" class="form-control @error('komentar') is-invalid @enderror"
                                      rows="4" placeholder="Ceritakan pengalaman Anda...">{{ old('komentar') }}</textarea>
                            @error('komentar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-submit-review px-4">
                                <i class="bi bi-send-fill me-1"></i> Kirim Ulasan
                            </button>
                            <a href="{{ route('destinasi.detail', $destinasi->id) }}" class="btn btn-outline-secondary px-4">
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
    document.addEventListener('DOMContentLoaded', function () {
        var starGroup = document.getElementById('starRatingGroup');
        var valueBadge = document.getElementById('starRatingValue');
        if (!starGroup || !valueBadge) return;

        starGroup.querySelectorAll('input[name="rating"]').forEach(function (input) {
            input.addEventListener('change', function () {
                valueBadge.textContent = this.value + ' / 5';
            });
        });
    });
</script>
@endsection