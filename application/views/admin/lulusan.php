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
                <h5 class="text-biru fw-bold mb-1"><i class="bi bi-mortarboard-fill"></i> Kelola Lulusan Terbaik</h5>
                <p class="text-muted small mb-0">Ditampilkan pada halaman publik "Lulusan Terbaik", diurutkan dari kecil ke besar.</p>
            </div>
            <a href="<?= base_url('admin/lulusan_tambah') ?>" class="btn btn-sk-gold">
                <i class="bi bi-plus-circle"></i> Tambah Lulusan
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle table-skanda">
                <thead>
                    <tr>
                        <th>Urutan</th>
                        <th>Foto</th>
                        <th>Nama</th>
                        <th>Jurusan</th>
                        <th>Tahun</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($lulusan)): ?>
                        <tr><td colspan="6" class="text-center text-muted py-4">Belum ada data lulusan terbaik.</td></tr>
                    <?php else: ?>
                        <?php foreach ($lulusan as $l): ?>
                        <tr>
                            <td><?= (int) $l->urutan ?></td>
                            <td>
                                <?php if (!empty($l->foto)): ?>
                                    <img src="<?= base_url('assets/images/' . $l->foto) ?>" alt="<?= htmlspecialchars($l->nama) ?>"
                                         style="width:70px;height:70px;object-fit:cover;border-radius:6px;">
                                <?php else: ?>
                                    <span class="text-muted small">Tidak ada foto</span>
                                <?php endif; ?>
                            </td>
                            <td><?= htmlspecialchars($l->nama) ?></td>
                            <td><?= htmlspecialchars($l->jurusan) ?></td>
                            <td><?= htmlspecialchars($l->tahun_lulus) ?></td>
                            <td>
                                <a href="<?= base_url('admin/lulusan_edit/' . $l->id) ?>" class="btn btn-sm btn-outline-dark">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <a href="<?= base_url('admin/lulusan_hapus/' . $l->id) ?>" class="btn btn-sm btn-outline-danger"
                                   onclick="return confirm('Hapus data lulusan \'<?= htmlspecialchars($l->nama, ENT_QUOTES) ?>\'?');">
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
