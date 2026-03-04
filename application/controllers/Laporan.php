<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_anggota');
        // Load library pdf yang sudah dibuat/diinstall
        $this->load->library('pdf');
    }

    public function export_pdf() {
        $data['saldo'] = $this->m_anggota->get_saldo_anggota();
        
        // Load view sebagai string
        $html = $this->load->view('laporan/v_pdf_saldo', $data, true);
        
        // Generate PDF
        $this->pdf->generate($html, "Laporan_Saldo_Koperasi_" . date('Y-m-d'), 'A4', 'portrait');
    }
}