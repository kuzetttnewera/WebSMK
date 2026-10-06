<?php $this->load->view('admin/_layout_atas'); ?>

<div class="row g-3 mb-4">
    <div class="col-md-3 col-6">
        <div class="stat-card biru">
            <div class="small">Total Pendaftar</div>
            <div class="fs-2 fw-bold"><?= $total ?></div>
            <i class="bi bi-people-fill"></i>
        </div>
    </div>
    <div class="col-md-3 col-6">
        <div class="stat-card gold">
            <div class="small">Menunggu Verifikasi</div>
            <div class="fs-2 fw-bold"><?= $menunggu ?></div>
            <i class="bi bi-hourglass-split"></i>
        </div>
    </div>
    <div class="col-md-3 col-6">
        <div class="stat-card hitam">
            <div class="small">Diterima</div>
            <div class="fs-2 fw-bold"><?= $diterima ?></div>
            <i class="bi bi-check-circle-fill"></i>
        </div>
    </div>
    <div class="col-md-3 col-6">
        <div class="stat-card" style="background:linear-gradient(135deg,#7a1f27,#b02a37);">
            <div class="small">Ditolak</div>
            <div class="fs-2 fw-bold"><?= $ditolak ?></div>
            <i class="bi bi-x-circle-fill"></i>
        </div>
    </div>
</div>

<div class="card card-skanda">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
            <h5 class="text-biru fw-bold mb-0"><i class="bi bi-clock-history"></i> Pendaftar Terbaru</h5>
            <a href="<?= base_url('admin/laporan') ?>" class="btn btn-sm btn-sk-gold">
                <i class="bi bi-file-earmark-bar-graph-fill"></i> Lihat Laporan Lengkap
            </a>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle table-skanda">
                <thead>
                    <tr>
                        <th>No. Pendaftaran</th>
                        <th>Nama</th>
                        <th>Asal Sekolah</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($terbaru)): ?>
                        <tr><td colspan="6" class="text-center text-muted py-4">Belum ada pendaftar.</td></tr>
                    <?php else: ?>
                        <?php foreach ($terbaru as $p): ?>
                        <tr>
                            <td><?= htmlspecialchars($p->no_pendaftaran) ?></td>
                            <td><?= htmlspecialchars($p->nama_lengkap) ?></td>
                            <td><?= htmlspecialchars($p->asal_sekolah) ?></td>
                            <td>
                                <?php
                                    $cls = $p->status == 'Diterima' ? 'badge-diterima' : ($p->status == 'Ditolak' ? 'badge-ditolak' : 'badge-menunggu');
                                ?>
                                <span class="badge <?= $cls ?>"><?= $p->status ?></span>
                            </td>
                            <td><?= date('d-m-Y', strtotime($p->created_at)) ?></td>
                            <td><a href="<?= base_url('admin/detail/' . $p->id) ?>" class="btn btn-sm btn-outline-dark">Detail</a></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php $this->load->view('admin/_layout_bawah'); ?>
