<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pinjaman extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Sesuai kesepakatan awal, kita pakai M_koperasi agar satu pintu
        $this->load->model('M_koperasi');
        $this->load->library(['form_validation', 'session']);
        $this->load->helper('url');
    }

    // 1. Menampilkan Daftar Pinjaman
    public function index() {
        $data['pinjaman'] = $this->M_koperasi->get_pengajuan_pinjaman();
        
        $this->load->view('layout/header');
        $this->load->view('pinjaman/v_daftar', $data);
        $this->load->view('layout/footer');
    }

    // 2. Menampilkan Form Tambah Pinjaman
    public function tambah() {
        $data['anggota'] = $this->M_koperasi->get_semua_anggota();
        
        $this->load->view('layout/header');
        $this->load->view('pinjaman/v_tambah', $data);
        $this->load->view('layout/footer');
    }

    // 3. Eksekusi Simpan Pinjaman (Logika Si A)
    public function simpan_pinjaman() {
        // Validasi Input
        $this->form_validation->set_rules('jumlah_pinjaman', 'Jumlah Pinjaman', 'required|numeric');
        $this->form_validation->set_rules('lama_angsuran', 'Tenor', 'required|is_natural_no_zero');
        $this->form_validation->set_rules('id_anggota', 'Anggota', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->tambah(); // Jika gagal balik ke form tambah
        } else {
            // Ambil input
            $jumlah_pinjam = $this->input->post('jumlah_pinjaman', TRUE);
            $tenor         = $this->input->post('lama_angsuran', TRUE); 
            $bunga_persen  = 1.5; // Bunga flat per bulan

            // Logika Hitung Bunga Flat (Racikan Si A)
            $pokok_per_bulan = $jumlah_pinjam / $tenor;
            $bunga_per_bulan = $jumlah_pinjam * ($bunga_persen / 100);
            $total_angsuran  = round($pokok_per_bulan + $bunga_per_bulan);

            // Siapkan Data
            $data = [
                'id_anggota'      => $this->input->post('id_anggota', TRUE),
                'jumlah_pinjaman' => $jumlah_pinjam,
                'bunga'           => $bunga_persen,
                'lama_angsuran'   => $tenor,
                // Pastikan di database tabel pinjaman ada kolom angsuran_bulanan
                'angsuran_bulanan'=> $total_angsuran, 
                'tgl_pengajuan'   => date('Y-m-d'),
                'status_pinjaman' => 'proses'
            ];

            // Eksekusi simpan ke M_koperasi
            $simpan = $this->M_koperasi->insert_pinjaman($data);

            if($simpan) {
                $this->session->set_flashdata('success', 'Pengajuan pinjaman berhasil dikirim!');
            } else {
                $this->session->set_flashdata('error', 'Gagal menyimpan data.');
            }

            redirect('pinjaman');
        }
    }

    // 4. Verifikasi Pinjaman (Update Status)
    public function verifikasi($id, $status) {
        // status bisa 'disetujui' atau 'ditolak'
        $this->M_koperasi->update_status_pinjaman($id, $status);
        $this->session->set_flashdata('success', 'Status pinjaman berhasil diperbarui!');
        redirect('pinjaman');
    }
}