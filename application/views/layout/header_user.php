<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $title; ?> - Mitra Sejahtera</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f7f6;
        }

        /* Navbar dengan Gradasi Hijau Mewah */
        .navbar-custom {
            background: linear-gradient(135deg, #00b09b, #96c93d);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            padding: 15px 0;
        }

        .navbar-brand {
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .nav-link {
            font-weight: 500;
            transition: all 0.3s;
            padding: 8px 15px !important;
        }

        /* Styling Menu Aktif */
        .nav-item.active .nav-link {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            font-weight: 700;
        }

        .nav-link-logout {
            background: rgba(255, 255, 255, 0.2);
            padding: 8px 20px !important;
            border-radius: 50px;
            transition: all 0.3s;
            font-weight: 600;
            margin-left: 10px;
        }

        .nav-link-logout:hover {
            background: rgba(255, 255, 255, 0.4);
            transform: scale(1.05);
            color: #fff !important;
            text-decoration: none;
        }

        /* Container Content */
        .container-content {
            margin-top: 30px;
            margin-bottom: 50px;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
    <div class="container">
        <a class="navbar-brand" href="<?= base_url('index.php/user'); ?>">
            <i class="fas fa-university mr-2"></i> MITRA SEJAHTERA
        </a>
        
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item <?= ($this->uri->segment(2) == '') ? 'active' : ''; ?>">
                    <a class="nav-link text-white" href="<?= base_url('index.php/user'); ?>">
                        <i class="fas fa-home mr-1"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item <?= ($this->uri->segment(2) == 'simpanan') ? 'active' : ''; ?>">
                    <a class="nav-link text-white" href="<?= base_url('index.php/user/simpanan'); ?>">
                        <i class="fas fa-wallet mr-1"></i> Simpanan
                    </a>
                </li>
                <li class="nav-item <?= ($this->uri->segment(2) == 'pinjaman') ? 'active' : ''; ?>">
                    <a class="nav-link text-white" href="<?= base_url('index.php/user/pinjaman'); ?>">
                        <i class="fas fa-hand-holding-usd mr-1"></i> Pinjaman
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav align-items-center">
                <li class="nav-item <?= ($this->uri->segment(2) == 'profil') ? 'active' : ''; ?> mr-2">
                    <a class="nav-link text-white d-flex align-items-center" href="<?= base_url('index.php/user/profil'); ?>">
                        <i class="fas fa-user-circle fa-lg mr-2"></i>
                        <span class="small font-weight-bold"><?= $this->session->userdata('nama'); ?></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white nav-link-logout" href="<?= base_url('index.php/auth/logout'); ?>">
                        Keluar <i class="fas fa-sign-out-alt ml-1"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container container-content">