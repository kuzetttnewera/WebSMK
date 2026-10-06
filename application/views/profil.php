<div class="container my-5">

    <div class="text-center mb-5 section-title">
        <h2>Profil Sekolah</h2>
        <div class="garis-gold"></div>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-md-6">
            <div class="card card-skanda h-100 p-4">
                <div class="card-body">
                    <h4 class="text-biru fw-bold"><i class="bi bi-eye-fill text-gold"></i> Visi</h4>
                    <p class="lh-lg mt-3">
                        <?= nl2br(htmlspecialchars($info->visi ?? '')) ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-skanda h-100 p-4">
                <div class="card-body">
                    <h4 class="text-biru fw-bold"><i class="bi bi-flag-fill text-gold"></i> Misi</h4>
                    <ul class="lh-lg mt-3">
                        <?php
                            $daftar_misi = preg_split('/\r\n|\r|\n/', trim($info->misi ?? ''));
                        ?>
                        <?php foreach ($daftar_misi as $poin): ?>
                            <?php if (trim($poin) !== ''): ?>
                                <li><?= htmlspecialchars(trim($poin)) ?></li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center mb-4 section-title">
        <h2>Fasilitas Sekolah</h2>
        <div class="garis-gold"></div>
    </div>

    <div class="row g-4">
        <div class="col-md-4 col-sm-6">
            <div class="card card-skanda h-100 shadow-sm">
                <img src="<?= base_url('assets/images/fasilitas.jpg') ?>" class="card-img-top" style="height:200px;object-fit:cover;" alt="Ruang Kelas">
                <div class="card-body text-center">
                    <h6 class="fw-bold text-biru">Ruang Kelas Nyaman</h6>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class="card card-skanda h-100 shadow-sm">
                <img src="<?= base_url('assets/images/kelas.jpeg') ?>" class="card-img-top" style="height:200px;object-fit:cover;" alt="Kegiatan Belajar">
                <div class="card-body text-center">
                    <h6 class="fw-bold text-biru">Kegiatan Belajar Mengajar</h6>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class="card card-skanda h-100 shadow-sm">
                <img src="<?= base_url('assets/images/guru.jpg') ?>" class="card-img-top" style="height:200px;object-fit:cover;" alt="Tenaga Pendidik">
                <div class="card-body text-center">
                    <h6 class="fw-bold text-biru">Tenaga Pendidik Profesional</h6>
                </div>
            </div>
        </div>
    </div>

</div>
