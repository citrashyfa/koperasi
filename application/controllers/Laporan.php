<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

    public function index() {
        // 1. Ambil Total Simpanan (Kolom di tabel simpanan tetap 'nominal')
        $q_simpanan = $this->db->query("SELECT SUM(nominal) as total FROM simpanan")->row();
        $data['total_simpanan'] = $q_simpanan->total ?? 0;

        // 2. Ambil Pinjaman AKTIF 
        // Perbaikan: Nama kolom menggunakan 'jumlah_pinjaman' sesuai database kamu
        $q_aktif = $this->db->query("SELECT SUM(jumlah_pinjaman) as total FROM pinjaman WHERE status = 'belum lunas'")->row();
        $data['pinjaman_aktif'] = $q_aktif->total ?? 0;

        // 3. Ambil Pinjaman LUNAS
        // Perbaikan: Nama kolom menggunakan 'jumlah_pinjaman' sesuai database kamu
        $q_lunas = $this->db->query("SELECT SUM(jumlah_pinjaman) as total FROM pinjaman WHERE status = 'lunas'")->row();
        $data['pinjaman_lunas'] = $q_lunas->total ?? 0;

        // 4. Ambil 5 Transaksi Simpanan Terakhir
        $this->db->select('simpanan.*, anggota.nama_lengkap');
        $this->db->from('simpanan');
        $this->db->join('anggota', 'simpanan.id_anggota = anggota.id_anggota');
        $this->db->order_by('id_simpanan', 'DESC'); 
        $this->db->limit(5);
        $data['rincian_simpanan'] = $this->db->get()->result();

        // 5. Load View
        $this->load->view('layout/header');
        $this->load->view('v_laporan', $data);
        $this->load->view('layout/footer');
    }
}