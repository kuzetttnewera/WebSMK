<?php $this->load->view('admin/_layout_atas'); ?>

<style>
    @media print {
        .admin-sidebar, .navbar, .sk-no-print { display: none !important; }
        .flex-fill { width: 100% !important; }
    }
</style>

<div class="card card-skanda sk-no-print">
    <div class="card-body">
        <h5 class="text-biru fw-bold mb-3"><i class="bi bi-file-earmark-bar-graph-fill"></i> Laporan Pendaftar</h5>
        <p class="text-muted small mb-3">
            Rekap siapa saja yang mendaftar dan kapan mereka mendaftar. Gunakan filter di bawah untuk
            mempersempit rentang tanggal atau status, lalu unduh sebagai file CSV (bisa dibuka di Excel).
        </p>

        <?php echo form_open('admin/laporan', ['method' => 'get', 'class' => 'row g-2 align-items-end']); ?>
            <div class="col-md-3">
                <label class="form-label fw-semibold">Dari Tanggal</label>
                <input type="date" name="dari" class="form-control" value="<?= htmlspecialchars($dari ?? '') ?>">
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold">Sampai Tanggal</label>
                <input type="date" name="sampai" class="form-control" value="<?= htmlspecialchars($sampai ?? '') ?>">
            </div>
            <div class="col-md-3">
                <label class="form-label fw-semibold">Status</label>
                <select name="status" class="form-select">
                    <option value="">-- Semua Status --</option>
                    <?php foreach (['Menunggu', 'Diterima', 'Ditolak'] as $s): ?>
                        <option value="<?= $s ?>" <?= ($status ?? '') == $s ? 'selected' : '' ?>><?= $s ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-sk-gold flex-fill">
                    <i class="bi bi-funnel-fill"></i> Terapkan
                </button>
                <a href="<?= base_url('admin/laporan') ?>" class="btn btn-outline-dark" title="Reset filter">
                    <i class="bi bi-arrow-counterclockwise"></i>
                </a>
            </div>
        <?php echo form_close(); ?>

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mt-4 mb-2">
            <span class="text-muted small">
                Menampilkan <strong><?= count($pendaftar) ?></strong> data pendaftar
                <?php if (!empty($dari) || !empty($sampai)): ?>
                    (<?= !empty($dari) ? date('d M Y', strtotime($dari)) : '...' ?> &ndash; <?= !empty($sampai) ? date('d M Y', strtotime($sampai)) : '...' ?>)
                <?php endif; ?>
            </span>
            <div class="d-flex gap-2">
                <a href="<?= base_url('admin/laporan_export') . (!empty($_SERVER['QUERY_STRING']) ? '?' . htmlspecialchars($_SERVER['QUERY_STRING']) : '') ?>" class="btn btn-sm btn-outline-dark">
                    <i class="bi bi-file-earmark-spreadsheet"></i> Ekspor CSV
                </a>
                <button type="button" class="btn btn-sm btn-outline-dark" onclick="window.print()">
                    <i class="bi bi-printer-fill"></i> Cetak
                </button>
            </div>
        </div>
    </div>
</div>

<div class="card card-skanda mt-3">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle table-skanda">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Pendaftaran</th>
                        <th>Nama</th>
                        <th>Asal Sekolah</th>
                        <th>Status</th>
                        <th>Tanggal &amp; Waktu Daftar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($pendaftar)): ?>
                        <tr><td colspan="6" class="text-center text-muted py-4">Tidak ada data untuk filter yang dipilih.</td></tr>
                    <?php else: ?>
                        <?php foreach ($pendaftar as $i => $p): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><?= htmlspecialchars($p->no_pendaftaran) ?></td>
                            <td><?= htmlspecialchars($p->nama_lengkap) ?></td>
                            <td><?= htmlspecialchars($p->asal_sekolah) ?></td>
                            <td>
                                <?php $cls = $p->status == 'Diterima' ? 'badge-diterima' : ($p->status == 'Ditolak' ? 'badge-ditolak' : 'badge-menunggu'); ?>
                                <span class="badge <?= $cls ?>"><?= htmlspecialchars($p->status) ?></span>
                            </td>
                            <td><?= date('d M Y, H:i', strtotime($p->created_at)) ?> WIB</td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php $this->load->view('admin/_layout_bawah'); ?>
