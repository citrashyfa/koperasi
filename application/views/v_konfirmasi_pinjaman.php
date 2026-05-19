<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nama Anggota</th>
            <th>Jumlah Pinjaman</th>
            <th>Tanggal</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($pengajuan as $p) : ?>
        <tr>
            <td><?= $p->nama_lengkap; ?></td>
            <td>Rp <?= number_format($p->jumlah_pinjaman); ?></td>
            <td><?= $p->tgl_pinjaman; ?></td>
            <td>
                <a href="<?= base_url('index.php/admin/acc_pinjaman/'.$p->id_pinjaman); ?>" class="btn btn-success btn-sm">Setujui</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>