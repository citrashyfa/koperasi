<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Koperasi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        .card { border: none; transition: 0.3s; }
        .card:hover { transform: translateY(-5px); }
    </style>
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand font-weight-bold" href="<?= base_url('dashboard') ?>">
                <i class="fas fa-university"></i> KOPERASI KITA
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active"><a class="nav-link" href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('anggota') ?>">Anggota</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('pinjaman/verifikasi') ?>">Persetujuan</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('angsuran') ?>">Bayar Cicilan</a></li>
                    <li class="nav-item"><a class="nav-link text-warning" href="<?= base_url('auth/logout') ?>" onclick="return confirm('Keluar sistem?')">Log Out</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h2 class="mb-4">Dashboard Utama Koperasi</h2>
        
        <div class="row">
            <div class="col-md-3">
                <div class="card bg-info text-white shadow">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h6>Total Anggota</h6>
                            <i class="fas fa-users fa-2x opacity-50"></i>
                        </div>
                        <h3><?= $total_anggota ?> <small style="font-size: 15px;">Orang</small></h3>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card bg-success text-white shadow">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h6>Total Simpanan</h6>
                            <i class="fas fa-piggy-bank fa-2x opacity-50"></i>
                        </div>
                        <h3>Rp <?= number_format($total_simpanan, 0, ',', '.') ?></h3>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card bg-danger text-white shadow">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h6>Pinjaman Out</h6>
                            <i class="fas fa-hand-holding-usd fa-2x opacity-50"></i>
                        </div>
                        <h3>Rp <?= number_format($total_pinjaman, 0, ',', '.') ?></h3>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card bg-warning text-dark shadow">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h6>Kas Koperasi</h6>
                            <i class="fas fa-wallet fa-2x opacity-50"></i>
                        </div>
                        <h3>Rp <?= number_format($kas_koperasi, 0, ',', '.') ?></h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-5 p-5 bg-white shadow-sm rounded text-center border">
            <i class="fas fa-check-circle fa-3x text-success mb-3"></i>
            <h3>Selamat Datang di Sistem Simpan Pinjam</h3>
            <p class="text-muted">Aplikasi ini membantu Anda mengelola keuangan koperasi secara transparan dan akurat.</p>
            <hr>
            <a href="<?= base_url('anggota/tambah') ?>" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Anggota Baru
            </a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>