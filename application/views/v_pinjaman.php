<div class="container-fluid mt-4 mb-5 px-md-5"> 
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="font-weight-bold text-dark mb-1">Manajemen Pinjaman Anggota</h3>
            <p class="text-secondary small">Kelola persetujuan pengajuan dan status pembayaran anggota secara sistematis.</p>
        </div>
        </div>

    <div class="card border-0 shadow-sm" style="border-radius: 15px; overflow: hidden;">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead style="background-color: #28a745; color: white;">
                        <tr> 
                            <th class="border-0 px-4 py-4 text-center text-white" width="5%">NO</th>
                            <th class="border-0 py-4 text-white">DETAIL ANGGOTA</th>
                            <th class="border-0 py-4 text-right text-white">NOMINAL</th>
                            <th class="border-0 py-4 text-center text-white">TENOR</th>
                            <th class="border-0 py-4 text-center text-white">CICILAN/BLN</th>
                            <th class="border-0 py-4 text-center text-white">JATUH TEMPO</th>
                            <th class="border-0 py-4 text-center text-white">STATUS</th>
                            <th class="border-0 py-4 text-center text-white">AKSI MANAJEMEN</th>
                            <th class="border-0 py-4 text-center text-white" width="10%">OPSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($pinjaman)): ?>
                            <?php $n=1; foreach($pinjaman as $p): 
                                $st = strtolower(trim($p->status)); 
                                $cicilan_tabel = ($p->jangka_waktu > 0) ? ($p->jumlah_pinjaman / $p->jangka_waktu) : 0;
                            ?>
                            <tr class="align-middle">
                                <td class="px-4 text-center font-weight-bold text-muted"><?= $n++; ?></td>
                                <td class="py-3">
                                    <div class="font-weight-bold text-dark"><?= $p->nama_lengkap; ?></div>
                                    <div class="text-muted small"><i class="far fa-calendar-alt mr-1"></i> <?= date('d/m/Y', strtotime($p->tgl_pinjaman)); ?></div>
                                </td>
                                <td class="py-3 text-right">
                                    <span class="font-weight-bold text-dark">
                                        Rp <?= number_format($p->jumlah_pinjaman, 0, ',', '.'); ?>
                                    </span>
                                </td>
                                <td class="py-3 text-center">
                                    <span class="badge badge-light border text-dark px-3" style="border-radius: 5px;"><?= $p->jangka_waktu; ?> Bln</span>
                                </td>
                                <td class="py-3 text-center font-weight-bold text-primary">
                                    Rp <?= number_format($cicilan_tabel, 0, ',', '.'); ?>
                                </td>
                                <td class="py-3 text-center text-muted small">
                                    <?= ($p->tgl_jatuh_tempo) ? date('d/m/Y', strtotime($p->tgl_jatuh_tempo)) : '-'; ?>
                                </td>
                                <td class="py-3 text-center">
                                    <?php 
                                        if($st == 'pending' || $st == 'menunggu acc' || $st == '') {
                                            echo '<span class="badge badge-warning text-white px-3 py-2 shadow-sm" style="border-radius: 30px; font-size: 11px;"><i class="fas fa-clock mr-1"></i> MENUNGGU ACC</span>';
                                        } elseif($st == 'belum lunas') {
                                            echo '<span class="badge badge-primary px-3 py-2 shadow-sm" style="border-radius: 30px; font-size: 11px;"><i class="fas fa-hand-holding-usd mr-1"></i> BELUM LUNAS</span>';
                                        } elseif($st == 'lunas') {
                                            echo '<span class="badge badge-success px-3 py-2 shadow-sm" style="border-radius: 30px; font-size: 11px;"><i class="fas fa-check-circle mr-1"></i> LUNAS</span>';
                                        } elseif($st == 'ditolak') {
                                            echo '<span class="badge badge-danger px-3 py-2 shadow-sm" style="border-radius: 30px; font-size: 11px;"><i class="fas fa-times-circle mr-1"></i> DITOLAK</span>';
                                        }
                                    ?>
                                </td>
                                <td class="py-3 text-center">
                                    <?php if($st == 'pending' || $st == 'menunggu acc' || $st == ''): ?>
                                        <div class="btn-group shadow-sm" style="border-radius: 8px; overflow: hidden;">
                                            <a href="<?= base_url('index.php/pinjaman/acc_pinjaman/'.$p->id_pinjaman); ?>" 
                                               class="btn btn-sm btn-success px-3 btn-action" 
                                               data-title="Setujui Pinjaman?" data-text="Dana akan dialokasikan ke anggota.">
                                                <i class="fas fa-check mr-1"></i> Terima
                                            </a>
                                            <a href="<?= base_url('index.php/pinjaman/tolak_pinjaman/'.$p->id_pinjaman); ?>" 
                                               class="btn btn-sm btn-white text-danger border-left btn-action"
                                               data-title="Tolak Pengajuan?" data-text="Pengajuan akan ditandai sebagai ditolak.">
                                                <i class="fas fa-times mr-1"></i> Tolak
                                            </a>
                                        </div>
                                    <?php elseif($st == 'belum lunas'): ?>
                                        <a href="<?= base_url('index.php/pinjaman/set_lunas/'.$p->id_pinjaman); ?>" 
                                           class="btn btn-sm btn-info px-4 shadow-sm btn-action"
                                           style="border-radius: 8px;"
                                           data-title="Set Lunas?" data-text="Pastikan pembayaran sudah diterima secara penuh.">
                                            <i class="fas fa-money-bill-wave mr-1"></i> Tandai Lunas
                                        </a>
                                    <?php else: ?>
                                        <span class="text-muted small font-italic">Selesai</span>
                                    <?php endif; ?>
                                </td>
                                <td class="py-3 text-center">
                                    <a href="<?= base_url('index.php/pinjaman/hapus/'.$p->id_pinjaman); ?>" 
                                       class="btn btn-sm btn-danger px-3 btn-delete" 
                                       style="border-radius: 8px; font-weight: 600;" 
                                       title="Blokir Data">
                                        <i class="fas fa-ban mr-1"></i> Blokir
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="9" class="text-center py-5 text-secondary font-italic">Data pinjaman kosong.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    .table thead th { text-transform: uppercase; letter-spacing: 0.5px; border-bottom: none !important; font-size: 11px; }
    .btn-action:hover { filter: brightness(95%); }
    .btn-delete:hover { transform: scale(1.05); filter: brightness(90%); }
    .form-control:focus { border-color: #28a745; box-shadow: none; }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
    // Popup Konfirmasi Aksi (Terima/Tolak/Lunas)
    $(document).on('click', '.btn-action', function(e) {
        e.preventDefault();
        const url = $(this).attr('href');
        Swal.fire({
            title: $(this).data('title'),
            text: $(this).data('text'),
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Lanjutkan!',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) { window.location.href = url; }
        });
    });

    // Popup Konfirmasi Blokir/Hapus
    $(document).on('click', '.btn-delete', function(e) {
        e.preventDefault();
        const url = $(this).attr('href');
        Swal.fire({
            title: 'Blokir Data Pinjaman?',
            text: "Data ini akan diblokir/dihapus secara permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Blokir!'
        }).then((result) => {
            if (result.isConfirmed) { window.location.href = url; }
        });
    });
});
</script>