<div class="container-fluid py-4">

    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #00b09b, #96c93d); border-radius: 20px;">
                <div class="card-body p-5 text-white">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="text-uppercase opacity-8 font-weight-bold mb-1">Informasi Pinjaman</h6>
                            <h1 class="display-4 font-weight-bold mb-0">Pinjaman Saya</h1>
                            <p class="mt-2 mb-0 opacity-8"><i class="fas fa-info-circle mr-1"></i> Pantau status pengajuan dan sisa pinjaman Anda di sini.</p>
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
            <h6 class="m-0 font-weight-bold text-success"><i class="fas fa-history mr-2"></i> Riwayat Pengajuan Pinjaman</h6>
            <span class="badge badge-light text-muted">Update: <?= date('d/m/Y'); ?></span>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-items-center">
                    <thead class="thead-light">
                        <tr>
                            <th class="px-4" style="border-radius: 10px 0 0 10px;">Total Pinjaman</th>
                            <th>Tanggal Pinjam</th>
                            <th>Status</th>
                            <th class="text-center" style="border-radius: 0 10px 10px 0;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($pinjaman)): foreach($pinjaman as $p): ?>
                        <tr>
                            <td class="px-4 font-weight-bold text-dark">
                                <?php 
                                    $nominal = isset($p->jumlah_pinjaman) ? $p->jumlah_pinjaman : (isset($p->jumlah_pinjam) ? $p->jumlah_pinjam : 0);
                                    echo "Rp " . number_format($nominal, 0, ',', '.');
                                ?>
                            </td>
                            <td>
                                <i class="far fa-calendar-alt mr-1 text-muted"></i>
                                <?= date('d M Y', strtotime($p->tgl_pinjaman)); ?>
                            </td>
                            <td>
                                <?php 
                                $status = strtolower($p->status);
                                if($status == 'diajukan' || $status == 'pending'): ?>
                                    <span class="badge badge-pill badge-warning px-3 py-2">Menunggu ACC</span>
                                <?php elseif($status == 'aktif' || $status == 'belum lunas'): ?>
                                    <span class="badge badge-pill badge-primary px-3 py-2">Aktif</span>
                                <?php elseif($status == 'lunas'): ?>
                                    <span class="badge badge-pill badge-success px-3 py-2">Lunas</span>
                                <?php else: ?>
                                    <span class="badge badge-pill badge-danger px-3 py-2">Tunggu Verifikasi</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-outline-success btn-klik-detail" 
                                        data-id="<?= $p->id_pinjaman; ?>" 
                                        data-jumlah="Rp <?= number_format($nominal, 0, ',', '.'); ?>"
                                        data-tanggal="<?= date('d F Y', strtotime($p->tgl_pinjaman)); ?>"
                                        data-status="<?= strtoupper($p->status); ?>"
                                        style="border-radius: 8px;">
                                    <i class="fas fa-search mr-1"></i> Detail
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; else: ?>
                        <tr>
                            <td colspan="4" class="text-center py-5">
                                <i class="fas fa-folder-open fa-3x text-muted mb-3"></i>
                                <p class="text-muted small">Belum ada riwayat pinjaman tercatat.</p>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalDetailP" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow" style="border-radius: 20px;">
            <div class="modal-body p-4 text-center">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div class="icon-shape bg-light-success text-success mb-3 mx-auto" style="width: 70px; height: 70px; border-radius: 50%; display: flex; align-items: center; justify-content: center; background-color: #e8f5e9;">
                    <i class="fas fa-file-invoice-dollar fa-2x"></i>
                </div>
                <h5 class="font-weight-bold mb-1">Rincian Pinjaman</h5>
                <p class="text-muted small mb-3" id="tampil-tanggal"></p>
                <h2 class="text-success font-weight-bold mb-4" id="tampil-jumlah">Rp 0</h2>
                
                <div class="text-left bg-light p-3" style="border-radius: 12px;">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted small">ID Pinjaman</span>
                        <span class="font-weight-bold small" id="tampil-id">#000</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted small">Status Pengajuan</span>
                        <span class="badge badge-dark shadow-sm" id="tampil-status">-</span>
                    </div>
                    <hr>
                    <small class="text-muted d-block mb-1 font-weight-bold">Informasi:</small>
                    <p class="small text-dark mb-0 font-italic">Jika status sudah <b>Aktif</b>, silakan hubungi bendahara untuk proses pencairan dana.</p>
                </div>
                <button type="button" class="btn btn-secondary btn-block mt-4 py-2 font-weight-bold" data-dismiss="modal" style="border-radius: 10px;">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Gunakan class btn-klik-detail untuk memicu klik
    $('.btn-klik-detail').on('click', function() {
        // Ambil data dari atribut tombol yang diklik
        var id = $(this).data('id');
        var jumlah = $(this).data('jumlah');
        var status = $(this).data('status');
        var tanggal = $(this).data('tanggal');

        // Masukkan data ke dalam elemen Modal
        $('#tampil-id').text('#PJN-' + id);
        $('#tampil-jumlah').text(jumlah);
        $('#tampil-status').text(status);
        $('#tampil-tanggal').text(tanggal);

        // Munculkan modal secara manual
        $('#modalDetailP').modal('show');
    });
});
</script>