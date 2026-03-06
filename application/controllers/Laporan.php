<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('M_koperasi');
        
        // Proteksi Login
        if($this->session->userdata('status') != "login"){
            redirect(base_url("index.php/auth"));
        }
    }

    public function index() {
        // Mengambil data ringkasan untuk laporan
        $data['total_anggota']  = $this->M_koperasi->total_anggota();
        $data['total_simpanan'] = $this->M_koperasi->total_simpanan();
        $data['total_pinjaman'] = $this->M_koperasi->total_pinjaman_out();
        $data['total_kas']      = $this->M_koperasi->total_kas();

        $this->load->view('layout/header');
        $this->load->view('v_laporan', $data);
        $this->load->view('layout/footer');
    }
}