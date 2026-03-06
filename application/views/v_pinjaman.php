<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Pinjaman Anggota</h1>
        <a href="#" class="btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Pinjaman
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Riwayat Pinjaman</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" width="100%" cellspacing="0">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Nama Anggota</th>
                            <th>Jumlah Pinjaman</th>
                            <th>Bunga (%)</th>
                            <th>Tgl Pinjaman</th>
                            <th>Tenor (Bulan)</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        foreach($pinjaman as $p) : ?>
                        <tr>
                            <td class="text-center"><?= $no++; ?></td>
                            <td><?= $p->nama_lengkap; ?></td>
                            <td>Rp <?= number_format($p->jumlah_pinjaman, 0, ',', '.'); ?></td>
                            <td class="text-center"><?= $p->bunga_pinjaman; ?>%</td>
                            <td><?= date('d-m-Y', strtotime($p->tgl_pinjaman)); ?></td>
                            <td class="text-center"><?= $p->lama_angsuran; ?></td>
                            <td class="text-center">
                                <?php if($p->status == 'lunas'): ?>
                                    <span class="badge badge-success">Lunas</span>
                                <?php else: ?>
                                    <span class="badge badge-warning">Belum Lunas</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="<?= base_url('index.php/pinjaman/edit/'.$p->id_pinjaman); ?>" class="btn btn-sm btn-info" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="<?= base_url('index.php/pinjaman/hapus/'.$p->id_pinjaman); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus data ini?')" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>