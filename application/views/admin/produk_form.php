<?php $this->load->view('admin/_layout_atas'); ?>

<a href="<?= base_url('admin/produk') ?>" class="btn btn-sm btn-outline-dark mb-3">
    <i class="bi bi-arrow-left"></i> Kembali
</a>

<?php if ($this->session->flashdata('pesan_error')): ?>
    <div class="alert alert-danger"><?= $this->session->flashdata('pesan_error') ?></div>
<?php endif; ?>

<?php if (validation_errors()): ?>
    <div class="alert alert-danger">Periksa kembali isian Anda.</div>
<?php endif; ?>

<div class="card card-skanda">
    <div class="card-body">
        <h5 class="text-biru fw-bold mb-3">
            <i class="bi bi-bag-check-fill"></i> <?= $item ? 'Edit Produk' : 'Tambah Produk' ?>
        </h5>

        <?php
            $aksi = $item ? 'admin/produk_edit/' . $item->id : 'admin/produk_tambah';
            echo form_open_multipart($aksi);
        ?>

            <div class="row">
                <div class="col-md-8">
                    <label class="form-label fw-semibold">Nama Produk</label>
                    <input type="text" name="nama" class="form-control <?= form_error('nama') ? 'is-invalid' : '' ?>"
                           value="<?= set_value('nama', $item->nama ?? '') ?>" placeholder="contoh: Kursi Kayu Jati Ukir">
                    <?= form_error('nama') ?>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Harga (opsional)</label>
                    <input type="text" name="harga" class="form-control <?= form_error('harga') ? 'is-invalid' : '' ?>"
                           value="<?= set_value('harga', $item->harga ?? '') ?>" placeholder="contoh: Rp 500.000">
                    <?= form_error('harga') ?>
                </div>
            </div>

            <label class="form-label fw-semibold mt-3">Jurusan Penghasil (opsional)</label>
            <input type="text" name="jurusan" class="form-control <?= form_error('jurusan') ? 'is-invalid' : '' ?>"
                   value="<?= set_value('jurusan', $item->jurusan ?? '') ?>" placeholder="contoh: Desain Produksi Kriya Kayu">
            <?= form_error('jurusan') ?>

            <label class="form-label fw-semibold mt-3">Deskripsi</label>
            <textarea name="deskripsi" rows="3" class="form-control <?= form_error('deskripsi') ? 'is-invalid' : '' ?>"
                      placeholder="Deskripsi singkat produk..."><?= set_value('deskripsi', $item->deskripsi ?? '') ?></textarea>
            <?= form_error('deskripsi') ?>

            <label class="form-label fw-semibold mt-3">Urutan Tampil</label>
            <input type="number" name="urutan" class="form-control <?= form_error('urutan') ? 'is-invalid' : '' ?>"
                   value="<?= set_value('urutan', $item->urutan ?? '') ?>" min="1">
            <div class="form-text">Produk dengan angka lebih kecil akan tampil lebih dulu.</div>
            <?= form_error('urutan') ?>

            <label class="form-label fw-semibold mt-3">Foto Produk<?= $item ? ' (kosongkan jika tidak ingin mengganti)' : '' ?></label>
            <input type="file" name="foto" class="form-control" accept=".jpg,.jpeg,.png,.webp">
            <div class="form-text">Format JPG/PNG/WEBP, maksimal 2MB.</div>

            <?php if ($item && !empty($item->foto)): ?>
                <div class="mt-2">
                    <img src="<?= base_url('assets/images/' . $item->foto) ?>" alt="Foto saat ini"
                         style="width:150px;height:100px;object-fit:cover;border-radius:6px;">
                </div>
            <?php endif; ?>

            <button type="submit" class="btn btn-sk-gold w-100 mt-4">
                <i class="bi bi-save"></i> Simpan
            </button>

        <?php echo form_close(); ?>
    </div>
</div>

<?php $this->load->view('admin/_layout_bawah'); ?>
