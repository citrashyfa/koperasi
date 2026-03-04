<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Input Simpanan Anggota</h6>
    </div>
    <div class="card-body">
        <form action="<?= base_url('simpanan/proses_simpan') ?>" method="post">
            <div class="form-group">
                <label>Pilih Anggota</label>
                <select name="id_anggota" class="form-control" required>
                    <option value="">-- Pilih Anggota --</option>
                    <?php foreach($anggota as $a): ?>
                    <option value="<?= $a->id_anggota ?>"><?= $a->kode_anggota ?> - <?= $a->nama_lengkap ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Jumlah Simpanan (Rp)</label>
                <input type="number" name="jumlah" class="form-control" placeholder="Contoh: 100000" required>
            </div>
            <button type="submit" class="btn btn-primary">Proses Simpanan</button>
        </form>
    </div>
</div>