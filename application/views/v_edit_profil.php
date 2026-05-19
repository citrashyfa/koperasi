<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg border-0" style="border-radius: 20px;">
                <div class="card-header text-white text-center" style="background: linear-gradient(135deg, #1d976c 0%, #93f9b9 100%); border-radius: 20px 20px 0 0; padding: 25px;">
                    <h4 class="mb-0 font-weight-bold"><i class="fas fa-user-check"></i> LENGKAPI PROFIL</h4>
                    <p class="small mb-0 opacity-8">Satu langkah lagi untuk mengaktifkan akun Anda</p>
                </div>
                <div class="card-body p-5">
                    <form action="<?= base_url('index.php/user/update_profil_aksi'); ?>" method="post">
                        
                        <div class="form-group">
                            <label class="small font-weight-bold text-uppercase text-muted">Nama Lengkap</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light border-0"><i class="fas fa-id-card text-success"></i></span>
                                </div>
                                <input type="text" class="form-control bg-light border-0" value="<?= $profil->nama_lengkap; ?>" readonly style="border-radius: 0 10px 10px 0;">
                            </div>
                        </div>
                        
                        <div class="form-group mt-4">
                            <label class="small font-weight-bold text-uppercase text-muted">Alamat Domisili</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light border-0"><i class="fas fa-map-marker-alt text-success"></i></span>
                                </div>
                                <textarea name="alamat" class="form-control border-left-0" rows="3" placeholder="Contoh: Kasihan, Bantul" required style="border-radius: 0 10px 10px 0; background-color: #f8f9fa;"><?= $profil->alamat; ?></textarea>
                            </div>
                        </div>

                        <div class="form-group mt-4">
                            <label class="small font-weight-bold text-uppercase text-muted">Nomor Telepon / WA</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light border-0"><i class="fas fa-phone text-success"></i></span>
                                </div>
                                <input type="number" name="no_telp" class="form-control border-left-0" placeholder="08XXXXXXXXXX" value="<?= $profil->no_telp; ?>" required style="border-radius: 0 10px 10px 0; background-color: #f8f9fa;">
                            </div>
                        </div>

                        <div class="mt-5">
                            <button type="submit" class="btn btn-block text-white font-weight-bold shadow-sm" style="background-color: #1d976c; border-radius: 12px; padding: 12px; transition: 0.3s;">
                                SIMPAN DATA & MASUK DASHBOARD <i class="fas fa-arrow-right ml-2"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .form-control:focus {
        box-shadow: none;
        border-color: #1d976c;
    }
    .btn:hover {
        background-color: #147a57 !important;
        transform: translateY(-2px);
    }
</style>