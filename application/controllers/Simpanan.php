<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Simpanan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('M_koperasi');
    }

    // Menampilkan semua riwayat simpanan
    public function index() {
        $data['simpanan'] = $this->M_koperasi->get_riwayat_simpanan();
        
        $this->load->view('layout/header');
        $this->load->view('simpanan/v_riwayat', $data);
        $this->load->view('layout/footer');
    }

    // Form input simpanan baru
    public function tambah() {
        $data['anggota'] = $this->M_koperasi->get_semua_anggota();
        
        $this->load->view('layout/header');
        $this->load->view('simpanan/v_tambah', $data);
        $this->load->view('layout/footer');
    }

    // Eksekusi simpan ke database
    public function proses_simpan() {
        $data = [
            'id_anggota'      => $this->input->post('id_anggota'),
            'jumlah_simpanan' => $this->input->post('jumlah'),
            'tgl_simpanan'    => date('Y-m-d H:i:s')
        ];

        $this->M_koperasi->tambah_simpanan($data);
        redirect('simpanan');
    }
}