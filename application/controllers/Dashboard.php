<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        // Load Model & Helper
        $this->load->model('M_koperasi');
        $this->load->helper('url');

        // PROTEKSI LOGIN & ROLE ADMIN
        if($this->session->userdata('status') != "login" || $this->session->userdata('role') != "admin"){
            $this->session->set_flashdata('error', 'Akses ditolak! Anda bukan Admin.');
            redirect(base_url("index.php/auth"));
        }
    }

    // --- HALAMAN UTAMA DASHBOARD ---
    public function index() {
        $data['title'] = "Dashboard Admin";
        
        // Mengambil data statistik dari Model
        $data['total_anggota']  = $this->M_koperasi->total_anggota();
        $data['total_simpanan'] = $this->M_koperasi->total_simpanan();
        $data['total_pinjaman'] = $this->M_koperasi->total_pinjaman_out();
        $data['kas_koperasi']   = $this->M_koperasi->total_kas();

        $this->load->view('layout/header', $data);
        $this->load->view('v_dashboard', $data); 
        $this->load->view('layout/footer');
    }

    // --- HALAMAN KONFIRMASI PINJAMAN ---
    public function pengajuan_pinjaman() {
        $data['title'] = "Konfirmasi Pinjaman Anggota";
        
        // 1. Ambil data anggota untuk dropdown di Modal Tambah Pinjaman
        $data['anggota_list'] = $this->db->get('anggota')->result();

        // 2. Ambil data pinjaman yang statusnya 'pending'
        $this->db->select('pinjaman.*, anggota.nama_lengkap');
        $this->db->from('pinjaman');
        $this->db->join('anggota', 'anggota.id_anggota = pinjaman.id_anggota');
        $this->db->where('pinjaman.status', 'pending'); // Filter hanya yang mengantre
        $this->db->order_by('pinjaman.id_pinjaman', 'DESC');
        
        // VARIABEL DISESUAIKAN MENJADI 'pinjaman' AGAR COCOK DENGAN VIEW
        $data['pinjaman'] = $this->db->get()->result();

        $this->load->view('layout/header', $data); 
        $this->load->view('v_pengajuan_pinjaman', $data); 
        $this->load->view('layout/footer'); 
    }

    // --- PROSES TAMBAH PINJAMAN MANUAL OLEH ADMIN ---
    public function tambah_pinjaman_aksi() {
        // Ambil data dari inputan view
        $data = [
            'id_anggota'      => $this->input->post('id_anggota'),
            'jumlah_pinjaman' => $this->input->post('nominal'), // Ini ambil dari input 'nominal'
            'tgl_pinjaman'    => $this->input->post('tanggal'),
            'jangka_waktu'    => $this->input->post('jangka_waktu'),
            'tgl_jatuh_tempo' => $this->input->post('tgl_jatuh_tempo'),
            'status'          => 'pending' // Masuk ke antrean dulu
        ];

        $insert = $this->db->insert('pinjaman', $data);

        if($insert) {
            $this->session->set_flashdata('success', 'Data Pinjaman Berhasil Ditambahkan!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menambah data.');
        }

        redirect('dashboard/pengajuan_pinjaman');
    }

    // --- PROSES MENYETUJUI PINJAMAN (ACC) ---
    public function acc_pinjaman($id) {
        if (!$id) redirect('dashboard/pengajuan_pinjaman');

        $this->db->where('id_pinjaman', $id);
        // Status berubah dari 'pending' menjadi 'belum lunas'
        $update = $this->db->update('pinjaman', ['status' => 'belum lunas']);

        if($update) {
            $this->session->set_flashdata('success', 'Pinjaman Berhasil Disetujui!');
        } else {
            $this->session->set_flashdata('error', 'Gagal memproses persetujuan.');
        }
        
        redirect('dashboard/pengajuan_pinjaman');
    }

    // --- PROSES MENOLAK PINJAMAN ---
    public function tolak_pinjaman($id) {
        if (!$id) redirect('dashboard/pengajuan_pinjaman');

        $this->db->where('id_pinjaman', $id);
        // Status berubah jadi 'ditolak'
        $update = $this->db->update('pinjaman', ['status' => 'ditolak']);

        if($update) {
            $this->session->set_flashdata('success', 'Pinjaman Telah Ditolak.');
        } else {
            $this->session->set_flashdata('error', 'Gagal memproses penolakan.');
        }
        
        redirect('dashboard/pengajuan_pinjaman');
    }

    // --- PROSES HAPUS PINJAMAN ---
    public function hapus_pinjaman($id) {
        $this->db->where('id_pinjaman', $id);
        $delete = $this->db->delete('pinjaman');
        
        if($delete) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus selamanya.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus data.');
        }
        
        redirect('dashboard/pengajuan_pinjaman');
    }
}