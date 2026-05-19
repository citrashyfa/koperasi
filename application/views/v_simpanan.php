<div class="container-fluid mt-4 mb-5 px-md-5"> 
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="font-weight-bold text-dark mb-1">Data Simpanan Anggota</h3>
            <p class="text-secondary small">Kelola saldo tabungan seluruh anggota aktif secara transparan.</p>
        </div>
        <button class="btn btn-success shadow-sm px-4" style="border-radius: 10px; font-weight: 600;" data-toggle="modal" data-target="#modalSimpanan">
            <i class="fas fa-plus-circle mr-2"></i> Tambah Simpanan Baru
        </button>
    </div>

    <div class="card border-0 shadow-sm" style="border-radius: 15px; overflow: hidden;">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead style="background-color: #28a745; color: white;">
                        <tr> 
                            <th class="border-0 px-4 py-4 text-center text-white" width="5%">NO</th>
                            <th class="border-0 py-4 text-white">INFORMASI ANGGOTA</th>
                            <th class="border-0 py-4 text-right text-white">TOTAL SALDO</th>
                            <th class="border-0 py-4 text-center text-white" width="15%">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($simpanan)): ?>
                            <?php $n=1; foreach($simpanan as $s): ?>
                            <tr class="align-middle">
                                <td class="px-4 text-center font-weight-bold text-muted"><?= $n++; ?></td>
                                <td class="py-3">
                                    <div class="font-weight-bold text-dark" style="font-size: 1.05rem;"><?= $s->nama_lengkap; ?></div>
                                    <div class="text-muted small"><i class="fas fa-id-card mr-1"></i> ID: #AG-00<?= $s->id_anggota; ?></div>
                                </td>
                                <td class="py-3 text-right">
                                    <span class="font-weight-bold <?= $s->total_simpanan > 0 ? 'text-success' : 'text-muted'; ?>" style="font-size: 1.1rem;">
                                        Rp <?= number_format($s->total_simpanan, 0, ',', '.'); ?>
                                    </span>
                                </td>
                                <td class="py-3 text-center">
                                    <a href="<?= base_url('index.php/simpanan/detail/'.$s->id_anggota); ?>" 
                                       class="btn btn-sm btn-outline-primary px-3" 
                                       style="border-radius: 8px; font-weight: 600; border-width: 2px;">
                                        <i class="fas fa-history mr-1"></i> Lihat Riwayat
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="text-center py-5 text-secondary font-italic">Belum ada data simpanan tersedia.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalSimpanan" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow" style="border-radius: 20px;">
            <div class="modal-header border-0 pt-4 px-4">
                <h5 class="font-weight-bold text-dark"><i class="fas fa-piggy-bank text-success mr-2"></i> Input Transaksi Simpanan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('index.php/simpanan/tambah_aksi'); ?>" method="post">
                <div class="modal-body px-4">
                    <div class="form-group mb-3">
                        <label class="small font-weight-bold text-muted text-uppercase">Pilih Anggota</label>
                        <select name="id_anggota" class="form-control shadow-sm" style="border-radius: 10px; height: 45px; background-color: #f8f9fa;" required>
                            <option value="">-- Cari Nama Anggota --</option>
                            <?php foreach($anggota_list as $al): ?>
                                <option value="<?= $al->id_anggota; ?>"><?= $al->nama_lengkap; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label class="small font-weight-bold text-muted text-uppercase">Nominal Setoran (Rp)</label>
                        <div class="input-group shadow-sm" style="border-radius: 10px; overflow: hidden;">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-light border-right-0" style="font-weight: bold;">Rp</span>
                            </div>
                            <input type="text" id="tampilan_nominal" class="form-control font-weight-bold text-success" 
                                   placeholder="Contoh: 50.000" 
                                   style="height: 45px; border-left: 0;" required>
                            <input type="hidden" name="nominal" id="nominal_asli">
                        </div>
                        <small class="text-muted mt-2 d-block">* Nominal akan terformat otomatis saat diketik.</small>
                    </div>
                </div>
                <div class="modal-footer border-0 pb-4 px-4">
                    <button type="button" class="btn btn-light px-4" data-dismiss="modal" style="border-radius: 10px; font-weight: 600;">Batal</button>
                    <button type="submit" class="btn btn-success px-4 shadow-sm" style="border-radius: 10px; font-weight: 600;">Simpan Transaksi</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .table thead th { text-transform: uppercase; letter-spacing: 1px; border-bottom: none !important; font-size: 12px; }
    .table tbody tr:hover { background-color: #f1f8f4; }
    .form-control:focus { border-color: #28a745; box-shadow: none; background-color: #fff; }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#tampilan_nominal').on('keyup', function() {
        // Ambil hanya angka
        let value = $(this).val().replace(/[^0-9]/g, '');
        
        // Simpan angka murni ke input hidden
        $('#nominal_asli').val(value);
        
        // Format ke tampilan dengan titik
        if (value !== "") {
            $(this).val(new Intl.NumberFormat('id-ID').format(value));
        }
    });
});
</script>