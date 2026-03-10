<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pinjaman extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        // Memastikan hanya admin yang sudah login yang bisa akses
        if($this->session->userdata('status') != "login"){
            redirect(base_url("index.php/auth"));
        }
    }

    // 1. Menampilkan Daftar Pinjaman
    public function index() {
        // Query untuk mengambil data pinjaman digabung dengan nama anggota dari tabel anggota
        $this->db->select('pinjaman.*, anggota.nama_lengkap');
        $this->db->from('pinjaman');
        $this->db->join('anggota', 'pinjaman.id_anggota = anggota.id_anggota', 'left');
        $data['pinjaman'] = $this->db->get()->result();

        // Mengambil daftar anggota untuk isi Dropdown (Pilih Nama) di Modal Tambah Pinjaman
        $data['anggota_list'] = $this->db->get('anggota')->result();

        $this->load->view('layout/header');
        $this->load->view('v_pinjaman', $data);
        $this->load->view('layout/footer');
    }

    // 2. Aksi Tambah Pinjaman Baru
    public function tambah_aksi() {
        // Menangkap data dari form modal
        $data = [
            'id_anggota' => $this->input->post('id_anggota'),
            'nominal'    => $this->input->post('nominal'),
            'tgl_pinjam' => $this->input->post('tanggal') ? $this->input->post('tanggal') : date('Y-m-d'),
            'status'     => 'Belum Lunas'
        ];
        
        // Simpan ke tabel pinjaman
        $this->db->insert('pinjaman', $data);
        
        // Kembali ke halaman utama pinjaman
        redirect(base_url('index.php/pinjaman'));
    }

    // 3. Aksi Hapus Pinjaman
    public function hapus($id) {
        // Menghapus data berdasarkan id_pinjaman
        $this->db->where('id_pinjaman', $id);
        $this->db->delete('pinjaman');
        
        // Kembali ke halaman utama pinjaman
        redirect(base_url('index.php/pinjaman'));
    }

   public function set_lunas($id) {
    // 1. Cari data pinjaman berdasarkan ID, lalu ubah statusnya jadi Lunas
    $this->db->where('id_pinjaman', $id);
    $this->db->update('pinjaman', ['status' => 'Lunas']);
    
    // 2. Setelah beres, balikkan lagi ke halaman pinjaman
    redirect(base_url('index.php/pinjaman'));
}
}