<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Angsuran extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load Database, Session, dan Helper agar tidak error
        $this->load->database();
        $this->load->library(['session']);
        $this->load->helper(['url']);
    }

    // Fungsi untuk menampilkan form bayar
    public function index() {
        $this->db->select('pinjaman.*, anggota.nama_lengkap');
        $this->db->from('pinjaman');
        $this->db->join('anggota', 'pinjaman.id_anggota = anggota.id_anggota');
        $this->db->where('pinjaman.status_pinjaman', 'disetujui');
        $data['pinjaman_aktif'] = $this->db->get()->result();

        $this->load->view('angsuran/v_bayar', $data);
    }

    // Fungsi proses bayar
    public function bayar() {
        $id_pinjaman = $this->input->post('id_pinjaman');
        
        // 1. Ambil data pinjaman
        $pinjaman = $this->db->get_where('pinjaman', ['id_pinjaman' => $id_pinjaman])->row();

        // Safety check: Mencegah error jika ID tidak ada
        if (!$pinjaman) {
            $this->session->set_flashdata('error', 'Data pinjaman tidak ditemukan!');
            redirect('angsuran/index');
        }

        // 2. Hitung ini angsuran ke berapa
        $cek_angsuran = $this->db->get_where('angsuran', ['id_pinjaman' => $id_pinjaman])->num_rows();
        $angsuran_ke  = $cek_angsuran + 1;

        // 3. Cek apakah sudah melebihi tenor (mencegah double bayar jika sudah lunas)
        if ($cek_angsuran >= $pinjaman->lama_angsuran) {
            $this->session->set_flashdata('error', 'Pinjaman ini sudah lunas!');
            redirect('angsuran/riwayat');
        }

        // 4. Siapkan data insert
        $data = [
            'id_pinjaman'   => $id_pinjaman,
            'angsuran_ke'   => $angsuran_ke,
            'jumlah_bayar'  => $pinjaman->angsuran_bulanan,
            'tgl_bayar'     => date('Y-m-d')
        ];

        $this->db->insert('angsuran', $data);

        // 5. Logika Pelunasan Otomatis
        if ($angsuran_ke >= $pinjaman->lama_angsuran) {
            $this->db->where('id_pinjaman', $id_pinjaman);
            $this->db->update('pinjaman', ['status_pinjaman' => 'lunas']);
        }

        $this->session->set_flashdata('pesan', 'Pembayaran angsuran ke-'.$angsuran_ke.' berhasil!');
        redirect('angsuran/riwayat');
    }

    // Fungsi untuk melihat riwayat
    public function riwayat() {
        $this->db->select('angsuran.*, anggota.nama_lengkap, pinjaman.jumlah_pinjaman');
        $this->db->from('angsuran');
        $this->db->join('pinjaman', 'angsuran.id_pinjaman = pinjaman.id_pinjaman');
        $this->db->join('anggota', 'pinjaman.id_anggota = anggota.id_anggota');
        $this->db->order_by('tgl_bayar', 'DESC');
        $data['riwayat'] = $this->db->get()->result();

        $this->load->view('angsuran/v_riwayat', $data);
    }
}