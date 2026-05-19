<div class="container-fluid mt-4 mb-5 px-md-5">
    <div class="d-flex justify-content-between align-items-center mb-4 no-print">
        <div>
            <h3 class="font-weight-bold text-dark mb-1">
                <i class="fas fa-chart-line text-primary mr-2"></i>Ikhtisar Keuangan Koperasi
            </h3>
            <p class="text-secondary small mb-0">Laporan real-time per tanggal <span class="badge badge-light border"><?= date('d F Y'); ?></span></p>
        </div>
        <div class="d-flex border rounded-pill bg-white shadow-sm p-1">
            <button onclick="window.print()" class="btn btn-success px-4" style="border-radius: 20px; font-weight: 600;">
                <i class="fas fa-file-pdf mr-2"></i> Cetak Laporan
            </button>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm overflow-hidden" style="border-radius: 20px; background: #fff; border-left: 6px solid #28a745 !important;">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="text-uppercase text-muted small font-weight-bold mb-2" style="letter-spacing: 1px;">Total Simpanan (KAS)</h6>
                            <h2 class="font-weight-bold text-success mb-0">Rp <?= number_format($total_simpanan, 0, ',', '.'); ?></h2>
                        </div>
                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 50px; height: 50px;">
                            <i class="fas fa-wallet text-success" style="font-size: 1.5rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm overflow-hidden" style="border-radius: 20px; background: #fff; border-left: 6px solid #dc3545 !important;">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="text-uppercase text-muted small font-weight-bold mb-2" style="letter-spacing: 1px;">Pinjaman Aktif</h6>
                            <h2 class="font-weight-bold text-danger mb-0">Rp <?= number_format($pinjaman_aktif, 0, ',', '.'); ?></h2>
                        </div>
                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 50px; height: 50px;">
                            <i class="fas fa-hand-holding-usd text-danger" style="font-size: 1.5rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm overflow-hidden" style="border-radius: 20px; background: #fff; border-left: 6px solid #007bff !important;">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="text-uppercase text-muted small font-weight-bold mb-2" style="letter-spacing: 1px;">Pinjaman Lunas</h6>
                            <h2 class="font-weight-bold text-primary mb-0">Rp <?= number_format($pinjaman_lunas, 0, ',', '.'); ?></h2>
                        </div>
                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 50px; height: 50px;">
                            <i class="fas fa-check-double text-primary" style="font-size: 1.5rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm" style="border-radius: 20px;">
                <div class="card-header bg-white border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
                    <h6 class="font-weight-bold text-dark mb-0">
                        <i class="fas fa-history mr-2 text-primary"></i> 5 Transaksi Simpanan Terakhir
                    </h6>
                    <span class="badge badge-pill badge-primary px-3 py-2">Data Terbaru</span>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead style="background-color: #f8f9fa;">
                                <tr class="text-muted small font-weight-bold text-uppercase">
                                    <th class="border-0 px-4 py-3">TANGGAL</th>
                                    <th class="border-0 py-3">NAMA ANGGOTA</th>
                                    <th class="border-0 text-right px-4 py-3">NOMINAL SETORAN</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($rincian_simpanan)): ?>
                                    <?php foreach($rincian_simpanan as $rs): ?>
                                    <tr class="text-dark align-middle">
                                        <td class="px-4 py-3">
                                            <i class="far fa-calendar-alt text-muted mr-1"></i> 
                                            <?= date('d M Y', strtotime($rs->tgl_setor)); ?>
                                        </td>
                                        <td class="font-weight-bold py-3"><?= $rs->nama_lengkap; ?></td>
                                        <td class="text-right px-4 py-3">
                                            <span class="font-weight-bold text-success">Rp <?= number_format($rs->nominal, 0, ',', '.'); ?></span>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="3" class="text-center py-5 text-muted">Belum ada transaksi simpanan hari ini.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-light border-0 pb-4 pt-3 px-4 text-center no-print">
                    <a href="<?= base_url('index.php/simpanan'); ?>" class="btn btn-sm btn-outline-primary px-4 rounded-pill font-weight-bold">
                        Lihat Semua Riwayat Simpanan <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Agar tampilan kartu lebih bersih, saya gunakan border-left warna daripada background full gradient */
    .card { transition: transform 0.2s; }
    .card:hover { transform: translateY(-5px); }

    /* CSS Khusus Cetak */
    @media print {
        .no-print, .btn, .sidebar, .navbar, .card-footer { 
            display: none !important; 
        }
        body { 
            background-color: white !important; 
        }
        .container-fluid { 
            padding: 0 !important; 
            margin: 0 !important; 
        }
        .card { 
            box-shadow: none !important; 
            border: 1px solid #eee !important; 
            border-radius: 0 !important;
        }
        .card-header {
            border-bottom: 2px solid #333 !important;
        }
        .text-success, .text-danger, .text-primary {
            color: black !important;
            font-weight: bold !important;
        }
    }
</style>