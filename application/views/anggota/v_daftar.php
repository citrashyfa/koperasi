<div class="container-fluid p-4">
    <div class="card shadow border-0">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="m-0 font-weight-bold text-primary">Daftar Anggota Koperasi</h5>
            <a href="<?= base_url('index.php/anggota/tambah'); ?>" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah Anggota
            </a>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead class="bg-light">
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nama Lengkap</th>
                        <th>Alamat</th>
                        <th>No. Telp</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; foreach($anggota as $row): ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row['kode_anggota']; ?></td>
                        <td><?= $row['nama_lengkap']; ?></td>
                        <td><?= $row['alamat']; ?></td>
                        <td><?= $row['no_telp']; ?></td>
                        <td>
                            <button class="btn btn-sm btn-warning text-white">Edit</button>
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>