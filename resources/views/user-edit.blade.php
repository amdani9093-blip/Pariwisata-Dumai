@extends('layouts.app')

@section('title', 'Edit ' . $user->name)

@section('body-class', 'page-user-edit')

@section('content')
<div class="container my-5">

    {{-- Breadcrumb --}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('beranda') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('user') }}">User</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit {{ $user->name }}</li>
        </ol>
    </nav>

    <div class="row justify-content-center">
        <div class="col-lg-6">

            {{-- Header Halaman --}}
            <div class="d-flex align-items-center gap-3 mb-4">
                <div class="rounded-circle bg-primary bg-opacity-10 text-primary
                            d-flex align-items-center justify-content-center"
                     style="width:48px;height:48px;">
                    <i class="fa-solid fa-user-pen"></i>
                </div>
                <div>
                    <h1 class="h3 fw-semibold mb-0">Edit User</h1>
                    <p class="text-muted small mb-0">Perbarui data pengguna "{{ $user->name }}"</p>
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4 p-md-5">

                    <form action="{{ route('user.update', $user->id) }}" method="POST" novalidate>
                        @csrf
                        @method('PUT')

                        {{-- Informasi Akun --}}
                        <h2 class="h6 text-uppercase text-muted fw-semibold mb-3">
                            <i class="fa-solid fa-id-card me-1"></i> Informasi Akun
                        </h2>

                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                   id="name" name="name" value="{{ old('name', $user->name) }}"
                                   autocomplete="name" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                   id="email" name="email" value="{{ old('email', $user->email) }}"
                                   autocomplete="email" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Keamanan --}}
                        <h2 class="h6 text-uppercase text-muted fw-semibold mb-3">
                            <i class="fa-solid fa-shield-halved me-1"></i> Keamanan
                        </h2>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password Baru</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                   id="password" name="password" autocomplete="new-password">
                            <div class="form-text">Kosongkan jika tidak ingin mengubah password.</div>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                            <input type="password" class="form-control" id="password_confirmation"
                                   name="password_confirmation" autocomplete="new-password">
                        </div>

                        {{-- Hak Akses --}}
                        <h2 class="h6 text-uppercase text-muted fw-semibold mb-3">
                            <i class="fa-solid fa-key me-1"></i> Hak Akses
                        </h2>

                        <div class="mb-4">
                            <label for="role" class="form-label">Role</label>
                            <select class="form-select @error('role') is-invalid @enderror"
                                    id="role" name="role" required>
                                <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
                                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                            @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr class="my-4">

                        {{-- Aksi --}}
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fa-solid fa-floppy-disk me-1"></i> Simpan Perubahan
                            </button>
                            <a href="{{ route('user') }}" class="btn btn-outline-secondary">
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
