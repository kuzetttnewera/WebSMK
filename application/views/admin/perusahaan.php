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
                <h5 class="text-biru fw-bold mb-1"><i class="bi bi-buildings-fill"></i> Kelola Mitra Perusahaan</h5>
                <p class="text-muted small mb-0">Ditampilkan pada halaman publik "Mitra Kerjasama", diurutkan dari kecil ke besar.</p>
            </div>
            <a href="<?= base_url('admin/perusahaan_tambah') ?>" class="btn btn-sk-gold">
                <i class="bi bi-plus-circle"></i> Tambah Mitra
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle table-skanda">
                <thead>
                    <tr>
                        <th>Urutan</th>
                        <th>Logo</th>
                        <th>Nama Perusahaan</th>
                        <th>Bidang</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($mitra)): ?>
                        <tr><td colspan="5" class="text-center text-muted py-4">Belum ada data mitra perusahaan.</td></tr>
                    <?php else: ?>
                        <?php foreach ($mitra as $m): ?>
                        <tr>
                            <td><?= (int) $m->urutan ?></td>
                            <td>
                                <?php if (!empty($m->logo)): ?>
                                    <img src="<?= base_url('assets/images/' . $m->logo) ?>" alt="<?= htmlspecialchars($m->nama) ?>"
                                         style="width:80px;height:50px;object-fit:contain;border-radius:6px;">
                                <?php else: ?>
                                    <span class="text-muted small">Tidak ada logo</span>
                                <?php endif; ?>
                            </td>
                            <td><?= htmlspecialchars($m->nama) ?></td>
                            <td><?= htmlspecialchars($m->bidang) ?></td>
                            <td>
                                <a href="<?= base_url('admin/perusahaan_edit/' . $m->id) ?>" class="btn btn-sm btn-outline-dark">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <a href="<?= base_url('admin/perusahaan_hapus/' . $m->id) ?>" class="btn btn-sm btn-outline-danger"
                                   onclick="return confirm('Hapus mitra \'<?= htmlspecialchars($m->nama, ENT_QUOTES) ?>\'?');">
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
