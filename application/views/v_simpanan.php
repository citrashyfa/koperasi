<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Simpanan Anggota</h1>
        <a href="#" class="btn btn-sm btn-success shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Simpanan
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Riwayat Simpanan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>Total Simpanan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        if (!empty($simpanan)) :
                            foreach($simpanan as $s) : ?>
                            <tr>
                                <td class="text-center"><?= $no++; ?></td>
                                <td><?= $s->nama_lengkap; ?></td>
                                <td class="text-right">Rp <?= number_format($s->total_simpanan, 0, ',', '.'); ?></td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="<?= base_url('index.php/simpanan/edit/'.$s->id_simpanan); ?>" class="btn btn-sm btn-info" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="<?= base_url('index.php/simpanan/hapus/'.$s->id_simpanan); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus data ini?')" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; 
                        else : ?>
                            <tr>
                                <td colspan="4" class="text-center">Data simpanan masih kosong.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>