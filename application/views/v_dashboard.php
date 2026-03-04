<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard Utama Koperasi</h1>
    <button onclick="window.print()" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-print fa-sm text-white-50"></i> Cetak Laporan
    </button>
</div>

<div class="row">

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2 bg-primary text-white">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Total Anggota</div>
                        <div class="h5 mb-0 font-weight-bold"><?= $total_anggota ?> Orang</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-white-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2 bg-success text-white">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Total Simpanan</div>
                        <div class="h5 mb-0 font-weight-bold">Rp <?= number_format($total_simpanan, 0, ',', '.') ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-cash-register fa-2x text-white-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2 bg-danger text-white">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Pinjaman Keluar</div>
                        <div class="h5 mb-0 font-weight-bold">Rp <?= number_format($total_pinjaman, 0, ',', '.') ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-hand-holding-usd fa-2x text-white-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2 bg-warning text-dark">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">Kas Koperasi</div>
                        <div class="h5 mb-0 font-weight-bold">Rp <?= number_format($kas_koperasi, 0, ',', '.') ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-university fa-2x text-black-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Status Sistem</h6>
            </div>
            <div class="card-body text-center">
                <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 15rem;" src="https://undraw.co/api/illustrations/svg/undraw_finance_re_gnv2" alt="Ilustrasi Keuangan">
                <p>Selamat Datang, <b>Admin!</b> Data yang ditampilkan di atas bersifat real-time berdasarkan transaksi terbaru di database.</p>
                <a href="<?= base_url('anggota/tambah') ?>" class="btn btn-primary btn-icon-split">
                    <span class="icon text-white-50"><i class="fas fa-user-plus"></i></span>
                    <span class="text">Tambah Anggota Baru</span>
                </a>
            </div>
        </div>
    </div>
</div>