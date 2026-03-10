<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Anggota extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('M_koperasi');
        $this->load->helper('url');

        // PROTEKSI LOGIN: Jika belum login, tendang ke halaman login
        if($this->session->userdata('status') != "login"){
            redirect(base_url("index.php/auth"));
        }
    }

    // 1. Menampilkan Data Anggota
    public function index() {
        $data['anggota'] = $this->db->get('anggota')->result(); 
        
        $this->load->view('layout/header');
        $this->load->view('v_anggota', $data);
        $this->load->view('layout/footer');
    }

    // 2. Aksi Tambah Anggota Baru
    public function tambah_aksi() {
        $data = [
            'nama_lengkap' => $this->input->post('nama'),
            'username'     => $this->input->post('user'), // Menambahkan username agar login lancar
            'password'     => md5($this->input->post('pass')), // Menambahkan password (enkripsi MD5)
            'alamat'       => $this->input->post('alamat'),
            'no_telp'      => $this->input->post('telp'),
            'id_jabatan'   => 2 // Default: 2 (Anggota biasa)
        ];
        
        $this->db->insert('anggota', $data);
        redirect(base_url('index.php/anggota'));
    }

    // 3. Menampilkan Halaman Edit (Membawa Data Lama)
    public function edit($id) {
        $data['anggota'] = $this->db->get_where('anggota', ['id_anggota' => $id])->row();
        
        if(!$data['anggota']) {
            redirect(base_url('index.php/anggota'));
        }

        $this->load->view('layout/header');
        $this->load->view('v_anggota_edit', $data); // Pastikan kamu buat file v_anggota_edit.php
        $this->load->view('layout/footer');
    }

    // 4. Aksi Update Data Anggota
    public function update_aksi() {
        $id = $this->input->post('id_anggota');
        $data = [
            'nama_lengkap' => $this->input->post('nama'),
            'username'     => $this->input->post('user'),
            'alamat'       => $this->input->post('alamat'),
            'no_telp'      => $this->input->post('telp')
        ];

        // Update password hanya jika diisi di form edit
        $password = $this->input->post('pass');
        if(!empty($password)) {
            $data['password'] = md5($password);
        }

        $this->db->where('id_anggota', $id); 
        $this->db->update('anggota', $data);
        redirect(base_url('index.php/anggota'));
    }

    // 5. Aksi Hapus Anggota
    public function hapus($id) {
        $this->db->where('id_anggota', $id);
        $this->db->delete('anggota');
        redirect(base_url('index.php/anggota'));
    }
}