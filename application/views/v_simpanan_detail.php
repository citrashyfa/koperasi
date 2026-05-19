<div class="container-fluid mt-4 mb-5 px-md-5"> 
    <div class="d-flex justify-content-between align-items-end mb-4">
        <div>
            <a href="<?= base_url('index.php/simpanan'); ?>" class="text-success small font-weight-bold text-decoration-none transition-all hover-left">
                <i class="fas fa-arrow-left mr-1"></i> Kembali ke Daftar Utama
            </a>
            <h3 class="font-weight-bold text-dark mt-2 mb-0">Riwayat Simpanan</h3>
            <p class="text-muted small mb-0">Anggota: <span class="badge badge-light border px-2 py-1 text-dark"><strong><?= $anggota->nama_lengkap; ?></strong> (ID: #AG-00<?= $anggota->id_anggota; ?>)</span></p>
        </div>
        <div class="text-right bg-white p-3 shadow-sm" style="border-radius: 15px; border-left: 5px solid #28a745;">
            <span class="small text-secondary d-block font-weight-bold text-uppercase" style="letter-spacing: 1px;">Total Saldo Terkumpul</span>
            <h2 class="text-success font-weight-bold mb-0">Rp <?= number_format($total, 0, ',', '.'); ?></h2>
        </div>
    </div>

    <div class="card border-0 shadow-sm" style="border-radius: 15px; overflow: hidden;">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead style="background-color: #28a745; color: white;">
                        <tr class="small font-weight-bold">
                            <th class="border-0 px-4 py-4 text-center text-white" width="8%">NO</th>
                            <th class="border-0 py-4 text-white">TANGGAL TRANSAKSI</th>
                            <th class="border-0 py-4 text-right text-white">NOMINAL SETORAN</th>
                            <th class="border-0 py-4 text-center text-white" width="15%">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($riwayat)): ?>
                            <?php $n=1; foreach($riwayat as $r): ?>
                            <tr class="text-dark align-middle">
                                <td class="px-4 text-center font-weight-bold text-muted"><?= $n++; ?></td>
                                <td class="py-3 font-weight-bold">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-success rounded-circle d-flex align-items-center justify-content-center mr-3 shadow-sm" style="width: 35px; height: 35px; opacity: 0.8;">
                                            <i class="far fa-calendar-check text-white" style="font-size: 0.9rem;"></i>
                                        </div>
                                        <span><?= date('d F Y', strtotime($r->tgl_simpan)); ?></span>
                                    </div>
                                </td>
                                <td class="py-3 text-right font-weight-bold text-success" style="font-size: 1.1rem;">
                                    Rp <?= number_format($r->nominal, 0, ',', '.'); ?>
                                </td>
                                <td class="py-3 text-center">
                                    <button onclick="konfirmasiHapusRiwayat('<?= base_url('index.php/simpanan/hapus/'.$r->id_simpanan.'/'.$r->id_anggota); ?>')" 
                                            class="btn btn-sm btn-light text-danger border rounded-pill px-3 shadow-sm btn-action">
                                        <i class="fas fa-trash-alt mr-1"></i> Hapus
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="text-center py-5">
                                    <div class="py-4">
                                        <i class="fas fa-receipt text-light mb-3" style="font-size: 5rem; opacity: 0.5;"></i>
                                        <h5 class="text-secondary font-weight-bold">Belum Ada Riwayat</h5>
                                        <p class="text-muted">Anggota ini belum pernah melakukan setoran simpanan.</p>
                                        <a href="<?= base_url('index.php/simpanan'); ?>" class="btn btn-success px-4 shadow-sm" style="border-radius: 20px; font-weight: 600;">
                                            <i class="fas fa-plus mr-1"></i> Tambah Simpanan Sekarang
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

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function konfirmasiHapusRiwayat(url) {
    Swal.fire({
        title: 'Hapus Riwayat Setoran?',
        text: "Saldo anggota akan berkurang otomatis setelah data ini dihapus!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Hapus Saja!',
        cancelButtonText: 'Batal',
        reverseButtons: true,
        borderRadius: '15px'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = url;
        }
    })
}
</script>

<style>
    .table td { vertical-align: middle !important; }
    .table tbody tr { transition: all 0.2s; }
    .table tbody tr:hover { background-color: #f1f8f4; }
    
    .hover-left:hover { padding-left: 5px; color: #1e7e34 !important; }
    .transition-all { transition: all 0.3s ease; }
    
    .btn-action { transition: all 0.2s; font-weight: 700; }
    .btn-action:hover { background-color: #dc3545 !important; color: white !important; transform: scale(1.05); }

    /* Custom scrollbar untuk table responsive */
    .table-responsive::-webkit-scrollbar { height: 6px; }
    .table-responsive::-webkit-scrollbar-thumb { background: #28a745; border-radius: 10px; }
</style>