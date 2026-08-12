@extends('layouts.app')

@section('body-class', 'page-auth')
@section('title', 'Login - Wisata Kota Dumai')

@section('content')

<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<div class="login-page">

    <div class="login-container">

        {{-- =========================
             JUDUL LOGIN
        ========================== --}}
        <div class="login-title-box">
            <h1>MASUK AKUN DULU YA</h1>
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
========================= --}}

<div class="login-divider">
    <span>atau masuk dengan</span>
</div>

<div class="social-login">

    {{-- GOOGLE --}}
    <a
        href="{{ route('auth.google') }}"
        class="social-login-btn google"
    >
        <i class="fab fa-google"></i>
        <span>Masuk dengan Google</span>
    </a>


    {{-- WHATSAPP --}}
<a
    {{-- WHATSAPP --}}
    href="https://wa.me/6285278776696"
    target="_blank"
    rel="noopener noreferrer"
    class="social-login-btn whatsapp"
>
    <i class="fab fa-whatsapp"></i>
    <span>Hubungi via WhatsApp</span>
</a>

        {{-- Error umum --}}
        @if (session('status'))
            <div class="login-alert login-success">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="login-alert login-danger">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.submit') }}" novalidate>
            @csrf

            {{-- USERNAME / EMAIL --}}
            <div class="login-form-group">
                <label for="email">USERNAME</label>

                <div class="login-input">
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        autocomplete="email"
                        autofocus
                        placeholder="Enter Username"
                        class="@error('email') input-error @enderror"
                    >
                </div>

                @error('email')
                    <div class="login-error">{{ $message }}</div>
                @enderror
            </div>

            {{-- PASSWORD --}}
            <div class="login-form-group">
                <label for="passwordInput">PASSWORD</label>

                <div class="login-input password-wrapper">
                    <input
                        type="password"
                        id="passwordInput"
                        name="password"
                        autocomplete="current-password"
                        placeholder="Enter Password"
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
                    <div class="login-error">{{ $message }}</div>
                @enderror
            </div>

            {{-- BUTTON LOGIN --}}
            <button type="submit" class="login-button">
                Masuk
            </button>

            {{-- REMEMBER ME --}}
            <div class="remember-wrapper">
                <label class="remember-label">
                    <input
                        type="checkbox"
                        name="remember"
                        id="rememberMe"
                    >
                    <span>Ingat Saya</span>
                </label>
            </div>

        </form>

        {{-- =========================
             FOOTER LOGIN
        ========================== --}}
        <div class="login-footer">

            <a href="{{ url('/') }}" class="cancel-button">
                Cancel
            </a>

            @if (Route::has('password.request'))
                <a
                    href="{{ route('password.request') }}"
                    class="forgot-password"
                >
                    Lupa <span>password?</span>
                </a>
            @endif

        </div>

    </div>

</div>


<script>
    document.addEventListener('DOMContentLoaded', function () {

        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('passwordInput');

        if (togglePassword && passwordInput) {

            togglePassword.addEventListener('click', function () {

                const icon = this.querySelector('i');

                if (passwordInput.type === 'password') {

                    passwordInput.type = 'text';

                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');

                } else {

                    passwordInput.type = 'password';

                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');

                }

            });

        }

    });
</script>

@endsection