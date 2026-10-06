<?php $this->load->view('admin/_layout_atas'); ?>

<?php if ($this->session->flashdata('pesan_sukses')): ?>
    <div class="alert alert-success"><?= $this->session->flashdata('pesan_sukses') ?></div>
<?php endif; ?>

<div class="card card-skanda">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center flex-wrap mb-3 gap-2">
            <h5 class="text-biru fw-bold mb-0"><i class="bi bi-people-fill"></i> Data Pendaftar</h5>
            <div class="btn-group">
                <a href="<?= base_url('admin/pendaftar') ?>" class="btn btn-sm <?= !$status_aktif ? 'btn-dark' : 'btn-outline-dark' ?>">Semua</a>
                <a href="<?= base_url('admin/pendaftar/Menunggu') ?>" class="btn btn-sm <?= $status_aktif == 'Menunggu' ? 'btn-dark' : 'btn-outline-dark' ?>">Menunggu</a>
                <a href="<?= base_url('admin/pendaftar/Diterima') ?>" class="btn btn-sm <?= $status_aktif == 'Diterima' ? 'btn-dark' : 'btn-outline-dark' ?>">Diterima</a>
                <a href="<?= base_url('admin/pendaftar/Ditolak') ?>" class="btn btn-sm <?= $status_aktif == 'Ditolak' ? 'btn-dark' : 'btn-outline-dark' ?>">Ditolak</a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle table-skanda">
                <thead>
                    <tr>
                        <th>No. Pendaftaran</th>
                        <th>Nama</th>
                        <th>NIS</th>
                        <th>Asal Sekolah</th>
                        <th>No. HP</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($pendaftar)): ?>
                        <tr><td colspan="7" class="text-center text-muted py-4">Belum ada data.</td></tr>
                    <?php else: ?>
                        <?php foreach ($pendaftar as $p): ?>
                        <tr>
                            <td><?= htmlspecialchars($p->no_pendaftaran) ?></td>
                            <td><?= htmlspecialchars($p->nama_lengkap) ?></td>
                            <td><?= htmlspecialchars($p->nis) ?></td>
                            <td><?= htmlspecialchars($p->asal_sekolah) ?></td>
                            <td><?= htmlspecialchars($p->no_hp) ?></td>
                            <td>
                                <?php
                                    $cls = $p->status == 'Diterima' ? 'badge-diterima' : ($p->status == 'Ditolak' ? 'badge-ditolak' : 'badge-menunggu');
                                ?>
                                <span class="badge <?= $cls ?>"><?= $p->status ?></span>
                            </td>
                            <td>
                                <a href="<?= base_url('admin/detail/' . $p->id) ?>" class="btn btn-sm btn-outline-dark">
                                    <i class="bi bi-eye"></i> Detail
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php $this->load->view('admin/_layout_bawah'); ?>
