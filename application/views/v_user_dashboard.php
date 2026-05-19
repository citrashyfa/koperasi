<div class="container-fluid py-4">

    <?php if($this->session->flashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert" style="border-radius: 15px; background-color: #d4edda; color: #155724;">
            <i class="fas fa-check-circle mr-2"></i> <?= $this->session->flashdata('success'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #00b09b, #96c93d); border-radius: 20px;">
                <div class="card-body p-5 text-white">
                    <span class="badge badge-light mb-2 text-success px-3 py-2" style="border-radius: 50px;">
                        <i class="fas fa-check-circle mr-1"></i> Sistem Koperasi Terintegrasi
                    </span>
                    <h1 class="display-4 font-weight-bold">Halo, <?= !empty($profil->nama_lengkap) ? $profil->nama_lengkap : 'Anggota'; ?>!</h1>
                    <p class="lead opacity-8">Pantau saldo simpanan dan status pinjaman kamu dengan mudah dan transparan setiap hari.</p>
                    <div class="mt-4">
                        <button class="btn btn-light btn-lg px-4 text-success font-weight-bold shadow-sm" style="border-radius: 12px; pointer-events: none;">
                            ID Anggota: <?= !empty($profil->id_anggota) ? $profil->id_anggota : '-'; ?>
                        </button>
                        <a href="<?= base_url('index.php/user/ajukan_pinjaman'); ?>" class="btn btn-warning font-weight-bold px-4 ml-2 shadow-sm" style="border-radius: 12px; color: #333;">
                            <i class="fas fa-plus-circle mr-1"></i> Ajukan Pinjaman Baru
                        </a>
                        <a href="<?= base_url('index.php/user/cetak_laporan'); ?>" target="_blank" class="btn btn-outline-light font-weight-bold px-4 ml-2 shadow-sm" style="border-radius: 12px; border-width: 2px;">
                            <i class="fas fa-print mr-1"></i> Cetak Laporan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 15px;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Simpanan Saya</div>
                            <div class="h3 mb-0 font-weight-bold text-gray-800">Rp <?= number_format($total_simpanan, 0, ',', '.'); ?></div>
                            <button class="btn btn-sm btn-outline-success mt-2 btn-detail-simpanan" 
                                    data-id="<?= !empty($profil->id_anggota) ? $profil->id_anggota : '-'; ?>"
                                    style="border-radius: 8px; font-size: 11px;">
                                <i class="fas fa-eye mr-1"></i> Lihat Rincian
                            </button>
                        </div>
                        <div class="col-auto">
                            <div class="icon-shape p-3" style="border-radius: 12px; background-color: #e8f5e9;">
                                <i class="fas fa-wallet fa-2x text-success"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 15px;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Sisa Pinjaman Saya</div>
                            <div class="h3 mb-0 font-weight-bold text-gray-800">Rp <?= number_format($total_pinjaman, 0, ',', '.'); ?></div>
                        </div>
                        <div class="col-auto">
                            <div class="icon-shape p-3" style="border-radius: 12px; background-color: #ffebee;">
                                <i class="fas fa-hand-holding-usd fa-2x text-danger"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 15px;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Pinjaman Selesai (Lunas)</div>
                            <div class="h3 mb-0 font-weight-bold text-gray-800"><?= $jumlah_lunas; ?> <small class="text-muted" style="font-size: 15px;">Data</small></div>
                        </div>
                        <div class="col-auto">
                            <div class="icon-shape p-3" style="border-radius: 12px; background-color: #e3f2fd;">
                                <i class="fas fa-check-double fa-2x text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm mb-4" style="border-radius: 15px;">
        <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-success"><i class="fas fa-history mr-2"></i> Riwayat Pinjaman Terbaru</h6>
            <span class="badge badge-light text-muted">Data Real-time</span>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-items-center">
                    <thead class="thead-light">
                        <tr>
                            <th class="px-4" style="border-radius: 10px 0 0 10px;">Tanggal Pengajuan</th>
                            <th class="text-right">Jumlah Pinjam</th>
                            <th class="text-center">Status</th>
                            <th class="text-center" style="border-radius: 0 10px 10px 0;">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($pinjaman)): foreach($pinjaman as $p): ?>
                        <tr>
                            <td class="px-4 font-weight-bold text-gray-700">
                                <i class="far fa-calendar-alt mr-2 text-muted"></i><?= date('d-m-Y', strtotime($p->tgl_pinjaman)); ?>
                            </td>
                            <td class="text-right text-gray-800 font-weight-bold">
                                Rp <?= number_format($p->jumlah_pinjaman, 0, ',', '.'); ?>
                            </td>
                            <td class="text-center">
                                <?php 
                                    $badge_class = 'secondary';
                                    $status_text = $p->status;

                                    if($p->status == 'pending') {
                                        $badge_class = 'warning text-dark';
                                        $status_text = 'Menunggu ACC';
                                    } elseif($p->status == 'belum lunas') {
                                        $badge_class = 'primary';
                                        $status_text = 'Aktif / Cair';
                                    } elseif($p->status == 'lunas') {
                                        $badge_class = 'success';
                                        $status_text = 'Lunas';
                                    } elseif($p->status == 'ditolak') {
                                        $badge_class = 'danger';
                                        $status_text = 'Ditolak';
                                    }
                                ?>
                                <span class="badge badge-pill badge-<?= $badge_class; ?> px-3 py-2" style="font-size: 0.75rem; min-width: 100px;">
                                    <?= strtoupper($status_text); ?>
                                </span>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-outline-success btn-detail-pinjaman" 
                                        data-id="<?= $p->id_pinjaman; ?>"
                                        style="border-radius: 8px;">
                                    <i class="fas fa-eye mr-1"></i> Detail
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; else: ?>
                        <tr>
                            <td colspan="4" class="text-center py-5">
                                <i class="fas fa-folder-open fa-3x text-light mb-3"></i><br>
                                <span class="text-muted small mt-2 d-block">Belum ada riwayat pengajuan pinjaman.</span>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalDetailUniversal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow" style="border-radius: 15px;">
            <div class="modal-header bg-light border-0 px-4 pt-4">
                <h5 class="font-weight-bold text-dark m-0" id="judul_modal">Detail Informasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4" id="isi_modal_ajax">
                </div>
            <div class="modal-footer border-0 px-4 pb-4">
                <button type="button" class="btn btn-secondary btn-block font-weight-bold py-2" data-dismiss="modal" style="border-radius: 10px;">Tutup</button>
            </div>
        </div>
    </div>
</div>

<style>
    .card:hover { transform: translateY(-2px); transition: all 0.3s ease; }
    .table thead th { background-color: #f8f9fa; border: none; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 1px; }
    .btn-outline-success:hover { background-color: #28a745; color: white !important; }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Tombol Detail Pinjaman
    $('.btn-detail-pinjaman').on('click', function() {
        var id = $(this).data('id');
        $('#judul_modal').text('Rincian Pinjaman');
        $('#isi_modal_ajax').html('<div class="text-center py-4"><i class="fas fa-spinner fa-spin fa-2x text-primary"></i><p class="mt-2 small text-muted">Mengambil data...</p></div>');
        $('#modalDetailUniversal').modal('show');
        
        $.ajax({
            url: "<?= base_url('index.php/user/ambil_detail_pinjaman'); ?>",
            type: "GET",
            data: {id: id},
            success: function(response) {
                $('#isi_modal_ajax').html(response);
            },
            error: function() {
                $('#isi_modal_ajax').html('<div class="alert alert-danger small">Gagal memuat data.</div>');
            }
        });
    });

    // Tombol Detail Simpanan
    $('.btn-detail-simpanan').on('click', function() {
        var id = $(this).data('id');
        $('#judul_modal').text('Rincian Simpanan');
        $('#isi_modal_ajax').html('<div class="text-center py-4"><i class="fas fa-spinner fa-spin fa-2x text-success"></i><p class="mt-2 small text-muted">Mengambil data...</p></div>');
        $('#modalDetailUniversal').modal('show');
        
        $.ajax({
            url: "<?= base_url('index.php/user/ambil_detail_simpanan'); ?>",
            type: "GET",
            data: {id: id},
            success: function(response) {
                $('#isi_modal_ajax').html(response);
            },
            error: function() {
                $('#isi_modal_ajax').html('<div class="alert alert-danger small">Gagal memuat data.</div>');
            }
        });
    });
});
</script>