<div class="container-fluid mt-4 mb-5 px-md-5"> 
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="font-weight-bold text-dark mb-1">Data Anggota</h3>
            <p class="text-secondary small">Daftar informasi lengkap seluruh anggota Mitra Sejahtera.</p>
        </div>
        <button class="btn btn-success shadow-sm px-4" style="border-radius: 8px; font-weight: 600;" data-toggle="modal" data-target="#modalTambah">
            <i class="fas fa-plus mr-2"></i> Tambah Anggota
        </button>
    </div>

    <div class="card border-0 shadow-sm" style="border-radius: 12px;">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-light">
                        <tr class="text-dark small font-weight-bold"> 
                            <th class="border-0 px-4 py-3 text-center" width="5%">NO</th>
                            <th class="border-0 py-3">NAMA LENGKAP</th>
                            <th class="border-0 py-3">ALAMAT DOMISILI</th>
                            <th class="border-0 py-3">NOMOR TELEPON</th>
                            <th class="border-0 py-3 text-center" width="15%">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $n=1; foreach($anggota as $a): ?>
                        <tr class="align-middle">
                            <td class="px-4 text-center text-dark font-weight-bold"><?= $n++; ?></td>
                            <td class="py-3">
                                <div class="text-dark font-weight-bold" style="font-size: 1rem;"><?= $a->nama_lengkap; ?></div>
                                <div class="text-secondary small">ID: #AG-00<?= $a->id_anggota; ?> | @<?= isset($a->username) ? $a->username : 'user'; ?></div>
                            </td>
                            <td class="py-3">
                                <div class="text-dark" style="font-size: 0.95rem;"><?= $a->alamat; ?></div>
                            </td>
                            <td class="py-3">
                                <div class="text-dark font-weight-bold" style="font-size: 0.95rem;"><?= $a->no_telp; ?></div>
                            </td>
                            <td class="py-3 text-center">
                                <div class="btn-group">
                                    <a href="<?= base_url('index.php/anggota/edit/'.$a->id_anggota); ?>" class="btn btn-sm btn-outline-primary border-0 mx-1">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="<?= base_url('index.php/anggota/hapus/'.$a->id_anggota); ?>" class="btn btn-sm btn-outline-danger border-0 mx-1" onclick="return confirm('Hapus data anggota?')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <div class="mt-3 d-flex justify-content-between align-items-center px-2">
        <p class="text-dark small">Menampilkan <strong><?= count($anggota); ?></strong> anggota aktif.</p>
        <div class="text-secondary small font-weight-bold">Mitra Sejahtera &copy; 2026</div>
    </div>
</div>

<div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow" style="border-radius: 15px;">
            <div class="modal-header border-0 px-4 pt-4">
                <h5 class="font-weight-bold text-dark">Tambah Anggota Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('index.php/anggota/tambah_aksi'); ?>" method="post">
                <div class="modal-body px-4">
                    <div class="form-group mb-3">
                        <label class="small font-weight-bold text-dark">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control bg-light border-0 text-dark" placeholder="Nama sesuai KTP" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="small font-weight-bold text-dark">Username</label>
                                <input type="text" name="user" class="form-control bg-light border-0 text-dark" placeholder="Untuk login" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="small font-weight-bold text-dark">Password</label>
                                <input type="password" name="pass" class="form-control bg-light border-0 text-dark" placeholder="Minimal 5 karakter" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label class="small font-weight-bold text-dark">Nomor Telepon</label>
                        <input type="text" name="telp" class="form-control bg-light border-0 text-dark" placeholder="Contoh: 08123456xxx">
                    </div>
                    <div class="form-group mb-0">
                        <label class="small font-weight-bold text-dark">Alamat</label>
                        <textarea name="alamat" class="form-control bg-light border-0 text-dark" rows="3" placeholder="Alamat domisili lengkap"></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 px-4 pb-4">
                    <button type="submit" class="btn btn-success btn-block py-2 font-weight-bold" style="border-radius: 8px;">
                        <i class="fas fa-save mr-2"></i> SIMPAN ANGGOTA
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    /* Baris Tabel lebih kontras */
    .table tbody tr { transition: background 0.2s; border-bottom: 1px solid #eee; }
    .table tbody tr:hover { background-color: #fcfcfc; }
    
    /* Ukuran font global di tabel */
    .table td { vertical-align: middle !important; }

    /* Memperjelas warna teks sekunder agar tidak terlalu pudar */
    .text-secondary { color: #555 !important; } 
    .text-dark { color: #222 !important; }
    
    /* Style tambahan untuk form di modal */
    .form-control:focus {
        background-color: #fff !important;
        border: 1px solid #28a745 !important;
        box-shadow: none;
    }
</style>