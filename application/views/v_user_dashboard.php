<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Selamat Datang, <strong><?= $profil->nama_lengkap; ?></strong></h1>
    </div>

    <div class="row">
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2 border-bottom-success">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Tabungan Anda</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                Rp <?= number_format($simpanan->total_simpanan ?? 0, 0, ',', '.'); ?>
                            </div>
                        </div>
                        <div class="col-auto"><i class="fas fa-wallet fa-2x text-gray-300"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2 border-bottom-primary">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Alamat Domisili</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $profil->alamat; ?></div>
                        </div>
                        <div class="col-auto"><i class="fas fa-map-marker-alt fa-2x text-gray-300"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-light">
            <h6 class="m-0 font-weight-bold text-success">Riwayat Pinjaman Saya</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                    <thead class="bg-light text-center">
                        <tr>
                            <th>Tgl Pinjam</th>
                            <th>Jumlah Pinjaman</th>
                            <th>Tenor</th>
                            <th>Status Pembayaran</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php if(!empty($pinjaman)): foreach($pinjaman as $p): ?>
                        <tr>
                            <td><?= date('d-m-Y', strtotime($p->tgl_pinjaman)); ?></td>
                            <td class="font-weight-bold">Rp <?= number_format($p->jumlah_pinjaman, 0, ',', '.'); ?></td>
                            <td><?= $p->lama_angsuran; ?> Bln</td>
                            <td>
                                <span class="badge badge-pill badge-<?= ($p->status == 'lunas') ? 'success' : 'warning text-dark'; ?>">
                                    <?= strtoupper($p->status); ?>
                                </span>
                            </td>
                        </tr>
                        <?php endforeach; else: ?>
                        <tr><td colspan="4" class="text-muted">Belum ada riwayat pinjaman terdaftar.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>