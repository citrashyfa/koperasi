<!DOCTYPE html>
<html>
<head>
    <title>Bayar Angsuran - Koperasi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-success text-white">
                        <h5><i class="fa fa-money-bill"></i> Form Pembayaran Angsuran</h5>
                    </div>
                    <div class="card-body">
                        <?php if($this->session->flashdata('pesan')): ?>
                            <div class="alert alert-success"><?= $this->session->flashdata('pesan') ?></div>
                        <?php endif; ?>

                        <form action="<?= base_url('angsuran/bayar') ?>" method="post">
                            <div class="form-group">
                                <label>Pilih Pinjaman Anggota</label>
                                <select name="id_pinjaman" class="form-control" required>
                                    <option value="">-- Pilih Anggota & Nominal --</option>
                                    <?php foreach($pinjaman_aktif as $p): ?>
                                        <option value="<?= $p->id_pinjaman ?>">
                                            <?= $p->nama_lengkap ?> | 
                                            Cicilan: Rp <?= number_format($p->angsuran_bulanan, 0, ',', '.') ?> 
                                            (Tenor: <?= $p->lama_angsuran ?> Bln)
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <small class="text-muted">*Hanya menampilkan pinjaman yang belum lunas.</small>
                            </div>

                            <div class="form-group">
                                <label>Tanggal Bayar</label>
                                <input type="text" class="form-control" value="<?= date('d-m-Y') ?>" readonly>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block">Proses Bayar Sekarang</button>
                            <a href="<?= base_url('dashboard') ?>" class="btn btn-link btn-block">Kembali ke Dashboard</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>