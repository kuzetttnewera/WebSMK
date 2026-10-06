<?php $this->load->view('admin/_layout_atas'); ?>

<?php if ($this->session->flashdata('pesan_sukses')): ?>
    <div class="alert alert-success"><?= $this->session->flashdata('pesan_sukses') ?></div>
<?php endif; ?>

<?php if ($this->session->flashdata('pesan_error')): ?>
    <div class="alert alert-danger"><?= $this->session->flashdata('pesan_error') ?></div>
<?php endif; ?>

<div class="card card-skanda">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h5 class="text-biru fw-bold mb-1"><i class="bi bi-briefcase-fill"></i> Kelola Lowongan Pekerjaan</h5>
                <p class="text-muted small mb-0">Hanya lowongan berstatus "Aktif" yang tampil di halaman publik.</p>
            </div>
            <a href="<?= base_url('admin/lowongan_tambah') ?>" class="btn btn-sk-gold">
                <i class="bi bi-plus-circle"></i> Tambah Lowongan
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle table-skanda">
                <thead>
                    <tr>
                        <th>Posisi</th>
                        <th>Perusahaan</th>
                        <th>Jenis</th>
                        <th>Tutup</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($lowongan)): ?>
                        <tr><td colspan="6" class="text-center text-muted py-4">Belum ada data lowongan pekerjaan.</td></tr>
                    <?php else: ?>
                        <?php foreach ($lowongan as $lo): ?>
                        <tr>
                            <td><?= htmlspecialchars($lo->posisi) ?></td>
                            <td><?= htmlspecialchars($lo->perusahaan) ?></td>
                            <td><?= htmlspecialchars($lo->jenis) ?></td>
                            <td><?= !empty($lo->tanggal_tutup) ? date('d M Y', strtotime($lo->tanggal_tutup)) : '-' ?></td>
                            <td>
                                <span class="badge <?= $lo->status == 'Aktif' ? 'badge-diterima' : 'badge-ditolak' ?>">
                                    <?= htmlspecialchars($lo->status) ?>
                                </span>
                            </td>
                            <td>
                                <a href="<?= base_url('admin/lowongan_edit/' . $lo->id) ?>" class="btn btn-sm btn-outline-dark">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <a href="<?= base_url('admin/lowongan_hapus/' . $lo->id) ?>" class="btn btn-sm btn-outline-danger"
                                   onclick="return confirm('Hapus lowongan \'<?= htmlspecialchars($lo->posisi, ENT_QUOTES) ?>\'?');">
                                    <i class="bi bi-trash"></i> Hapus
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
