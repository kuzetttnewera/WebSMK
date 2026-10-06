<div class="container">
    <div class="form-skanda text-center">
        <div class="form-header" style="border-bottom:4px solid #d4af37;">
            <h3 class="mb-0"><i class="bi bi-check-circle-fill"></i> Pendaftaran Berhasil</h3>
        </div>
        <div class="form-body">
            <p class="text-muted">Terima kasih, pendaftaran Anda telah kami terima dengan nomor pendaftaran:</p>
            <h2 class="text-biru fw-bold my-3"><?= htmlspecialchars($no_pendaftaran) ?></h2>
            <p class="text-muted small">
                Mohon simpan nomor pendaftaran ini. Pihak sekolah akan menghubungi Anda
                melalui nomor HP yang telah didaftarkan untuk proses selanjutnya.
            </p>
            <a href="<?= base_url('website') ?>" class="btn btn-sk-gold mt-3">
                <i class="bi bi-house-fill"></i> Kembali ke Beranda
            </a>
        </div>
    </div>
</div>
