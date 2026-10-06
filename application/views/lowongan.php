<div class="container my-5">

    <!-- JUDUL HALAMAN -->
    <div class="text-center mb-5 section-title">
        <h2>LOWONGAN PEKERJAAN</h2>
        <p class="text-muted mt-2">Info lowongan kerja dari mitra industri untuk lulusan SKANDA - SMK Negeri 2 Karanganyar</p>
        <div class="garis-gold"></div>
    </div>

    <?php if (empty($lowongan)): ?>
        <p class="text-center text-muted py-5">Belum ada lowongan pekerjaan yang dibuka saat ini.</p>
    <?php else: ?>
    <div class="row g-4">
        <?php foreach ($lowongan as $lo): ?>
        <div class="col-md-6">
            <div class="card card-skanda h-100 shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <h5 class="card-title text-biru fw-bold mb-0"><?= htmlspecialchars($lo->posisi) ?></h5>
                        <?php if (!empty($lo->jenis)): ?>
                            <span class="badge" style="background:var(--sk-gold, #d4af37); color:#1a1a1a;"><?= htmlspecialchars($lo->jenis) ?></span>
                        <?php endif; ?>
                    </div>
                    <p class="text-gold small fw-semibold mb-2">
                        <i class="bi bi-building"></i> <?= htmlspecialchars($lo->perusahaan) ?>
                        <?php if (!empty($lo->lokasi)): ?>
                            &bull; <i class="bi bi-geo-alt-fill"></i> <?= htmlspecialchars($lo->lokasi) ?>
                        <?php endif; ?>
                    </p>
                    <p class="card-text small mb-2"><?= nl2br(htmlspecialchars($lo->deskripsi)) ?></p>
                    <?php if (!empty($lo->kualifikasi)): ?>
                        <p class="card-text small text-muted mb-2">
                            <strong>Kualifikasi:</strong><br><?= nl2br(htmlspecialchars($lo->kualifikasi)) ?>
                        </p>
                    <?php endif; ?>
                    <hr>
                    <div class="d-flex justify-content-between align-items-center small text-muted">
                        <span>
                            <?php if (!empty($lo->kontak)): ?>
                                <i class="bi bi-telephone-fill"></i> <?= htmlspecialchars($lo->kontak) ?>
                            <?php endif; ?>
                        </span>
                        <?php if (!empty($lo->tanggal_tutup)): ?>
                            <span><i class="bi bi-calendar-event"></i> Tutup: <?= date('d M Y', strtotime($lo->tanggal_tutup)) ?></span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

</div>
