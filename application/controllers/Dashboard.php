<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Me-load Model yang sudah kamu buat tadi
        $this->load->model('M_koperasi');
        // Pastikan url helper aktif untuk link menu
        $this->load->helper('url');
    }

    public function index() {
        // Mengambil data statistik dari Model M_koperasi
        $data['total_anggota']  = $this->M_koperasi->total_anggota();
        $data['total_simpanan'] = $this->M_koperasi->total_simpanan();
        $data['total_pinjaman'] = $this->M_koperasi->total_pinjaman_out();
        
        // Logika Hitung Kas: Uang masuk (Simpanan) dikurangi Uang keluar (Pinjaman)
        $data['kas_koperasi']   = $data['total_simpanan'] - $data['total_pinjaman'];

        // Memanggil Template (Tugas Si B) dan mengirimkan $data
        $this->load->view('layout/header');
        $this->load->view('v_dashboard', $data);
        $this->load->view('layout/footer');
    }
}