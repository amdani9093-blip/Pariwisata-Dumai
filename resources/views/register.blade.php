@extends('layouts.app')

@section('body-class', 'page-auth')
@section('title', 'Daftar Akun - Wisata Kota Dumai')

@section('content')

<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<div class="login-page">

    <div class="login-container">

        {{-- ==========================================
             JUDUL REGISTER
        =========================================== --}}
        <div class="login-title-box">
            <h1>REGISTER FORM</h1>
        </div>


        {{-- ==========================================
             REGISTER CARD
        =========================================== --}}
        <div class="login-card register-card">

            {{-- ======================================
                 AVATAR
            ======================================= --}}
            <div class="login-avatar register-avatar">
                <div class="avatar-circle">
                    <i class="fas fa-user-plus"></i>
                </div>
            </div>


            {{-- ======================================
                 PESAN STATUS
            ======================================= --}}
            @if (session('status'))
                <div class="login-alert login-success">
                    {{ session('status') }}
                </div>
            @endif


            {{-- ======================================
                 ERROR UMUM
            ======================================= --}}
            @if ($errors->any())
                <div class="login-alert login-danger">
                    {{ $errors->first() }}
                </div>
            @endif


            {{-- ======================================
                 FORM REGISTER
            ======================================= --}}
            <form
                action="{{ route('register.submit') }}"
                method="POST"
                novalidate
            >
                @csrf


                {{-- ================================
                     NAMA
                ================================= --}}
                <div class="login-form-group">

                    <label for="name">
                        NAMA
                    </label>

                    <div class="login-input">

                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                            autocomplete="name"
                            autofocus
                            placeholder="Masukkan Nama Lengkap"
                            class="@error('name') input-error @enderror"
                        >

                    </div>

                    @error('name')
                        <div class="login-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- ================================
                     EMAIL
                ================================= --}}
                <div class="login-form-group">

                    <label for="email">
                        EMAIL
                    </label>

                    <div class="login-input">

                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            autocomplete="email"
                            placeholder="Masukkan Email"
                            class="@error('email') input-error @enderror"
                        >

                    </div>

                    @error('email')
                        <div class="login-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- ================================
                     PASSWORD
                ================================= --}}
                <div class="login-form-group">

                    <label for="passwordInput">
                        PASSWORD
                    </label>

                    <div class="login-input password-wrapper">

                        <input
                            type="password"
                            id="passwordInput"
                            name="password"
                            autocomplete="new-password"
                            placeholder="Minimal 8 karakter"
                            class="@error('password') input-error @enderror"
                        >

                        <button
                            type="button"
                            class="password-toggle"
                            data-target="passwordInput"
                            aria-label="Tampilkan password"
                        >
                            <i class="fas fa-eye"></i>
                        </button>

                    </div>

                    @error('password')
                        <div class="login-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>


                {{-- ================================
                     KONFIRMASI PASSWORD
                ================================= --}}
                <div class="login-form-group register-confirm-group">

                    <label for="passwordConfirmInput">
                        KONFIRMASI PASSWORD
                    </label>

                    <div class="login-input password-wrapper">

                        <input
                            type="password"
                            id="passwordConfirmInput"
                            name="password_confirmation"
                            autocomplete="new-password"
                            placeholder="Ulangi Password"
                        >

                        <button
                            type="button"
                            class="password-toggle"
                            data-target="passwordConfirmInput"
                            aria-label="Tampilkan password"
                        >
                            <i class="fas fa-eye"></i>
                        </button>

                    </div>

                </div>


                {{-- ================================
                     BUTTON DAFTAR
                ================================= --}}
                <button
                    type="submit"
                    class="login-button register-button"
                >
                    Daftar
                </button>

            </form>


            {{-- ======================================
                 FOOTER
            ======================================= --}}
            <div class="login-footer register-footer">

                <a
                    href="{{ url('/') }}"
                    class="cancel-button"
                >
                    Cancel
                </a>


                @if (Route::has('login'))

                    <a
                        href="{{ route('login') }}"
                        class="forgot-password register-login-link"
                    >
                        Sudah punya akun?
                        <span>Login</span>
                    </a>

                @endif

            </div>

        </div>

    </div>

</div>


{{-- ================================================
     JAVASCRIPT PASSWORD TOGGLE
================================================= --}}
<script>

document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.password-toggle').forEach(function (button) {

        button.addEventListener('click', function () {

            const targetId = this.getAttribute('data-target');

            const input = document.getElementById(targetId);

            const icon = this.querySelector('i');


            if (!input) {
                return;
            }


            if (input.type === 'password') {

                input.type = 'text';

                icon.classList.remove('fa-eye');

                icon.classList.add('fa-eye-slash');

            } else {

                input.type = 'password';

                icon.classList.remove('fa-eye-slash');

                icon.classList.add('fa-eye');

            }

        });

    });

});

</script>

@endsection