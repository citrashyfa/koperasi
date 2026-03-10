<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Simpanan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('M_koperasi');
        $this->load->helper('url');
        
        // Proteksi Login
        if($this->session->userdata('status') != "login"){
            redirect(base_url("index.php/auth"));
        }
    }

    // 1. Menampilkan Daftar Total Simpanan Per Anggota
    public function index() {
        // Query untuk mengambil data anggota beserta total simpanannya
        $this->db->select('anggota.id_anggota, anggota.nama_lengkap, IFNULL(SUM(simpanan.nominal), 0) as total_simpanan');
        $this->db->from('anggota');
        $this->db->join('simpanan', 'simpanan.id_anggota = anggota.id_anggota', 'left');
        $this->db->group_by('anggota.id_anggota');
        $data['simpanan'] = $this->db->get()->result();

        // Data untuk pilihan nama anggota di Modal Tambah Simpanan
        $data['anggota_list'] = $this->db->get('anggota')->result();

        $this->load->view('layout/header');
        $this->load->view('v_simpanan', $data);
        $this->load->view('layout/footer');
    }

    // 2. Menampilkan Riwayat Transaksi Per Anggota (Fungsi Riwayat)
    public function detail($id) {
        // Ambil data profil anggota
        $data['anggota'] = $this->db->get_where('anggota', ['id_anggota' => $id])->row();

        // Ambil semua daftar setoran anggota ini (dari yang terbaru)
        $this->db->order_by('tgl_simpan', 'DESC');
        $data['riwayat'] = $this->db->get_where('simpanan', ['id_anggota' => $id])->result();

        // Hitung total saldo simpanan anggota ini
        $this->db->select_sum('nominal');
        $query_total = $this->db->get_where('simpanan', ['id_anggota' => $id])->row();
        $data['total'] = ($query_total->nominal) ? $query_total->nominal : 0;

        $this->load->view('layout/header');
        $this->load->view('v_simpanan_detail', $data); // Pastikan file v_simpanan_detail.php sudah dibuat
        $this->load->view('layout/footer');
    }

    // 3. Aksi Simpan Transaksi Baru
    public function tambah_aksi() {
        // Pastikan nama-nama input ('id_anggota', 'nominal', 'tanggal') sesuai dengan yang ada di View
        $data = [
            'id_anggota' => $this->input->post('id_anggota'),
            'nominal'    => $this->input->post('nominal'),
            'tgl_simpan' => $this->input->post('tanggal') ? $this->input->post('tanggal') : date('Y-m-d')
        ];
        
        $this->db->insert('simpanan', $data);
        redirect(base_url('index.php/simpanan'));
    }

    public function hapus($id_simpanan, $id_anggota) {
    // Menghapus data simpanan berdasarkan ID uniknya
    $this->db->where('id_simpanan', $id_simpanan);
    $this->db->delete('simpanan');

    // Setelah hapus, kembali ke halaman riwayat anggota tadi
    redirect(base_url('index.php/simpanan/detail/' . $id_anggota));
}
}