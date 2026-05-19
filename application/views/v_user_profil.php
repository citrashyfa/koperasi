<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm overflow-hidden" style="border-radius: 20px;">
                <div style="height: 120px; background: linear-gradient(135deg, #00b09b, #96c93d);"></div>
                
                <div class="card-body pt-0 text-center" style="margin-top: -50px;">
                    <div class="mb-3">
                        <img src="https://ui-avatars.com/api/?name=<?= urlencode($profil->nama_lengkap); ?>&background=fff&color=00b09b&size=128" 
                             class="rounded-circle img-thumbnail shadow-sm" 
                             style="width: 120px; height: 120px; border: 5px solid #fff;">
                    </div>
                    
                    <h3 class="font-weight-bold mb-1"><?= $profil->nama_lengkap; ?></h3>
                    <p class="text-muted mb-3">
                        <i class="fas fa-id-card mr-1"></i> ID Anggota: <strong><?= $profil->id_anggota; ?></strong>
                    </p>
                    
                    <div class="d-flex justify-content-center">
                        <span class="badge badge-pill badge-success px-4 py-2 shadow-sm">
                            <i class="fas fa-check-circle mr-1"></i> Anggota Aktif
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card border-0 shadow-sm" style="border-radius: 15px;">
                <div class="card-header bg-white border-0 py-3">
                    <h6 class="m-0 font-weight-bold text-dark"><i class="fas fa-user-edit mr-2 text-success"></i> Informasi Akun</h6>
                </div>
                <div class="card-body">
                    <div class="row mb-3 border-bottom pb-2">
                        <div class="col-sm-4 text-muted">Nama Lengkap</div>
                        <div class="col-sm-8 font-weight-bold"><?= $profil->nama_lengkap; ?></div>
                    </div>
                    <div class="row mb-3 border-bottom pb-2">
                        <div class="col-sm-4 text-muted">Kode Anggota</div>
                        <div class="col-sm-8 text-primary font-weight-bold"><?= $profil->kode_anggota; ?></div>
                    </div>
                    <div class="row mb-3 border-bottom pb-2">
                        <div class="col-sm-4 text-muted">Username</div>
                        <div class="col-sm-8"><?= $profil->username; ?></div>
                    </div>
                    <div class="row mb-3 border-bottom pb-2">
                        <div class="col-sm-4 text-muted">Nomor Telepon</div>
                        <div class="col-sm-8"><?= $profil->no_telp ? $profil->no_telp : '-'; ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 text-muted">Alamat</div>
                        <div class="col-sm-8"><?= $profil->alamat ? $profil->alamat : '-'; ?></div>
                    </div>
                </div>
                <div class="card-footer bg-light border-0 py-3 text-center">
                    <small class="text-muted italic">Bergabung sejak: <?= date('d F Y', strtotime($profil->tgl_gabung)); ?></small>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mt-4">
        <div class="col-md-8 mx-auto text-center">
            <button type="button" class="btn btn-warning btn-sm px-4 shadow-sm" data-toggle="modal" data-target="#modalGantiPassword" style="border-radius: 50px; font-weight: 600;">
                <i class="fas fa-key mr-2"></i> Ganti Password
            </button>
            <p class="text-muted small mt-3">Ingin mengubah data diri? Silakan hubungi pengurus koperasi.</p>
        </div>
    </div>
</div>

<div class="modal fade" id="modalGantiPassword" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow" style="border-radius: 20px;">
            <div class="modal-header border-0">
                <h5 class="modal-title font-weight-bold">Ubah Kata Sandi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('index.php/user/ganti_password'); ?>" method="post">
                <div class="modal-body p-4">
                    <div class="form-group">
                        <label class="small font-weight-bold">Password Baru</label>
                        <input type="password" name="password_baru" class="form-control" placeholder="Masukkan password baru" required style="border-radius: 10px;">
                    </div>
                    <div class="form-group">
                        <label class="small font-weight-bold">Konfirmasi Password Baru</label>
                        <input type="password" name="konfirm_password" class="form-control" placeholder="Ulangi password baru" required style="border-radius: 10px;">
                    </div>
                </div>
                <div class="modal-footer border-0 p-4">
                    <button type="button" class="btn btn-light px-4" data-dismiss="modal" style="border-radius: 10px;">Batal</button>
                    <button type="submit" class="btn btn-success px-4" style="border-radius: 10px;">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>