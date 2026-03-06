<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Laporan Keuangan Koperasi</h1>

    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Anggota</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_anggota; ?> Orang</div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Simpanan</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">Rp <?= number_format($total_simpanan, 0, ',', '.'); ?></div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Total Pinjaman</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">Rp <?= number_format($total_pinjaman, 0, ',', '.'); ?></div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Saldo Kas</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">Rp <?= number_format($total_kas, 0, ',', '.'); ?></div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-3">
        <button onclick="window.print()" class="btn btn-primary">
            <i class="fas fa-print"></i> Cetak Laporan
        </button>
    </div>
</div>