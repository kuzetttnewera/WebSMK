<div class="container my-5">

    <!-- JUDUL HALAMAN -->
    <div class="text-center mb-5 section-title">
        <h2>MITRA KERJASAMA</h2>
        <p class="text-muted mt-2">Perusahaan dan industri yang bekerja sama dengan SKANDA - SMK Negeri 2 Karanganyar</p>
        <div class="garis-gold"></div>
    </div>

    <?php if (empty($mitra)): ?>
        <p class="text-center text-muted py-5">Data mitra kerjasama belum tersedia.</p>
    <?php else: ?>
    <div class="row g-4 justify-content-center">
        <?php foreach ($mitra as $m): ?>
        <div class="col-md-3 col-sm-4 col-6">
            <div class="card card-skanda h-100 shadow-sm border-0 text-center">
                <div class="d-flex align-items-center justify-content-center" style="height:120px; padding:1rem;">
                    <img
                        src="<?= base_url('assets/images/' . (!empty($m->logo) ? $m->logo : 'mitra/default.png')) ?>"
                        alt="<?= htmlspecialchars($m->nama) ?>"
                        style="max-width:100%; max-height:100%; object-fit:contain;"
                    >
                </div>
                <div class="card-body pt-0">
                    <h6 class="card-title text-biru fw-bold mb-1"><?= htmlspecialchars($m->nama) ?></h6>
                    <?php if (!empty($m->bidang)): ?>
                        <p class="text-gold small mb-1"><?= htmlspecialchars($m->bidang) ?></p>
                    <?php endif; ?>
                    <?php if (!empty($m->deskripsi)): ?>
                        <p class="card-text text-muted small mb-0"><?= nl2br(htmlspecialchars($m->deskripsi)) ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

</div>
