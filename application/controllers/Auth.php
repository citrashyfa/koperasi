<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function index() {
        // Jika sudah login, langsung arahkan ke dashboard masing-masing berdasarkan role
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
        $username = $this->input->post('username', TRUE);
        $password = $this->input->post('password', TRUE);

        if(empty($username) || empty($password)) {
            $this->session->set_flashdata('error', 'Username dan Password wajib diisi!');
            redirect(base_url('index.php/auth'));
        }

        // 1. Cek Login sebagai ADMIN (Tabel users)
        $cek_admin = $this->db->get_where('users', array('username' => $username, 'password' => $password));

        if($cek_admin->num_rows() > 0){
            $data_admin = $cek_admin->row();
            $data_session = array(
                'id_user' => $data_admin->id_user,
                'nama'    => $data_admin->nama_admin,
                'role'    => 'admin', // Role Admin
                'status'  => 'login'
            );
            $this->session->set_userdata($data_session);
            redirect(base_url("index.php/dashboard")); 

        } else {
            // 2. Cek Login sebagai ANGGOTA (Tabel anggota)
            $cek_user = $this->db->get_where('anggota', array('username' => $username, 'password' => $password));

            if($cek_user->num_rows() > 0) {
                $data_user = $cek_user->row();
                
                $data_session = array(
                    'id_anggota' => $data_user->id_anggota,
                    'nama'       => $data_user->nama_lengkap, 
                    'role'       => 'anggota', // Role Anggota
                    'status'     => 'login'
                );
                
                $this->session->set_userdata($data_session);
                
                // Redirect ke halaman user
                redirect(base_url("index.php/user"));
            } else {
                $this->session->set_flashdata('error', 'Username atau Password salah!');
                redirect(base_url('index.php/auth'));
            }
        }
    }

    public function register() {
        $this->load->view('v_register');
    }

    public function register_aksi() {
    $nama = $this->input->post('nama_lengkap');
    $user = $this->input->post('username');
    $pass = $this->input->post('password');

    $data = array(
        'nama_lengkap' => $nama,
        'username'     => $user,
        'password'     => $pass,
        'id_jabatan'   => '2', 
        'tgl_gabung'   => date('Y-m-d')
    );

    $this->db->insert('anggota', $data);
    $insert_id = $this->db->insert_id(); // Ambil ID yang baru saja dibuat

    // Langsung buatkan session login
    $data_session = array(
        'id_anggota' => $insert_id,
        'nama'       => $nama,
        'role'       => 'anggota',
        'status'     => 'login'
    );
    $this->session->set_userdata($data_session);

    // Lempar ke halaman edit profil untuk isi Alamat & No Telp
    $this->session->set_flashdata('success', 'Akun berhasil dibuat! Silakan lengkapi data diri Anda.');
    redirect(base_url('index.php/user/edit_profil'));
}

    public function reset_password() {
        $this->load->view('v_reset_password');
    }

    public function reset_aksi() {
        $username = $this->input->post('username', TRUE);
        $password_baru = $this->input->post('password_baru', TRUE);

        $admin = $this->db->get_where('users', array('username' => $username))->row();
        $anggota = $this->db->get_where('anggota', array('username' => $username))->row();

        if ($admin) {
            $this->db->where('username', $username);
            $this->db->update('users', array('password' => $password_baru));
            $this->session->set_flashdata('success', 'Password Admin berhasil direset!');
            redirect(base_url('index.php/auth'));
        } else if ($anggota) {
            $this->db->where('username', $username);
            $this->db->update('anggota', array('password' => $password_baru));
            $this->session->set_flashdata('success', 'Password Anggota berhasil direset!');
            redirect(base_url('index.php/auth'));
        } else {
            $this->session->set_flashdata('error', 'Username tidak ditemukan!');
            redirect(base_url('index.php/auth/reset_password'));
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect(base_url('index.php/auth'));
    }
}