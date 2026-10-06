<div class="container my-5">

    <!-- JUDUL HALAMAN -->
    <div class="text-center mb-5 section-title">
        <h2>PRODUK KHAS SEKOLAH</h2>
        <p class="text-muted mt-2">Hasil karya dan produk unggulan siswa-siswi SKANDA - SMK Negeri 2 Karanganyar</p>
        <div class="garis-gold"></div>
    </div>

    <?php if (empty($produk)): ?>
        <p class="text-center text-muted py-5">Data produk khas sekolah belum tersedia.</p>
    <?php else: ?>
    <div class="row g-4 justify-content-center">
        <?php foreach ($produk as $p): ?>
        <div class="col-md-4 col-sm-6">
            <div class="card card-skanda h-100 shadow-sm border-0">
                <img
                    src="<?= base_url('assets/images/' . (!empty($p->foto) ? $p->foto : 'produk/default.jpg')) ?>"
                    class="card-img-top"
                    alt="<?= htmlspecialchars($p->nama) ?>"
                    style="width: 100%; height: 220px; object-fit: cover;"
                >
                <div class="card-body">
                    <h5 class="card-title text-biru mb-1"><?= htmlspecialchars($p->nama) ?></h5>
                    <?php if (!empty($p->jurusan)): ?>
                        <p class="text-gold small fw-semibold mb-2"><i class="bi bi-diagram-3-fill"></i> <?= htmlspecialchars($p->jurusan) ?></p>
                    <?php endif; ?>
                    <p class="card-text text-muted small mb-2"><?= nl2br(htmlspecialchars($p->deskripsi)) ?></p>
                    <?php if (!empty($p->harga)): ?>
                        <p class="card-text fw-bold text-biru mb-0"><?= htmlspecialchars($p->harga) ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

</div>
