<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm" style="border-radius: 20px;">
                <div class="card-header text-white text-center py-4" style="background: linear-gradient(135deg, #00b09b, #96c93d); border-radius: 20px 20px 0 0;">
                    <h4 class="mb-0 font-weight-bold"><i class="fas fa-hand-holding-usd mr-2"></i> Form Pengajuan Pinjaman</h4>
                </div>
                
                <div class="card-body p-4">
                    <form action="<?= base_url('index.php/user/proses_pengajuan'); ?>" method="POST">
                        
                        <div class="form-group mb-4">
                            <label class="text-muted small font-weight-bold">NAMA ANGGOTA</label>
                            <input type="text" class="form-control bg-light border-0" value="<?= $profil->nama_lengkap; ?>" readonly style="border-radius: 10px;">
                        </div>

                        <div class="form-group mb-4">
                            <label class="text-muted small font-weight-bold">NOMINAL PINJAMAN (RP)</label>
                            <input type="text" id="input_mask" class="form-control border-success" placeholder="Contoh: 1.000.000" required style="border-radius: 10px; height: 50px; font-size: 1.2rem; font-weight: bold;">
                            
                            <input type="hidden" name="jumlah_pinjaman" id="jumlah_asli">
                            <small class="text-muted">*Titik akan muncul otomatis saat Anda mengetik</small>
                        </div>

                        <div class="form-group mb-4">
                            <label class="text-muted small font-weight-bold">JANGKA WAKTU (TENOR)</label>
                            <select name="jangka_waktu" id="jangka_waktu" class="form-control border-success shadow-sm" style="border-radius: 10px; height: 50px; font-weight: bold;" required>
                                <option value="">-- Pilih Lama Pinjaman --</option>
                                <option value="3">3 Bulan</option>
                                <option value="6">6 Bulan</option>
                                <option value="12">12 Bulan (1 Tahun)</option>
                                <option value="24">24 Bulan (2 Tahun)</option>
                            </select>
                        </div>

                        <div id="box-simulasi" class="p-4 mb-4" style="display: none; background: #f0fdf4; border: 2px dashed #00b894; border-radius: 15px;">
                            <h6 class="font-weight-bold text-success mb-3"><i class="fas fa-calculator mr-2"></i> Ringkasan Simulasi</h6>
                            <div class="row">
                                <div class="col-6">
                                    <span class="text-muted small">Cicilan / Bulan:</span><br>
                                    <span class="font-weight-bold text-dark" id="res-cicilan" style="font-size: 1.1rem;">Rp 0</span>
                                </div>
                                <div class="col-6 text-right">
                                    <span class="text-muted small">Tenor:</span><br>
                                    <span class="font-weight-bold text-dark" id="res-tenor">-</span>
                                </div>
                                <div class="col-12 mt-3">
                                    <hr class="my-2">
                                    <span class="text-muted small">Estimasi Tanggal Lunas (Jatuh Tempo):</span><br>
                                    <span class="font-weight-bold text-primary" id="res-jatuh-tempo">-</span>
                                    
                                    <input type="hidden" name="tgl_jatuh_tempo" id="input_tgl_jatuh_tempo">
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-block text-white font-weight-bold py-3 mb-3" style="background: linear-gradient(135deg, #00b09b, #96c93d); border-radius: 12px; box-shadow: 0 4px 15px rgba(0, 176, 155, 0.3);">
                            KIRIM PENGAJUAN SEKARANG
                        </button>
                        
                        <a href="<?= base_url('index.php/user'); ?>" class="btn btn-link btn-block text-muted">Batal & Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const inputMask = document.getElementById('input_mask');
    const inputAsli = document.getElementById('jumlah_asli');
    const inputTenor = document.getElementById('jangka_waktu');
    const boxSimulasi = document.getElementById('box-simulasi');

    // 1. Fungsi Masking Rupiah (Titik Otomatis)
    inputMask.addEventListener('keyup', function(e) {
        let value = this.value.replace(/[^,\d]/g, '').toString();
        let split = value.split(',');
        let sisa = split[0].length % 3;
        let rupiah = split[0].substr(0, sisa);
        let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            let separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        this.value = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        inputAsli.value = value.replace(/\./g, ''); // Simpan angka asli ke hidden input
        
        updateSimulasi();
    });

    // 2. Fungsi Hitung Cicilan & Jatuh Tempo
    inputTenor.addEventListener('change', updateSimulasi);

    function updateSimulasi() {
        const nominal = parseInt(inputAsli.value) || 0;
        const tenor = parseInt(inputTenor.value) || 0;

        if (nominal > 0 && tenor > 0) {
            // Hitung Cicilan
            const cicilan = Math.ceil(nominal / tenor);
            
            // Format Rupiah untuk Tampilan
            const formatter = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            });

            document.getElementById('res-cicilan').innerText = formatter.format(cicilan);
            document.getElementById('res-tenor').innerText = tenor + " Bulan";

            // Hitung Tanggal Jatuh Tempo (Hari ini + Tenor Bulan)
            let d = new Date();
            d.setMonth(d.getMonth() + tenor);
            
            const opsiTgl = { year: 'numeric', month: 'long', day: 'numeric' };
            document.getElementById('res-jatuh-tempo').innerText = d.toLocaleDateString('id-ID', opsiTgl);
            
            // Masukkan ke Hidden Input format YYYY-MM-DD
            const yyyy = d.getFullYear();
            const mm = String(d.getMonth() + 1).padStart(2, '0');
            const dd = String(d.getDate()).padStart(2, '0');
            document.getElementById('input_tgl_jatuh_tempo').value = `${yyyy}-${mm}-${dd}`;

            boxSimulasi.style.display = 'block';
        } else {
            boxSimulasi.style.display = 'none';
        }
    }
</script>