<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mitra Sejahtera - Solusi Digital Koperasi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body { background-color: #f8fafb; font-family: 'Segoe UI', Roboto, sans-serif; }
        
        /* Navbar Utama ala eKoperasi */
        .navbar-ekop {
            background: white !important;
            padding: 15px 50px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.05);
            border-bottom: 1px solid #edf2f7;
        }

        .brand-logo {
            font-weight: 800;
            font-size: 1.4rem;
            color: #0d6871; /* Warna hijau gelap profesional */
            letter-spacing: -0.5px;
            display: flex;
            align-items: center;
        }

        .brand-logo i {
            color: #00b894; /* Warna toska icon */
            margin-right: 10px;
            font-size: 1.8rem;
        }

        /* Menu Navigasi Tengah */
        .nav-link-custom {
            color: #4a5568 !important;
            font-weight: 600;
            margin: 0 15px;
            font-size: 0.95rem;
            transition: 0.3s;
            position: relative;
            padding-bottom: 5px;
        }

        .nav-link-custom:hover, .nav-link-custom.active {
            color: #0d6871 !important;
        }

        /* Garis bawah ungu/biru ala eKoperasi saat aktif */
        .nav-link-custom.active::after {
            content: '';
            position: absolute;
            width: 50%;
            height: 3px;
            background: #6c5ce7; /* Warna ungu aksen menu aktif */
            bottom: 0;
            left: 25%;
            border-radius: 10px;
        }

        /* Tombol Keluar di Kanan */
        .btn-logout {
            background-color: #ff7675;
            color: white !important;
            border-radius: 8px;
            padding: 8px 20px;
            font-weight: 700;
            font-size: 0.85rem;
            transition: 0.3s;
            border: none;
        }

        .btn-logout:hover {
            background-color: #d63031;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(255,118,117,0.3);
        }

        .container-main {
            padding: 40px 50px;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-ekop sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand brand-logo" href="<?= base_url('index.php/dashboard') ?>">
            <i class="fas fa-handshake"></i> MITRA SEJAHTERA
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link nav-link-custom <?= ($this->uri->segment(1) == 'dashboard') ? 'active' : '' ?>" href="<?= base_url('index.php/dashboard') ?>">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-custom <?= ($this->uri->segment(1) == 'anggota') ? 'active' : '' ?>" href="<?= base_url('index.php/anggota') ?>">Data Anggota</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-custom <?= ($this->uri->segment(1) == 'simpanan') ? 'active' : '' ?>" href="<?= base_url('index.php/simpanan') ?>">Simpanan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-custom <?= ($this->uri->segment(1) == 'pinjaman') ? 'active' : '' ?>" href="<?= base_url('index.php/pinjaman') ?>">Pinjaman</a>
                </li>
                <li class="nav-item">
    <a class="nav-link" href="<?= base_url('index.php/laporan'); ?>">Laporan</a>
</li>
            </ul>

            <div class="navbar-nav ml-auto">
                <a href="<?= base_url('index.php/auth/logout') ?>" class="nav-link btn-logout">
                    <i class="fas fa-sign-out-alt mr-1"></i> Keluar
                </a>
            </div>
        </div>
    </div>
</nav>

<div class="container-main">