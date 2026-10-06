<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $judul ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">
</head>
<body>
<div class="d-flex">
    <!-- SIDEBAR -->
    <div class="admin-sidebar" style="width:230px; min-width:230px;">
        <div class="brand">
            <div class="logo">
                <img src="<?= base_url('assets/images/logo-smkn2kra.png') ?>" alt="Logo SMK Negeri 2 Karanganyar" class="img-fluid">
            </div>
            <div class="small text-white-50" style="font-weight:400;">Panel Admin</div>
        </div>
        <a href="<?= base_url('admin/dashboard') ?>" class="<?= (uri_string() == 'admin/dashboard') ? 'active' : '' ?>">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>
        <a href="<?= base_url('admin/pendaftar') ?>" class="<?= (strpos(uri_string(), 'admin/pendaftar') === 0 || strpos(uri_string(), 'admin/detail') === 0) ? 'active' : '' ?>">
            <i class="bi bi-people-fill"></i> Data Pendaftar
        </a>
        <a href="<?= base_url('admin/laporan') ?>" class="<?= (strpos(uri_string(), 'admin/laporan') === 0) ? 'active' : '' ?>">
            <i class="bi bi-file-earmark-bar-graph-fill"></i> Laporan Pendaftar
        </a>
        <a href="<?= base_url('admin/jurusan') ?>" class="<?= (strpos(uri_string(), 'admin/jurusan') === 0) ? 'active' : '' ?>">
            <i class="bi bi-diagram-3-fill"></i> Kelola Jurusan
        </a>
        <a href="<?= base_url('admin/karousel') ?>" class="<?= (strpos(uri_string(), 'admin/karousel') === 0) ? 'active' : '' ?>">
            <i class="bi bi-images"></i> Kelola Karousel
        </a>
        <a href="<?= base_url('admin/lulusan') ?>" class="<?= (strpos(uri_string(), 'admin/lulusan') === 0) ? 'active' : '' ?>">
            <i class="bi bi-mortarboard-fill"></i> Lulusan Terbaik
        </a>
        <a href="<?= base_url('admin/lowongan') ?>" class="<?= (strpos(uri_string(), 'admin/lowongan') === 0) ? 'active' : '' ?>">
            <i class="bi bi-briefcase-fill"></i> Lowongan Pekerjaan
        </a>
        <a href="<?= base_url('admin/produk') ?>" class="<?= (strpos(uri_string(), 'admin/produk') === 0) ? 'active' : '' ?>">
            <i class="bi bi-bag-check-fill"></i> Produk Khas Sekolah
        </a>
        <a href="<?= base_url('admin/perusahaan') ?>" class="<?= (strpos(uri_string(), 'admin/perusahaan') === 0) ? 'active' : '' ?>">
            <i class="bi bi-buildings-fill"></i> Mitra Perusahaan
        </a>
        <a href="<?= base_url('admin/info_sekolah') ?>" class="<?= (strpos(uri_string(), 'admin/info_sekolah') === 0) ? 'active' : '' ?>">
            <i class="bi bi-info-circle-fill"></i> Info Sekolah
        </a>
        <a href="<?= base_url('website') ?>" target="_blank">
            <i class="bi bi-globe"></i> Lihat Website
        </a>
        <a href="<?= base_url('admin/logout') ?>" class="text-warning">
            <i class="bi bi-box-arrow-right"></i> Keluar
        </a>
    </div>

    <!-- KONTEN -->
    <div class="flex-fill">
        <nav class="navbar navbar-light bg-white border-bottom px-4 py-3 shadow-sm">
            <span class="fw-semibold text-biru"><?= $judul ?></span>
            <span class="text-muted small">
                <i class="bi bi-person-circle"></i> <?= htmlspecialchars($nama_admin ?? '') ?>
            </span>
        </nav>
        <div class="p-4">
