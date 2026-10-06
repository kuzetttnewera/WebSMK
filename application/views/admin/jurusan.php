<?php $this->load->view('admin/_layout_atas'); ?>

<?php if ($this->session->flashdata('pesan_sukses')): ?>
    <div class="alert alert-success"><?= $this->session->flashdata('pesan_sukses') ?></div>
<?php endif; ?>

<div class="card card-skanda">
    <div class="card-body">
        <h5 class="text-biru fw-bold mb-3"><i class="bi bi-diagram-3-fill"></i> Kelola Halaman Jurusan</h5>
        <p class="text-muted small">Admin dapat mengubah nama, ikon, warna identitas, dan deskripsi tiap jurusan yang tampil di halaman publik.</p>

        <div class="table-responsive">
            <table class="table table-hover align-middle table-skanda">
                <thead>
                    <tr>
                        <th>Ikon</th>
                        <th>Nama Jurusan</th>
                        <th>Slug</th>
                        <th>Warna</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($jurusan)): ?>
                        <tr><td colspan="5" class="text-center text-muted py-4">Belum ada data jurusan.</td></tr>
                    <?php else: ?>
                        <?php foreach ($jurusan as $j): ?>
                        <tr>
                            <td><i class="bi <?= htmlspecialchars($j->icon) ?>" style="font-size:1.3rem;"></i></td>
                            <td><?= htmlspecialchars($j->nama) ?></td>
                            <td><code><?= htmlspecialchars($j->slug) ?></code></td>
                            <td>
                                <span class="color-preview jurusan-<?= htmlspecialchars($j->warna) ?>"></span>
                                <?= ucfirst(htmlspecialchars($j->warna)) ?>
                            </td>
                            <td>
                                <a href="<?= base_url('admin/jurusan_edit/' . $j->id) ?>" class="btn btn-sm btn-outline-dark">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <a href="<?= base_url('jurusan/detail/' . $j->slug) ?>" target="_blank" class="btn btn-sm btn-outline-secondary">
                                    <i class="bi bi-box-arrow-up-right"></i> Lihat
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
