<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Koperasi Syariah - Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body { overflow-x: hidden; background-color: #f4f6f9; }
        #wrapper { display: flex; width: 100%; }
        #sidebar-wrapper { min-height: 100vh; width: 250px; background: #2d3436; color: white; transition: all 0.3s; }
        .sidebar-heading { padding: 20px; font-size: 1.2rem; background: #00b894; color: white; text-align: center; }
        .list-group-item { background: transparent; color: #dfe6e9; border: none; padding: 15px 25px; }
        .list-group-item:hover { background: #636e72; color: white; text-decoration: none; }
        .list-group-item i { margin-right: 10px; width: 20px; }
        #page-content-wrapper { width: 100%; }
        .navbar { background: white !important; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
    </style>
</head>
<body>
<div id="wrapper">
    <div id="sidebar-wrapper">
        <div class="sidebar-heading"><strong>KOPERASI KITA</strong></div>
        <div class="list-group list-group-flush">
            <a href="<?= base_url('dashboard') ?>" class="list-group-item"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
            <a href="<?= base_url('anggota') ?>" class="list-group-item"><i class="fas fa-users"></i> Data Anggota</a>
            <a href="<?= base_url('simpanan') ?>" class="list-group-item"><i class="fas fa-wallet"></i> Simpanan</a>
            <a href="<?= base_url('pinjaman') ?>" class="list-group-item"><i class="fas fa-hand-holding-usd"></i> Pinjaman</a>
            <a href="<?= base_url('angsuran') ?>" class="list-group-item"><i class="fas fa-calendar-check"></i> Angsuran</a>
            <hr style="border-color: rgba(255,255,255,0.1)">
            <a href="<?= base_url('auth/logout') ?>" class="list-group-item text-danger"><i class="fas fa-sign-out-alt"></i> Keluar</a>
        </div>
    </div>
    <div id="page-content-wrapper">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <span class="navbar-text">Selamat Datang, <strong>Admin Koperasi</strong></span>
            </div>
        </nav>
        <div class="container-fluid p-4">