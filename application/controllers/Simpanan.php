<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Simpanan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('M_koperasi');
        
        if($this->session->userdata('status') != "login"){
            redirect(base_url("index.php/auth"));
        }
    }

    public function index() {
        // Data dikirim ke view dengan nama 'simpanan'
        $data['simpanan'] = $this->M_koperasi->get_riwayat_simpanan(); 
        
        $this->load->view('layout/header');
        $this->load->view('v_simpanan', $data); 
        $this->load->view('layout/footer');
    }
}