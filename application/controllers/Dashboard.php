<?php
class Dashboard extends CI_Controller {
    public function index() {
        // Hitung Total Simpanan
        $data['total_simpanan'] = $this->db->select_sum('jumlah_simpanan')->get('simpanan')->row()->jumlah_simpanan;
        
        // Hitung Total Pinjaman (yang sudah disetujui)
        $data['total_pinjaman'] = $this->db->select_sum('jumlah_pinjaman')->get_where('pinjaman', ['status_pinjaman' => 'disetujui'])->row()->jumlah_pinjaman;
        
        // Hitung Total Anggota
        $data['total_anggota'] = $this->db->count_all('anggota');

        // Kas Bersih
        $data['kas_koperasi'] = $data['total_simpanan'] - $data['total_pinjaman'];

        $this->load->view('v_dashboard', $data);
    }
}