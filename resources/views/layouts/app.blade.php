<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Visit Dumai')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- Font Awesome -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <!-- Google Font -->
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

        <nav class="navbar">

            <div class="container">

                <a href="{{ url('/') }}" class="logo">

                    <img
                        src="{{ asset('images/logo.png') }}"
                        alt="Visit Dumai - Kota Idaman"
                        class="navbar-logo-img"
                    >

                </a>

                <ul class="nav-menu">

                    <li>
                        <a href="{{ url('/') }}"
                            class="{{ Request::is('/') ? 'active' : '' }}">
                            Beranda
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('/destinasi') }}"
                            class="{{ Request::is('destinasi') ? 'active' : '' }}">
                            Destinasi
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('/tentang') }}"
                            class="{{ Request::is('tentang') ? 'active' : '' }}">
                            Tentang
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('/kontak') }}"
                            class="{{ Request::is('kontak') ? 'active' : '' }}">
                            Kontak
                        </a>
                    </li>

                </ul>

                <!-- Tombol Mobile -->

                <div class="menu-toggle">

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

                <h2>

                    <i class="fa-solid fa-umbrella-beach"></i>

                    Visit Dumai

                </h2>

                <p>

                    Website informasi destinasi wisata,
                    kuliner, dan tempat menarik
                    di Kota Dumai.

                </p>

            </div>

            <div>

                <h3>Menu</h3>

                <ul>

                    <li><a href="/">Beranda</a></li>

                    <li><a href="/destinasi">Destinasi</a></li>

                    <li><a href="/destinasi">Tentang</a></li>

               

                </ul>

            </div>

            <div>

                <h3>Kontak</h3>

                <p>

                    <i class="fa-solid fa-location-dot"></i>

                    Kota Dumai, Riau

                </p>

                <p>

                    <i class="fa-solid fa-envelope"></i>

                    amdani9093@gmai.com

                </p>

                <p>

                    <i class="fa-solid fa-phone"></i>

                    (+62) 85278776696

                </p>

            </div>

            <div>

                <h3>Ikuti Kami</h3>

                <div class="social">

                    <a href="#">

                        <i class="fab fa-facebook"></i>

                    </a>

                    <a href="#">

                        <i class="fab fa-instagram"></i>

                    </a>

                    <a href="#">

                        <i class="fab fa-youtube"></i>

                    </a>

                    <a href="#">

                        <i class="fab fa-tiktok"></i>

                    </a>

                </div>

            </div>

        </div>

        <div class="copyright">

            © {{ date('Y') }} Visit Dumai.
            Semua Hak Cipta Dilindungi.

        </div>

    </footer>

    <!-- Tombol Scroll ke Atas -->

    <button id="scrollTop">

        <i class="fa-solid fa-arrow-up"></i>

    </button>

    <!-- ================= JAVASCRIPT ================= -->

    <script>

        // ================= MENU MOBILE =================

        const toggle = document.querySelector(".menu-toggle");

        const menu = document.querySelector(".nav-menu");

        toggle.onclick = () => {

            menu.classList.toggle("show");

        };

        // ================= SCROLL BUTTON =================

        let btn = document.getElementById("scrollTop");

        window.onscroll = function () {

            if (document.documentElement.scrollTop > 200) {

                btn.style.display = "block";

            } else {

                btn.style.display = "none";

            }

        };

        btn.onclick = function () {

            window.scrollTo({

                top: 0,

                behavior: "smooth"

            });

        };

    </script>

    @stack('scripts')

</body>

</html>