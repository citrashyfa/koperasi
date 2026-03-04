<html>
<head>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .header { text-align: center; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>LAPORAN SALDO ANGGOTA KOPERASI</h2>
        <p>Tanggal Cetak: <?= date('d/m/Y'); ?></p>
    </div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Nama Anggota</th>
                <th>Saldo Akhir</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; foreach($saldo as $row): ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $row->kode_anggota; ?></td>
                <td><?= $row->nama_lengkap; ?></td>
                <td>Rp <?= number_format($row->saldo_akhir, 0, ',', '.'); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>