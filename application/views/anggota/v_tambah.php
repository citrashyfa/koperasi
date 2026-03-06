<div class="container-fluid p-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow border-0">
                <div class="card-header bg-primary text-white">
                    <h5 class="m-0">Tambah Anggota Baru</h5>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('index.php/anggota/proses_simpan'); ?>" method="POST">
                        <div class="form-group mb-3">
                            <label>Kode Anggota</label>
                            <input type="text" name="kode" class="form-control" placeholder="Contoh: AGT001" required>
                        </div>
                        <div class="form-group mb-3">
                            <label>Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label>Alamat</label>
                            <textarea name="alamat" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="form-group mb-4">
                            <label>No. Telepon</label>
                            <input type="text" name="telp" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Simpan Anggota</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>