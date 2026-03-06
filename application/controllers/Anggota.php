<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Anggota extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('M_koperasi');
        $this->load->helper('url');

        // Cek status login
        if($this->session->userdata('status') != "login"){
            redirect(base_url("index.php/auth"));
        }
    }

    public function index() {
    $data['anggota'] = $this->M_koperasi->get_all_anggota();
    $this->load->view('layout/header');
    $this->load->view('v_anggota', $data);
    $this->load->view('layout/footer');
    }

    public function simpan() {
        $data = [
            'nama_lengkap' => $this->input->post('nama'), // Nama kolom di DB adalah 'nama_lengkap'
            'alamat'       => $this->input->post('alamat'),
            'no_telp'      => $this->input->post('no_telp')
        ];
        $this->db->insert('anggota', $data);
        redirect(base_url('index.php/anggota'));
    }

    // Fungsi hapus cukup satu saja di sini
    public function hapus($id) {
        $this->db->where('id_anggota', $id); // Primary key di DB adalah 'id_anggota'
        $this->db->delete('anggota');
        redirect(base_url('index.php/anggota'));
    }

    public function update() {
        // Disesuaikan dengan primary key database: id_anggota
        $id = $this->input->post('id');
        $data = [
            'nama_lengkap' => $this->input->post('nama'),
            'alamat'       => $this->input->post('alamat'),
            'no_telp'      => $this->input->post('no_telp')
        ];
        $this->db->where('id_anggota', $id); 
        $this->db->update('anggota', $data);
        redirect(base_url('index.php/anggota'));
    }
    
    // Fungsi hapus yang tadinya ada di sini sudah saya hapus karena duplikat
}