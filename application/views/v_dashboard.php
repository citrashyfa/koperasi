<style>
    /* Desain Banner Modern - Tanpa Foto */
    .banner-custom {
        background: linear-gradient(135deg, #0d6871 0%, #00b894 100%);
        border-radius: 24px;
        padding: 60px 50px;
        position: relative;
        overflow: hidden; 
        color: white;
        box-shadow: 0 20px 40px rgba(13, 104, 113, 0.15);
        margin-bottom: 40px; 
    }

    .banner-content { 
        position: relative; 
        z-index: 2; 
    }

    /* Statistik Card Minimalis */
    .stat-card {
        background: white;
        border: none;
        border-radius: 20px;
        padding: 25px;
        transition: 0.3s;
        box-shadow: 0 10px 25px rgba(0,0,0,0.02);
        height: 100%;
    }

    .stat-card:hover { 
        transform: translateY(-5px); 
        box-shadow: 0 15px 35px rgba(0,0,0,0.06); 
    }
    
    .icon-circle {
        width: 55px; 
        height: 55px;
        border-radius: 15px;
        display: flex; 
        align-items: center; 
        justify-content: center;
        font-size: 1.4rem;
    }

    /* Section Layanan */
    .service-card {
        background: white;
        border-radius: 25px;
        transition: 0.3s;
        border: none;
        height: 100%;
    }
    .service-card:hover {
        transform: translateY(-12px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.08) !important;
    }
</style>

<div class="container py-4">
    <div class="banner-custom shadow-sm">
        <div class="row align-items-center banner-content">
            <div class="col-lg-12 text-left">
                <span class="badge badge-pill mb-3 px-3 py-2" style="background: rgba(255,255,255,0.2); color: white;">
                    <i class="fas fa-check-circle mr-2"></i> Sistem Koperasi Terintegrasi
                </span>
                <h1 class="font-weight-bold mb-3" style="font-size: 3rem; letter-spacing: -1px;">
                    Halo, Admin!
                </h1>
                <p class="lead mb-4" style="opacity: 0.9; max-width: 600px;">
                    Kelola ekosistem ekonomi bersama <strong style="color: #fff;">Mitra Sejahtera</strong> dengan lebih transparan, cepat, dan aman setiap harinya.
                </p>
                <div class="d-flex">
                    <a href="<?= base_url('index.php/anggota') ?>" class="btn btn-light btn-lg px-4 py-3 mr-3 shadow-sm" style="border-radius: 14px; color: #0d6871; font-weight: 700; font-size: 0.95rem;">
                        Kelola Anggota <i class="fas fa-users ml-2"></i>
                    </a>
                    <a href="<?= base_url('index.php/laporan') ?>" class="btn btn-outline-light btn-lg px-4 py-3" style="border-radius: 14px; font-weight: 600; font-size: 0.95rem; border-width: 2px;">
                        Lihat Laporan
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="stat-card d-flex align-items-center shadow-sm">
                <div class="icon-circle mr-3" style="background: rgba(0, 184, 148, 0.1); color: #00b894;">
                    <i class="fas fa-user-friends"></i>
                </div>
                <div>
                    <h6 class="text-muted small font-weight-bold mb-1">TOTAL ANGGOTA</h6>
                    <h3 class="font-weight-bold mb-0 text-dark">
                        <?= number_format($total_anggota, 0, ',', '.'); ?>
                    </h3>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="stat-card d-flex align-items-center shadow-sm">
                <div class="icon-circle mr-3" style="background: rgba(13, 104, 113, 0.1); color: #0d6871;">
                    <i class="fas fa-wallet"></i>
                </div>
                <div>
                    <h6 class="text-muted small font-weight-bold mb-1">TOTAL SIMPANAN</h6>
                    <h3 class="font-weight-bold mb-0 text-dark">
                        Rp <?= number_format($total_simpanan, 0, ',', '.'); ?>
                    </h3>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="stat-card d-flex align-items-center shadow-sm">
                <div class="icon-circle mr-3" style="background: rgba(108, 92, 231, 0.1); color: #6c5ce7;">
                    <i class="fas fa-hand-holding-usd"></i>
                </div>
                <div>
                    <h6 class="text-muted small font-weight-bold mb-1">TOTAL PINJAMAN</h6>
                    <h3 class="font-weight-bold mb-0 text-dark">
                        Rp <?= number_format($total_pinjaman, 0, ',', '.'); ?>
                    </h3>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5 mb-4 text-center">
        <div class="col-12">
            <h2 class="font-weight-bold text-dark">Layanan <span style="color: #0d6871;">Mitra Sejahtera</span></h2>
            <p class="text-muted">Solusi digital terintegrasi untuk berbagai kebutuhan koperasi Anda</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 mb-4">
            <div class="service-card text-center p-5 shadow-sm" style="border-bottom: 5px solid #00b894;">
                <div class="mb-4 mx-auto d-flex align-items-center justify-content-center" style="width: 80px; height: 80px; background: rgba(0, 184, 148, 0.1); border-radius: 20px;">
                    <i class="fas fa-piggy-bank" style="font-size: 2rem; color: #00b894;"></i>
                </div>
                <h4 class="font-weight-bold mb-3">Mitra KSP</h4>
                <p class="text-muted small">Optimalkan operasional simpan pinjam Anda dengan sistem yang lebih cepat dan aman.</p>
            </div>
        </div>

        <div class="col-lg-4 mb-4">
            <div class="service-card text-center p-5 shadow-sm" style="border-bottom: 5px solid #0d6871;">
                <div class="mb-4 mx-auto d-flex align-items-center justify-content-center" style="width: 80px; height: 80px; background: rgba(13, 104, 113, 0.1); border-radius: 20px;">
                    <i class="fas fa-store" style="font-size: 2rem; color: #0d6871;"></i>
                </div>
                <h4 class="font-weight-bold mb-3">Mitra KSU</h4>
                <p class="text-muted small">Tingkatkan efisiensi koperasi serba usaha dengan manajemen retail terintegrasi.</p>
            </div>
        </div>

        <div class="col-lg-4 mb-4">
            <div class="service-card text-center p-5 shadow-sm" style="border-bottom: 5px solid #6c5ce7;">
                <div class="mb-4 mx-auto d-flex align-items-center justify-content-center" style="width: 80px; height: 80px; background: rgba(108, 92, 231, 0.1); border-radius: 20px;">
                    <i class="fas fa-balance-scale" style="font-size: 2rem; color: #6c5ce7;"></i>
                </div>
                <h4 class="font-weight-bold mb-3">Mitra Syariah</h4>
                <p class="text-muted small">Wujudkan pengelolaan syariah yang transparan sesuai prinsip bagi hasil.</p>
            </div>
        </div>
    </div>
</div>