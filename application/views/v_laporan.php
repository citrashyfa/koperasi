<div class="container-fluid mt-4 mb-5 px-md-5">
    <div class="d-flex justify-content-between align-items-end mb-4">
        <div>
            <h3 class="font-weight-bold text-dark mb-1">Ikhtisar Keuangan Koperasi</h3>
            <p class="text-secondary small mb-0">Laporan real-time per tanggal <?= date('d/m/Y'); ?></p>
        </div>
        <button onclick="window.print()" class="btn btn-outline-dark shadow-sm px-4" style="border-radius: 8px;">
            <i class="fas fa-print mr-2"></i> Cetak PDF
        </button>
    </div>

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm" style="border-radius: 15px; background: linear-gradient(45deg, #2ecc71, #27ae60);">
                <div class="card-body p-4 text-white">
                    <h6 class="small font-weight-bold opacity-75">TOTAL SIMPANAN (KAS)</h6>
                    <h2 class="font-weight-bold mb-0">Rp <?= number_format($total_simpanan, 0, ',', '.'); ?></h2>
                    <i class="fas fa-wallet fa-2x position-absolute" style="right: 20px; bottom: 20px; opacity: 0.2;"></i>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm" style="border-radius: 15px; background: linear-gradient(45deg, #e74c3c, #c0392b);">
                <div class="card-body p-4 text-white">
                    <h6 class="small font-weight-bold opacity-75">PINJAMAN AKTIF (DI ANGGOTA)</h6>
                    <h2 class="font-weight-bold mb-0">Rp <?= number_format($pinjaman_aktif, 0, ',', '.'); ?></h2>
                    <i class="fas fa-hand-holding-usd fa-2x position-absolute" style="right: 20px; bottom: 20px; opacity: 0.2;"></i>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm" style="border-radius: 15px; background: linear-gradient(45deg, #3498db, #2980b9);">
                <div class="card-body p-4 text-white">
                    <h6 class="small font-weight-bold opacity-75">PINJAMAN TERBAYAR (LUNAS)</h6>
                    <h2 class="font-weight-bold mb-0">Rp <?= number_format($pinjaman_lunas, 0, ',', '.'); ?></h2>
                    <i class="fas fa-check-double fa-2x position-absolute" style="right: 20px; bottom: 20px; opacity: 0.2;"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm" style="border-radius: 12px;">
                <div class="card-header bg-white border-0 pt-4 px-4">
                    <h6 class="font-weight-bold text-dark"><i class="fas fa-history mr-2 text-primary"></i> 5 Transaksi Simpanan Terakhir</h6>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="bg-light small font-weight-bold">
                                <tr>
                                    <th class="border-0 px-4">TANGGAL</th>
                                    <th class="border-0">NAMA ANGGOTA</th>
                                    <th class="border-0 text-right px-4">NOMINAL</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($rincian_simpanan as $rs): ?>
                                <tr class="small text-dark">
                                    <td class="px-4"><?= date('d M Y', strtotime($rs->tgl_setor)); ?></td>
                                    <td class="font-weight-bold"><?= $rs->nama_lengkap; ?></td>
                                    <td class="text-right px-4 text-success">Rp <?= number_format($rs->nominal, 0, ',', '.'); ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-white border-0 pb-4 px-4 text-center">
                    <a href="<?= base_url('index.php/simpanan'); ?>" class="small font-weight-bold text-decoration-none">Lihat Semua Simpanan <i class="fas fa-arrow-right ml-1"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .opacity-75 { opacity: 0.75; }
    @media print {
        .btn, .sidebar, .navbar, .card-footer { display: none !important; }
        .card { border: 1px solid #ddd !important; box-shadow: none !important; }
    }
</style>