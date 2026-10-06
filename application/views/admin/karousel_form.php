<?php $this->load->view('admin/_layout_atas'); ?>

<a href="<?= base_url('admin/karousel') ?>" class="btn btn-sm btn-outline-dark mb-3">
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
            <i class="bi bi-pencil-square"></i> <?= $item ? 'Edit Slide Karousel' : 'Tambah Slide Karousel' ?>
        </h5>

        <?php
            $aksi = $item ? 'admin/karousel_edit/' . $item->id : 'admin/karousel_tambah';
            echo form_open_multipart($aksi);
        ?>

            <label class="form-label fw-semibold">Judul Slide</label>
            <input type="text" name="judul" class="form-control <?= form_error('judul') ? 'is-invalid' : '' ?>"
                   value="<?= set_value('judul', $item->judul ?? '') ?>" placeholder="contoh: Lingkungan Nyaman">
            <?= form_error('judul') ?>

            <label class="form-label fw-semibold mt-3">Urutan Tampil</label>
            <input type="number" name="urutan" class="form-control <?= form_error('urutan') ? 'is-invalid' : '' ?>"
                   value="<?= set_value('urutan', $item->urutan ?? '') ?>" min="1">
            <div class="form-text">Slide dengan angka lebih kecil akan tampil lebih dulu.</div>
            <?= form_error('urutan') ?>

            <label class="form-label fw-semibold mt-3">Gambar<?= $item ? ' (kosongkan jika tidak ingin mengganti)' : '' ?></label>
            <input type="file" name="gambar" class="form-control" accept=".jpg,.jpeg,.png,.webp">
            <div class="form-text">Format JPG/PNG/WEBP, maksimal 2MB.</div>

            <?php if ($item): ?>
                <div class="mt-2">
                    <img src="<?= base_url('assets/images/' . $item->gambar) ?>" alt="Gambar saat ini"
                         style="width:180px;height:110px;object-fit:cover;border-radius:6px;">
                </div>
            <?php endif; ?>

            <button type="submit" class="btn btn-sk-gold w-100 mt-4">
                <i class="bi bi-save"></i> Simpan
            </button>

        <?php echo form_close(); ?>
    </div>
</div>

<?php $this->load->view('admin/_layout_bawah'); ?>
