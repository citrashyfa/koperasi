<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        // 1. Load Model & Helper
        // Memastikan model M_koperasi sudah terhubung untuk mengambil data database
        $this->load->model('M_koperasi');
        $this->load->helper('url');

        // 2. PROTEKSI LOGIN
        // Jika session 'status' bukan 'login', user tendang balik ke halaman login
        if($this->session->userdata('status') != "login"){
            redirect(base_url("index.php/auth"));
        }
    }

    public function index() {
        // Ambil data real-time dari Model M_koperasi
        // Pastikan nama function di model (total_anggota, dll) sudah sesuai
        $data['total_anggota']  = $this->M_koperasi->total_anggota();
        $data['total_simpanan'] = $this->M_koperasi->total_simpanan();
        $data['total_pinjaman'] = $this->M_koperasi->total_pinjaman_out();
        $data['kas_koperasi']   = $this->M_koperasi->total_kas();

        // Kirim data ke View agar angka di kotak statistik muncul
        $this->load->view('layout/header');
        $this->load->view('v_dashboard', $data); // Data statistik masuk ke sini
        $this->load->view('layout/footer');
    }
}