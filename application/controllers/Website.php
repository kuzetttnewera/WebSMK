<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Website extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url', 'form'));
        $this->load->model(array('Karousel_model', 'Info_sekolah_model', 'Lulusan_model', 'Lowongan_model', 'Produk_model', 'Mitra_model'));
    }

    // Halaman Beranda
    public function index()
    {
        $data['judul']    = "Beranda - SKANDA SMK Negeri 2 Karanganyar";
        $data['karousel'] = $this->Karousel_model->get_all();
        $data['info']     = $this->Info_sekolah_model->get();

        $this->load->view('template', [
            'content' => $this->load->view('home', $data, TRUE),
            'judul'   => $data['judul']
        ]);
    }

    // Halaman Profil Sekolah
    public function profil()
    {
        $data['judul'] = "Profil Sekolah - SKANDA";
        $data['info']  = $this->Info_sekolah_model->get();

        $this->load->view('template', [
            'content' => $this->load->view('profil', $data, TRUE),
            'judul'   => $data['judul']
        ]);
    }

    // Halaman Lulusan Terbaik (dahulu halaman Galeri)
    public function lulusan()
    {
        $data['judul']   = "Lulusan Terbaik - SKANDA";
        $data['lulusan'] = $this->Lulusan_model->get_all();

        $this->load->view('template', [
            'content' => $this->load->view('lulusan', $data, TRUE),
            'judul'   => $data['judul']
        ]);
    }

    // Halaman Lowongan Pekerjaan
    public function lowongan()
    {
        $data['judul']    = "Lowongan Pekerjaan - SKANDA";
        $data['lowongan'] = $this->Lowongan_model->get_aktif();

        $this->load->view('template', [
            'content' => $this->load->view('lowongan', $data, TRUE),
            'judul'   => $data['judul']
        ]);
    }

    // Halaman Produk Khas Sekolah
    public function produk()
    {
        $data['judul']  = "Produk Khas Sekolah - SKANDA";
        $data['produk'] = $this->Produk_model->get_all();

        $this->load->view('template', [
            'content' => $this->load->view('produk', $data, TRUE),
            'judul'   => $data['judul']
        ]);
    }

    // Halaman Mitra / Perusahaan yang Bekerja Sama
    public function mitra()
    {
        $data['judul'] = "Mitra Kerjasama - SKANDA";
        $data['mitra'] = $this->Mitra_model->get_all();

        $this->load->view('template', [
            'content' => $this->load->view('mitra', $data, TRUE),
            'judul'   => $data['judul']
        ]);
    }
}
