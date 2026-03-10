<div class="container-fluid mt-4 mb-5 px-md-5">
    <div class="d-flex justify-content-between align-items-end mb-4">
        <div>
            <a href="<?= base_url('index.php/simpanan'); ?>" class="text-secondary small font-weight-bold text-decoration-none">
                <i class="fas fa-arrow-left mr-1"></i> Kembali ke Daftar
            </a>
            <h3 class="font-weight-bold text-dark mt-2 mb-0">Riwayat Simpanan</h3>
            <p class="text-muted small mb-0">Anggota: <strong><?= $anggota->nama_lengkap; ?></strong> (ID: #AG-00<?= $anggota->id_anggota; ?>)</p>
        </div>
        <div class="text-right">
            <span class="small text-secondary d-block mb-1">Total Saldo Terkumpul:</span>
            <h2 class="text-success font-weight-bold mb-0">Rp <?= number_format($total, 0, ',', '.'); ?></h2>
        </div>
    </div>

    <div class="card border-0 shadow-sm" style="border-radius: 12px;">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-light text-dark small font-weight-bold">
                        <tr>
                            <th class="border-0 px-4 py-3 text-center" width="8%">NO</th>
                            <th class="border-0 py-3">TANGGAL TRANSAKSI</th>
                            <th class="border-0 py-3 text-right">NOMINAL SETORAN</th>
                            <th class="border-0 py-3 text-center" width="15%">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($riwayat)): ?>
                            <?php $n=1; foreach($riwayat as $r): ?>
                            <tr class="text-dark align-middle">
                                <td class="px-4 text-center font-weight-bold text-secondary"><?= $n++; ?></td>
                                <td class="py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mr-2" style="width: 30px; height: 30px;">
                                            <i class="far fa-calendar-alt text-primary" style="font-size: 0.8rem;"></i>
                                        </div>
                                        <span><?= date('d F Y', strtotime($r->tgl_simpan)); ?></span>
                                    </div>
                                </td>
                                <td class="py-3 text-right font-weight-bold text-success">
                                    Rp <?= number_format($r->nominal, 0, ',', '.'); ?>
                                </td>
                                <td class="py-3 text-center">
                                    <a href="<?= base_url('index.php/simpanan/hapus/'.$r->id_simpanan.'/'.$r->id_anggota); ?>" 
                                       class="btn btn-sm btn-outline-danger border-0 rounded-pill px-3" 
                                       onclick="return confirm('Yakin ingin menghapus riwayat setoran ini? Saldo anggota akan berkurang.')">
                                        <i class="fas fa-trash-alt mr-1"></i> Hapus
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="text-center py-5">
                                    <div class="py-4">
                                        <i class="fas fa-folder-open text-light mb-3" style="font-size: 4rem;"></i>
                                        <p class="text-secondary">Belum ada aktivitas simpanan untuk anggota ini.</p>
                                        <a href="<?= base_url('index.php/simpanan'); ?>" class="btn btn-sm btn-success px-4" style="border-radius: 20px;">
                                            Tambah Simpanan Sekarang
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    /* Merapikan posisi vertikal konten tabel */
    .table td { 
        vertical-align: middle !important; 
    }
    
    /* Efek hover pada baris agar lebih interaktif */
    .table tbody tr:hover {
        background-color: #f8f9fa;
    }

    /* Style khusus tombol hapus agar lebih modern */
    .btn-outline-danger {
        transition: all 0.3s;
        font-size: 0.85rem;
        font-weight: 600;
    }
    .btn-outline-danger:hover {
        background-color: #dc3545;
        color: white;
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(220, 53, 69, 0.2);
    }
</style>