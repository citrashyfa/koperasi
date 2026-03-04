class M_pinjaman extends CI_Model {
    
    public function insert_data($data) {
        return $this->db->insert('pinjaman', $data);
    }

    // Fungsi untuk mengambil sisa pinjaman anggota
    public function get_sisa_pinjaman($id_pinjaman) {
        $this->db->select('jumlah_pinjaman, lama_angsuran');
        $this->db->from('pinjaman');
        $this->db->where('id_pinjaman', $id_pinjaman);
        return $this->db->get()->row();
    }
}