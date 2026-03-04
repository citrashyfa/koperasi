<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tambah Anggota Baru</h6>
    </div>
    <div class="card-body">
        <form action="<?= base_url('anggota/proses_simpan') ?>" method="post">
            <div class="form-group">
                <label>Kode Anggota</label>
                <input type="text" name="kode" class="form-control" placeholder="Contoh: AG-001" required>
            </div>
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="nama" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Alamat</label>
                <textarea name="alamat" class="form-control" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label>No. Telepon</label>
                <input type="text" name="telp" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Simpan Data Anggota</button>
            <a href="<?= base_url('anggota') ?>" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>