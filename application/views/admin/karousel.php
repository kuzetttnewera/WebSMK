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
                <h5 class="text-biru fw-bold mb-1"><i class="bi bi-images"></i> Kelola Karousel</h5>
                <p class="text-muted small mb-0">Gambar slide yang tampil di halaman beranda website, diurutkan dari kecil ke besar.</p>
            </div>
            <a href="<?= base_url('admin/karousel_tambah') ?>" class="btn btn-sk-gold">
                <i class="bi bi-plus-circle"></i> Tambah Slide
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle table-skanda">
                <thead>
                    <tr>
                        <th>Urutan</th>
                        <th>Gambar</th>
                        <th>Judul</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($karousel)): ?>
                        <tr><td colspan="4" class="text-center text-muted py-4">Belum ada slide karousel.</td></tr>
                    <?php else: ?>
                        <?php foreach ($karousel as $k): ?>
                        <tr>
                            <td><?= (int) $k->urutan ?></td>
                            <td>
                                <img src="<?= base_url('assets/images/' . $k->gambar) ?>" alt="<?= htmlspecialchars($k->judul) ?>"
                                     style="width:120px;height:70px;object-fit:cover;border-radius:6px;">
                            </td>
                            <td><?= htmlspecialchars($k->judul) ?></td>
                            <td>
                                <a href="<?= base_url('admin/karousel_edit/' . $k->id) ?>" class="btn btn-sm btn-outline-dark">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <a href="<?= base_url('admin/karousel_hapus/' . $k->id) ?>" class="btn btn-sm btn-outline-danger"
                                   onclick="return confirm('Hapus slide \'<?= htmlspecialchars($k->judul, ENT_QUOTES) ?>\'?');">
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
