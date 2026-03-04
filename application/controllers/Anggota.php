<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Anggota extends CI_Controller {

    public function index() {
        // Menampilkan daftar anggota
        $data['anggota'] = $this->db->get('anggota')->result();
        $this->load->view('anggota/v_daftar', $data);
    }

    public function tambah() {
        // Menampilkan form tambah
        $this->load->view('anggota/v_tambah');
    }

    public function simpan() {
        $data = [
            'kode_anggota' => $this->input->post('kode_anggota'),
            'nama_lengkap' => $this->input->post('nama_lengkap'),
            'alamat'       => $this->input->post('alamat'),
            'tgl_gabung'   => date('Y-m-d'),
            'status'       => 'aktif'
        ];

        $this->db->insert('anggota', $data);
        $this->session->set_flashdata('pesan', 'Data anggota berhasil disimpan!');
        redirect('anggota');
    }
}