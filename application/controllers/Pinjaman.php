<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pinjaman extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        // Memuat Model M_koperasi agar bisa digunakan di semua fungsi
        $this->load->model('M_koperasi');
        
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
        $data = [
            'id_anggota' => $this->input->post('id_anggota'),
            'jumlah_pinjaman'    => $this->input->post('nominal'), // Sesuaikan nama kolom jika di DB adalah jumlah_pinjaman
            'tgl_pinjaman' => $this->input->post('tanggal') ? $this->input->post('tanggal') : date('Y-m-d'),
            'status'     => 'pending' // Default pengajuan baru adalah pending
        ];
        
        $this->db->insert('pinjaman', $data);
        $this->session->set_flashdata('success', 'Pinjaman baru berhasil ditambahkan.');
        redirect(base_url('index.php/pinjaman'));
    }

    // 3. Aksi Hapus Pinjaman
    public function hapus($id) {
        $this->db->where('id_pinjaman', $id);
        $this->db->delete('pinjaman');
        $this->session->set_flashdata('success', 'Data pinjaman berhasil dihapus.');
        redirect(base_url('index.php/pinjaman'));
    }

    // 4. Set Lunas manual
    public function set_lunas($id) {
        $this->db->where('id_pinjaman', $id);
        $this->db->update('pinjaman', ['status' => 'lunas']);
        $this->session->set_flashdata('success', 'Status pinjaman diperbarui menjadi Lunas.');
        redirect(base_url('index.php/pinjaman'));
    }

    // 5. ACC Pinjaman (Ubah pending ke belum lunas/aktif)
    public function acc_pinjaman($id) {
        $data = array('status' => 'belum lunas');
        $where = array('id_pinjaman' => $id);
        
        $this->db->update('pinjaman', $data, $where);
        
        $this->session->set_flashdata('success', 'Pinjaman berhasil disetujui!');
        redirect(base_url('index.php/pinjaman'));
    }

    // 6. Tolak Pinjaman
    public function tolak_pinjaman($id) {
        // Menggunakan model M_koperasi yang sudah di-load di construct
        $this->db->where('id_pinjaman', $id);
        $this->db->update('pinjaman', ['status' => 'ditolak']);
        
        $this->session->set_flashdata('info', 'Pinjaman telah ditolak.');
        redirect(base_url('index.php/pinjaman'));
    }
}