<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('M_koperasi');
        
        // Proteksi: Jika belum login atau bukan anggota, lempar ke login
        if($this->session->userdata('status') != "login" || $this->session->userdata('role') != "anggota"){
            redirect(base_url("index.php/auth"));
        }
    }

    public function index() {
        $id_session = $this->session->userdata('id_anggota');

        // Ambil data profil terbaru dari database
        $profil = $this->db->get_where('anggota', ['id_anggota' => $id_session])->row();

        if ($profil) {
            $data['profil'] = $profil;
        } else {
            $data['profil'] = (object) [
                'nama_lengkap' => $this->session->userdata('nama'),
                'id_anggota'   => $id_session,
                'alamat'       => '-',
                'no_telp'      => '-'
            ];
        }

        // 1. Ambil data statistik keuangan user
        $data['total_simpanan'] = $this->M_koperasi->get_simpanan_by_user($id_session);
        $data['total_pinjaman'] = $this->M_koperasi->get_pinjaman_by_user($id_session); 

        // 2. Hitung jumlah pinjaman yang sudah LUNAS
        $this->db->where(['id_anggota' => $id_session, 'status' => 'Lunas']);
        $data['jumlah_lunas'] = $this->db->count_all_results('pinjaman');

        // 3. Ambil data riwayat pinjaman untuk tabel
        $data['pinjaman'] = $this->M_koperasi->get_riwayat_user($id_session);
        
        $data['title'] = "Dashboard Anggota";

        $this->load->view('layout/header_user', $data); 
        $this->load->view('v_user_dashboard', $data);
        $this->load->view('layout/footer');
    }

    // --- FUNGSI PROSES PENGAJUAN PINJAMAN (UPDATE) ---
    public function proses_pengajuan() {
        $id_anggota = $this->session->userdata('id_anggota');

        // Menangkap data dari form simulasi
        $data = array(
            'id_anggota'      => $id_anggota,
            'jumlah_pinjaman' => $this->input->post('jumlah_pinjaman'), // Angka asli dari hidden input
            'jangka_waktu'    => $this->input->post('jangka_waktu'),    // Tenor bulan
            'tgl_jatuh_tempo' => $this->input->post('tgl_jatuh_tempo'), // Tanggal otomatis dari JS
            'tgl_pinjaman'    => date('Y-m-d'),
            'status'          => 'pending'
        );

        $insert = $this->db->insert('pinjaman', $data);

        if($insert) {
            $this->session->set_flashdata('success', 'Pengajuan pinjaman berhasil dikirim! Silakan tunggu konfirmasi admin.');
        } else {
            $this->session->set_flashdata('error', 'Gagal mengirim pengajuan.');
        }
        
        redirect(base_url('index.php/user'));
    }

    // --- FUNGSI AJAX UNTUK DETAIL SIMPANAN ---
    public function ambil_detail_simpanan() {
        $id = $this->input->get('id');
        $this->db->order_by('id_simpanan', 'DESC');
        $data = $this->db->get_where('simpanan', ['id_anggota' => $id])->result();
        
        if($data) {
            echo '<div class="table-responsive"><table class="table table-sm table-borderless">';
            echo '<thead class="small text-muted border-bottom"><tr><th>TGL</th><th>JENIS</th><th class="text-right">JUMLAH</th></tr></thead><tbody>';
            foreach($data as $s) {
                $tanggal = isset($s->tgl_simpan) ? $s->tgl_simpan : (isset($s->tgl_simpanan) ? $s->tgl_simpanan : date('Y-m-d'));
                echo '<tr>
                        <td class="small align-middle">'.date('d/m/y', strtotime($tanggal)).'</td>
                        <td class="align-middle"><span class="badge badge-light text-dark">'.$s->jenis_simpanan.'</span></td>
                        <td class="text-right font-weight-bold text-success align-middle">Rp '.number_format($s->jumlah,0,',','.').'</td>
                      </tr>';
            }
            echo '</tbody></table></div>';
        } else {
            echo '<div class="text-center text-muted py-3">Belum ada riwayat simpanan.</div>';
        }
    }

    // --- FUNGSI AJAX UNTUK DETAIL PINJAMAN ---
    public function ambil_detail_pinjaman() {
        $id = $this->input->get('id');
        $p = $this->db->get_where('pinjaman', ['id_pinjaman' => $id])->row();
        
        if($p) {
            $tenor = isset($p->jangka_waktu) ? $p->jangka_waktu . ' Bulan' : '-';
            $jatuh_tempo = isset($p->tgl_jatuh_tempo) ? date('d F Y', strtotime($p->tgl_jatuh_tempo)) : '-';

            echo '
            <div class="text-center mb-4">
                <div class="icon-shape bg-light-primary text-primary mb-3" style="width: 60px; height: 60px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; background-color: #e3f2fd;">
                    <i class="fas fa-file-invoice-dollar fa-2x text-primary"></i>
                </div>
                <h6 class="text-muted mb-1">ID Pinjaman</h6>
                <h5 class="font-weight-bold text-dark">#PJN-'.$p->id_pinjaman.'</h5>
            </div>
            <hr>
            <div class="row mb-3">
                <div class="col-6 text-muted small">Tanggal Pengajuan</div>
                <div class="col-6 text-right font-weight-bold">'.date('d F Y', strtotime($p->tgl_pinjaman)).'</div>
            </div>
            <div class="row mb-3">
                <div class="col-6 text-muted small">Nominal Pinjaman</div>
                <div class="col-6 text-right font-weight-bold text-success">Rp '.number_format($p->jumlah_pinjaman, 0, ',', '.').'</div>
            </div>
            <div class="row mb-3">
                <div class="col-6 text-muted small">Tenor</div>
                <div class="col-6 text-right font-weight-bold">'.$tenor.'</div>
            </div>
            <div class="row mb-3">
                <div class="col-6 text-muted small">Jatuh Tempo</div>
                <div class="col-6 text-right font-weight-bold text-primary">'.$jatuh_tempo.'</div>
            </div>
            <div class="row mb-3">
                <div class="col-6 text-muted small">Status</div>
                <div class="col-6 text-right"><span class="badge badge-primary px-3 py-2">'.strtoupper($p->status).'</span></div>
            </div>';
        } else {
            echo '<div class="text-center text-muted py-3">Data tidak ditemukan.</div>';
        }
    }

    public function edit_profil() {
        $id_anggota = $this->session->userdata('id_anggota');
        $data['profil'] = $this->db->get_where('anggota', ['id_anggota' => $id_anggota])->row();
        $data['title']  = "Lengkapi Profil";

        $this->load->view('layout/header_user', $data);
        $this->load->view('v_edit_profil', $data);
        $this->load->view('layout/footer');
    }

    public function update_profil_aksi() {
        $id_anggota = $this->session->userdata('id_anggota');
        
        $data = array(
            'alamat'  => $this->input->post('alamat'),
            'no_telp' => $this->input->post('no_telp')
        );

        $this->db->where('id_anggota', $id_anggota);
        $update = $this->db->update('anggota', $data);

        if($update) {
            $this->session->set_flashdata('success', 'Data profil berhasil diperbarui!');
        } else {
            $this->session->set_flashdata('error', 'Gagal memperbarui profil.');
        }
        
        redirect(base_url('index.php/user'));
    }

    public function ajukan_pinjaman() {
        $id_anggota = $this->session->userdata('id_anggota');
        $data['profil'] = $this->db->get_where('anggota', ['id_anggota' => $id_anggota])->row();
        $data['title']  = "Form Pengajuan Pinjaman";

        $this->load->view('layout/header_user', $data);
        $this->load->view('v_ajukan_pinjaman', $data);
        $this->load->view('layout/footer');
    }

    public function simpanan() {
        $id_session = $this->session->userdata('id_anggota');
        $data['total_simpanan'] = $this->M_koperasi->get_simpanan_by_user($id_session);
        
        $this->db->order_by('id_simpanan', 'DESC'); 
        $data['simpanan'] = $this->db->get_where('simpanan', ['id_anggota' => $id_session])->result();
        
        $data['title'] = "Simpanan Saya";
        $data['profil'] = $this->db->get_where('anggota', ['id_anggota' => $id_session])->row();

        $this->load->view('layout/header_user', $data); 
        $this->load->view('v_user_simpanan', $data); 
        $this->load->view('layout/footer');
    }

    public function pinjaman() {
        $id_session = $this->session->userdata('id_anggota');
        
        $this->db->where('id_anggota', $id_session);
        $this->db->order_by('id_pinjaman', 'DESC');
        $data['pinjaman'] = $this->db->get('pinjaman')->result();
        
        $data['title'] = "Pinjaman Saya";
        $data['profil'] = $this->db->get_where('anggota', ['id_anggota' => $id_session])->row();

        $this->load->view('layout/header_user', $data); 
        $this->load->view('v_user_pinjaman', $data); 
        $this->load->view('layout/footer');
    }

    public function profil() {
        $id_session = $this->session->userdata('id_anggota');
        $data['title'] = "Profil Saya";
        $data['profil'] = $this->db->get_where('anggota', ['id_anggota' => $id_session])->row();

        $this->load->view('layout/header_user', $data); 
        $this->load->view('v_user_profil', $data); 
        $this->load->view('layout/footer');
    }

    public function cetak_laporan() {
        $id_session = $this->session->userdata('id_anggota');
        $data['profil'] = $this->db->get_where('anggota', ['id_anggota' => $id_session])->row();
        $data['simpanan'] = $this->db->get_where('simpanan', ['id_anggota' => $id_session])->result();
        $data['pinjaman'] = $this->db->get_where('pinjaman', ['id_anggota' => $id_session])->result();
        
        $this->load->view('v_user_cetak', $data);
    }
}