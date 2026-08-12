<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Visit Dumai')</title>

    <!-- Bootstrap 5.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <!-- CSS Kustom -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <!-- Google Font: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    @stack('styles')

    {{-- Catatan: style logo navbar SUDAH dipindahkan ke public/css/style.css
         (cari komentar "LOGO NAVBAR"). Jangan tambahkan <style> inline lagi
         di sini untuk .navbar-logo-img, supaya tidak tabrakan/override
         dengan style.css lagi. --}}
</head>

{{-- Class body diambil dari @section('body-class', '...') yang didefinisikan di tiap view.
     Ini kunci dari perbaikannya: setiap halaman punya "namespace" CSS sendiri (page-beranda,
     page-destinasi, dst) supaya style satu halaman tidak bisa menimpa style halaman lain. --}}
<body class="@yield('body-class', '')">

    <!-- ================= NAVBAR ================= -->
    <header>
        <nav class="navbar" aria-label="Navigasi utama">
            <div class="container">

                <a href="{{ url('/') }}" class="logo" aria-label="Visit Dumai - Beranda">
                    <img src="{{ asset('images/logo.png') }}" alt="Visit Dumai - Kota Idaman" class="navbar-logo-img">
                </a>

                <ul class="nav-menu" id="navMenu">

                    <li>
                        <a href="{{ url('/') }}" class="{{ Request::is('/') ? 'active' : '' }}">Beranda</a>
                    </li>

                    <li>
                        <a href="{{ url('/destinasi') }}" class="{{ Request::is('destinasi') ? 'active' : '' }}">Destinasi</a>
                    </li>

                    <li>
                        <a href="{{ url('/tentang') }}" class="{{ Request::is('tentang') ? 'active' : '' }}">Tentang</a>
                    </li>

                    <li>
                        <a href="{{ url('/kontak') }}" class="{{ Request::is('kontak') ? 'active' : '' }}">Kontak</a>
                    </li>

                    {{-- Tombol Login / Profil --}}
                    <li class="nav-auth">
                        @guest
                            <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm me-2">Login</a>
                            <a href="{{ route('register') }}" class="btn btn-light btn-sm">Daftar</a>
                        @else
                            <div class="dropdown">
                                <a href="#" class="dropdown-toggle text-white text-decoration-none d-inline-flex align-items-center gap-2"
                                   role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="user-avatar rounded-circle bg-light text-dark d-inline-flex
                                                 align-items-center justify-content-center fw-bold"
                                          style="width:32px;height:32px;">
                                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                    </span>
                                </a>

                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><span class="dropdown-item-text fw-bold">{{ Auth::user()->name }}</span></li>

                                    @if (Auth::user()->role === 'admin')
                                        <li>
                                            <a class="dropdown-item" href="{{ route('admin.dashboard') }}">Dashboard Admin</a>
                                        </li>
                                    @endif

                                    <li><hr class="dropdown-divider"></li>

                                    <li>
                                        <form action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button type="submit" class="dropdown-item text-danger">Logout</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        @endguest
                    </li>

                </ul>

                <!-- Tombol Mobile -->
                <div class="menu-toggle" id="menuToggle" aria-label="Buka menu" aria-controls="navMenu" aria-expanded="false">
                    <i class="fas fa-bars"></i>
                </div>

            </div>
        </nav>
    </header>

    <!-- ================= CONTENT ================= -->
    <main>
        @yield('content')
    </main>

    <!-- ================= FOOTER ================= -->
    <footer>
        <div class="container footer-grid">

            <div>
                <h2><i class="fa-solid fa-umbrella-beach"></i> Visit Dumai</h2>
                <p>Website informasi destinasi wisata, kuliner, dan tempat menarik di Kota Dumai.</p>
            </div>

            <div>
                <h3>Menu</h3>
                <ul>
                    <li><a href="{{ url('/') }}">Beranda</a></li>
                    <li><a href="{{ url('/destinasi') }}">Destinasi</a></li>
                    <li><a href="{{ url('/tentang') }}">Tentang</a></li>
                    <li><a href="{{ url('/kontak') }}">Kontak</a></li>
                </ul>
            </div>

            <div>
                <h3>Kontak</h3>
                <p><i class="fa-solid fa-location-dot"></i> Kota Dumai, Riau</p>
                <p><i class="fa-solid fa-envelope"></i> amdani9093@gmail.com</p>
                <p><i class="fa-solid fa-phone"></i> (+62) 85278776696</p>
            </div>

            <div>
                <h3>Ikuti Kami</h3>
                <div class="social">
                    <a href="#" aria-label="Facebook"><i class="fab fa-facebook"></i></a>
                    <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                    <a href="#" aria-label="TikTok"><i class="fab fa-tiktok"></i></a>
                </div>
            </div>

        </div>

        <div class="copyright">
            © {{ date('Y') }} Visit Dumai. Semua Hak Cipta Dilindungi.
        </div>
    </footer>

    <!-- Tombol Scroll ke Atas -->
    <button id="scrollTop" aria-label="Kembali ke atas">
        <i class="fa-solid fa-arrow-up"></i>
    </button>

    <!-- ================= JAVASCRIPT ================= -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>

    <script>
        // ================= MENU MOBILE =================
        const toggle = document.getElementById("menuToggle");
        const menu = document.getElementById("navMenu");

        toggle.addEventListener("click", () => {
            const isOpen = menu.classList.toggle("show");
            toggle.setAttribute("aria-expanded", isOpen);
        });

        // Tutup menu otomatis saat salah satu link diklik (berguna di layar kecil)
        menu.querySelectorAll("a").forEach(link => {
            link.addEventListener("click", () => {
                menu.classList.remove("show");
                toggle.setAttribute("aria-expanded", "false");
            });
        });

        // ================= SCROLL BUTTON =================
        const btn = document.getElementById("scrollTop");
        const updateScrollBtn = () => {
            btn.style.display = document.documentElement.scrollTop > 200 ? "block" : "none";
        };

        window.addEventListener("scroll", updateScrollBtn);
        updateScrollBtn(); // cek posisi awal (mis. saat refresh di tengah halaman)

        btn.addEventListener("click", () => {
            window.scrollTo({ top: 0, behavior: "smooth" });
        });
    </script>

    @stack('scripts')

</body>

</html>
