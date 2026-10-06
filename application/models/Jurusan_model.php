<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jurusan_model extends CI_Model {

    protected $table = 'jurusan';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // Ambil semua jurusan, urut sesuai kolom 'urutan'
    public function get_all()
    {
        $this->db->order_by('urutan', 'ASC');
        return $this->db->get($this->table)->result();
    }

    // Ambil satu jurusan berdasarkan slug (untuk halaman publik)
    public function get_by_slug($slug)
    {
        return $this->db->get_where($this->table, ['slug' => $slug])->row();
    }

    // Ambil satu jurusan berdasarkan id (untuk form edit admin)
    public function get_by_id($id)
    {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }

    // Perbarui konten halaman jurusan (dipakai admin)
    public function ubah($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }
}
