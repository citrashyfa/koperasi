<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Pembayaran Angsuran: <?= $p->nama_lengkap ?></h6>
    </div>
    <div class="card-body">
        <form action="<?= base_url('angsuran/proses_bayar') ?>" method="post">
            <input type="hidden" name="id_pinjaman" value="<?= $p->id_pinjaman ?>">
            <input type="hidden" name="tenor_total" value="<?= $p->lama_angsuran ?>">
            <input type="hidden" name="angsuran_ke" value="<?= $angsuran_ke ?>">

            <div class="row">
                <div class="col-md-6">
                    <p>Total Pinjaman: <b>Rp <?= number_format($p->jumlah_pinjaman) ?></b></p>
                    <p>Tenor: <b><?= $p->lama_angsuran ?> Bulan</b></p>
                </div>
                <div class="col-md-6 text-right">
                    <h4>Angsuran Ke-<?= $angsuran_ke ?></h4>
                </div>
            </div>
            <hr>
            <div class="form-group">
                <label>Nominal yang Harus Dibayar (Pokok + Bunga)</label>
                <input type="number" name="jumlah_bayar" class="form-control form-control-lg" value="<?= $p->angsuran_bulanan ?>" readonly>
                <small class="text-danger">*Nominal flat sesuai perjanjian awal.</small>
            </div>
            
            <button type="submit" class="btn btn-success btn-block btn-lg">KONFIRMASI PEMBAYARAN</button>
        </form>
    </div>
</div>