<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Angsuran extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('M_koperasi');
        $this->load->library(['session', 'form_validation']);
    }

    // Menampilkan daftar pinjaman yang aktif (yang harus dicicil)
    public function index() {
        $this->db->select('pinjaman.*, anggota.nama_lengkap');
        $this->db->from('pinjaman');
        $this->db->join('anggota', 'pinjaman.id_anggota = anggota.id_anggota');
        $this->db->where('status_pinjaman', 'disetujui');
        $data['pinjaman_aktif'] = $this->db->get()->result();

        $this->load->view('layout/header');
        $this->load->view('angsuran/v_daftar_pinjaman', $data);
        $this->load->view('layout/footer');
    }

    // Form untuk bayar angsuran
    public function bayar($id_pinjaman) {
        $this->db->select('pinjaman.*, anggota.nama_lengkap');
        $this->db->from('pinjaman');
        $this->db->join('anggota', 'pinjaman.id_anggota = anggota.id_anggota');
        $this->db->where('id_pinjaman', $id_pinjaman);
        $data['p'] = $this->db->get()->row();

        // Hitung sudah angsuran ke berapa
        $data['angsuran_ke'] = $this->db->where('id_pinjaman', $id_pinjaman)->count_all_results('angsuran') + 1;

        $this->load->view('layout/header');
        $this->load->view('angsuran/v_bayar', $data);
        $this->load->view('layout/footer');
    }

    // Eksekusi Simpan Pembayaran
    public function proses_bayar() {
        $id_pinjaman = $this->input->post('id_pinjaman');
        $tenor_total = $this->input->post('tenor_total');
        $angsuran_ke = $this->input->post('angsuran_ke');

        $data = [
            'id_pinjaman'   => $id_pinjaman,
            'jumlah_bayar'  => $this->input->post('jumlah_bayar'),
            'angsuran_ke'   => $angsuran_ke,
            'tgl_bayar'     => date('Y-m-d H:i:s')
        ];

        $this->M_koperasi->insert_angsuran($data);

        // LOGIKA OTOMATIS: Jika angsuran sudah mencapai batas tenor, ubah status pinjaman jadi LUNAS
        if ($angsuran_ke >= $tenor_total) {
            $this->M_koperasi->update_status_pinjaman($id_pinjaman, 'lunas');
        }

        $this->session->set_flashdata('success', 'Pembayaran angsuran berhasil dicatat!');
        redirect('angsuran');
    }
}