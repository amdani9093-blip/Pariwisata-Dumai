@extends('layouts.admin')

@section('title', 'Pengaturan Admin')

@section('content')

<style>

    .settings-wrapper {
        padding-bottom: 40px;
    }

    .settings-header {
        background:
            linear-gradient(
                135deg,
                #0E3B36,
                #176B5B
            );

        border-radius: 20px;

        padding: 28px 30px;

        color: #fff;

        margin-bottom: 25px;

        position: relative;

        overflow: hidden;

        box-shadow:
            0 10px 30px rgba(14, 59, 54, .15);
    }

    .settings-header::after {
        content: "";

        position: absolute;

        width: 180px;
        height: 180px;

        border: 25px solid rgba(255,255,255,.05);

        border-radius: 50%;

        right: -50px;
        top: -70px;
    }

    .settings-header h3 {
        margin: 0;

        font-size: 24px;

        font-weight: 700;
    }

    .settings-header p {
        margin: 7px 0 0;

        font-size: 13px;

        opacity: .8;
    }

    .settings-card {
        background: #fff;

        border-radius: 18px;

        border: 1px solid #E8EEEB;

        box-shadow:
            0 8px 28px rgba(24,49,43,.07);

        overflow: hidden;

        margin-bottom: 25px;
    }

    .settings-card-header {
        padding: 20px 23px;

        border-bottom: 1px solid #EDF1EF;

        display: flex;

        align-items: center;

        gap: 12px;
    }

    .settings-card-header-icon {
        width: 42px;
        height: 42px;

        border-radius: 12px;

        display: flex;

        align-items: center;
        justify-content: center;

        background: rgba(14,59,54,.08);

        color: #0E3B36;
    }

    .settings-card-header h5 {
        margin: 0;

        font-size: 15px;

        font-weight: 700;

        color: #24332F;
    }

    .settings-card-header span {
        display: block;

        font-size: 11px;

        color: #8A9793;

        margin-top: 3px;
    }

    .settings-card-body {
        padding: 23px;
    }

    .form-label {
        color: #344540;

        font-size: 13px;

        font-weight: 600;
    }

    .form-control {
        border: 1px solid #E2E9E6;

        border-radius: 11px;

        padding: 11px 13px;

        font-size: 13px;
    }

    .form-control:focus {
        border-color: #176B5B;

        box-shadow:
            0 0 0 3px rgba(23,107,91,.10);
    }

    .btn-save {
        border: 0;

        border-radius: 10px;

        padding: 10px 17px;

        background: #0E3B36;

        color: #fff;

        font-size: 13px;

        font-weight: 600;

        transition: .2s ease;
    }

    .btn-save:hover {
        background: #176B5B;

        color: #fff;

        transform: translateY(-1px);
    }

    .admin-profile {
        text-align: center;

        padding: 10px 0 25px;
    }

    .admin-avatar {
        width: 80px;
        height: 80px;

        border-radius: 50%;

        background:
            linear-gradient(
                135deg,
                #0E3B36,
                #176B5B
            );

        color: #fff;

        display: flex;

        align-items: center;
        justify-content: center;

        font-size: 28px;

        font-weight: 700;

        margin: 0 auto 13px;
    }

    .admin-profile h5 {
        margin: 0;

        color: #24332F;

        font-weight: 700;
    }

    .admin-profile p {
        margin: 4px 0;

        color: #8A9793;

        font-size: 12px;
    }

    .status-badge {
        display: inline-flex;

        align-items: center;

        gap: 6px;

        background: rgba(25,135,84,.10);

        color: #198754;

        padding: 6px 11px;

        border-radius: 20px;

        font-size: 11px;

        font-weight: 600;
    }

    .status-badge span {
        width: 7px;
        height: 7px;

        border-radius: 50%;

        background: #198754;
    }

    .alert {
        border-radius: 12px;

        font-size: 13px;
    }

</style>


<div class="settings-wrapper">


    {{-- =====================================================
         HEADER
    ====================================================== --}}

    <div class="settings-header">

        <h3>

            <i class="fas fa-cog me-2"></i>

            Pengaturan Admin

        </h3>

        <p>
            Kelola informasi akun dan keamanan administrator
            website Visit Dumai.
        </p>

    </div>


    {{-- =====================================================
         NOTIFICATION
    ====================================================== --}}

    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show">

            <i class="fas fa-check-circle me-2"></i>

            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif


    @if($errors->any())

        <div class="alert alert-danger">

            <strong>
                Periksa kembali data berikut:
            </strong>

            <ul class="mb-0 mt-2">

                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    <div class="row g-4">


        {{-- =================================================
             PROFIL ADMIN
        ================================================== --}}

        <div class="col-xl-4">

            <div class="settings-card">

                <div class="settings-card-body">

                    <div class="admin-profile">

                        <div class="admin-avatar">

                            {{ strtoupper(
                                substr($admin->name ?? 'A', 0, 1)
                            ) }}

                        </div>

                        <h5>
                            {{ $admin->name ?? 'Administrator' }}
                        </h5>

                        <p>
                            {{ $admin->email ?? '-' }}
                        </p>

                        <div class="status-badge">

                            <span></span>

                            Administrator Aktif

                        </div>

                    </div>


                    <hr>


                    <div class="mt-3">

                        <small class="text-muted d-block mb-2">
                            Akun dibuat
                        </small>

                        <strong>
                            {{ optional($admin->created_at)->format('d M Y') ?? '-' }}
                        </strong>

                    </div>


                </div>

            </div>


            {{-- INFORMASI --}}
            <div class="settings-card">

                <div class="settings-card-header">

                    <div class="settings-card-header-icon">

                        <i class="fas fa-shield-alt"></i>

                    </div>

                    <div>

                        <h5>
                            Keamanan
                        </h5>

                        <span>
                            Tips keamanan akun
                        </span>

                    </div>

                </div>


                <div class="settings-card-body">

                    <ul class="small text-muted mb-0 ps-3">

                        <li class="mb-2">
                            Gunakan password minimal 8 karakter.
                        </li>

                        <li class="mb-2">
                            Jangan membagikan password kepada orang lain.
                        </li>

                        <li>
                            Ganti password secara berkala.
                        </li>

                    </ul>

                </div>

            </div>

        </div>


        {{-- =================================================
             PENGATURAN
        ================================================== --}}

        <div class="col-xl-8">


            {{-- PROFIL --}}
            <div class="settings-card">

                <div class="settings-card-header">

                    <div class="settings-card-header-icon">

                        <i class="fas fa-user"></i>

                    </div>

                    <div>

                        <h5>
                            Informasi Profil
                        </h5>

                        <span>
                            Perbarui nama dan email administrator
                        </span>

                    </div>

                </div>


                <div class="settings-card-body">

                    <form
                        action="{{ route('admin.settings.profile.update') }}"
                        method="POST"
                    >

                        @csrf

                        @method('PUT')


                        <div class="row g-3">


                            <div class="col-md-6">

                                <label class="form-label">
                                    Nama Admin
                                </label>

                                <input
                                    type="text"
                                    name="name"
                                    class="form-control"
                                    value="{{ old('name', $admin->name) }}"
                                    required
                                >

                            </div>


                            <div class="col-md-6">

                                <label class="form-label">
                                    Email Admin
                                </label>

                                <input
                                    type="email"
                                    name="email"
                                    class="form-control"
                                    value="{{ old('email', $admin->email) }}"
                                    required
                                >

                            </div>


                        </div>


                        <div class="text-end mt-4">

                            <button
                                type="submit"
                                class="btn-save"
                            >

                                <i class="fas fa-save me-2"></i>

                                Simpan Profil

                            </button>

                        </div>


                    </form>

                </div>

            </div>


            {{-- PASSWORD --}}
            <div class="settings-card">

                <div class="settings-card-header">

                    <div
                        class="settings-card-header-icon"
                        style="
                            background:rgba(214,168,79,.12);
                            color:#B78320;
                        "
                    >

                        <i class="fas fa-lock"></i>

                    </div>

                    <div>

                        <h5>
                            Ubah Password
                        </h5>

                        <span>
                            Perbarui password keamanan administrator
                        </span>

                    </div>

                </div>


                <div class="settings-card-body">

                    <form
                        action="{{ route('admin.settings.password.update') }}"
                        method="POST"
                    >

                        @csrf

                        @method('PUT')


                        <div class="mb-3">

                            <label class="form-label">
                                Password Saat Ini
                            </label>

                            <input
                                type="password"
                                name="current_password"
                                class="form-control"
                                required
                            >

                        </div>


                        <div class="row g-3">


                            <div class="col-md-6">

                                <label class="form-label">
                                    Password Baru
                                </label>

                                <input
                                    type="password"
                                    name="password"
                                    class="form-control"
                                    minlength="8"
                                    required
                                >

                            </div>


                            <div class="col-md-6">

                                <label class="form-label">
                                    Konfirmasi Password Baru
                                </label>

                                <input
                                    type="password"
                                    name="password_confirmation"
                                    class="form-control"
                                    minlength="8"
                                    required
                                >

                            </div>


                        </div>


                        <div class="text-end mt-4">

                            <button
                                type="submit"
                                class="btn-save"
                            >

                                <i class="fas fa-key me-2"></i>

                                Perbarui Password

                            </button>

                        </div>


                    </form>

                </div>

            </div>


        </div>

    </div>

</div>

@endsection