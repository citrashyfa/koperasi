<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_koperasi extends CI_Model {

    // ==========================================
    // 1. FUNGSI UNTUK DASHBOARD (STATISTIK)
    // ==========================================

    // Hitung total semua anggota
    public function total_anggota() {
        return $this->db->count_all('anggota');
    }

    // Hitung total seluruh simpanan yang masuk
    public function total_simpanan() {
        $this->db->select_sum('jumlah_simpanan');
        $query = $this->db->get('simpanan');
        return $query->row()->jumlah_simpanan ?? 0;
    }

    // Hitung total pinjaman yang statusnya 'disetujui'
    public function total_pinjaman_out() {
        $this->db->select_sum('jumlah_pinjaman');
        $this->db->where('status_pinjaman', 'disetujui');
        $query = $this->db->get('pinjaman');
        return $query->row()->jumlah_pinjaman ?? 0;
    }

    // ==========================================
    // 2. KELOLA DATA ANGGOTA
    // ==========================================

    public function get_semua_anggota() {
        return $this->db->get('anggota')->result();
    }

    public function simpan_anggota($data) {
        return $this->db->insert('anggota', $data);
    }

    // ==========================================
    // 3. KELOLA TRANSAKSI SIMPANAN
    // ==========================================

    public function get_riwayat_simpanan() {
        $this->db->select('simpanan.*, anggota.nama_lengkap');
        $this->db->from('simpanan');
        $this->db->join('anggota', 'simpanan.id_anggota = anggota.id_anggota');
        $this->db->order_by('tgl_simpanan', 'DESC');
        return $this->db->get()->result();
    }

    public function tambah_simpanan($data) {
        return $this->db->insert('simpanan', $data);
    }

    // ==========================================
    // 4. KELOLA PINJAMAN & PERSETUJUAN
    // ==========================================

    public function get_pengajuan_pinjaman() {
        $this->db->select('pinjaman.*, anggota.nama_lengkap');
        $this->db->from('pinjaman');
        $this->db->join('anggota', 'pinjaman.id_anggota = anggota.id_anggota');
        return $this->db->get()->result();
    }

    public function update_status_pinjaman($id, $status) {
        $this->db->where('id_pinjaman', $id);
        return $this->db->update('pinjaman', ['status_pinjaman' => $status]);
    }

    // ==========================================
    // 5. KELOLA ANGSURAN (PEMBAYARAN)
    // ==========================================

    public function simpan_angsuran($data) {
        return $this->db->insert('angsuran', $data);
    }
}