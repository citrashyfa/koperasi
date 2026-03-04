<!DOCTYPE html>
<html>
<head>
    <title>Tambah Anggota - Koperasi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4>Form Registrasi Anggota Baru</h4>
            </div>
            <div class="card-body">
                <form action="<?= base_url('anggota/simpan') ?>" method="post">
                    <div class="form-group">
                        <label>Kode Anggota</label>
                        <input type="text" name="kode_anggota" class="form-control" placeholder="Contoh: AG-001" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Simpan Anggota</button>
                    <a href="<?= base_url('anggota') ?>" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>