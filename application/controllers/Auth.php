<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function index() {
        // Jika sudah login, langsung arahkan ke dashboard masing-masing
        if($this->session->userdata('status') == "login") {
            if($this->session->userdata('role') == "admin") {
                redirect("dashboard");
            } else {
                redirect("user");
            }
        }
        $this->load->view('v_login');
    }

    public function login_aksi() {
        $username = $this->input->post('username', TRUE);
        $password = $this->input->post('password', TRUE);

        if(empty($username) || empty($password)) {
            $this->session->set_flashdata('error', 'Username dan Password wajib diisi!');
            redirect('auth');
        }

        // 1. Cek Login sebagai ADMIN (Tabel users)
        $cek_admin = $this->db->get_where('users', array('username' => $username, 'password' => $password));

        if($cek_admin->num_rows() > 0){
            $data_admin = $cek_admin->row();
            $data_session = array(
                'id_user' => $data_admin->id_user,
                'nama'    => $data_admin->nama_admin,
                'role'    => 'admin',
                'status'  => 'login'
            );
            $this->session->set_userdata($data_session);
            redirect("dashboard");

        } else {
            // 2. Cek Login sebagai ANGGOTA (Tabel anggota)
            $cek_user = $this->db->get_where('anggota', array('username' => $username, 'password' => $password));

            if($cek_user->num_rows() > 0) {
                $data_user = $cek_user->row();
                $data_session = array(
                    'id_anggota' => $data_user->id_anggota,
                    'nama'       => $data_user->nama_lengkap,
                    'role'       => 'anggota',
                    'status'     => 'login'
                );
                $this->session->set_userdata($data_session);
                redirect("user");
            } else {
                $this->session->set_flashdata('error', 'Username atau Password salah!');
                redirect('auth');
            }
        }
    }

    // Menampilkan halaman Register
    public function register() {
        $data['jabatan'] = $this->db->get('jabatan')->result();
        $this->load->view('v_register', $data);
    }

    // Aksi pendaftaran akun
    public function register_aksi() {
        $data = array(
            'nama_admin' => $this->input->post('nama_admin'),
            'username'   => $this->input->post('username'),
            'password'   => $this->input->post('password'),
            'id_jabatan' => $this->input->post('id_jabatan')
        );

        $simpan = $this->db->insert('users', $data);
        if($simpan) {
            $this->session->set_flashdata('success', 'Registrasi berhasil! Silakan Login.');
            redirect('auth');
        } else {
            $this->session->set_flashdata('error', 'Registrasi gagal, coba lagi.');
            redirect('auth/register');
        }
    }

    // --- FITUR RESET PASSWORD ---

    // 1. Menampilkan halaman Reset Password (Agar tidak 404)
    public function reset_password() {
        $this->load->view('v_reset_password');
    }

    public function reset_aksi() {
    $username = $this->input->post('username', TRUE);
    $password_baru = $this->input->post('password_baru', TRUE);
    
    // Logika pengecekan user admin/anggota tetap sama seperti sebelumnya...
    // (Gunakan kode reset_aksi yang sudah saya berikan sebelumnya)
}

    public function logout() {
        $this->session->sess_destroy();
        redirect('auth');
    }
}