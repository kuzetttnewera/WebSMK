<div class="container">
    <div class="form-skanda">
        <div class="form-header">
            <h3 class="mb-1"><i class="bi bi-search"></i> Cek Status Pendaftaran (PPDB)</h3>
            <p class="mb-0 small">Masukkan kode/nomor pendaftaran Anda untuk melihat status terbaru</p>
        </div>

        <div class="form-body">

            <?php echo form_open('pendaftaran/cek_status'); ?>
                <div class="row g-2 align-items-start">
                    <div class="col-md-9">
                        <label>Kode Pendaftaran (PPDB)</label>
                        <input type="text" name="kode_ppdb" class="form-control"
                               placeholder="Contoh: PPDB-<?= date('Y') ?>-0001"
                               value="<?= htmlspecialchars($kode_ppdb ?? '') ?>" required>
                    </div>
                    <div class="col-md-3 d-grid">
                        <label class="d-none d-md-block">&nbsp;</label>
                        <button type="submit" class="btn btn-sk-gold">
                            <i class="bi bi-search"></i> Cek Status
                        </button>
                    </div>
                </div>
            <?php echo form_close(); ?>

            <?php if ($sudah_cari): ?>
                <hr class="my-4">

                <?php if (!$pendaftar): ?>
                    <div class="alert alert-danger mb-0">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                        Kode pendaftaran <strong><?= htmlspecialchars($kode_ppdb) ?></strong> tidak ditemukan.
                        Pastikan kode yang dimasukkan sudah benar.
                    </div>
                <?php else:
                    $cls = $pendaftar->status == 'Diterima' ? 'badge-diterima' : ($pendaftar->status == 'Ditolak' ? 'badge-ditolak' : 'badge-menunggu');
                ?>
                    <div class="text-center">
                        <p class="text-muted small mb-1">Kode Pendaftaran</p>
                        <h4 class="text-biru fw-bold mb-3"><?= htmlspecialchars($pendaftar->no_pendaftaran) ?></h4>

                        <p class="text-muted small mb-1">Nama Pendaftar</p>
                        <h5 class="fw-semibold mb-3"><?= htmlspecialchars($pendaftar->nama_lengkap) ?></h5>

                        <p class="text-muted small mb-2">Status Pendaftaran</p>
                        <span class="badge <?= $cls ?> px-4 py-2 mb-3" style="font-size:1rem;">
                            <?= htmlspecialchars($pendaftar->status) ?>
                        </span>

                        <p class="text-muted small mt-3">
                            <?php if ($pendaftar->status == 'Diterima'): ?>
                                Selamat! Anda dinyatakan diterima. Pihak sekolah akan menghubungi Anda untuk proses selanjutnya.
                            <?php elseif ($pendaftar->status == 'Ditolak'): ?>
                                Mohon maaf, pendaftaran Anda belum dapat kami terima pada tahun ajaran ini.
                            <?php else: ?>
                                Pendaftaran Anda sedang dalam proses verifikasi oleh panitia PPDB.
                            <?php endif; ?>
                        </p>
                    </div>
                <?php endif; ?>
            <?php endif; ?>

        </div>
    </div>
</div>
