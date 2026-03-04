<table class="table table-hover">
    <thead class="thead-dark">
        <tr>
            <th>ID</th>
            <th>Nama Anggota</th>
            <th>Nominal</th>
            <th>Tenor</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($pengajuan as $p): ?>
        <tr>
            <td><?= $p->id_pinjaman ?></td>
            <td><?= $p->id_anggota ?></td> <td>Rp <?= number_format($p->jumlah_pinjaman) ?></td>
            <td><?= $p->lama_angsuran ?> Bulan</td>
            <td>
                <a href="<?= base_url('pinjaman/aksi_verifikasi/'.$p->id_pinjaman.'/disetujui') ?>" 
                   class="btn btn-sm btn-success" onclick="return confirm('Setujui pinjaman ini?')">
                   <i class="fa fa-check"></i> Setujui
                </a>
                <a href="<?= base_url('pinjaman/aksi_verifikasi/'.$p->id_pinjaman.'/ditolak') ?>" 
                   class="btn btn-sm btn-danger">
                   <i class="fa fa-times"></i> Tolak
                </a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>