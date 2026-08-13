
@extends('layouts.app')

@section('body-class', 'page-auth')
@section('title', 'Login - Wisata Kota Dumai')

@section('content')

<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<div class="login-page">

    {{-- OVERLAY BACKGROUND --}}
    <div class="login-overlay"></div>

    <div class="login-container">

        {{-- =========================
             HEADER
        ========================== --}}
        <div class="login-header">

            <div class="brand-icon">
                <i class="fa-solid fa-umbrella-beach"></i>
            </div>

            <h1>Selamat Datang</h1>

            <p>
                Masuk ke akun <strong>Visit Dumai</strong>
            </p>

        </div>


        {{-- =========================
             AVATAR
        ========================== --}}
        <div class="login-avatar">

            <div class="avatar-circle">

                <img
                    src="{{ asset('images/ss.png') }}"
                    alt="Avatar Login"
                >

            </div>

        </div>


        {{-- =========================
             LOGIN SOSIAL
        ========================== --}}
        <div class="login-social-section">

            <div class="login-divider">
                <span>atau masuk dengan</span>
            </div>

            <a
                href="{{ route('auth.google') }}"
                class="social-login-btn google"
            >
                <i class="fab fa-google"></i>
                <span>Masuk dengan Google</span>
            </a>

        </div>


        {{-- =========================
             ALERT
        ========================== --}}
        @if (session('status'))
            <div class="login-alert login-success">
                <i class="fa-solid fa-circle-check"></i>
                <span>{{ session('status') }}</span>
            </div>
        @endif

        @if ($errors->any())
            <div class="login-alert login-danger">
                <i class="fa-solid fa-circle-exclamation"></i>
                <span>{{ $errors->first() }}</span>
            </div>
        @endif


        {{-- =========================
             FORM LOGIN
        ========================== --}}
        <form
            method="POST"
            action="{{ route('login.submit') }}"
            class="login-form"
            novalidate
        >

            @csrf


            {{-- EMAIL --}}
            <div class="login-form-group">

                <label for="email">
                    <i class="fa-solid fa-user"></i>
                    Username / Email
                </label>

                <div class="login-input">

                    <i class="fa-solid fa-envelope input-icon"></i>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        autocomplete="email"
                        autofocus
                        placeholder="Masukkan username atau email"
                        class="@error('email') input-error @enderror"
                    >

                </div>

                @error('email')
                    <div class="login-error">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        {{ $message }}
                    </div>
                @enderror

            </div>


            {{-- PASSWORD --}}
            <div class="login-form-group">

                <label for="passwordInput">
                    <i class="fa-solid fa-lock"></i>
                    Password
                </label>

                <div class="login-input password-wrapper">

                    <i class="fa-solid fa-key input-icon"></i>

                    <input
                        type="password"
                        id="passwordInput"
                        name="password"
                        autocomplete="current-password"
                        placeholder="Masukkan password"
                        class="@error('password') input-error @enderror"
                    >

                    <button
                        type="button"
                        class="password-toggle"
                        id="togglePassword"
                        aria-label="Tampilkan password"
                    >
                        <i class="fas fa-eye"></i>
                    </button>

                </div>

                @error('password')
                    <div class="login-error">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        {{ $message }}
                    </div>
                @enderror

            </div>


            {{-- REMEMBER + FORGOT --}}
            <div class="login-options">

                <label class="remember-label">

                    <input
                        type="checkbox"
                        name="remember"
                        id="rememberMe"
                    >

                    <span class="custom-checkbox"></span>

                    <span>Ingat Saya</span>

                </label>

                @if (Route::has('password.request'))

                    <a
                        href="{{ route('password.request') }}"
                        class="forgot-password"
                    >
                        Lupa password?
                    </a>

                @endif

            </div>


            {{-- BUTTON LOGIN --}}
            <button
                type="submit"
                class="login-button"
            >
                <span>Masuk</span>
                <i class="fa-solid fa-arrow-right"></i>
            </button>

        </form>


        {{-- =========================
             FOOTER
        ========================== --}}
        <div class="login-footer">

            <a
                href="{{ url('/') }}"
                class="cancel-button"
            >
                <i class="fa-solid fa-arrow-left"></i>
                Kembali ke Beranda
            </a>

        </div>


        {{-- =========================
             BRAND FOOTER
        ========================== --}}
        <div class="login-brand-footer">

            <i class="fa-solid fa-location-dot"></i>

            <span>
                Visit Dumai
            </span>

            <small>
                Jelajahi Pesona Kota Dumai
            </small>

        </div>

    </div>

</div>


{{-- =========================
     PASSWORD TOGGLE
========================== --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('passwordInput');

    if (togglePassword && passwordInput) {

        togglePassword.addEventListener('click', function () {

            const icon = this.querySelector('i');

            const isPassword =
                passwordInput.getAttribute('type') === 'password';

            passwordInput.setAttribute(
                'type',
                isPassword ? 'text' : 'password'
            );

            icon.classList.toggle('fa-eye');
            icon.classList.toggle('fa-eye-slash');

            this.setAttribute(
                'aria-label',
                isPassword
                    ? 'Sembunyikan password'
                    : 'Tampilkan password'
            );

        });

    }

});
</script>

@endsection
