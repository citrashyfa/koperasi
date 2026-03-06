<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('M_koperasi');
        $this->load->helper('url');
        
        // Proteksi halaman: Hanya anggota yang boleh masuk
        if($this->session->userdata('role') != "anggota"){
            redirect(base_url("index.php/auth"));
        }
    }

    public function index() {
        $id_anggota = $this->session->userdata('id_anggota');
        
        // Ambil data profil, simpanan, dan pinjaman
        $data['profil'] = $this->db->get_where('anggota', ['id_anggota' => $id_anggota])->row();
        $data['simpanan'] = $this->db->get_where('simpanan', ['id_anggota' => $id_anggota])->row();
        $data['pinjaman'] = $this->db->get_where('pinjaman', ['id_anggota' => $id_anggota])->result();

        $this->load->view('layout/header_user', $data);
        $this->load->view('v_user_dashboard', $data);
        $this->load->view('layout/footer');
    }
}