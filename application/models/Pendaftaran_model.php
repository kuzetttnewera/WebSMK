<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendaftaran_model extends CI_Model {

    protected $table = 'pendaftaran';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // Ambil semua data pendaftar (terbaru dahulu)
    public function get_all($status = NULL)
    {
        if ($status) {
            $this->db->where('status', $status);
        }
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get($this->table)->result();
    }

    // Ambil satu data pendaftar berdasarkan id
    public function get_by_id($id)
    {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }

    // Ambil satu data pendaftar berdasarkan nomor pendaftaran
    public function get_by_no_pendaftaran($no)
    {
        return $this->db->get_where($this->table, ['no_pendaftaran' => $no])->row();
    }

    // Simpan data pendaftar baru, kembalikan insert id
    public function simpan($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    // Perbarui status pendaftar (Diterima / Ditolak / Menunggu)
    public function ubah_status($id, $status)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->table, ['status' => $status]);
    }

    // Ambil data pendaftar dengan filter rentang tanggal daftar & status (untuk halaman Laporan)
    public function get_laporan($dari = NULL, $sampai = NULL, $status = NULL)
    {
        if ($dari) {
            $this->db->where('DATE(created_at) >=', $dari);
        }
        if ($sampai) {
            $this->db->where('DATE(created_at) <=', $sampai);
        }
        if ($status) {
            $this->db->where('status', $status);
        }
        $this->db->order_by('created_at', 'ASC');
        return $this->db->get($this->table)->result();
    }

    // Hapus data pendaftar
    public function hapus($id)
    {
        return $this->db->delete($this->table, ['id' => $id]);
    }

    // Hitung jumlah pendaftar berdasarkan status (untuk dashboard)
    public function hitung($status = NULL)
    {
        if ($status) {
            $this->db->where('status', $status);
        }
        return $this->db->count_all_results($this->table);
    }

    // Buat nomor pendaftaran unik: PPDB-<tahun>-<urutan 4 digit>
    public function buat_no_pendaftaran()
    {
        $tahun = date('Y');
        $jumlah = $this->hitung();
        $urutan = str_pad($jumlah + 1, 4, '0', STR_PAD_LEFT);
        $no = 'PPDB-' . $tahun . '-' . $urutan;

        // Pastikan nomor benar-benar unik walau ada penghapusan data
        while ($this->get_by_no_pendaftaran($no)) {
            $urutan = str_pad((int) $urutan + 1, 4, '0', STR_PAD_LEFT);
            $no = 'PPDB-' . $tahun . '-' . $urutan;
        }

        return $no;
    }
}
