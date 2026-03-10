<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

   public function index() {
    // 1. Ambil Total untuk Card (Tetap sama)
    $this->db->select_sum('nominal');
    $data['total_simpanan'] = $this->db->get('simpanan')->row()->nominal ?? 0;

    $this->db->select_sum('nominal');
    $this->db->where('status', 'Belum Lunas');
    $data['pinjaman_aktif'] = $this->db->get('pinjaman')->row()->nominal ?? 0;

    $this->db->select_sum('nominal');
    $this->db->where('status', 'Lunas');
    $data['pinjaman_lunas'] = $this->db->get('pinjaman')->row()->nominal ?? 0;

    // 2. AMBIL RINCIAN (Tambahan agar lebih bagus)
    $this->db->select('simpanan.*, anggota.nama_lengkap');
    $this->db->from('simpanan');
    $this->db->join('anggota', 'simpanan.id_anggota = anggota.id_anggota');
    $this->db->order_by('tgl_setor', 'DESC');
    $this->db->limit(5); // Tampilkan 5 simpanan terbaru saja di laporan
    $data['rincian_simpanan'] = $this->db->get()->result();

    $this->load->view('layout/header');
    $this->load->view('v_laporan', $data);
    $this->load->view('layout/footer');
}
}