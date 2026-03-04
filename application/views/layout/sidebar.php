<!DOCTYPE html>
<html lang="en">
<head>
    <title>Koperasi Syariah - Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        #wrapper { display: flex; }
        #sidebar-wrapper { min-height: 100vh; width: 250px; background: #00a65a; color: white; }
        .sidebar-heading { padding: 20px; font-size: 1.2rem; border-bottom: 1px solid rgba(255,255,255,0.2); }
        .list-group-item { background: transparent; color: white; border: none; }
        .list-group-item:hover { background: rgba(255,255,255,0.1); }
    </style>
</head>
<body>
<div id="wrapper">
    <div id="sidebar-wrapper">
        <div class="sidebar-heading text-center"><strong>KOPERASI</strong></div>
        <div class="list-group list-group-flush">
            <a href="<?= base_url('dashboard') ?>" class="list-group-item"><i class="fas fa-home"></i> Beranda</a>
            <a href="<?= base_url('anggota') ?>" class="list-group-item"><i class="fas fa-users"></i> Data Anggota</a>
            <a href="<?= base_url('simpanan') ?>" class="list-group-item"><i class="fas fa-piggy-bank"></i> Simpanan</a>
            <a href="<?= base_url('pinjaman') ?>" class="list-group-item"><i class="fas fa-hand-holding-usd"></i> Pinjaman</a>
            <a href="<?= base_url('laporan') ?>" class="list-group-item"><i class="fas fa-file-invoice"></i> Laporan</a>
        </div>
    </div>
    <div id="page-content-wrapper" class="w-100">
        <nav class="navbar navbar-light bg-white border-bottom shadow-sm">
            <span class="navbar-brand mb-0 h1">Panel Admin</span>
        </nav>
        <div class="container-fluid p-4">