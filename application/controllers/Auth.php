public function proses_login() {
    $user = $this->input->post('username');
    $pass = $this->input->post('password');

    $cek = $this->db->get_where('users', ['username' => $user])->row();

    if ($cek && password_verify($pass, $cek->password)) {
        $session_data = [
            'id_user' => $cek->id_user,
            'role'    => $cek->role,
            'logged_in' => TRUE
        ];
        $this->set_userdata($session_data);
        redirect('dashboard');
    } else {
        $this->session->set_flashdata('error', 'Username atau Password salah!');
        redirect('auth');
    }
}