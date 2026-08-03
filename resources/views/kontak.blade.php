@extends('layouts.app')

@section('title', 'Reservasi Wisata')

@section('content')



<!-- HERO -->
<section class="reservasi-hero">
    <div class="container">
        <div class="hero-icon"><i class="fas fa-ticket-alt"></i></div>
        <h1>Reservasi Wisata Online</h1>
        <p>Pesan tiket destinasi wisata Kota Dumai dengan mudah dan cepat.</p>
    </div>
</section>

<!-- FORM RESERVASI -->
<section class="container reservasi-wrap mb-5">

    <div class="reservasi-card reveal">

        <div class="section-title mb-4 text-center">
            <div class="form-step-label">Form Pemesanan</div>
            <h2 class="mb-1">Lengkapi Data Reservasi</h2>
            <p class="mb-0">Silakan isi data di bawah ini dengan benar.</p>
        </div>

    

            <div class="row g-3">

                <div class="col-md-6">
                    <label class="form-label">Nama Lengkap</label>
                    <div class="input-icon-group">
                        <i class="fas fa-user"></i>
                        <input
                            type="text"
                            name="nama"
                            class="form-control"
                            placeholder="Masukkan nama lengkap"
                            required>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Nomor WhatsApp</label>
                    <div class="input-icon-group">
                        <i class="fab fa-whatsapp"></i>
                        <input
                            type="text"
                            name="wa"
                            class="form-control"
                            placeholder="08xxxxxxxxxx"
                            required>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Pilih Destinasi</label>
                    <div class="input-icon-group">
                        <i class="fas fa-map-marker-alt"></i>
                        <select
                            name="destinasi"
                            id="destinasi"
                            class="form-select"
                            required>

                            <option value="">-- Pilih Destinasi --</option>

                            <option value="Pantai Purnama" data-harga="25000">
                                Pantai Purnama
                            </option>

                            <option value="Pantai Teluk Makmur" data-harga="20000">
                                Pantai Teluk Makmur
                            </option>

                            <option value="Bukit Gelanggang" data-harga="15000">
                                Bukit Gelanggang
                            </option>

                            <option value="Hutan Mangrove" data-harga="30000">
                                Hutan Mangrove
                            </option>

                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Tanggal Reservasi</label>
                    <div class="input-icon-group">
                        <i class="fas fa-calendar-alt"></i>
                        <input
                            type="date"
                            name="tanggal"
                            class="form-control"
                            required>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Harga Tiket</label>
                    <input
                        type="text"
                        id="harga"
                        class="form-control"
                        placeholder="Rp 0"
                        readonly>
                    <input type="hidden" name="harga" id="hargaValue">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Jumlah Tiket</label>
                    <div class="input-icon-group">
                        <i class="fas fa-users"></i>
                        <input
                            type="number"
                            name="jumlah"
                            id="jumlah"
                            value="1"
                            min="1"
                            class="form-control">
                    </div>
                </div>

                <div class="col-12">
                    <div class="summary-box d-flex justify-content-between align-items-center flex-wrap gap-2" id="summaryBox">
                        <div>
                            <div class="summary-label">Total Pembayaran</div>
                            <div class="summary-value" id="total">Rp 0</div>
                        </div>
                        <i class="fas fa-receipt" style="font-size:1.8rem;color:var(--brand-light);"></i>
                    </div>
                </div>

                <div class="col-12 mt-2">
                    <button type="submit" class="btn-primary">
                        <i class="fas fa-ticket-alt"></i>
                        Pesan Sekarang
                    </button>
                </div>

            </div>
        </form>
    </div>

</section>

<script>
document.addEventListener('DOMContentLoaded', function () {

    // Animasi muncul saat card masuk viewport
    const revealEls = document.querySelectorAll('.reveal');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });
    revealEls.forEach((el) => observer.observe(el));

    // Kalkulasi harga & total
    const destinasi = document.getElementById("destinasi");
    const harga = document.getElementById("harga");
    const hargaValue = document.getElementById("hargaValue");
    const jumlah = document.getElementById("jumlah");
    const total = document.getElementById("total");
    const summaryBox = document.getElementById("summaryBox");

    function hitung() {
        let selected = destinasi.options[destinasi.selectedIndex];
        let h = Number(selected.getAttribute("data-harga")) || 0;
        let j = Number(jumlah.value) || 0;

        harga.value = "Rp " + h.toLocaleString("id-ID");
        hargaValue.value = h;

        let t = h * j;
        total.textContent = "Rp " + t.toLocaleString("id-ID");

        // animasi denyut singkat setiap kali total berubah
        summaryBox.classList.remove('pulse-update');
        void summaryBox.offsetWidth;
        summaryBox.classList.add('pulse-update');
    }

    destinasi.addEventListener("change", hitung);
    jumlah.addEventListener("input", hitung);
    jumlah.addEventListener("change", hitung);

    // hitung ulang saat halaman pertama kali dimuat
    hitung();
});
</script>

@endsection