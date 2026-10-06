<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jurusan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Jurusan_model');
        $this->load->helper(array('url', 'form'));
    }

    // Halaman daftar semua jurusan
    public function index()
    {
        $data['judul']   = "Jurusan - SKANDA SMK Negeri 2 Karanganyar";
        $data['jurusan'] = $this->Jurusan_model->get_all();

        $this->load->view('template', [
            'content' => $this->load->view('jurusan_index', $data, TRUE),
            'judul'   => $data['judul']
        ]);
    }

    // Halaman detail satu jurusan
    public function detail($slug = NULL)
    {
        $jurusan = $this->Jurusan_model->get_by_slug($slug);
        if (!$jurusan) show_404();

        $data['judul']   = $jurusan->nama . " - SKANDA";
        $data['jurusan'] = $jurusan;

        $this->load->view('template', [
            'content' => $this->load->view('jurusan_detail', $data, TRUE),
            'judul'   => $data['judul']
        ]);
    }
}
