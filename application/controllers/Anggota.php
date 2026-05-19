<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Anggota extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Memastikan library session, database, dan helper url sudah terload
        $this->load->model('M_koperasi');

        // PROTEKSI LOGIN: Jika belum login, tendang ke halaman login
        if($this->session->userdata('status') != "login"){
            $this->session->set_flashdata('pesan', 'Anda harus login terlebih dahulu!');
            redirect(base_url("index.php/auth"));
        }
    }

    // 1. Menampilkan Semua Data Anggota
    public function index() {
        // Menggunakan model agar lebih rapi (tadi di M_koperasi sudah kita buat get_all_anggota)
        $data['anggota'] = $this->M_koperasi->get_all_anggota(); 
        $data['title']   = "Data Anggota";
        
        $this->load->view('layout/header', $data);
        $this->load->view('v_anggota', $data);
        $this->load->view('layout/footer');
    }

    // 2. Aksi Tambah Anggota Baru
    public function tambah_aksi() {
        // Menggunakan input post dari CI lebih aman
        $data = [
            'nama_lengkap' => $this->input->post('nama', true),
            'username'     => $this->input->post('user', true), 
            'password'     => md5($this->input->post('pass')), // Gunakan md5 sesuai sistem login Anda
            'alamat'       => $this->input->post('alamat', true),
            'no_telp'      => $this->input->post('telp', true),
            'id_jabatan'   => 2 // 2 = Anggota, 1 = Admin (sesuaikan database)
        ];
        
        $this->db->insert('anggota', $data);
        $this->session->set_flashdata('success', 'Data Anggota berhasil ditambahkan!');
        redirect(base_url('index.php/anggota'));
    }

    // 3. Menampilkan Halaman Edit (Membawa Data Lama)
    public function edit($id) {
        $data['title']   = "Edit Anggota";
        $data['anggota'] = $this->db->get_where('anggota', ['id_anggota' => $id])->row();
        
        // Cek jika data tidak ditemukan
        if(!$data['anggota']) {
            show_404();
        }

        $this->load->view('layout/header', $data);
        $this->load->view('v_anggota_edit', $data);
        $this->load->view('layout/footer');
    }

    // 4. Aksi Update Data Anggota
    public function update_aksi() {
        $id = $this->input->post('id_anggota');
        
        $data = [
            'nama_lengkap' => $this->input->post('nama', true),
            'username'     => $this->input->post('user', true),
            'alamat'       => $this->input->post('alamat', true),
            'no_telp'      => $this->input->post('telp', true)
        ];

        // Update password hanya jika kotak password diisi
        $password = $this->input->post('pass');
        if(!empty($password)) {
            $data['password'] = md5($password);
        }

        $this->db->where('id_anggota', $id); 
        $this->db->update('anggota', $data);
        
        $this->session->set_flashdata('success', 'Data Anggota berhasil diupdate!');
        redirect(base_url('index.php/anggota'));
    }

   public function hapus($id) {
    // 1. Hapus dulu data di tabel anak (pinjaman) yang nyambung ke anggota ini
    $this->db->where('id_anggota', $id);
    $this->db->delete('pinjaman');

    // 2. Baru hapus data di tabel utama (anggota)
    $this->db->where('id_anggota', $id);
    $this->db->delete('anggota');

    $this->session->set_flashdata('message', 'Data anggota dan riwayatnya berhasil dihapus!');
    redirect('anggota'); // Sesuaikan dengan nama controller anggota kamu
}
}