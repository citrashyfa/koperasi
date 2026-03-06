<style>
    #sidebar-wrapper { 
        min-height: 100vh; 
        width: 260px; 
        background-color: #084d54; /* Hijau gelap profesional agar kontras */
        color: white; 
        transition: all 0.3s;
        box-shadow: 4px 0 10px rgba(0,0,0,0.1);
    }

    .sidebar-heading { 
        padding: 30px 20px; 
        font-size: 1.1rem; 
        background: #063a3f; /* Area nama dibuat paling gelap */
        color: #00b894; /* Teks warna toska */
        text-align: center; 
        letter-spacing: 2px;
        font-weight: 800;
        border-bottom: 1px solid rgba(255,255,255,0.05);
    }

    .list-group-item { 
        background: transparent; 
        color: rgba(255,255,255,0.7); 
        border: none; 
        padding: 16px 25px; 
        transition: 0.3s;
        font-size: 0.95rem;
        display: flex;
        align-items: center;
    }

    .list-group-item:hover { 
        background: rgba(255,255,255,0.1); 
        color: #00b894; /* Teks jadi toska saat disentuh */
        text-decoration: none; 
        padding-left: 35px; /* Efek geser sedikit */
    }

    /* Penanda Menu Aktif */
    .list-group-item.active { 
        background: #00b894; 
        color: white !important; 
        font-weight: 600;
        box-shadow: inset 4px 0 0 white;
    }

    .list-group-item i { 
        margin-right: 12px; 
        width: 25px; 
        text-align: center;
        font-size: 1.1rem;
    }

    .sidebar-divider {
        border-top: 1px solid rgba(255,255,255,0.05);
        margin: 10px 0;
    }

    .logout-item {
        color: #ff7675 !important; /* Warna merah lembut untuk tombol keluar */
    }
</style>

<div id="sidebar-wrapper">
    <div class="sidebar-heading">
        <i class="fas fa-handshake mr-2"></i>MITRA SEJAHTERA
    </div>
    
    <div class="list-group list-group-flush mt-2">
        <a href="<?= base_url('index.php/dashboard') ?>" 
           class="list-group-item <?= ($this->uri->segment(1) == 'dashboard') ? 'active' : '' ?>">
            <i class="fas fa-home"></i> Beranda
        </a>

        <a href="<?= base_url('index.php/anggota') ?>" 
           class="list-group-item <?= ($this->uri->segment(1) == 'anggota') ? 'active' : '' ?>">
            <i class="fas fa-users"></i> Data Anggota
        </a>

        <a href="<?= base_url('index.php/simpanan') ?>" 
           class="list-group-item <?= ($this->uri->segment(1) == 'simpanan') ? 'active' : '' ?>">
            <i class="fas fa-piggy-bank"></i> Simpanan
        </a>

        <a href="<?= base_url('index.php/pinjaman') ?>" 
           class="list-group-item <?= ($this->uri->segment(1) == 'pinjaman') ? 'active' : '' ?>">
            <i class="fas fa-hand-holding-usd"></i> Pinjaman
        </a>

        <a href="<?= base_url('index.php/laporan') ?>" 
           class="list-group-item <?= ($this->uri->segment(1) == 'laporan') ? 'active' : '' ?>">
            <i class="fas fa-file-invoice"></i> Laporan
        </a>

        <div class="sidebar-divider"></div>

        <a href="<?= base_url('index.php/auth/logout') ?>" class="list-group-item logout-item">
            <i class="fas fa-sign-out-alt"></i> Keluar
        </a>
    </div>
</div>