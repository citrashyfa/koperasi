<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Pengajuan Pinjaman</h6>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Anggota</th>
                    <th>Jumlah Pinjam</th>
                    <th>Tenor (Bulan)</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($pinjaman as $p): ?>
                <tr>
                    <td><?= $p->nama_lengkap ?></td>
                    <td>Rp <?= number_format($p->jumlah_pinjaman) ?></td>
                    <td><?= $p->lama_angsuran ?> Bulan</td>
                    <td>
                        <?php if($p->status_pinjaman == 'proses'): ?>
                            <span class="badge badge-warning">Menunggu</span>
                        <?php elseif($p->status_pinjaman == 'disetujui'): ?>
                            <span class="badge badge-success">Disetujui</span>
                        <?php else: ?>
                            <span class="badge badge-danger">Ditolak</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if($p->status_pinjaman == 'proses'): ?>
                            <a href="<?= base_url('pinjaman/setujui/'.$p->id_pinjaman) ?>" class="btn btn-sm btn-success">Setujui</a>
                            <a href="<?= base_url('pinjaman/tolak/'.$p->id_pinjaman) ?>" class="btn btn-sm btn-danger">Tolak</a>
                        <?php else: ?>
                            <button class="btn btn-sm btn-secondary" disabled>Selesai</button>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>