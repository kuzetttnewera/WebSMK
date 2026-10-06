<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('Admin_model', 'Pendaftaran_model', 'Jurusan_model', 'Karousel_model', 'Info_sekolah_model', 'Lulusan_model', 'Lowongan_model', 'Produk_model', 'Mitra_model'));
        $this->load->library(array('session', 'form_validation'));
        $this->load->helper(array('url', 'form'));
    }

    // ==========================================
    // HALAMAN LOGIN ADMIN
    // ==========================================
    public function index()
    {
        // Kalau sudah login, langsung ke dashboard
        if ($this->session->userdata('admin_login') === TRUE) {
            redirect('admin/dashboard');
        }

        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        $this->form_validation->set_error_delimiters('<div class="invalid-feedback">', '</div>');

        if ($this->form_validation->run() == FALSE) {
            $data['judul'] = "Login Admin - SKANDA";
            $this->load->view('admin/login', $data);
        } else {
            $username = $this->input->post('username', TRUE);
            $password = $this->input->post('password', TRUE);

            $akun = $this->Admin_model->cek($username);

            if ($akun && password_verify($password, $akun->password)) {
                $data_sesi = [
                    'admin_id'    => $akun->id,
                    'admin_nama'  => $akun->nama,
                    'admin_login' => TRUE
                ];
                $this->session->set_userdata($data_sesi);
                redirect('admin/dashboard');
            } else {
                $this->session->set_flashdata('pesan', 'Username atau password salah.');
                redirect('admin');
            }
        }
    }

    // ==========================================
    // DASHBOARD ADMIN
    // ==========================================
    public function dashboard()
    {
        $this->_cek_login();

        $data['judul']       = "Dashboard Admin - SKANDA";
        $data['nama_admin']  = $this->session->userdata('admin_nama');
        $data['total']       = $this->Pendaftaran_model->hitung();
        $data['menunggu']    = $this->Pendaftaran_model->hitung('Menunggu');
        $data['diterima']    = $this->Pendaftaran_model->hitung('Diterima');
        $data['ditolak']     = $this->Pendaftaran_model->hitung('Ditolak');
        $data['terbaru']     = array_slice($this->Pendaftaran_model->get_all(), 0, 5);

        $this->load->view('admin/dashboard', $data);
    }

    // ==========================================
    // DATA PENDAFTAR (LIST + FILTER STATUS)
    // ==========================================
    public function pendaftar($status = NULL)
    {
        $this->_cek_login();

        $status_valid = ['Menunggu', 'Diterima', 'Ditolak'];
        if ($status && !in_array($status, $status_valid, TRUE)) {
            show_404();
        }

        $data['judul']      = "Data Pendaftar - SKANDA";
        $data['nama_admin'] = $this->session->userdata('admin_nama');
        $data['status_aktif'] = $status;
        $data['pendaftar']  = $this->Pendaftaran_model->get_all($status);

        $this->load->view('admin/pendaftar', $data);
    }

    // ==========================================
    // DETAIL SATU PENDAFTAR
    // ==========================================
    public function detail($id)
    {
        $this->_cek_login();

        $pendaftar = $this->Pendaftaran_model->get_by_id($id);
        if (!$pendaftar) show_404();

        $data['judul']      = "Detail Pendaftar - SKANDA";
        $data['nama_admin'] = $this->session->userdata('admin_nama');
        $data['pendaftar']  = $pendaftar;

        $this->load->view('admin/detail', $data);
    }

    // ==========================================
    // VERIFIKASI / UBAH STATUS PENDAFTAR (dengan validasi form)
    // ==========================================
    public function verifikasi($id)
    {
        $this->_cek_login();

        $pendaftar = $this->Pendaftaran_model->get_by_id($id);
        if (!$pendaftar) show_404();

        $this->form_validation->set_rules('status', 'Status', 'required|in_list[Menunggu,Diterima,Ditolak]');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('pesan_error', 'Status tidak valid. Silakan pilih status yang tersedia.');
            redirect('admin/detail/' . $id);
        }

        $this->Pendaftaran_model->ubah_status($id, $this->input->post('status', TRUE));
        $this->session->set_flashdata('pesan_sukses', 'Status pendaftar berhasil diperbarui.');
        redirect('admin/detail/' . $id);
    }

    // ==========================================
    // HAPUS DATA PENDAFTAR
    // ==========================================
    public function hapus($id)
    {
        $this->_cek_login();

        $pendaftar = $this->Pendaftaran_model->get_by_id($id);
        if (!$pendaftar) show_404();

        $this->Pendaftaran_model->hapus($id);
        $this->session->set_flashdata('pesan_sukses', 'Data pendaftar berhasil dihapus.');
        redirect('admin/pendaftar');
    }

    // ==========================================
    // LAPORAN PENDAFTAR (BATCH, FILTER TANGGAL & STATUS)
    // ==========================================
    public function laporan()
    {
        $this->_cek_login();

        $dari   = $this->input->get('dari', TRUE);
        $sampai = $this->input->get('sampai', TRUE);
        $status = $this->input->get('status', TRUE);

        $status_valid = ['Menunggu', 'Diterima', 'Ditolak'];
        if ($status && !in_array($status, $status_valid, TRUE)) {
            $status = NULL;
        }

        $data['judul']      = "Laporan Pendaftar - SKANDA";
        $data['nama_admin'] = $this->session->userdata('admin_nama');
        $data['dari']       = $dari;
        $data['sampai']     = $sampai;
        $data['status']     = $status;
        $data['pendaftar']  = $this->Pendaftaran_model->get_laporan($dari, $sampai, $status);

        $this->load->view('admin/laporan', $data);
    }

    // EKSPOR LAPORAN PENDAFTAR KE CSV (bisa dibuka di Excel), mengikuti filter yang aktif
    public function laporan_export()
    {
        $this->_cek_login();

        $dari   = $this->input->get('dari', TRUE);
        $sampai = $this->input->get('sampai', TRUE);
        $status = $this->input->get('status', TRUE);

        $status_valid = ['Menunggu', 'Diterima', 'Ditolak'];
        if ($status && !in_array($status, $status_valid, TRUE)) {
            $status = NULL;
        }

        $data = $this->Pendaftaran_model->get_laporan($dari, $sampai, $status);

        $nama_file = 'laporan_pendaftar_' . date('Ymd_His') . '.csv';

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $nama_file . '"');

        $output = fopen('php://output', 'w');
        // Tambahkan BOM agar karakter terbaca benar saat dibuka di Excel
        fwrite($output, "\xEF\xBB\xBF");

        fputcsv($output, [
            'No', 'Kode Pendaftaran', 'Nama Lengkap', 'NIS', 'Jenis Kelamin',
            'Asal Sekolah', 'No. HP Siswa', 'Nama Orang Tua/Wali', 'No. HP Orang Tua/Wali',
            'Status', 'Tanggal & Waktu Daftar'
        ]);

        foreach ($data as $i => $p) {
            fputcsv($output, [
                $i + 1,
                $p->no_pendaftaran,
                $p->nama_lengkap,
                $p->nis,
                $p->jenis_kelamin,
                $p->asal_sekolah,
                $p->no_hp,
                $p->nama_orang_tua,
                $p->no_hp_orang_tua,
                $p->status,
                date('d-m-Y H:i', strtotime($p->created_at)),
            ]);
        }

        fclose($output);
        exit;
    }

    // ==========================================
    // HALAMAN JURUSAN (LIST)
    // ==========================================
    public function jurusan()
    {
        $this->_cek_login();

        $data['judul']      = "Kelola Jurusan - SKANDA";
        $data['nama_admin'] = $this->session->userdata('admin_nama');
        $data['jurusan']    = $this->Jurusan_model->get_all();

        $this->load->view('admin/jurusan', $data);
    }

    // ==========================================
    // EDIT HALAMAN JURUSAN
    // ==========================================
    public function jurusan_edit($id)
    {
        $this->_cek_login();

        $jurusan = $this->Jurusan_model->get_by_id($id);
        if (!$jurusan) show_404();

        $this->form_validation->set_rules('nama', 'Nama Jurusan', 'required|min_length[3]|max_length[100]');
        $this->form_validation->set_rules('icon', 'Kode Ikon', 'required|max_length[50]');
        $this->form_validation->set_rules('warna', 'Warna Identitas', 'required|in_list[biru,oranye,merah,hijau]');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|min_length[10]');
        $this->form_validation->set_error_delimiters('<div class="invalid-feedback">', '</div>');

        if ($this->form_validation->run() == FALSE) {
            $data['judul']      = "Edit Jurusan - SKANDA";
            $data['nama_admin'] = $this->session->userdata('admin_nama');
            $data['jurusan']    = $jurusan;
            $this->load->view('admin/jurusan_edit', $data);
        } else {
            $data = [
                'nama'      => $this->input->post('nama', TRUE),
                'icon'      => $this->input->post('icon', TRUE),
                'warna'     => $this->input->post('warna', TRUE),
                'deskripsi' => $this->input->post('deskripsi', TRUE),
            ];

            $this->Jurusan_model->ubah($id, $data);
            $this->session->set_flashdata('pesan_sukses', 'Halaman jurusan berhasil diperbarui.');
            redirect('admin/jurusan');
        }
    }

    // ==========================================
    // KAROUSEL (LIST)
    // ==========================================
    public function karousel()
    {
        $this->_cek_login();

        $data['judul']      = "Kelola Karousel - SKANDA";
        $data['nama_admin'] = $this->session->userdata('admin_nama');
        $data['karousel']   = $this->Karousel_model->get_all();

        $this->load->view('admin/karousel', $data);
    }

    // ==========================================
    // TAMBAH SLIDE KAROUSEL
    // ==========================================
    public function karousel_tambah()
    {
        $this->_cek_login();

        $this->form_validation->set_rules('judul', 'Judul', 'required|min_length[3]|max_length[150]');
        $this->form_validation->set_rules('urutan', 'Urutan', 'required|numeric');
        $this->form_validation->set_error_delimiters('<div class="invalid-feedback">', '</div>');

        if ($this->form_validation->run() == FALSE) {
            $data['judul']      = "Tambah Slide Karousel - SKANDA";
            $data['nama_admin'] = $this->session->userdata('admin_nama');
            $data['item']       = NULL;
            $this->load->view('admin/karousel_form', $data);
            return;
        }

        if (empty($_FILES['gambar']['name'])) {
            $this->session->set_flashdata('pesan_error', 'Gambar wajib diunggah.');
            redirect('admin/karousel_tambah');
        }

        $nama_file = $this->_upload_gambar_karousel();
        if ($nama_file === FALSE) {
            $this->session->set_flashdata('pesan_error', strip_tags($this->upload->display_errors()));
            redirect('admin/karousel_tambah');
        }

        $this->Karousel_model->tambah([
            'judul'      => $this->input->post('judul', TRUE),
            'gambar'     => $nama_file,
            'urutan'     => (int) $this->input->post('urutan', TRUE),
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        $this->session->set_flashdata('pesan_sukses', 'Slide karousel berhasil ditambahkan.');
        redirect('admin/karousel');
    }

    // ==========================================
    // EDIT SLIDE KAROUSEL
    // ==========================================
    public function karousel_edit($id)
    {
        $this->_cek_login();

        $item = $this->Karousel_model->get_by_id($id);
        if (!$item) show_404();

        $this->form_validation->set_rules('judul', 'Judul', 'required|min_length[3]|max_length[150]');
        $this->form_validation->set_rules('urutan', 'Urutan', 'required|numeric');
        $this->form_validation->set_error_delimiters('<div class="invalid-feedback">', '</div>');

        if ($this->form_validation->run() == FALSE) {
            $data['judul']      = "Edit Slide Karousel - SKANDA";
            $data['nama_admin'] = $this->session->userdata('admin_nama');
            $data['item']       = $item;
            $this->load->view('admin/karousel_form', $data);
            return;
        }

        $data_update = [
            'judul'  => $this->input->post('judul', TRUE),
            'urutan' => (int) $this->input->post('urutan', TRUE),
        ];

        // Gambar bersifat opsional saat edit; hanya diganti jika admin upload file baru
        if (!empty($_FILES['gambar']['name'])) {
            $nama_file = $this->_upload_gambar_karousel();
            if ($nama_file === FALSE) {
                $this->session->set_flashdata('pesan_error', strip_tags($this->upload->display_errors()));
                redirect('admin/karousel_edit/' . $id);
            }
            $data_update['gambar'] = $nama_file;

            // Hapus file gambar lama supaya tidak menumpuk di server
            $lama = FCPATH . 'assets/images/' . $item->gambar;
            if ($item->gambar && is_file($lama)) {
                @unlink($lama);
            }
        }

        $this->Karousel_model->ubah($id, $data_update);
        $this->session->set_flashdata('pesan_sukses', 'Slide karousel berhasil diperbarui.');
        redirect('admin/karousel');
    }

    // ==========================================
    // HAPUS SLIDE KAROUSEL
    // ==========================================
    public function karousel_hapus($id)
    {
        $this->_cek_login();

        $item = $this->Karousel_model->get_by_id($id);
        if (!$item) show_404();

        $file = FCPATH . 'assets/images/' . $item->gambar;
        if ($item->gambar && is_file($file)) {
            @unlink($file);
        }

        $this->Karousel_model->hapus($id);
        $this->session->set_flashdata('pesan_sukses', 'Slide karousel berhasil dihapus.');
        redirect('admin/karousel');
    }

    // Helper: proses upload gambar karousel. Mengembalikan path relatif
    // (disimpan ke DB) atau FALSE jika gagal.
    private function _upload_gambar_karousel()
    {
        $folder = FCPATH . 'assets/images/karousel/';
        if (!is_dir($folder)) {
            mkdir($folder, 0755, TRUE);
        }

        $config['upload_path']   = $folder;
        $config['allowed_types'] = 'jpg|jpeg|png|webp';
        $config['max_size']      = 2048; // KB
        $config['encrypt_name']  = TRUE;

        $this->load->library('upload');
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('gambar')) {
            return FALSE;
        }

        return 'karousel/' . $this->upload->data('file_name');
    }

    // ==========================================
    // INFO SEKOLAH (SAMBUTAN, VISI, MISI, STATISTIK)
    // ==========================================
    public function info_sekolah()
    {
        $this->_cek_login();

        $info = $this->Info_sekolah_model->get();

        $this->form_validation->set_rules('nama_kepsek', 'Nama Kepala Sekolah', 'required|max_length[100]');
        $this->form_validation->set_rules('sambutan', 'Sambutan Kepala Sekolah', 'required|min_length[20]');
        $this->form_validation->set_rules('visi', 'Visi', 'required|min_length[10]');
        $this->form_validation->set_rules('misi', 'Misi', 'required|min_length[10]');
        $this->form_validation->set_rules('jumlah_siswa', 'Jumlah Siswa', 'required|max_length[20]');
        $this->form_validation->set_rules('jumlah_guru', 'Jumlah Guru', 'required|max_length[20]');
        $this->form_validation->set_rules('jumlah_prestasi', 'Jumlah Prestasi', 'required|max_length[20]');
        $this->form_validation->set_rules('jumlah_fasilitas', 'Jumlah Fasilitas', 'required|max_length[20]');
        $this->form_validation->set_error_delimiters('<div class="invalid-feedback">', '</div>');

        if ($this->form_validation->run() == FALSE) {
            $data['judul']      = "Info Sekolah - SKANDA";
            $data['nama_admin'] = $this->session->userdata('admin_nama');
            $data['info']       = $info;
            $this->load->view('admin/info_sekolah', $data);
            return;
        }

        $data_update = [
            'nama_kepsek'      => $this->input->post('nama_kepsek', TRUE),
            'sambutan'         => $this->input->post('sambutan', TRUE),
            'visi'             => $this->input->post('visi', TRUE),
            'misi'             => $this->input->post('misi', TRUE),
            'jumlah_siswa'     => $this->input->post('jumlah_siswa', TRUE),
            'jumlah_guru'      => $this->input->post('jumlah_guru', TRUE),
            'jumlah_prestasi'  => $this->input->post('jumlah_prestasi', TRUE),
            'jumlah_fasilitas' => $this->input->post('jumlah_fasilitas', TRUE),
        ];

        if (!empty($_FILES['foto_kepsek']['name'])) {
            $folder = FCPATH . 'assets/images/';

            $config['upload_path']   = $folder;
            $config['allowed_types'] = 'jpg|jpeg|png|webp';
            $config['max_size']      = 2048;
            $config['encrypt_name']  = TRUE;

            $this->load->library('upload');
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('foto_kepsek')) {
                $this->session->set_flashdata('pesan_error', strip_tags($this->upload->display_errors()));
                redirect('admin/info_sekolah');
            }

            $data_update['foto_kepsek'] = $this->upload->data('file_name');
        }

        $this->Info_sekolah_model->ubah($info->id, $data_update);
        $this->session->set_flashdata('pesan_sukses', 'Info sekolah berhasil diperbarui.');
        redirect('admin/info_sekolah');
    }

    // ==========================================
    // LULUSAN TERBAIK (LIST)
    // ==========================================
    public function lulusan()
    {
        $this->_cek_login();

        $data['judul']      = "Kelola Lulusan Terbaik - SKANDA";
        $data['nama_admin'] = $this->session->userdata('admin_nama');
        $data['lulusan']    = $this->Lulusan_model->get_all();

        $this->load->view('admin/lulusan', $data);
    }

    // TAMBAH LULUSAN TERBAIK
    public function lulusan_tambah()
    {
        $this->_cek_login();

        $this->form_validation->set_rules('nama', 'Nama', 'required|min_length[3]|max_length[100]');
        $this->form_validation->set_rules('jurusan', 'Jurusan', 'required|max_length[100]');
        $this->form_validation->set_rules('tahun_lulus', 'Tahun Lulus', 'required|numeric|exact_length[4]');
        $this->form_validation->set_rules('prestasi', 'Prestasi', 'required|min_length[5]');
        $this->form_validation->set_rules('urutan', 'Urutan', 'required|numeric');
        $this->form_validation->set_error_delimiters('<div class="invalid-feedback">', '</div>');

        if ($this->form_validation->run() == FALSE) {
            $data['judul']      = "Tambah Lulusan Terbaik - SKANDA";
            $data['nama_admin'] = $this->session->userdata('admin_nama');
            $data['item']       = NULL;
            $this->load->view('admin/lulusan_form', $data);
            return;
        }

        $nama_file = '';
        if (!empty($_FILES['foto']['name'])) {
            $nama_file = $this->_upload_gambar('foto', 'lulusan');
            if ($nama_file === FALSE) {
                $this->session->set_flashdata('pesan_error', strip_tags($this->upload->display_errors()));
                redirect('admin/lulusan_tambah');
            }
        }

        $this->Lulusan_model->tambah([
            'nama'        => $this->input->post('nama', TRUE),
            'jurusan'     => $this->input->post('jurusan', TRUE),
            'tahun_lulus' => $this->input->post('tahun_lulus', TRUE),
            'prestasi'    => $this->input->post('prestasi', TRUE),
            'urutan'      => (int) $this->input->post('urutan', TRUE),
            'foto'        => $nama_file,
            'created_at'  => date('Y-m-d H:i:s'),
        ]);

        $this->session->set_flashdata('pesan_sukses', 'Data lulusan terbaik berhasil ditambahkan.');
        redirect('admin/lulusan');
    }

    // EDIT LULUSAN TERBAIK
    public function lulusan_edit($id)
    {
        $this->_cek_login();

        $item = $this->Lulusan_model->get_by_id($id);
        if (!$item) show_404();

        $this->form_validation->set_rules('nama', 'Nama', 'required|min_length[3]|max_length[100]');
        $this->form_validation->set_rules('jurusan', 'Jurusan', 'required|max_length[100]');
        $this->form_validation->set_rules('tahun_lulus', 'Tahun Lulus', 'required|numeric|exact_length[4]');
        $this->form_validation->set_rules('prestasi', 'Prestasi', 'required|min_length[5]');
        $this->form_validation->set_rules('urutan', 'Urutan', 'required|numeric');
        $this->form_validation->set_error_delimiters('<div class="invalid-feedback">', '</div>');

        if ($this->form_validation->run() == FALSE) {
            $data['judul']      = "Edit Lulusan Terbaik - SKANDA";
            $data['nama_admin'] = $this->session->userdata('admin_nama');
            $data['item']       = $item;
            $this->load->view('admin/lulusan_form', $data);
            return;
        }

        $data_update = [
            'nama'        => $this->input->post('nama', TRUE),
            'jurusan'     => $this->input->post('jurusan', TRUE),
            'tahun_lulus' => $this->input->post('tahun_lulus', TRUE),
            'prestasi'    => $this->input->post('prestasi', TRUE),
            'urutan'      => (int) $this->input->post('urutan', TRUE),
        ];

        if (!empty($_FILES['foto']['name'])) {
            $nama_file = $this->_upload_gambar('foto', 'lulusan');
            if ($nama_file === FALSE) {
                $this->session->set_flashdata('pesan_error', strip_tags($this->upload->display_errors()));
                redirect('admin/lulusan_edit/' . $id);
            }
            $data_update['foto'] = $nama_file;

            $lama = FCPATH . 'assets/images/' . $item->foto;
            if ($item->foto && is_file($lama)) {
                @unlink($lama);
            }
        }

        $this->Lulusan_model->ubah($id, $data_update);
        $this->session->set_flashdata('pesan_sukses', 'Data lulusan terbaik berhasil diperbarui.');
        redirect('admin/lulusan');
    }

    // HAPUS LULUSAN TERBAIK
    public function lulusan_hapus($id)
    {
        $this->_cek_login();

        $item = $this->Lulusan_model->get_by_id($id);
        if (!$item) show_404();

        $file = FCPATH . 'assets/images/' . $item->foto;
        if ($item->foto && is_file($file)) {
            @unlink($file);
        }

        $this->Lulusan_model->hapus($id);
        $this->session->set_flashdata('pesan_sukses', 'Data lulusan terbaik berhasil dihapus.');
        redirect('admin/lulusan');
    }

    // ==========================================
    // LOWONGAN PEKERJAAN (LIST)
    // ==========================================
    public function lowongan()
    {
        $this->_cek_login();

        $data['judul']      = "Kelola Lowongan Pekerjaan - SKANDA";
        $data['nama_admin'] = $this->session->userdata('admin_nama');
        $data['lowongan']   = $this->Lowongan_model->get_all();

        $this->load->view('admin/lowongan', $data);
    }

    // TAMBAH LOWONGAN
    public function lowongan_tambah()
    {
        $this->_cek_login();
        $this->_atur_validasi_lowongan();

        if ($this->form_validation->run() == FALSE) {
            $data['judul']      = "Tambah Lowongan Pekerjaan - SKANDA";
            $data['nama_admin'] = $this->session->userdata('admin_nama');
            $data['item']       = NULL;
            $this->load->view('admin/lowongan_form', $data);
            return;
        }

        $this->Lowongan_model->tambah($this->_ambil_data_lowongan());
        $this->session->set_flashdata('pesan_sukses', 'Lowongan pekerjaan berhasil ditambahkan.');
        redirect('admin/lowongan');
    }

    // EDIT LOWONGAN
    public function lowongan_edit($id)
    {
        $this->_cek_login();

        $item = $this->Lowongan_model->get_by_id($id);
        if (!$item) show_404();

        $this->_atur_validasi_lowongan();

        if ($this->form_validation->run() == FALSE) {
            $data['judul']      = "Edit Lowongan Pekerjaan - SKANDA";
            $data['nama_admin'] = $this->session->userdata('admin_nama');
            $data['item']       = $item;
            $this->load->view('admin/lowongan_form', $data);
            return;
        }

        $this->Lowongan_model->ubah($id, $this->_ambil_data_lowongan());
        $this->session->set_flashdata('pesan_sukses', 'Lowongan pekerjaan berhasil diperbarui.');
        redirect('admin/lowongan');
    }

    // HAPUS LOWONGAN
    public function lowongan_hapus($id)
    {
        $this->_cek_login();

        $item = $this->Lowongan_model->get_by_id($id);
        if (!$item) show_404();

        $this->Lowongan_model->hapus($id);
        $this->session->set_flashdata('pesan_sukses', 'Lowongan pekerjaan berhasil dihapus.');
        redirect('admin/lowongan');
    }

    // Aturan validasi form lowongan
    private function _atur_validasi_lowongan()
    {
        $this->form_validation->set_rules('posisi', 'Posisi', 'required|min_length[3]|max_length[150]');
        $this->form_validation->set_rules('perusahaan', 'Nama Perusahaan', 'required|max_length[150]');
        $this->form_validation->set_rules('lokasi', 'Lokasi', 'max_length[150]');
        $this->form_validation->set_rules('jenis', 'Jenis Pekerjaan', 'required|in_list[Full Time,Part Time,Magang,Kontrak]');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|min_length[5]');
        $this->form_validation->set_rules('kualifikasi', 'Kualifikasi', 'max_length[1000]');
        $this->form_validation->set_rules('kontak', 'Kontak', 'max_length[100]');
        $this->form_validation->set_rules('tanggal_tutup', 'Tanggal Tutup', 'required|callback_cek_tanggal_lowongan');
        $this->form_validation->set_rules('status', 'Status', 'required|in_list[Aktif,Nonaktif]');
        $this->form_validation->set_error_delimiters('<div class="invalid-feedback">', '</div>');
    }

    // Callback: pastikan format tanggal tutup lowongan valid (YYYY-MM-DD)
    public function cek_tanggal_lowongan($tanggal)
    {
        $d = DateTime::createFromFormat('Y-m-d', $tanggal);
        if (!$d || $d->format('Y-m-d') !== $tanggal) {
            $this->form_validation->set_message('cek_tanggal_lowongan', 'Format {field} tidak valid.');
            return FALSE;
        }
        return TRUE;
    }

    // Kumpulkan data lowongan dari input POST
    private function _ambil_data_lowongan()
    {
        return [
            'posisi'        => $this->input->post('posisi', TRUE),
            'perusahaan'    => $this->input->post('perusahaan', TRUE),
            'lokasi'        => $this->input->post('lokasi', TRUE),
            'jenis'         => $this->input->post('jenis', TRUE),
            'deskripsi'     => $this->input->post('deskripsi', TRUE),
            'kualifikasi'   => $this->input->post('kualifikasi', TRUE),
            'kontak'        => $this->input->post('kontak', TRUE),
            'tanggal_tutup' => $this->input->post('tanggal_tutup', TRUE),
            'status'        => $this->input->post('status', TRUE),
            'created_at'    => date('Y-m-d H:i:s'),
        ];
    }

    // ==========================================
    // PRODUK KHAS SEKOLAH (LIST)
    // ==========================================
    public function produk()
    {
        $this->_cek_login();

        $data['judul']      = "Kelola Produk Khas Sekolah - SKANDA";
        $data['nama_admin'] = $this->session->userdata('admin_nama');
        $data['produk']     = $this->Produk_model->get_all();

        $this->load->view('admin/produk', $data);
    }

    // TAMBAH PRODUK
    public function produk_tambah()
    {
        $this->_cek_login();

        $this->form_validation->set_rules('nama', 'Nama Produk', 'required|min_length[3]|max_length[150]');
        $this->form_validation->set_rules('jurusan', 'Jurusan Penghasil', 'max_length[100]');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|min_length[5]');
        $this->form_validation->set_rules('harga', 'Harga', 'max_length[50]');
        $this->form_validation->set_rules('urutan', 'Urutan', 'required|numeric');
        $this->form_validation->set_error_delimiters('<div class="invalid-feedback">', '</div>');

        if ($this->form_validation->run() == FALSE) {
            $data['judul']      = "Tambah Produk - SKANDA";
            $data['nama_admin'] = $this->session->userdata('admin_nama');
            $data['item']       = NULL;
            $this->load->view('admin/produk_form', $data);
            return;
        }

        $nama_file = '';
        if (!empty($_FILES['foto']['name'])) {
            $nama_file = $this->_upload_gambar('foto', 'produk');
            if ($nama_file === FALSE) {
                $this->session->set_flashdata('pesan_error', strip_tags($this->upload->display_errors()));
                redirect('admin/produk_tambah');
            }
        }

        $this->Produk_model->tambah([
            'nama'       => $this->input->post('nama', TRUE),
            'jurusan'    => $this->input->post('jurusan', TRUE),
            'deskripsi'  => $this->input->post('deskripsi', TRUE),
            'harga'      => $this->input->post('harga', TRUE),
            'urutan'     => (int) $this->input->post('urutan', TRUE),
            'foto'       => $nama_file,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        $this->session->set_flashdata('pesan_sukses', 'Produk berhasil ditambahkan.');
        redirect('admin/produk');
    }

    // EDIT PRODUK
    public function produk_edit($id)
    {
        $this->_cek_login();

        $item = $this->Produk_model->get_by_id($id);
        if (!$item) show_404();

        $this->form_validation->set_rules('nama', 'Nama Produk', 'required|min_length[3]|max_length[150]');
        $this->form_validation->set_rules('jurusan', 'Jurusan Penghasil', 'max_length[100]');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|min_length[5]');
        $this->form_validation->set_rules('harga', 'Harga', 'max_length[50]');
        $this->form_validation->set_rules('urutan', 'Urutan', 'required|numeric');
        $this->form_validation->set_error_delimiters('<div class="invalid-feedback">', '</div>');

        if ($this->form_validation->run() == FALSE) {
            $data['judul']      = "Edit Produk - SKANDA";
            $data['nama_admin'] = $this->session->userdata('admin_nama');
            $data['item']       = $item;
            $this->load->view('admin/produk_form', $data);
            return;
        }

        $data_update = [
            'nama'      => $this->input->post('nama', TRUE),
            'jurusan'   => $this->input->post('jurusan', TRUE),
            'deskripsi' => $this->input->post('deskripsi', TRUE),
            'harga'     => $this->input->post('harga', TRUE),
            'urutan'    => (int) $this->input->post('urutan', TRUE),
        ];

        if (!empty($_FILES['foto']['name'])) {
            $nama_file = $this->_upload_gambar('foto', 'produk');
            if ($nama_file === FALSE) {
                $this->session->set_flashdata('pesan_error', strip_tags($this->upload->display_errors()));
                redirect('admin/produk_edit/' . $id);
            }
            $data_update['foto'] = $nama_file;

            $lama = FCPATH . 'assets/images/' . $item->foto;
            if ($item->foto && is_file($lama)) {
                @unlink($lama);
            }
        }

        $this->Produk_model->ubah($id, $data_update);
        $this->session->set_flashdata('pesan_sukses', 'Produk berhasil diperbarui.');
        redirect('admin/produk');
    }

    // HAPUS PRODUK
    public function produk_hapus($id)
    {
        $this->_cek_login();

        $item = $this->Produk_model->get_by_id($id);
        if (!$item) show_404();

        $file = FCPATH . 'assets/images/' . $item->foto;
        if ($item->foto && is_file($file)) {
            @unlink($file);
        }

        $this->Produk_model->hapus($id);
        $this->session->set_flashdata('pesan_sukses', 'Produk berhasil dihapus.');
        redirect('admin/produk');
    }

    // ==========================================
    // MITRA / PERUSAHAAN KERJASAMA (LIST)
    // ==========================================
    public function perusahaan()
    {
        $this->_cek_login();

        $data['judul']      = "Kelola Mitra Perusahaan - SKANDA";
        $data['nama_admin'] = $this->session->userdata('admin_nama');
        $data['mitra']      = $this->Mitra_model->get_all();

        $this->load->view('admin/perusahaan', $data);
    }

    // TAMBAH MITRA
    public function perusahaan_tambah()
    {
        $this->_cek_login();

        $this->form_validation->set_rules('nama', 'Nama Perusahaan', 'required|min_length[3]|max_length[150]');
        $this->form_validation->set_rules('bidang', 'Bidang Usaha', 'max_length[150]');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'max_length[500]');
        $this->form_validation->set_rules('urutan', 'Urutan', 'required|numeric');
        $this->form_validation->set_error_delimiters('<div class="invalid-feedback">', '</div>');

        if ($this->form_validation->run() == FALSE) {
            $data['judul']      = "Tambah Mitra Perusahaan - SKANDA";
            $data['nama_admin'] = $this->session->userdata('admin_nama');
            $data['item']       = NULL;
            $this->load->view('admin/perusahaan_form', $data);
            return;
        }

        $nama_file = '';
        if (!empty($_FILES['logo']['name'])) {
            $nama_file = $this->_upload_gambar('logo', 'mitra');
            if ($nama_file === FALSE) {
                $this->session->set_flashdata('pesan_error', strip_tags($this->upload->display_errors()));
                redirect('admin/perusahaan_tambah');
            }
        }

        $this->Mitra_model->tambah([
            'nama'       => $this->input->post('nama', TRUE),
            'bidang'     => $this->input->post('bidang', TRUE),
            'deskripsi'  => $this->input->post('deskripsi', TRUE),
            'urutan'     => (int) $this->input->post('urutan', TRUE),
            'logo'       => $nama_file,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        $this->session->set_flashdata('pesan_sukses', 'Mitra perusahaan berhasil ditambahkan.');
        redirect('admin/perusahaan');
    }

    // EDIT MITRA
    public function perusahaan_edit($id)
    {
        $this->_cek_login();

        $item = $this->Mitra_model->get_by_id($id);
        if (!$item) show_404();

        $this->form_validation->set_rules('nama', 'Nama Perusahaan', 'required|min_length[3]|max_length[150]');
        $this->form_validation->set_rules('bidang', 'Bidang Usaha', 'max_length[150]');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'max_length[500]');
        $this->form_validation->set_rules('urutan', 'Urutan', 'required|numeric');
        $this->form_validation->set_error_delimiters('<div class="invalid-feedback">', '</div>');

        if ($this->form_validation->run() == FALSE) {
            $data['judul']      = "Edit Mitra Perusahaan - SKANDA";
            $data['nama_admin'] = $this->session->userdata('admin_nama');
            $data['item']       = $item;
            $this->load->view('admin/perusahaan_form', $data);
            return;
        }

        $data_update = [
            'nama'      => $this->input->post('nama', TRUE),
            'bidang'    => $this->input->post('bidang', TRUE),
            'deskripsi' => $this->input->post('deskripsi', TRUE),
            'urutan'    => (int) $this->input->post('urutan', TRUE),
        ];

        if (!empty($_FILES['logo']['name'])) {
            $nama_file = $this->_upload_gambar('logo', 'mitra');
            if ($nama_file === FALSE) {
                $this->session->set_flashdata('pesan_error', strip_tags($this->upload->display_errors()));
                redirect('admin/perusahaan_edit/' . $id);
            }
            $data_update['logo'] = $nama_file;

            $lama = FCPATH . 'assets/images/' . $item->logo;
            if ($item->logo && is_file($lama)) {
                @unlink($lama);
            }
        }

        $this->Mitra_model->ubah($id, $data_update);
        $this->session->set_flashdata('pesan_sukses', 'Mitra perusahaan berhasil diperbarui.');
        redirect('admin/perusahaan');
    }

    // HAPUS MITRA
    public function perusahaan_hapus($id)
    {
        $this->_cek_login();

        $item = $this->Mitra_model->get_by_id($id);
        if (!$item) show_404();

        $file = FCPATH . 'assets/images/' . $item->logo;
        if ($item->logo && is_file($file)) {
            @unlink($file);
        }

        $this->Mitra_model->hapus($id);
        $this->session->set_flashdata('pesan_sukses', 'Mitra perusahaan berhasil dihapus.');
        redirect('admin/perusahaan');
    }

    // Helper generik: unggah satu gambar ke assets/images/<subfolder>/, kembalikan path
    // relatif ('<subfolder>/nama_file.ext') untuk disimpan ke DB, atau FALSE jika gagal.
    private function _upload_gambar($field, $subfolder)
    {
        $folder = FCPATH . 'assets/images/' . $subfolder . '/';
        if (!is_dir($folder)) {
            mkdir($folder, 0755, TRUE);
        }

        $config['upload_path']   = $folder;
        $config['allowed_types'] = 'jpg|jpeg|png|webp';
        $config['max_size']      = 2048; // KB
        $config['encrypt_name']  = TRUE;

        $this->load->library('upload');
        $this->upload->initialize($config);

        if (!$this->upload->do_upload($field)) {
            return FALSE;
        }

        return $subfolder . '/' . $this->upload->data('file_name');
    }

    // ==========================================
    // LOGOUT
    // ==========================================
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('admin');
    }

    // Pastikan admin sudah login, kalau belum tendang ke halaman login
    private function _cek_login()
    {
        if ($this->session->userdata('admin_login') !== TRUE) {
            $this->session->set_flashdata('pesan', 'Silakan login terlebih dahulu.');
            redirect('admin');
        }
    }
}
