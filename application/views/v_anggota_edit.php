<div class="container-fluid mt-4 mb-5 px-md-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="font-weight-bold text-dark mb-1">Edit Data Anggota</h3>
            <p class="text-dark small">Perbarui informasi lengkap anggota <strong><?= $anggota->nama_lengkap; ?></strong></p>
        </div>
        <a href="<?= base_url('index.php/anggota'); ?>" class="btn btn-light border shadow-sm px-4" style="border-radius: 8px;">
            <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>
    </div>

    <div class="card border-0 shadow-sm" style="border-radius: 15px;">
        <div class="card-body p-4">
            <form action="<?= base_url('index.php/anggota/update_aksi'); ?>" method="post">
                <input type="hidden" name="id_anggota" value="<?= $anggota->id_anggota; ?>">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label class="font-weight-bold text-dark">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control form-control-lg bg-light border-0 text-dark" 
                                   value="<?= $anggota->nama_lengkap; ?>" required>
                        </div>

                        <div class="form-group mb-4">
                            <label class="font-weight-bold text-dark">Username</label>
                            <input type="text" name="user" class="form-control form-control-lg bg-light border-0 text-dark" 
                                   value="<?= $anggota->username; ?>" required>
                        </div>

                        <div class="form-group mb-4">
                            <label class="font-weight-bold text-dark">Password Baru</label>
                            <input type="password" name="pass" class="form-control form-control-lg bg-light border-0" 
                                   placeholder="Kosongkan jika tidak ingin ganti password">
                            <small class="text-danger">*Isi hanya jika ingin mengganti password lama.</small>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label class="font-weight-bold text-dark">Nomor Telepon</label>
                            <input type="text" name="telp" class="form-control form-control-lg bg-light border-0 text-dark" 
                                   value="<?= $anggota->no_telp; ?>">
                        </div>

                        <div class="form-group mb-4">
                            <label class="font-weight-bold text-dark">Alamat Domisili</label>
                            <textarea name="alamat" class="form-control form-control-lg bg-light border-0 text-dark" 
                                      rows="5"><?= $anggota->alamat; ?></textarea>
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success btn-lg px-5 shadow-sm" style="border-radius: 10px; font-weight: 600;">
                        <i class="fas fa-save mr-2"></i> SIMPAN PERUBAHAN
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    /* Styling agar inputan lebih fokus dan teksnya hitam pekat */
    .form-control-lg {
        font-size: 1rem;
        border-radius: 10px;
    }
    .form-control:focus {
        background-color: #fff !important;
        box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
        border: 1px solid #28a745 !important;
    }
    label {
        font-size: 0.9rem;
        margin-bottom: 8px;
    }
    .text-dark {
        color: #2d3436 !important;
    }
</style>