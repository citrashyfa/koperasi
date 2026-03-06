<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_koperasi extends CI_Model {

    // 1. Menghitung total jumlah orang di tabel anggota
    public function total_anggota() {
        return $this->db->count_all('anggota');
    }

    // 2. Mengambil semua data anggota untuk ditampilkan di tabel v_anggota
    public function get_all_anggota() {
        return $this->db->get('anggota')->result();
    }

    // 3. Menghitung total seluruh uang simpanan
    public function total_simpanan() {
        $this->db->select_sum('total_simpanan'); 
        $query = $this->db->get('simpanan');
        $hasil = $query->row();
        return $hasil->total_simpanan ?? 0;
    }

    // 4. Menghitung total pinjaman yang belum lunas
    public function total_pinjaman_out() {
        $this->db->select_sum('jumlah_pinjaman'); 
        $this->db->where('status', 'belum lunas');
        $query = $this->db->get('pinjaman');
        $hasil = $query->row();
        return $hasil->jumlah_pinjaman ?? 0;
    }

    // 5. Menghitung saldo kas (Uang Masuk - Uang Keluar)
    public function total_kas() {
        return $this->total_simpanan() - $this->total_pinjaman_out();
    }

    public function get_riwayat_simpanan() {
        $this->db->select('simpanan.*, anggota.nama_lengkap');
        $this->db->from('simpanan');
        $this->db->join('anggota', 'anggota.id_anggota = simpanan.id_anggota');
        return $this->db->get()->result();
    }

    // --- TAMBAHKAN FUNGSI INI UNTUK MENGHILANGKAN ERROR ---
    public function get_pengajuan_pinjaman() {
    $this->db->select('pinjaman.*, anggota.nama_lengkap');
    $this->db->from('pinjaman');
    $this->db->join('anggota', 'anggota.id_anggota = pinjaman.id_anggota');
    return $this->db->get()->result();
    }
}