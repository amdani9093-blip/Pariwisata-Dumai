@extends('layouts.app')

@section('title', 'Tambah User')

@section('content')

{{-- Bootstrap Icons dibutuhkan untuk ikon di halaman ini.
     Kalau layouts.app Anda SUDAH memuat Bootstrap Icons, baris ini boleh dihapus. --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<style>
    .user-form-card {
        border: none;
        border-radius: 1.25rem;
        overflow: hidden;
    }
    .user-form-header {
        background: linear-gradient(135deg, #0a5c8a, #17a2b8);
        color: #fff;
        padding: 2rem 2rem 1.5rem;
    }
    .user-form-header .icon-circle {
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
    .user-form-body {
        padding: 2rem;
    }
    .user-form-body .form-control,
    .user-form-body .form-select {
        border-color: #dfe6ea;
        padding: .6rem .9rem;
        transition: border-color .2s ease, box-shadow .2s ease;
    }
    .user-form-body .form-control:focus,
    .user-form-body .form-select:focus {
        border-color: #17a2b8;
        box-shadow: 0 0 0 .2rem rgba(23,162,184,.15);
    }
    .btn-submit-user {
        background: linear-gradient(135deg, #0a5c8a, #17a2b8);
        border: none;
        color: #fff;
        transition: transform .2s ease, box-shadow .2s ease;
    }
    .btn-submit-user:hover {
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(10,92,138,.25);
    }
    .form-label {
        font-weight: 600;
        font-size: .9rem;
    }
</style>

<div class="container my-5">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('beranda') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('user') }}">User</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tambah User</li>
        </ol>
    </nav>

    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card user-form-card shadow-sm">

                <div class="user-form-header">
                    <div class="icon-circle">
                        <i class="bi bi-person-plus-fill"></i>
                    </div>
                    <h2 class="fw-bold h4 mb-1">Tambah User Baru</h2>
                    <p class="mb-0 small opacity-75">Lengkapi data di bawah untuk membuat akun baru.</p>
                </div>

                <div class="user-form-body">

                    {{-- Pesan error validasi. Tanpa blok ini, kegagalan validasi
                         (misalnya password tidak cocok, email sudah dipakai) tidak
                         akan pernah terlihat oleh user. --}}
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

                    <form action="{{ route('user.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input
                                type="text"
                                class="form-control @error('name') is-invalid @enderror"
                                id="name"
                                name="name"
                                value="{{ old('name') }}"
                                placeholder="Masukkan nama lengkap"
                                required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input
                                type="email"
                                class="form-control @error('email') is-invalid @enderror"
                                id="email"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="nama@email.com"
                                required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input
                                type="password"
                                class="form-control @error('password') is-invalid @enderror"
                                id="password"
                                name="password"
                                placeholder="Minimal 8 karakter"
                                required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Field ini WAJIB ada kalau controller memvalidasi password
                             dengan rule "confirmed". Tanpa field ini, validasi akan
                             selalu gagal dan user tidak pernah bisa ditambahkan. --}}
                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                            <input
                                type="password"
                                class="form-control"
                                id="password_confirmation"
                                name="password_confirmation"
                                placeholder="Ulangi password"
                                required>
                        </div>

                        <div class="mb-4">
                            <label for="role" class="form-label">Role</label>
                            <select
                                class="form-select @error('role') is-invalid @enderror"
                                id="role"
                                name="role"
                                required>
                                <option value="user" @selected(old('role', 'user') == 'user')>User</option>
                                <option value="admin" @selected(old('role') == 'admin')>Admin</option>
                            </select>
                            @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-submit-user px-4">
                                <i class="bi bi-check-lg me-1"></i> Simpan User
                            </button>
                            <a href="{{ route('user') }}" class="btn btn-outline-secondary px-4">
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