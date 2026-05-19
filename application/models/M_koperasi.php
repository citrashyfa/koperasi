<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_koperasi extends CI_Model {

    // --- FUNGSI UNTUK ADMIN ---
    public function total_anggota() {
        return $this->db->count_all('anggota');
    }

    public function get_all_anggota() {
        return $this->db->get('anggota')->result();
    }

    public function total_simpanan() {
        $this->db->select_sum('total_simpanan'); 
        $query = $this->db->get('simpanan');
        return $query->row()->total_simpanan ?? 0;
    }

    public function total_pinjaman_out() {
        $this->db->select_sum('jumlah_pinjaman'); 
        $this->db->where('status', 'belum lunas');
        $query = $this->db->get('pinjaman');
        return $query->row()->jumlah_pinjaman ?? 0;
    }

    public function total_kas() {
        return $this->total_simpanan() - $this->total_pinjaman_out();
    }

    public function get_riwayat_simpanan() {
        $this->db->select('simpanan.*, anggota.nama_lengkap');
        $this->db->from('simpanan');
        $this->db->join('anggota', 'anggota.id_anggota = simpanan.id_anggota');
        return $this->db->get()->result();
    }

    public function get_pengajuan_pinjaman() {
        $this->db->select('pinjaman.*, anggota.nama_lengkap');
        $this->db->from('pinjaman');
        $this->db->join('anggota', 'anggota.id_anggota = pinjaman.id_anggota');
        return $this->db->get()->result();
    }

    // --- FUNGSI UNTUK USER (ANGGOTA) ---
    
    // Fungsi baru untuk mengambil profil lengkap agar Nama muncul di Banner
    public function get_profil_anggota($id) {
        return $this->db->get_where('anggota', array('id_anggota' => $id))->row();
    }

    public function get_simpanan_by_user($id) {
        $this->db->select_sum('total_simpanan'); 
        $this->db->where('id_anggota', $id);
        $query = $this->db->get('simpanan');
        return $query->row()->total_simpanan ?? 0;
    }

    public function get_pinjaman_by_user($id) {
        $this->db->select_sum('jumlah_pinjaman'); 
        $this->db->where('id_anggota', $id);
        $this->db->where('status', 'belum lunas');
        $query = $this->db->get('pinjaman');
        return $query->row()->jumlah_pinjaman ?? 0;
    }

    public function get_riwayat_user($id_anggota) {
    $this->db->where('id_anggota', $id_anggota);
    // Kita arahkan ke kolom tgl_pinjaman dan jumlah_pinjaman sesuai gambar terbaru
    $this->db->order_by('tgl_pinjaman', 'DESC'); 
    return $this->db->get('pinjaman')->result();
}

public function update_status_pinjaman($id_pinjaman, $status) {
    $this->db->where('id_pinjaman', $id_pinjaman);
    return $this->db->update('pinjaman', ['status' => $status]);
}
}