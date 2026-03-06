<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="font-weight-bold text-dark mb-1">Data Anggota</h2>
            <p class="text-muted small">Kelola seluruh informasi anggota Mitra Sejahtera</p>
        </div>
        <button type="button" class="btn btn-primary px-4 py-2 shadow-sm" style="border-radius: 12px; background: #0d6871; border: none;" data-toggle="modal" data-target="#modalTambah">
            <i class="fas fa-plus mr-2"></i> Tambah Anggota
        </button>
    </div>

    <div class="card shadow-sm border-0" style="border-radius: 20px; overflow: hidden;">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead style="background: #f8f9fa;">
                        <tr>
                            <th class="px-4 py-3 border-0 text-muted small font-weight-bold">NO</th>
                            <th class="py-3 border-0 text-muted small font-weight-bold">NAMA LENGKAP</th>
                            <th class="py-3 border-0 text-muted small font-weight-bold">ALAMAT</th>
                            <th class="py-3 border-0 text-muted small font-weight-bold">NO. TELEPON</th>
                            <th class="py-3 border-0 text-center text-muted small font-weight-bold">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($anggota)): ?>
                            <?php $no = 1; foreach($anggota as $a): ?>
                            <tr>
                                <td class="px-4 py-3 align-middle"><?= $no++; ?></td>
                                <td class="py-3 align-middle font-weight-bold text-dark"><?= $a->nama_lengkap; ?></td>
                                <td class="py-3 align-middle text-muted"><?= $a->alamat; ?></td>
                                <td class="py-3 align-middle text-muted"><?= $a->no_telp; ?></td>
                                <td class="py-3 align-middle text-center">
                                    <button class="btn btn-sm btn-light text-primary mr-1" style="border-radius: 8px;" title="Edit" data-toggle="modal" data-target="#modalEdit<?= $a->id_anggota ?>">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    
                                    <a href="<?= base_url('index.php/anggota/hapus/'.$a->id_anggota) ?>" 
                                       class="btn btn-sm btn-light text-danger" 
                                       style="border-radius: 8px;" 
                                       title="Hapus" 
                                       onclick="return confirm('Yakin ingin menghapus anggota ini, Beb?')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <img src="https://cdn-icons-png.flaticon.com/512/7486/7486744.png" width="80" class="mb-3 opacity-50" style="filter: grayscale(1);">
                                    <p class="text-muted mb-0">Belum ada data anggota terdaftar.</p>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: 20px; border: none;">
            <div class="modal-header border-0 pt-4 px-4">
                <h5 class="modal-title font-weight-bold text-dark">Tambah Anggota Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('index.php/anggota/simpan') ?>" method="POST">
                <div class="modal-body px-4">
                    <div class="form-group mb-3">
                        <label class="small font-weight-bold text-muted">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control bg-light border-0" placeholder="Masukkan nama anggota" style="border-radius: 10px;" required>
                    </div>
                    <div class="form-group mb-3">
                        <label class="small font-weight-bold text-muted">Alamat</label>
                        <textarea name="alamat" class="form-control bg-light border-0" rows="3" placeholder="Masukkan alamat lengkap" style="border-radius: 10px;" required></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label class="small font-weight-bold text-muted">Nomor Telepon</label>
                        <input type="number" name="no_telp" class="form-control bg-light border-0" placeholder="Contoh: 08123456789" style="border-radius: 10px;" required>
                    </div>
                </div>
                <div class="modal-footer border-0 pb-4 px-4">
                    <button type="button" class="btn btn-light px-4" data-dismiss="modal" style="border-radius: 10px;">Batal</button>
                    <button type="submit" class="btn btn-primary px-4" style="border-radius: 10px; background: #0d6871; border: none;">Simpan Data Anggota</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php foreach($anggota as $a): ?>
<div class="modal fade" id="modalEdit<?= $a->id_anggota ?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: 20px; border: none;">
            <div class="modal-header border-0 pt-4 px-4">
                <h5 class="modal-title font-weight-bold text-dark">Edit Data Anggota</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('index.php/anggota/update') ?>" method="POST">
                <input type="hidden" name="id" value="<?= $a->id_anggota ?>">
                <div class="modal-body px-4">
                    <div class="form-group mb-3">
                        <label class="small font-weight-bold text-muted">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control bg-light border-0" value="<?= $a->nama_lengkap ?>" style="border-radius: 10px;" required>
                    </div>
                    <div class="form-group mb-3">
                        <label class="small font-weight-bold text-muted">Alamat</label>
                        <textarea name="alamat" class="form-control bg-light border-0" rows="3" style="border-radius: 10px;" required><?= $a->alamat ?></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label class="small font-weight-bold text-muted">Nomor Telepon</label>
                        <input type="number" name="no_telp" class="form-control bg-light border-0" value="<?= $a->no_telp ?>" style="border-radius: 10px;" required>
                    </div>
                </div>
                <div class="modal-footer border-0 pb-4 px-4">
                    <button type="button" class="btn btn-light px-4" data-dismiss="modal" style="border-radius: 10px;">Batal</button>
                    <button type="submit" class="btn btn-primary px-4" style="border-radius: 10px; background: #0d6871; border: none;">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; ?>