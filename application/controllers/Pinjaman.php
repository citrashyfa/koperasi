<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pinjaman extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Pastikan model sudah di-load
        $this->load->model('m_pinjaman');
        // Pastikan library session dan validation aktif
        $this->load->library(['form_validation', 'session']);
    }

    public function simpan_pinjaman() {
        // 1. Validasi Input
        $this->form_validation->set_rules('jumlah_pinjaman', 'Jumlah Pinjaman', 'required|numeric');
        $this->form_validation->set_rules('lama_angsuran', 'Tenor', 'required|is_natural_no_zero');
        $this->form_validation->set_rules('id_anggota', 'Anggota', 'required');

        if ($this->form_validation->run() == FALSE) {
            // Jika gagal, tampilkan kembali form tambah
            $this->load->view('pinjaman/v_tambah');
        } else {
            // Ambil input dengan filter XSS
            $jumlah_pinjam = $this->input->post('jumlah_pinjaman', TRUE);
            $tenor         = $this->input->post('lama_angsuran', TRUE); 
            $bunga_persen  = 1.5; 

            // 2. Logika Hitung Bunga Flat
            $pokok_per_bulan = $jumlah_pinjam / $tenor;
            $bunga_per_bulan = $jumlah_pinjam * ($bunga_persen / 100);
            $total_angsuran  = round($pokok_per_bulan + $bunga_per_bulan);

            // 3. Siapkan Data untuk Database
            $data = [
                'id_anggota'      => $this->input->post('id_anggota', TRUE),
                'jumlah_pinjaman' => $jumlah_pinjam,
                'bunga'           => $bunga_persen,
                'lama_angsuran'   => $tenor,
                'angsuran_bulanan'=> $total_angsuran, 
                'tgl_pengajuan'   => date('Y-m-d'),
                'status_pinjaman' => 'proses'
            ];

            // 4. Eksekusi simpan melalui Model
            $simpan = $this->m_pinjaman->insert_data($data);

            if($simpan) {
                $this->session->set_flashdata('success', 'Pengajuan pinjaman berhasil dikirim!');
            } else {
                $this->session->set_flashdata('error', 'Gagal menyimpan data ke database.');
            }

            redirect('pinjaman/index');
        }
    }
}