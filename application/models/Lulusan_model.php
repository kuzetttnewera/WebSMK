<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lulusan_model extends CI_Model {

    protected $table = 'lulusan_terbaik';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // Ambil semua data lulusan terbaik, urut sesuai kolom 'urutan' (dipakai halaman publik & admin)
    public function get_all()
    {
        $this->db->order_by('urutan', 'ASC');
        return $this->db->get($this->table)->result();
    }

    // Ambil satu data lulusan berdasarkan id
    public function get_by_id($id)
    {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }

    // Tambah data lulusan terbaik baru
    public function tambah($data)
    {
        return $this->db->insert($this->table, $data);
    }

    // Perbarui data lulusan terbaik
    public function ubah($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    // Hapus data lulusan terbaik
    public function hapus($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }
}
