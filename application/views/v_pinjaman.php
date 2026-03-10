<div class="container-fluid mt-4 mb-5 px-md-5"> 
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="font-weight-bold text-dark mb-1">Data Pinjaman Anggota</h3>
            <p class="text-secondary small">Kelola pengajuan dan status pinjaman Mitra Sejahtera.</p>
        </div>
        <button class="btn btn-danger shadow-sm px-4" style="border-radius: 8px; font-weight: 600;" data-toggle="modal" data-target="#modalPinjaman">
            <i class="fas fa-plus mr-2"></i> Tambah Pinjaman
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
                            <th class="border-0 py-3 text-right">JUMLAH PINJAMAN</th>
                            <th class="border-0 py-3 text-center">STATUS</th>
                            <th class="border-0 py-3 text-center" width="20%">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($pinjaman)): ?>
                            <?php $n=1; foreach($pinjaman as $p): ?>
                            <tr class="align-middle text-dark">
                                <td class="px-4 text-center font-weight-bold"><?= $n++; ?></td>
                                <td class="py-3">
                                    <div class="font-weight-bold"><?= $p->nama_lengkap; ?></div>
                                    <div class="text-secondary small">Tgl Pinjam: <?= date('d/m/Y', strtotime($p->tgl_pinjam)); ?></div>
                                </td>
                                <td class="py-3 text-right">
                                    <span class="font-weight-bold <?= $p->status == 'Lunas' ? 'text-secondary' : 'text-danger'; ?>">
                                        Rp <?= number_format($p->nominal, 0, ',', '.'); ?>
                                    </span>
                                </td>
                                <td class="py-3 text-center">
                                    <?php if($p->status == 'Lunas'): ?>
                                        <span class="badge badge-success px-3 py-2" style="border-radius: 20px;">
                                            <i class="fas fa-check-circle mr-1"></i> <?= $p->status; ?>
                                        </span>
                                    <?php else: ?>
                                        <span class="badge badge-warning px-3 py-2" style="border-radius: 20px;">
                                            <?= $p->status; ?>
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="py-3 text-center">
                                    <?php if($p->status == 'Belum Lunas'): ?>
                                        <a href="<?= base_url('index.php/pinjaman/set_lunas/'.$p->id_pinjaman); ?>" 
                                           class="btn btn-sm btn-outline-success border-0 px-3 mr-1" 
                                           onclick="return confirm('Tandai pinjaman ini sebagai Lunas?')">
                                            <i class="fas fa-check"></i> Lunas
                                        </a>
                                    <?php endif; ?>

                                    <a href="<?= base_url('index.php/pinjaman/hapus/'.$p->id_pinjaman); ?>" 
                                       class="btn btn-sm btn-outline-danger border-0 px-2" 
                                       onclick="return confirm('Hapus data pinjaman ini?')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center py-5 text-secondary font-italic">Belum ada data pinjaman.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalPinjaman" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow" style="border-radius: 15px;">
            <div class="modal-header border-0 px-4 pt-4">
                <h5 class="font-weight-bold">Input Pinjaman Baru</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="<?= base_url('index.php/pinjaman/tambah_aksi'); ?>" method="post">
                <div class="modal-body px-4 text-dark">
                    <div class="form-group mb-3">
                        <label class="small font-weight-bold">Pilih Anggota</label>
                        <select name="id_anggota" class="form-control bg-light border-0" required>
                            <option value="">-- Pilih Nama --</option>
                            <?php foreach($anggota_list as $al): ?>
                                <option value="<?= $al->id_anggota; ?>"><?= $al->nama_lengkap; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label class="small font-weight-bold">Besar Pinjaman (Rp)</label>
                        <input type="number" name="nominal" class="form-control bg-light border-0" placeholder="Misal: 1000000" required>
                    </div>
                    <div class="form-group mb-0">
                        <label class="small font-weight-bold">Tanggal Pinjam</label>
                        <input type="date" name="tanggal" class="form-control bg-light border-0" value="<?= date('Y-m-d'); ?>" required>
                    </div>
                </div>
                <div class="modal-footer border-0 px-4 pb-4">
                    <button type="submit" class="btn btn-danger btn-block py-2 font-weight-bold" style="border-radius: 8px;">SIMPAN PINJAMAN</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .table td { vertical-align: middle !important; }
    .btn-outline-success:hover { background-color: #28a745; color: white; }
    .btn-outline-danger:hover { background-color: #dc3545; color: white; }
</style>