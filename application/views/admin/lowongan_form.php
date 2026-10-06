<?php $this->load->view('admin/_layout_atas'); ?>

<a href="<?= base_url('admin/lowongan') ?>" class="btn btn-sm btn-outline-dark mb-3">
    <i class="bi bi-arrow-left"></i> Kembali
</a>

<?php if (validation_errors()): ?>
    <div class="alert alert-danger">Periksa kembali isian Anda.</div>
<?php endif; ?>

<div class="card card-skanda">
    <div class="card-body">
        <h5 class="text-biru fw-bold mb-3">
            <i class="bi bi-briefcase-fill"></i> <?= $item ? 'Edit Lowongan Pekerjaan' : 'Tambah Lowongan Pekerjaan' ?>
        </h5>

        <?php
            $aksi = $item ? 'admin/lowongan_edit/' . $item->id : 'admin/lowongan_tambah';
            echo form_open($aksi);
        ?>

            <div class="row">
                <div class="col-md-8">
                    <label class="form-label fw-semibold">Posisi / Jabatan</label>
                    <input type="text" name="posisi" class="form-control <?= form_error('posisi') ? 'is-invalid' : '' ?>"
                           value="<?= set_value('posisi', $item->posisi ?? '') ?>" placeholder="contoh: Staff Administrasi">
                    <?= form_error('posisi') ?>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Jenis Pekerjaan</label>
                    <select name="jenis" class="form-select <?= form_error('jenis') ? 'is-invalid' : '' ?>">
                        <?php $j = set_value('jenis', $item->jenis ?? ''); ?>
                        <option value="">-- Pilih --</option>
                        <?php foreach (['Full Time', 'Part Time', 'Magang', 'Kontrak'] as $opt): ?>
                            <option value="<?= $opt ?>" <?= $j == $opt ? 'selected' : '' ?>><?= $opt ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?= form_error('jenis') ?>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-8">
                    <label class="form-label fw-semibold">Nama Perusahaan</label>
                    <input type="text" name="perusahaan" class="form-control <?= form_error('perusahaan') ? 'is-invalid' : '' ?>"
                           value="<?= set_value('perusahaan', $item->perusahaan ?? '') ?>" placeholder="contoh: PT Astra Honda Motor">
                    <?= form_error('perusahaan') ?>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Lokasi</label>
                    <input type="text" name="lokasi" class="form-control <?= form_error('lokasi') ? 'is-invalid' : '' ?>"
                           value="<?= set_value('lokasi', $item->lokasi ?? '') ?>" placeholder="contoh: Karanganyar">
                    <?= form_error('lokasi') ?>
                </div>
            </div>

            <label class="form-label fw-semibold mt-3">Deskripsi Pekerjaan</label>
            <textarea name="deskripsi" rows="3" class="form-control <?= form_error('deskripsi') ? 'is-invalid' : '' ?>"
                      placeholder="Uraian tugas dan tanggung jawab..."><?= set_value('deskripsi', $item->deskripsi ?? '') ?></textarea>
            <?= form_error('deskripsi') ?>

            <label class="form-label fw-semibold mt-3">Kualifikasi</label>
            <textarea name="kualifikasi" rows="3" class="form-control <?= form_error('kualifikasi') ? 'is-invalid' : '' ?>"
                      placeholder="contoh: Lulusan SMK jurusan terkait, jujur, disiplin"><?= set_value('kualifikasi', $item->kualifikasi ?? '') ?></textarea>
            <?= form_error('kualifikasi') ?>

            <div class="row mt-3">
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Kontak</label>
                    <input type="text" name="kontak" class="form-control <?= form_error('kontak') ? 'is-invalid' : '' ?>"
                           value="<?= set_value('kontak', $item->kontak ?? '') ?>" placeholder="No. HP / Email">
                    <?= form_error('kontak') ?>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Tanggal Tutup Lowongan</label>
                    <input type="date" name="tanggal_tutup" class="form-control <?= form_error('tanggal_tutup') ? 'is-invalid' : '' ?>"
                           value="<?= set_value('tanggal_tutup', $item->tanggal_tutup ?? '') ?>">
                    <?= form_error('tanggal_tutup') ?>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Status</label>
                    <select name="status" class="form-select <?= form_error('status') ? 'is-invalid' : '' ?>">
                        <?php $s = set_value('status', $item->status ?? 'Aktif'); ?>
                        <option value="Aktif" <?= $s == 'Aktif' ? 'selected' : '' ?>>Aktif</option>
                        <option value="Nonaktif" <?= $s == 'Nonaktif' ? 'selected' : '' ?>>Nonaktif</option>
                    </select>
                    <?= form_error('status') ?>
                </div>
            </div>

            <button type="submit" class="btn btn-sk-gold w-100 mt-4">
                <i class="bi bi-save"></i> Simpan
            </button>

        <?php echo form_close(); ?>
    </div>
</div>

<?php $this->load->view('admin/_layout_bawah'); ?>
