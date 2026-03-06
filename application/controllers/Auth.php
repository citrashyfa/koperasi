<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function index() {
        // Jika session login masih ada, arahkan sesuai role
        if($this->session->userdata('status') == "login") {
            if($this->session->userdata('role') == "admin") {
                redirect(base_url("index.php/dashboard"));
            } else {
                redirect(base_url("index.php/user"));
            }
        }
        $this->load->view('v_login');
    }

    public function login_aksi() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        // 1. Cek Login sebagai ADMIN (Tabel users)
        $cek_admin = $this->db->get_where('users', array('username' => $username, 'password' => $password));

        if($cek_admin->num_rows() > 0){
            $data_admin = $cek_admin->row();
            $data_session = array(
                'nama'   => $username,
                'role'   => 'admin',
                'status' => 'login'
            );
            $this->session->set_userdata($data_session);
            redirect(base_url("index.php/dashboard"));

        } else {
            // 2. Cek Login sebagai ANGGOTA (Tabel anggota)
            // Menggunakan kode_anggota sebagai username dan kolom password yang baru kita buat
            $cek_user = $this->db->get_where('anggota', array('kode_anggota' => $username, 'password' => $password));

            if($cek_user->num_rows() > 0) {
                $data_user = $cek_user->row();
                $data_session = array(
                    'id_anggota' => $data_user->id_anggota,
                    'nama'       => $data_user->nama_lengkap,
                    'role'       => 'anggota',
                    'status'     => 'login'
                );
                $this->session->set_userdata($data_session);
                redirect(base_url("index.php/user"));
            } else {
                echo "<script>alert('Username atau Password salah!'); window.location='".base_url('index.php/auth')."';</script>";
            }
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect(base_url('index.php/auth'));
    }

    // --- Fitur Register & Reset tetap untuk Admin ---
    public function register() {
        $data['jabatan'] = $this->db->get('jabatan')->result();
        $this->load->view('v_register', $data);
    }

    public function register_aksi() {
        $data = array(
            'nama_admin' => $this->input->post('nama_admin'),
            'username'   => $this->input->post('username'),
            'password'   => $this->input->post('password'),
            'id_jabatan' => $this->input->post('id_jabatan')
        );
        $this->db->insert('users', $data);
        echo "<script>alert('Registrasi Berhasil! Silakan Login'); window.location='".base_url('index.php/auth')."';</script>";
    }

    public function reset_password() {
        $this->load->view('v_reset_password');
    }

    public function reset_aksi() {
        $username = $this->input->post('username');
        $pass_baru = $this->input->post('password_baru');

        $cek = $this->db->get_where('users', array('username' => $username))->num_rows();

        if($cek > 0) {
            $this->db->where('username', $username);
            $this->db->update('users', array('password' => $pass_baru));
            echo "<script>alert('Password Berhasil Diganti!'); window.location='".base_url('index.php/auth')."';</script>";
        } else {
            echo "<script>alert('Username tidak ditemukan!'); history.go(-1);</script>";
        }
    }
}