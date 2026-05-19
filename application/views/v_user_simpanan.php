<div class="container-fluid py-4">

    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #1d976c, #93f9b9); border-radius: 20px;">
                <div class="card-body p-5 text-white">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="text-uppercase opacity-8 font-weight-bold mb-1">Total Tabungan Saya</h6>
                            <h1 class="display-4 font-weight-bold mb-0">Rp <?= number_format($total_simpanan, 0, ',', '.'); ?></h1>
                            <p class="mt-2 mb-0 opacity-8"><i class="fas fa-info-circle mr-1"></i> Akumulasi dari semua transaksi simpanan Anda.</p>
                        </div>
                        <div class="col-auto d-none d-lg-block">
                            <i class="fas fa-wallet fa-5x opacity-3"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm mb-4" style="border-radius: 15px;">
        <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-success"><i class="fas fa-history mr-2"></i> Riwayat Transaksi Masuk</h6>
            <span class="badge badge-light text-muted">Update: <?= date('d/m/Y'); ?></span>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-items-center">
                    <thead class="thead-light">
                        <tr>
                            <th class="px-4" style="border-radius: 10px 0 0 10px;">Tanggal</th>
                            <th>Kategori</th>
                            <th class="text-right">Nominal</th>
                            <th class="text-center" style="border-radius: 0 10px 10px 0;">Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($simpanan)): foreach($simpanan as $s): ?>
                        <tr>
                            <td class="px-4 text-gray-700 font-weight-bold">
                                <?= date('d-m-Y', strtotime($s->tgl_simpan)); ?>
                            </td>
                            <td>
                                <span class="badge badge-pill badge-light text-success border px-3 py-2">
                                    <i class="fas fa-coins mr-1 small"></i> Simpanan
                                </span>
                            </td>
                            <td class="text-right text-dark font-weight-bold">
                                Rp <?= number_format($s->nominal, 0, ',', '.'); ?>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-outline-success btn-detail-user-s" 
                                        data-tgl="<?= date('d F Y', strtotime($s->tgl_simpan)); ?>"
                                        data-nominal="Rp <?= number_format($s->nominal, 0, ',', '.'); ?>"
                                        data-ket="Setoran simpanan ke koperasi."
                                        style="border-radius: 8px;">
                                    <i class="fas fa-search"></i>
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; else: ?>
                        <tr>
                            <td colspan="4" class="text-center py-5">
                                <i class="fas fa-folder-open fa-3x text-muted mb-3"></i>
                                <p class="text-muted small">Belum ada riwayat simpanan tercatat.</p>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalDetailUserS" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow" style="border-radius: 20px;">
            <div class="modal-body p-4 text-center">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div class="icon-shape bg-light-success text-success mb-3 mx-auto" style="width: 70px; height: 70px; border-radius: 50%; display: flex; align-items: center; justify-content: center; background-color: #e8f5e9;">
                    <i class="fas fa-coins fa-2x"></i>
                </div>
                <h5 class="font-weight-bold mb-1">Rincian Transaksi</h5>
                <h2 class="text-success font-weight-bold mb-4" id="m-nominal">Rp 0</h2>
                
                <div class="text-left bg-light p-3" style="border-radius: 12px;">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted small">Jenis Transaksi</span>
                        <span class="font-weight-bold small text-dark">Simpanan</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted small">Tanggal</span>
                        <span class="font-weight-bold small text-dark" id="m-tgl">-</span>
                    </div>
                    <hr>
                    <small class="text-muted d-block mb-1">Keterangan:</small>
                    <p class="small text-dark mb-0 font-italic" id="m-ket">-</p>
                </div>
                <button type="button" class="btn btn-secondary btn-block mt-4 py-2 font-weight-bold" data-dismiss="modal" style="border-radius: 10px;">Tutup</button>
            </div>
        </div>
    </div>
</div>