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
        
        /* Navbar Utama dengan Gradient Hijau - Flat */
        .navbar-ekop {
            background: linear-gradient(135deg, #0d6871 0%, #00b894 100%) !important;
            padding: 15px 50px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            border-bottom: none;
            border-radius: 0;
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 1.3rem;
            color: white !important;
            letter-spacing: 0.5px;
            display: flex;
            align-items: center;
        }

        .navbar-brand i {
            font-size: 1.6rem;
            margin-right: 10px;
        }

        /* Menu Navigasi Tengah */
        .nav-link-custom {
            color: rgba(255, 255, 255, 0.85) !important;
            font-weight: 600;
            margin: 0 5px;
            padding: 10px 18px !important;
            font-size: 0.9rem;
            transition: 0.3s;
            display: flex;
            align-items: center;
        }

        /* Hover & State Aktif */
        .nav-link-custom:hover, 
        .nav-link-custom.active {
            color: white !important;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 8px;
        }

        /* Badge Notifikasi */
        .badge-notif {
            font-size: 0.7rem;
            padding: 3px 6px;
            margin-left: 5px;
            border-radius: 50%;
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }

        /* Tombol Keluar */
        .btn-logout {
            background-color: rgba(255, 255, 255, 0.15);
            color: white !important;
            border-radius: 8px; 
            padding: 8px 20px !important;
            font-weight: 700;
            font-size: 0.85rem;
            transition: 0.3s;
            border: 1.5px solid rgba(255, 255, 255, 0.3);
        }

        .btn-logout:hover {
            background-color: #ff4757;
            border-color: transparent;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(255, 71, 87, 0.3);
            color: white !important;
        }

        .container-main {
            padding: 40px 50px;
        }

        @media (max-width: 992px) {
            .navbar-ekop { padding: 15px 20px; }
            .nav-link-custom { margin: 5px 0; }
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-ekop sticky-top">
    <div class="container-fluid">
         <a class="navbar-brand" href="<?= base_url('index.php/dashboard'); ?>">
            <i class="fas fa-university"></i> MITRA SEJAHTERA
        </a>

        <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#navbarNav">
            <span class="text-white"><i class="fas fa-bars"></i></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link nav-link-custom <?= ($this->uri->segment(2) == '') ? 'active' : '' ?>" href="<?= base_url('index.php/dashboard') ?>">
                        <i class="fas fa-home mr-1"></i> Beranda
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link nav-link-custom <?= ($this->uri->segment(2) == 'anggota') ? 'active' : '' ?>" href="<?= base_url('index.php/anggota') ?>">
                        <i class="fas fa-users mr-1"></i> Anggota
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link nav-link-custom <?= ($this->uri->segment(2) == 'simpanan') ? 'active' : '' ?>" href="<?= base_url('index.php/simpanan') ?>">
                        <i class="fas fa-piggy-bank mr-1"></i> Simpanan
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link nav-link-custom <?= ($this->uri->segment(2) == 'pengajuan_pinjaman') ? 'active' : '' ?>" href="<?= base_url('index.php/dashboard/pengajuan_pinjaman') ?>">
                        <i class="fas fa-clipboard-check mr-1"></i> Pengajuan
                        <?php 
                            $pending = $this->db->get_where('pinjaman', ['status' => 'pending'])->num_rows();
                            if($pending > 0): 
                        ?>
                            <span class="badge badge-danger badge-notif"><?= $pending ?></span>
                        <?php endif; ?>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link nav-link-custom <?= ($this->uri->segment(2) == 'pinjaman') ? 'active' : '' ?>" href="<?= base_url('index.php/pinjaman') ?>">
                        <i class="fas fa-hand-holding-usd mr-1"></i> Pinjaman
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link nav-link-custom <?= ($this->uri->segment(2) == 'laporan') ? 'active' : '' ?>" href="<?= base_url('index.php/laporan'); ?>">
                        <i class="fas fa-file-alt mr-1"></i> Laporan
                    </a>
                </li>
            </ul>

            <div class="navbar-nav ml-auto">
                <a href="<?= base_url('index.php/auth/logout') ?>" class="nav-link btn-logout shadow-sm" onclick="return confirm('Yakin ingin keluar?')">
                    <i class="fas fa-sign-out-alt mr-1"></i> Keluar
                </a>
            </div>
        </div>
    </div>
</nav>

<div class="container-main">