<div class="container my-5">

    <!-- JUDUL HALAMAN -->
    <div class="text-center mb-5 section-title">
        <h2>LULUSAN TERBAIK</h2>
        <p class="text-muted mt-2">Bangga menampilkan lulusan-lulusan berprestasi SKANDA - SMK Negeri 2 Karanganyar</p>
        <div class="garis-gold"></div>
    </div>

    <!-- TATA LETAK LULUSAN -->
    <?php if (empty($lulusan)): ?>
        <p class="text-center text-muted py-5">Data lulusan terbaik belum tersedia.</p>
    <?php else: ?>
    <div class="row g-4 justify-content-center">
        <?php foreach ($lulusan as $l): ?>
        <div class="col-md-4 col-sm-6">
            <div class="card card-skanda h-100 shadow-sm border-0 text-center">
                <img
                    src="<?= base_url('assets/images/' . (!empty($l->foto) ? $l->foto : 'lulusan/default.jpg')) ?>"
                    class="card-img-top"
                    alt="<?= htmlspecialchars($l->nama) ?>"
                    style="width: 100%; height: 280px; object-fit: cover;"
                >
                <div class="card-body">
                    <h5 class="card-title text-biru mb-1"><?= htmlspecialchars($l->nama) ?></h5>
                    <p class="text-gold small fw-semibold mb-2">
                        <?= htmlspecialchars($l->jurusan) ?> &bull; Angkatan <?= htmlspecialchars($l->tahun_lulus) ?>
                    </p>
                    <p class="card-text text-muted small mb-0"><?= nl2br(htmlspecialchars($l->prestasi)) ?></p>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

</div>
