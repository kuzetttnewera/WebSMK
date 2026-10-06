<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendaftaran extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pendaftaran_model');
        $this->load->library(array('form_validation', 'session'));
        $this->load->helper(array('url', 'form'));
    }

    // Tampilkan & proses formulir pendaftaran
    public function index()
    {
        $this->_atur_validasi();

        if ($this->form_validation->run() == FALSE) {
            $data['judul'] = "Formulir Pendaftaran Siswa Baru - SKANDA";
            $this->load->view('template', [
                'content' => $this->load->view('pendaftaran/form', '', TRUE),
                'judul'   => $data['judul']
            ]);
        } else {
            $no_pendaftaran = $this->Pendaftaran_model->buat_no_pendaftaran();

            $data = [
                'no_pendaftaran'  => $no_pendaftaran,
                'nama_lengkap'    => $this->input->post('nama_lengkap', TRUE),
                'nis'             => $this->input->post('nis', TRUE),
                'jenis_kelamin'   => $this->input->post('jenis_kelamin', TRUE),
                'tempat_lahir'    => $this->input->post('tempat_lahir', TRUE),
                'tanggal_lahir'   => $this->input->post('tanggal_lahir', TRUE),
                'asal_sekolah'    => $this->input->post('asal_sekolah', TRUE),
                'alamat'          => $this->input->post('alamat', TRUE),
                'no_hp'           => $this->input->post('no_hp', TRUE),
                'nama_orang_tua'  => $this->input->post('nama_orang_tua', TRUE),
                'no_hp_orang_tua' => $this->input->post('no_hp_orang_tua', TRUE),
                'status'          => 'Menunggu',
                'created_at'      => date('Y-m-d H:i:s'),
            ];

            $this->Pendaftaran_model->simpan($data);

            $this->session->set_flashdata('no_pendaftaran', $no_pendaftaran);
            redirect('pendaftaran/sukses');
        }
    }

    // Halaman cek status pendaftaran berdasarkan kode/nomor PPDB
    public function cek_status()
    {
        $data['judul'] = "Cek Status PPDB - SKANDA";
        $data['pendaftar'] = NULL;
        $data['sudah_cari'] = FALSE;

        $kode = $this->input->post('kode_ppdb', TRUE);

        if ($kode !== NULL) {
            $data['sudah_cari'] = TRUE;
            $data['kode_ppdb']  = $kode;
            $data['pendaftar']  = $this->Pendaftaran_model->get_by_no_pendaftaran(trim($kode));
        }

        $this->load->view('template', [
            'content' => $this->load->view('pendaftaran/cek_status', $data, TRUE),
            'judul'   => $data['judul']
        ]);
    }

    // Halaman sukses setelah mendaftar
    public function sukses()
    {
        $no_pendaftaran = $this->session->flashdata('no_pendaftaran');

        if (!$no_pendaftaran) {
            redirect('pendaftaran');
        }

        $data['judul'] = "Pendaftaran Berhasil - SKANDA";
        $data['no_pendaftaran'] = $no_pendaftaran;

        $this->load->view('template', [
            'content' => $this->load->view('pendaftaran/sukses', $data, TRUE),
            'judul'   => $data['judul']
        ]);
    }

    // Aturan validasi formulir pendaftaran
    private function _atur_validasi()
    {
        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required|min_length[3]|max_length[100]');
        $this->form_validation->set_rules('nis', 'NIS', 'required|numeric|min_length[5]|max_length[20]|is_unique[pendaftaran.nis]', [
            'is_unique' => 'NIS ini sudah pernah terdaftar.'
        ]);
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required|in_list[Laki-laki,Perempuan]');
        $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required|min_length[3]');
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required|callback_cek_tanggal');
        $this->form_validation->set_rules('asal_sekolah', 'Asal Sekolah', 'required|min_length[3]');
        $this->form_validation->set_rules('alamat', 'Alamat Lengkap', 'required|min_length[10]');
        $this->form_validation->set_rules('no_hp', 'Nomor HP / WA Siswa', 'required|numeric|min_length[10]|max_length[15]');
        $this->form_validation->set_rules('nama_orang_tua', 'Nama Orang Tua / Wali', 'required|min_length[3]');
        $this->form_validation->set_rules('no_hp_orang_tua', 'Nomor HP Orang Tua / Wali', 'required|numeric|min_length[10]|max_length[15]');

        $this->form_validation->set_error_delimiters('<div class="invalid-feedback">', '</div>');
    }

    // Callback: pastikan format tanggal lahir valid (YYYY-MM-DD)
    public function cek_tanggal($tanggal)
    {
        $d = DateTime::createFromFormat('Y-m-d', $tanggal);
        if (!$d || $d->format('Y-m-d') !== $tanggal) {
            $this->form_validation->set_message('cek_tanggal', 'Format {field} tidak valid.');
            return FALSE;
        }
        return TRUE;
    }
}
