<div class="row">
    <div class="col-md-3 mb-4">
        <div class="card bg-primary text-white shadow">
            <div class="card-body">
                <h6>Data Anggota</h6>
                <h2><?= $total_anggota ?></h2>
                <small>Total anggota terdaftar</small>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between small">
                <a class="text-white stretched-link" href="<?= base_url('anggota') ?>">Lihat Detail</a>
                <i class="fas fa-angle-right"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card bg-danger text-white shadow">
            <div class="card-body">
                <h6>Pinjaman Kredit</h6>
                <h2>Rp <?= number_format($total_pinjaman) ?></h2>
                <small>Uang beredar di anggota</small>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4">
        <div class="card bg-success text-white shadow">
            <div class="card-body">
                <h6>Simpanan Maret</h6>
                <h2>Rp <?= number_format($total_simpanan) ?></h2>
                <small>Total saldo simpanan</small>
            </div>
        </div>
    </div>
</div>