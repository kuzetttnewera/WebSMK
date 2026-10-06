<?php $this->load->view('admin/_layout_atas'); ?>

<a href="<?= base_url('admin/perusahaan') ?>" class="btn btn-sm btn-outline-dark mb-3">
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
            <i class="bi bi-buildings-fill"></i> <?= $item ? 'Edit Mitra Perusahaan' : 'Tambah Mitra Perusahaan' ?>
        </h5>

        <?php
            $aksi = $item ? 'admin/perusahaan_edit/' . $item->id : 'admin/perusahaan_tambah';
            echo form_open_multipart($aksi);
        ?>

            <div class="row">
                <div class="col-md-8">
                    <label class="form-label fw-semibold">Nama Perusahaan</label>
                    <input type="text" name="nama" class="form-control <?= form_error('nama') ? 'is-invalid' : '' ?>"
                           value="<?= set_value('nama', $item->nama ?? '') ?>" placeholder="contoh: PT Astra Honda Motor">
                    <?= form_error('nama') ?>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Bidang Usaha (opsional)</label>
                    <input type="text" name="bidang" class="form-control <?= form_error('bidang') ? 'is-invalid' : '' ?>"
                           value="<?= set_value('bidang', $item->bidang ?? '') ?>" placeholder="contoh: Otomotif">
                    <?= form_error('bidang') ?>
                </div>
            </div>

            <label class="form-label fw-semibold mt-3">Deskripsi Kerjasama (opsional)</label>
            <textarea name="deskripsi" rows="3" class="form-control <?= form_error('deskripsi') ? 'is-invalid' : '' ?>"
                      placeholder="contoh: Mitra untuk program PKL dan rekrutmen lulusan"><?= set_value('deskripsi', $item->deskripsi ?? '') ?></textarea>
            <?= form_error('deskripsi') ?>

            <label class="form-label fw-semibold mt-3">Urutan Tampil</label>
            <input type="number" name="urutan" class="form-control <?= form_error('urutan') ? 'is-invalid' : '' ?>"
                   value="<?= set_value('urutan', $item->urutan ?? '') ?>" min="1">
            <div class="form-text">Data dengan angka lebih kecil akan tampil lebih dulu.</div>
            <?= form_error('urutan') ?>

            <label class="form-label fw-semibold mt-3">Logo Perusahaan<?= $item ? ' (kosongkan jika tidak ingin mengganti)' : '' ?></label>
            <input type="file" name="logo" class="form-control" accept=".jpg,.jpeg,.png,.webp">
            <div class="form-text">Format JPG/PNG/WEBP, maksimal 2MB. Disarankan logo dengan latar transparan.</div>

            <?php if ($item && !empty($item->logo)): ?>
                <div class="mt-2">
                    <img src="<?= base_url('assets/images/' . $item->logo) ?>" alt="Logo saat ini"
                         style="width:150px;height:90px;object-fit:contain;border-radius:6px;">
                </div>
            <?php endif; ?>

            <button type="submit" class="btn btn-sk-gold w-100 mt-4">
                <i class="bi bi-save"></i> Simpan
            </button>

        <?php echo form_close(); ?>
    </div>
</div>

<?php $this->load->view('admin/_layout_bawah'); ?>
