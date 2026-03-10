<div class="container-fluid mt-4 mb-5 px-md-5"> 
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="font-weight-bold text-dark mb-1">Data Simpanan Anggota</h3>
            <p class="text-secondary small">Kelola saldo tabungan seluruh anggota aktif.</p>
        </div>
        <button class="btn btn-success shadow-sm px-4" style="border-radius: 8px;" data-toggle="modal" data-target="#modalSimpanan">
            <i class="fas fa-plus mr-2"></i> Tambah Simpanan
        </button>
    </div>

    <div class="card border-0 shadow-sm" style="border-radius: 12px;">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-light">
                        <tr class="text-dark small font-weight-bold"> 
                            <th class="border-0 px-4 py-3 text-center" width="5%">NO</th>
                            <th class="border-0 py-3">NAMA ANGGOTA</th>
                            <th class="border-0 py-3 text-right">SALDO SIMPANAN</th>
                            <th class="border-0 py-3 text-center" width="15%">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $n=1; foreach($simpanan as $s): ?>
                        <tr class="align-middle">
                            <td class="px-4 text-center text-dark font-weight-bold"><?= $n++; ?></td>
                            <td class="py-3">
                                <div class="text-dark font-weight-bold"><?= $s->nama_lengkap; ?></div>
                                <div class="text-secondary small">ID: #AG-00<?= $s->id_anggota; ?></div>
                            </td>
                            <td class="py-3 text-right">
                                <span class="badge badge-pill <?= $s->total_simpanan > 0 ? 'badge-success' : 'badge-light text-muted'; ?> px-3 py-2" style="font-size: 1rem;">
                                    Rp <?= number_format($s->total_simpanan, 0, ',', '.'); ?>
                                </span>
                            </td>
                            <td class="py-3 text-center">
                                <a href="<?= base_url('index.php/simpanan/detail/'.$s->id_anggota); ?>" class="btn btn-sm btn-outline-primary border-0">
                                    <i class="fas fa-history mr-1"></i> Riwayat
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalSimpanan" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow" style="border-radius: 15px;">
            <div class="modal-header border-0 px-4 pt-4">
                <h5 class="font-weight-bold">Input Simpanan Baru</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="<?= base_url('index.php/simpanan/tambah_aksi'); ?>" method="post">
                <div class="modal-body px-4 text-dark">
                    <div class="form-group">
                        <label class="small font-weight-bold">Pilih Anggota</label>
                        <select name="id_anggota" class="form-control bg-light border-0" required>
                            <option value="">-- Pilih Nama --</option>
                            <?php foreach($anggota_list as $al): ?>
                                <option value="<?= $al->id_anggota; ?>"><?= $al->nama_lengkap; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group mt-3">
                        <label class="small font-weight-bold">Nominal (Rp)</label>
                        <input type="number" name="nominal" class="form-control bg-light border-0" placeholder="Misal: 100000" required>
                    </div>
                </div>
                <div class="modal-footer border-0 px-4 pb-4">
                    <button type="submit" class="btn btn-success btn-block py-2">SIMPAN TRANSAKSI</button>
                </div>
            </form>
        </div>
    </div>
</div>