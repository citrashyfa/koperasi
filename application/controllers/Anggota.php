<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Anggota extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('M_koperasi'); // Memanggil model buatanmu
    }

    // Menampilkan daftar anggota
    public function index() {
        $data['anggota'] = $this->M_koperasi->get_semua_anggota();
        
        $this->load->view('layout/header');
        $this->load->view('anggota/v_daftar', $data);
        $this->load->view('layout/footer');
    }

    // Menampilkan form tambah
    public function tambah() {
        $this->load->view('layout/header');
        $this->load->view('anggota/v_tambah');
        $this->load->view('layout/footer');
    }

    // Memproses data dari form ke database
    public function proses_simpan() {
        $data = [
            'kode_anggota' => $this->input->post('kode'),
            'nama_lengkap' => $this->input->post('nama'),
            'alamat'       => $this->input->post('alamat'),
            'no_telp'      => $this->input->post('telp'),
            'tgl_gabung'   => date('Y-m-d'),
            'status'       => 'aktif'
        ];

        $this->M_koperasi->simpan_anggota($data);
        redirect('anggota'); // Kembali ke daftar anggota
    }
}