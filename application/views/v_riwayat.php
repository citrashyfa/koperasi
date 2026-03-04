<div class="card shadow">
    <div class="card-header bg-dark text-white">Riwayat Angsuran Masuk</div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>ID Pinjaman</th>
                    <th>Angsuran Ke-</th>
                    <th>Nominal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($riwayat as $r): ?>
                <tr>
                    <td><?= $r->tgl_bayar ?></td>
                    <td>PJN-00<?= $r->id_pinjaman ?></td>
                    <td><span class="badge badge-info"><?= $r->angsuran_ke ?></span></td>
                    <td>Rp <?= number_format($r->jumlah_bayar) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>