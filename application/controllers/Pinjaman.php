<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pinjaman extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('M_koperasi');
        
        // Proteksi Login
        if($this->session->userdata('status') != "login"){
            redirect(base_url("index.php/auth"));
        }
    }

    public function index() {
        // Baris 16 yang tadi error sekarang sudah aman karena fungsinya sudah ada di model
        $data['pinjaman'] = $this->M_koperasi->get_pengajuan_pinjaman();
        
        $this->load->view('layout/header');
        $this->load->view('v_pinjaman', $data); // Pastikan nama file view-nya benar
        $this->load->view('layout/footer');
    }
    
    // Anda bisa menambahkan fungsi simpan/hapus pinjaman di bawah sini jika diperlukan
}