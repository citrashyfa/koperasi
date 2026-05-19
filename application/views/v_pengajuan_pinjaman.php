<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="font-weight-bold text-dark mb-1">Konfirmasi Pinjaman</h3>
            <p class="text-secondary small">Setujui pengajuan pinjaman anggota atau tambahkan data secara manual.</p>
        </div>
        <button class="btn btn-success shadow-sm px-4" style="border-radius: 10px; font-weight: 600;" data-toggle="modal" data-target="#modalPinjamanManual">
            <i class="fas fa-plus-circle mr-2"></i> Tambah Pinjaman Manual
        </button>
    </div>

    <div class="card shadow-sm border-0" style="border-radius: 15px;">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 font-weight-bold text-dark">
                <i class="fas fa-clipboard-check text-success mr-2"></i> Antrean Pengajuan
            </h5>
            <span class="badge badge-pill badge-light border text-muted">Total Antrean: <?= count($pinjaman); ?></span>
        </div>
        
        <div class="card-body">
            <?php if($this->session->flashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 10px;">
                    <i class="fas fa-check-circle mr-2"></i> <?= $this->session->flashdata('success'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>

            <div class="table-responsive">
                <table class="table table-hover border">
                    <thead class="bg-success text-white">
                        <tr>
                            <th class="align-middle text-center">No</th>
                            <th class="align-middle">Nama Anggota</th>
                            <th class="align-middle">Total Pinjaman</th>
                            <th class="align-middle text-center">Tenor</th>
                            <th class="align-middle text-center">Cicilan /Bulan</th>
                            <th class="align-middle text-center">Batas Pelunasan</th>
                            <th class="align-middle text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($pinjaman)): ?>
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <i class="fas fa-inbox fa-3x text-light mb-3"></i>
                                    <p class="text-muted font-italic">Tidak ada pengajuan pinjaman baru saat ini.</p>
                                </td>
                            </tr>
                        <?php endif; ?>

                        <?php $no=1; foreach($pinjaman as $p) : 
                            $cicilan = ($p->jangka_waktu > 0) ? ($p->jumlah_pinjaman / $p->jangka_waktu) : 0;
                        ?>
                        <tr>
                            <td class="align-middle text-center"><?= $no++; ?></td>
                            <td class="align-middle">
                                <div class="font-weight-bold text-dark"><?= $p->nama_lengkap; ?></div>
                                <small class="text-muted"><i class="fas fa-clock mr-1"></i> Diajukan: <?= date('d/m/Y', strtotime($p->tgl_pinjaman)); ?></small>
                            </td>
                            <td class="align-middle font-weight-bold text-dark">
                                Rp <?= number_format($p->jumlah_pinjaman, 0, ',', '.'); ?>
                            </td>
                            
                            <td class="align-middle text-center">
                                <span class="badge badge-info px-3 py-2" style="border-radius: 8px; min-width: 80px;">
                                    <?= $p->jangka_waktu; ?> Bulan
                                </span>
                            </td>

                            <td class="align-middle text-center font-weight-bold text-primary">
                                Rp <?= number_format($cicilan, 0, ',', '.'); ?>
                            </td>

                            <td class="align-middle text-center text-dark">
                                <i class="fas fa-calendar-alt mr-1"></i> <?= date('d/m/Y', strtotime($p->tgl_jatuh_tempo)); ?>
                            </td>

                            <td class="align-middle text-center">
                                <div class="btn-group">
                                    <button type="button" 
                                        class="btn btn-success btn-sm font-weight-bold px-3 shadow-sm btn-acc" 
                                        data-url="<?= base_url('index.php/dashboard/acc_pinjaman/'.$p->id_pinjaman); ?>">
                                        <i class="fas fa-check-circle mr-1"></i> ACC
                                    </button>
                                    
                                    <button type="button" 
                                        class="btn btn-outline-danger btn-sm font-weight-bold px-3 ml-1 btn-tolak" 
                                        data-url="<?= base_url('index.php/dashboard/tolak_pinjaman/'.$p->id_pinjaman); ?>">
                                        <i class="fas fa-times mr-1"></i> TOLAK
                                    </button>
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

<div class="modal fade" id="modalPinjamanManual" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow" style="border-radius: 20px;">
            <div class="modal-header border-0 pt-4 px-4">
                <h5 class="font-weight-bold text-dark"><i class="fas fa-plus-circle text-success mr-2"></i>Tambah Pinjaman Manual</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('index.php/dashboard/tambah_pinjaman_aksi'); ?>" method="post">
                <div class="modal-body px-4">
                    <div class="form-group mb-3">
                        <label class="small font-weight-bold text-muted text-uppercase">Nama Anggota</label>
                        <select name="id_anggota" class="form-control" style="border-radius: 10px; height: 45px;" required>
                            <option value="">-- Pilih Anggota --</option>
                            <?php foreach($anggota_list as $agt): ?>
                                <option value="<?= $agt->id_anggota; ?>"><?= $agt->nama_lengkap; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label class="small font-weight-bold text-muted text-uppercase">Nominal Pinjaman (RP)</label>
                        <input type="text" id="input_nominal" class="form-control font-weight-bold" placeholder="Contoh: 1.000.000" style="border-radius: 10px; height: 45px;" required>
                        <input type="hidden" name="nominal" id="nominal_asli">
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="small font-weight-bold text-muted text-uppercase">Tenor (Bulan)</label>
                                <select name="jangka_waktu" id="tenor" class="form-control" style="border-radius: 10px; height: 45px;" required>
                                    <option value="">-- Pilih --</option>
                                    <option value="3">3 Bulan</option>
                                    <option value="6">6 Bulan</option>
                                    <option value="12">12 Bulan</option>
                                    <option value="24">24 Bulan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="small font-weight-bold text-muted text-uppercase">Tanggal Pinjam</label>
                                <input type="date" name="tanggal" id="tgl_pinjam" class="form-control" value="<?= date('Y-m-d'); ?>" style="border-radius: 10px; height: 45px;" required>
                            </div>
                        </div>
                    </div>

                    <div id="panel_simulasi" class="p-3 mt-2 mb-2 shadow-sm" style="background: #f8fbf9; border: 1px solid #d1e7dd; border-radius: 12px; display: none;">
                        <div class="d-flex justify-content-between mb-1">
                            <small class="text-muted font-weight-bold">Estimasi Cicilan / Bulan:</small>
                            <span class="font-weight-bold text-success" id="teks_cicilan">Rp 0</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <small class="text-muted font-weight-bold">Jatuh Tempo:</small>
                            <span class="font-weight-bold text-dark" id="teks_jt">-</span>
                        </div>
                        <input type="hidden" name="tgl_jatuh_tempo" id="jt_asli">
                    </div>
                </div>
                <div class="modal-footer border-0 pb-4 px-4">
                    <button type="button" class="btn btn-light px-4 font-weight-bold" data-dismiss="modal" style="border-radius: 10px;">Batal</button>
                    <button type="submit" class="btn btn-success px-4 font-weight-bold shadow-sm" style="border-radius: 10px;">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
    // Fungsi Hitung Simulasi
    function hitungSimulasi() {
        const nominal = parseInt($('#input_nominal').val().replace(/[^0-9]/g, '')) || 0;
        const bulan = parseInt($('#tenor').val()) || 0;
        const tglMulai = $('#tgl_pinjam').val();

        if (nominal > 0 && bulan > 0 && tglMulai !== "") {
            const cicilan = Math.round(nominal / bulan);
            $('#teks_cicilan').text("Rp " + cicilan.toLocaleString('id-ID'));
            $('#nominal_asli').val(nominal);

            let date = new Date(tglMulai);
            date.setMonth(date.getMonth() + bulan);
            let dd = String(date.getDate()).padStart(2, '0');
            let mm = String(date.getMonth() + 1).padStart(2, '0');
            let yyyy = date.getFullYear();
            
            $('#teks_jt').text(dd + '/' + mm + '/' + yyyy);
            $('#jt_asli').val(yyyy + '-' + mm + '-' + dd);
            $('#panel_simulasi').slideDown();
        } else {
            $('#panel_simulasi').slideUp();
        }
    }

    // Input Format Rupiah
    $('#input_nominal').on('keyup', function() {
        let val = $(this).val().replace(/[^0-9]/g, '');
        $(this).val(val.replace(/\B(?=(\d{3})+(?!\d))/g, "."));
        hitungSimulasi();
    });

    $('#tenor, #tgl_pinjam').on('change', hitungSimulasi);

    // SweetAlert untuk ACC
    $('.btn-acc').on('click', function() {
        const url = $(this).data('url');
        Swal.fire({
            title: 'Setujui Pinjaman?',
            text: "Dana akan segera diproses untuk anggota ini.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Setujui!',
            cancelButtonText: 'Batal',
            customClass: {
                popup: 'rounded-20'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    });

    // SweetAlert untuk TOLAK
    $('.btn-tolak').on('click', function() {
        const url = $(this).data('url');
        Swal.fire({
            title: 'Tolak Pengajuan?',
            text: "Data pengajuan ini akan dihapus dari antrean.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Tolak!',
            cancelButtonText: 'Kembali',
            customClass: {
                popup: 'rounded-20'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    });
});
</script>

<style>
    /* Agar SweetAlert identik dengan modal kamu */
    .rounded-20 {
        border-radius: 20px !important;
    }
    .swal2-popup {
        font-family: 'Poppins', sans-serif !important;
        padding: 2rem;
    }
    .swal2-title {
        font-weight: 700 !important;
        color: #343a40;
    }
    .swal2-html-container {
        font-size: 0.95rem !important;
        color: #6c757d !important;
    }
    .swal2-confirm, .swal2-cancel {
        border-radius: 10px !important;
        font-weight: 600 !important;
        padding: 10px 24px !important;
    }
</style>