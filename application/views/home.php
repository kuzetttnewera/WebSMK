<!-- HERO BANNER -->
<div class="hero-skanda text-center">
    <div class="container">
        <span class="badge rounded-pill px-3 py-2 mb-3" style="background:rgba(212,175,55,.15); color:#e8c76b; border:1px solid #d4af37;">
            Penerimaan Peserta Didik Baru Dibuka
        </span>
        <div class="mb-3">
            <img src="<?= base_url('assets/images/logo-smkn2kra.png') ?>" alt="Hero Banner" class="img-fluid" style="height:100px; margin-right:8px;">
        </div>
        <p class="lead">Mewujudkan Generasi Cerdas, Berakhlak Mulia, dan Berprestasi</p>
        <div class="mt-4">
            <a href="<?= base_url('pendaftaran') ?>" class="btn btn-sk-gold me-2">
                <i class="bi bi-pencil-square"></i> Daftar Sekarang
            </a>
            <a href="<?= base_url('website/profil') ?>" class="btn btn-sk-outline">
                Profil Sekolah
            </a>
        </div>
    </div>
</div>

<!-- STATISTIK SINGKAT -->
<div class="container my-5">
    <div class="row text-center g-4">
        <div class="col-6 col-md-3">
            <h2 class="fw-bold text-biru mb-0"><i class="bi bi-people-fill text-gold"></i></h2>
            <h4 class="fw-bold text-biru mb-0"><?= htmlspecialchars($info->jumlah_siswa ?? '0') ?></h4>
            <p class="text-muted small">Siswa Aktif</p>
        </div>
        <div class="col-6 col-md-3">
            <h2 class="fw-bold text-biru mb-0"><i class="bi bi-person-workspace text-gold"></i></h2>
            <h4 class="fw-bold text-biru mb-0"><?= htmlspecialchars($info->jumlah_guru ?? '0') ?></h4>
            <p class="text-muted small">Guru &amp; Staf</p>
        </div>
        <div class="col-6 col-md-3">
            <h2 class="fw-bold text-biru mb-0"><i class="bi bi-trophy-fill text-gold"></i></h2>
            <h4 class="fw-bold text-biru mb-0"><?= htmlspecialchars($info->jumlah_prestasi ?? '0') ?></h4>
            <p class="text-muted small">Prestasi Diraih</p>
        </div>
        <div class="col-6 col-md-3">
            <h2 class="fw-bold text-biru mb-0"><i class="bi bi-building text-gold"></i></h2>
            <h4 class="fw-bold text-biru mb-0"><?= htmlspecialchars($info->jumlah_fasilitas ?? '0') ?></h4>
            <p class="text-muted small">Ruang Fasilitas</p>
        </div>
    </div>
</div>

<!-- SAMBUTAN KEPALA SEKOLAH -->
<div class="container my-5">
    <div class="row align-items-start g-4">

        <div class="col-md-4">
            <div class="card card-skanda shadow" style="width: 100%;">
                <img
                    src="<?= base_url('assets/images/' . (!empty($info->foto_kepsek) ? $info->foto_kepsek : 'kepsek.jpg')) ?>"
                    class="card-img-top"
                    alt="Kepala Sekolah SKANDA"
                    style="height: 300px; object-fit: cover;"
                >
            </div>
        </div>

        <div class="col-md-8">
            <div class="card card-skanda shadow h-100 p-4">
                <div class="card-body">
                    <h3 class="text-uppercase fw-bold mb-3 text-biru">Sambutan Kepala Sekolah</h3>
                    <hr style="width: 100px; height: 3px; background-color: #d4af37; border: none; margin-left: 0;">

                    <h4 class="text-muted mt-4"><?= htmlspecialchars($info->nama_kepsek ?? '') ?></h4>

                    <p class="mt-4 lh-lg">
                        <?= nl2br(htmlspecialchars($info->sambutan ?? '')) ?>
                    </p>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- CAROUSEL -->
<?php if (!empty($karousel)): ?>
<div class="container">
<div id="carouselSkanda" class="carousel slide shadow rounded mb-5" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <?php foreach ($karousel as $i => $k): ?>
            <button type="button" data-bs-target="#carouselSkanda" data-bs-slide-to="<?= $i ?>" <?= $i === 0 ? 'class="active"' : '' ?>></button>
        <?php endforeach; ?>
    </div>
    <div class="carousel-inner">
        <?php foreach ($karousel as $i => $k): ?>
        <div class="carousel-item <?= $i === 0 ? 'active' : '' ?>">
            <img src="<?= base_url('assets/images/' . $k->gambar) ?>" class="d-block w-100" style="max-height:420px;object-fit:cover;" alt="<?= htmlspecialchars($k->judul) ?>">
            <div class="carousel-caption d-none d-md-block bg-hitam bg-opacity-75 rounded p-2">
                <h5 class="text-gold mb-0"><?= htmlspecialchars($k->judul) ?></h5>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselSkanda" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselSkanda" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>
</div>
<?php endif; ?>

<!-- DESKRIPSI -->
<div class="text-center mb-5 section-title">
    <h2>Tentang SKANDA</h2>
    <div class="garis-gold"></div>
    <p class="text-muted w-75 mx-auto mt-3">
        SMK Negeri 2 Karanganyar berkomitmen memberikan pendidikan terbaik dengan
        kurikulum yang sesuai perkembangan zaman, membentuk siswa yang berilmu, berakhlak
        mulia, dan siap bersaing di tingkat nasional maupun global.
    </p>
</div>

<!-- CTA PENDAFTARAN -->
<div class="bg-biru-tua text-center py-5 mb-0">
    <div class="container">
        <h3 class="text-white fw-bold">Bergabunglah Bersama SKANDA</h3>
        <p class="text-white-50 mb-4">Pendaftaran siswa baru tahun ajaran ini sudah dibuka. Daftarkan dirimu sekarang!</p>
        <a href="<?= base_url('pendaftaran') ?>" class="btn btn-sk-gold">
            <i class="bi bi-pencil-square"></i> Formulir Pendaftaran
        </a>
    </div>
</div>
