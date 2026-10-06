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
                <h5 class="text-biru fw-bold mb-1"><i class="bi bi-bag-check-fill"></i> Kelola Produk Khas Sekolah</h5>
                <p class="text-muted small mb-0">Ditampilkan pada halaman publik "Produk Khas Sekolah", diurutkan dari kecil ke besar.</p>
            </div>
            <a href="<?= base_url('admin/produk_tambah') ?>" class="btn btn-sk-gold">
                <i class="bi bi-plus-circle"></i> Tambah Produk
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle table-skanda">
                <thead>
                    <tr>
                        <th>Urutan</th>
                        <th>Foto</th>
                        <th>Nama Produk</th>
                        <th>Jurusan</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($produk)): ?>
                        <tr><td colspan="6" class="text-center text-muted py-4">Belum ada data produk.</td></tr>
                    <?php else: ?>
                        <?php foreach ($produk as $p): ?>
                        <tr>
                            <td><?= (int) $p->urutan ?></td>
                            <td>
                                <?php if (!empty($p->foto)): ?>
                                    <img src="<?= base_url('assets/images/' . $p->foto) ?>" alt="<?= htmlspecialchars($p->nama) ?>"
                                         style="width:80px;height:60px;object-fit:cover;border-radius:6px;">
                                <?php else: ?>
                                    <span class="text-muted small">Tidak ada foto</span>
                                <?php endif; ?>
                            </td>
                            <td><?= htmlspecialchars($p->nama) ?></td>
                            <td><?= htmlspecialchars($p->jurusan) ?></td>
                            <td><?= htmlspecialchars($p->harga) ?></td>
                            <td>
                                <a href="<?= base_url('admin/produk_edit/' . $p->id) ?>" class="btn btn-sm btn-outline-dark">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <a href="<?= base_url('admin/produk_hapus/' . $p->id) ?>" class="btn btn-sm btn-outline-danger"
                                   onclick="return confirm('Hapus produk \'<?= htmlspecialchars($p->nama, ENT_QUOTES) ?>\'?');">
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
