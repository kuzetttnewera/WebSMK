<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Info_sekolah_model extends CI_Model {

    protected $table = 'info_sekolah';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // Ambil data info sekolah. Tabel ini hanya berisi 1 baris data.
    // Kalau baris belum ada (instalasi baru), buat baris kosong dulu supaya
    // halaman publik & form admin tidak error.
    public function get()
    {
        $row = $this->db->get($this->table)->row();

        if (!$row) {
            $this->db->insert($this->table, [
                'nama_kepsek'      => '',
                'foto_kepsek'      => '',
                'sambutan'         => '',
                'visi'             => '',
                'misi'             => '',
                'jumlah_siswa'     => '0',
                'jumlah_guru'      => '0',
                'jumlah_prestasi'  => '0',
                'jumlah_fasilitas' => '0',
            ]);
            $row = $this->db->get($this->table)->row();
        }

        return $row;
    }

    // Perbarui data info sekolah
    public function ubah($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }
}
