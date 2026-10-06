<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $judul ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Tema SKANDA -->
    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-skanda fixed-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="<?= base_url('website') ?>">
                <img src="<?= base_url('assets/images/logo-smkn2kra.png') ?>" alt="Logo SMK Negeri 2 Karanganyar" class="img-fluid" style="height:50px;">
                <span class="d-flex flex-column ms-2 lh-sm">
                    <span class="fw-bold" style="font-size:1.05rem; color:var(--sk-gold);">SKANDA</span>
                    <small class="text-white-50" style="font-size:.68rem; font-weight:400;">SMK Negeri 2 Karanganyar</small>
                </span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('website') ?>">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('website/profil') ?>">Profil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('jurusan') ?>">Jurusan</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Info Sekolah
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="<?= base_url('website/lulusan') ?>"><i class="bi bi-mortarboard-fill"></i> Lulusan Terbaik</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('website/lowongan') ?>"><i class="bi bi-briefcase-fill"></i> Lowongan Pekerjaan</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('website/produk') ?>"><i class="bi bi-bag-check-fill"></i> Produk Khas Sekolah</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('website/mitra') ?>"><i class="bi bi-buildings-fill"></i> Mitra Kerjasama</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?= base_url('pendaftaran/cek_status') ?>"><i class="bi bi-search"></i> Cek Status PPDB</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="btn-daftar" href="<?= base_url('pendaftaran') ?>">
                            <i class="bi bi-pencil-square"></i> Daftar Sekarang
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Konten Halaman -->
    <div class="site-content">
        <?= $content ?>
    </div>

    <!-- Footer -->
    <footer class="footer-skanda mt-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-5">
                    <h5>SKANDA</h5>
                    <p class="small mb-1">SMK Negeri 2 Karanganyar</p>
                    <p class="small text-white-50">
                        Mencetak lulusan yang kompeten, berkarakter, dan siap kerja
                        melalui pendidikan kejuruan yang unggul dan berbasis industri.
                    </p>
                </div>
                <div class="col-md-3">
                    <h5>Tautan</h5>
                    <p class="mb-1"><a href="<?= base_url('website') ?>">Beranda</a></p>
                    <p class="mb-1"><a href="<?= base_url('website/profil') ?>">Profil Sekolah</a></p>
                    <p class="mb-1"><a href="<?= base_url('jurusan') ?>">Jurusan</a></p>
                    <p class="mb-1"><a href="<?= base_url('website/lulusan') ?>">Lulusan Terbaik</a></p>
                    <p class="mb-1"><a href="<?= base_url('website/lowongan') ?>">Lowongan Pekerjaan</a></p>
                    <p class="mb-1"><a href="<?= base_url('website/produk') ?>">Produk Khas Sekolah</a></p>
                    <p class="mb-1"><a href="<?= base_url('website/mitra') ?>">Mitra Kerjasama</a></p>
                    <p class="mb-1"><a href="<?= base_url('pendaftaran') ?>">Pendaftaran Siswa Baru</a></p>
                    <p class="mb-1"><a href="<?= base_url('pendaftaran/cek_status') ?>">Cek Status PPDB</a></p>
                </div>
                <div class="col-md-4">
                    <h5>Kontak</h5>
                    <p class="mb-1 small"><i class="bi bi-geo-alt-fill text-gold"></i> Karanganyar, Jawa Tengah</p>
                    <p class="mb-1 small"><i class="bi bi-envelope-fill text-gold"></i> info@skanda.sch.id</p>
                    <p class="mb-1 small"><i class="bi bi-telephone-fill text-gold"></i> (0271) 000-0000</p>
                </div>
            </div>
            <hr>
            <p class="text-center small mb-0 text-white-50">&copy; <?= date('Y') ?> SMK Negeri 2 Karanganyar (SKANDA). Seluruh hak cipta dilindungi.</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <?php $this->load->view('partials/chatbot'); ?>
</body>
</html>
