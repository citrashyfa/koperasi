<ul class="nav">
    <li><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
    
    <?php if($this->session->userdata('role') == 'admin'): ?>
        <li><a href="<?= base_url('anggota') ?>">Data Anggota</a></li>
        <li><a href="<?= base_url('simpanan') ?>">Input Simpanan</a></li>
    <?php endif; ?>

    <?php if($this->session->userdata('role') == 'ketua'): ?>
        <li><a href="<?= base_url('pinjaman/verifikasi') ?>">Persetujuan Pinjaman</a></li>
        <li><a href="<?= base_url('laporan') ?>">Laporan Keuangan</a></li>
    <?php endif; ?>
    
    <li><a href="<?= base_url('auth/logout') ?>">Keluar</a></li>
</ul>