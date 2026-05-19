<!DOCTYPE html>
<html>
<head>
    <title>Laporan Keanggotaan - <?= $profil->nama_lengkap; ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        .line { border-bottom: 2px solid #000; margin-bottom: 20px; }
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body onload="window.print()">
    <div class="container mt-4">
        <div class="text-center">
            <h4>LAPORAN ANGGOTA KOPERASI MITRA SEJAHTERA</h4>
            <p>Alamat Koperasi: Jl. Raya Utama No. 123 | Telp: (021) 123456</p>
        </div>
        <div class="line"></div>

        <h6>DATA ANGGOTA</h6>
        <table class="table table-sm table-borderless">
            <tr><td width="150">ID Anggota</td><td>: <?= $profil->id_anggota; ?></td></tr>
            <tr><td>Nama Lengkap</td><td>: <?= $profil->nama_lengkap; ?></td></tr>
            <tr><td>Kode Anggota</td><td>: <?= $profil->kode_anggota; ?></td></tr>
        </table>

        <h6 class="mt-4">RIWAYAT SIMPANAN</h6>
        <table class="table table-bordered table-sm">
            <thead class="thead-light">
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Nominal</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1; $total=0; foreach($simpanan as $s): ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= date('d-m-Y', strtotime($s->tgl_simpan)); ?></td>
                    <td>Rp <?= number_format($s->nominal, 0, ',', '.'); ?></td>
                </tr>
                <?php $total += $s->nominal; endforeach; ?>
                <tr class="font-weight-bold">
                    <td colspan="2" class="text-right">TOTAL SALDO :</td>
                    <td>Rp <?= number_format($total, 0, ',', '.'); ?></td>
                </tr>
            </tbody>
        </table>

        <button class="btn btn-primary no-print mt-3" onclick="window.print()">
            <i class="fas fa-print"></i> Print Laporan
        </button>
        <a href="<?= base_url('index.php/user'); ?>" class="btn btn-secondary no-print mt-3">Kembali</a>
    </div>
</body>
</html>