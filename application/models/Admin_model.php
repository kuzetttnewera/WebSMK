<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

    protected $table = 'admin';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // Cari akun berdasarkan username
    public function cek($username)
    {
        $this->db->where('username', $username);
        return $this->db->get($this->table)->row();
    }

    // Ambil data admin berdasarkan id
    public function get_by_id($id)
    {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }

    // Perbarui password admin
    public function ubah_password($id, $password_hash)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->table, ['password' => $password_hash]);
    }
}
