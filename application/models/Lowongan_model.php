<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lowongan_model extends CI_Model {

    protected $table = 'lowongan_kerja';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // Ambil semua data lowongan (untuk admin). Bisa difilter berdasarkan status.
    public function get_all($status = NULL)
    {
        if ($status) {
            $this->db->where('status', $status);
        }
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get($this->table)->result();
    }

    // Ambil lowongan yang masih Aktif saja (dipakai halaman publik)
    public function get_aktif()
    {
        $this->db->where('status', 'Aktif');
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get($this->table)->result();
    }

    // Ambil satu data lowongan berdasarkan id
    public function get_by_id($id)
    {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }

    // Tambah data lowongan baru
    public function tambah($data)
    {
        return $this->db->insert($this->table, $data);
    }

    // Perbarui data lowongan
    public function ubah($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    // Hapus data lowongan
    public function hapus($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }
}
