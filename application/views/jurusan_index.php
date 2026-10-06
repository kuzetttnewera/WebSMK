<div class="container my-5">

    <div class="text-center mb-5 section-title">
        <h2>Kompetensi Keahlian</h2>
        <p class="text-muted mt-2">Jurusan yang tersedia di SKANDA - SMK Negeri 2 Karanganyar</p>
        <div class="garis-gold"></div>
    </div>

    <div class="row g-4">
        <?php if (empty($jurusan)): ?>
            <div class="col-12 text-center text-muted py-5">Belum ada data jurusan.</div>
        <?php else: ?>
            <?php foreach ($jurusan as $j): ?>
            <div class="col-md-6 col-lg-3">
                <div class="jurusan-card shadow-sm">
                    <div class="jurusan-top jurusan-<?= htmlspecialchars($j->warna) ?>">
                        <i class="bi <?= htmlspecialchars($j->icon) ?>"></i>
                        <h5 class="fw-bold mt-2 mb-0"><?= htmlspecialchars($j->nama) ?></h5>
                    </div>
                    <div class="jurusan-body text-center">
                        <p class="text-muted small mb-3">
                            <?= character_limiter(htmlspecialchars($j->deskripsi), 100) ?>
                        </p>
                        <a href="<?= base_url('jurusan/detail/' . $j->slug) ?>" class="btn btn-sm btn-outline-dark">
                            Selengkapnya <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

</div>
