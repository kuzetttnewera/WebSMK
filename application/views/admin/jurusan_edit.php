<?php $this->load->view('admin/_layout_atas'); ?>

<a href="<?= base_url('admin/jurusan') ?>" class="btn btn-sm btn-outline-dark mb-3">
    <i class="bi bi-arrow-left"></i> Kembali
</a>

<?php if (validation_errors()): ?>
    <div class="alert alert-danger">Periksa kembali isian Anda.</div>
<?php endif; ?>

<div class="card card-skanda">
    <div class="card-body">
        <h5 class="text-biru fw-bold mb-3">
            <i class="bi bi-pencil-square"></i> Edit Jurusan: <?= htmlspecialchars($jurusan->nama) ?>
        </h5>

        <?php echo form_open('admin/jurusan_edit/' . $jurusan->id); ?>

            <label class="form-label fw-semibold">Nama Jurusan</label>
            <input type="text" name="nama" class="form-control <?= form_error('nama') ? 'is-invalid' : '' ?>"
                   value="<?= set_value('nama', $jurusan->nama) ?>">
            <?= form_error('nama') ?>

            <label class="form-label fw-semibold mt-3">Kode Ikon (Bootstrap Icons)</label>
            <input type="text" name="icon" class="form-control <?= form_error('icon') ? 'is-invalid' : '' ?>"
                   value="<?= set_value('icon', $jurusan->icon) ?>" placeholder="contoh: bi-gear-fill">
            <div class="form-text">Lihat daftar ikon di <a href="https://icons.getbootstrap.com/" target="_blank">icons.getbootstrap.com</a>, salin nama kelasnya (misal <code>bi-gear-fill</code>).</div>
            <?= form_error('icon') ?>

            <label class="form-label fw-semibold mt-3">Warna Identitas</label>
            <select name="warna" class="form-select <?= form_error('warna') ? 'is-invalid' : '' ?>">
                <?php $pilihan_warna = ['biru' => 'Biru', 'oranye' => 'Oranye', 'merah' => 'Merah', 'hijau' => 'Hijau']; ?>
                <?php foreach ($pilihan_warna as $key => $label): ?>
                    <option value="<?= $key ?>" <?= set_select('warna', $key, $jurusan->warna == $key) ?>><?= $label ?></option>
                <?php endforeach; ?>
            </select>
            <?= form_error('warna') ?>

            <label class="form-label fw-semibold mt-3">Deskripsi Halaman</label>
            <textarea name="deskripsi" rows="8" class="form-control <?= form_error('deskripsi') ? 'is-invalid' : '' ?>"><?= set_value('deskripsi', $jurusan->deskripsi) ?></textarea>
            <div class="form-text">Teks ini akan tampil di halaman detail jurusan pada website publik.</div>
            <?= form_error('deskripsi') ?>

            <button type="submit" class="btn btn-sk-gold w-100 mt-4">
                <i class="bi bi-save"></i> Simpan Perubahan
            </button>

        <?php echo form_close(); ?>
    </div>
</div>

<?php $this->load->view('admin/_layout_bawah'); ?>
