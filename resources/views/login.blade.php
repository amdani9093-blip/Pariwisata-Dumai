@extends('layouts.app')

@section('body-class', 'page-auth')
@section('title', 'Login - Visit Dumai')

@section('content')

<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<div class="login-page">

    {{-- Background Decoration --}}
    <div class="login-decoration decoration-1"></div>
    <div class="login-decoration decoration-2"></div>
    <div class="login-decoration decoration-3"></div>

    <div class="login-wrapper">

        {{-- =========================================
             LOGIN CARD
        ========================================== --}}
        <div class="login-card">

            {{-- LOGO --}}
            <div class="login-logo">

                <div class="logo-circle">
                    <i class="fa-solid fa-location-dot"></i>
                </div>

                <div class="logo-text">
                    <strong>Visit Dumai</strong>
                    <span>Wisata Kota Dumai</span>
                </div>

            </div>


            {{-- HEADER --}}
            <div class="login-header">

                <h1>Selamat Datang</h1>

                <p>
                    Silakan masuk untuk melanjutkan
                </p>

            </div>


            {{-- ALERT SUCCESS --}}
            @if (session('status'))

                <div class="login-alert success">

                    <i class="fa-solid fa-circle-check"></i>

                    <span>
                        {{ session('status') }}
                    </span>

                </div>

            @endif


            {{-- ALERT ERROR --}}
            @if ($errors->any())

                <div class="login-alert danger">

                    <i class="fa-solid fa-circle-exclamation"></i>

                    <span>
                        {{ $errors->first() }}
                    </span>

                </div>

            @endif


            {{-- =========================================
                 GOOGLE LOGIN
            ========================================== --}}
            @if (Route::has('auth.google'))

                <a href="{{ route('auth.google') }}"
                   class="google-button">

                    <i class="fab fa-google"></i>

                    <span>
                        Masuk dengan Google
                    </span>

                </a>

                <div class="login-divider">
                    <span>atau</span>
                </div>

            @endif


            {{-- =========================================
                 LOGIN FORM
            ========================================== --}}
            <form
                method="POST"
                action="{{ route('login.submit') }}"
                class="login-form"
            >

                @csrf


                {{-- EMAIL --}}
                <div class="form-group">

                    <label for="email">
                        <i class="fa-solid fa-envelope"></i>
                        Email
                    </label>

                    <div class="input-wrapper">

                        <i class="fa-regular fa-envelope input-icon"></i>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            autocomplete="email"
                            autofocus
                            placeholder="Masukkan email Anda"
                            required
                        >

                    </div>

                    @error('email')

                        <small class="field-error">
                            <i class="fa-solid fa-circle-exclamation"></i>
                            {{ $message }}
                        </small>

                    @enderror

                </div>


                {{-- PASSWORD --}}
                <div class="form-group">

                    <div class="password-label-row">

                        <label for="passwordInput">
                            <i class="fa-solid fa-lock"></i>
                            Password
                        </label>

                        @if (Route::has('password.request'))

                            <a href="{{ route('password.request') }}">
                                Lupa password?
                            </a>

                        @endif

                    </div>


                    <div class="input-wrapper">

                        <i class="fa-solid fa-key input-icon"></i>

                        <input
                            type="password"
                            id="passwordInput"
                            name="password"
                            autocomplete="current-password"
                            placeholder="Masukkan password"
                            required
                        >

                        <button
                            type="button"
                            class="password-toggle"
                            id="togglePassword"
                            aria-label="Tampilkan password"
                        >
                            <i class="fa-solid fa-eye"></i>
                        </button>

                    </div>

                    @error('password')

                        <small class="field-error">
                            <i class="fa-solid fa-circle-exclamation"></i>
                            {{ $message }}
                        </small>

                    @enderror

                </div>


                {{-- REMEMBER --}}
                <div class="login-options">

                    <label class="remember">

                        <input
                            type="checkbox"
                            name="remember"
                            id="rememberMe"
                        >

                        <span class="checkmark"></span>

                        <span>
                            Ingat saya
                        </span>

                    </label>

                </div>


                {{-- LOGIN BUTTON --}}
                <button
                    type="submit"
                    class="login-button"
                >

                    <span>
                        Masuk ke Akun
                    </span>

                    <i class="fa-solid fa-arrow-right"></i>

                </button>

            </form>


            {{-- BACK TO HOME --}}
            <a
                href="{{ url('/') }}"
                class="back-home"
            >

                <i class="fa-solid fa-arrow-left"></i>

                Kembali ke Beranda

            </a>


            {{-- FOOTER --}}
            <div class="login-footer">

                <span>
                    <i class="fa-solid fa-compass"></i>
                    Jelajahi Pesona Kota Dumai
                </span>

            </div>

        </div>

    </div>

</div>


{{-- =========================================
     PASSWORD TOGGLE
========================================== --}}
<script>

document.addEventListener('DOMContentLoaded', function () {

    const togglePassword =
        document.getElementById('togglePassword');

    const passwordInput =
        document.getElementById('passwordInput');

    if (!togglePassword || !passwordInput) {
        return;
    }

    togglePassword.addEventListener('click', function () {

        const icon = this.querySelector('i');

        const isPassword =
            passwordInput.type === 'password';

        passwordInput.type =
            isPassword ? 'text' : 'password';

        icon.classList.toggle(
            'fa-eye',
            !isPassword
        );

        icon.classList.toggle(
            'fa-eye-slash',
            isPassword
        );

        this.setAttribute(
            'aria-label',
            isPassword
                ? 'Sembunyikan password'
                : 'Tampilkan password'
        );

    });

});

</script>

@endsection