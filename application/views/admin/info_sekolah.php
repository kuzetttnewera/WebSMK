<?php $this->load->view('admin/_layout_atas'); ?>

<?php if ($this->session->flashdata('pesan_sukses')): ?>
    <div class="alert alert-success"><?= $this->session->flashdata('pesan_sukses') ?></div>
<?php endif; ?>

<?php if ($this->session->flashdata('pesan_error')): ?>
    <div class="alert alert-danger"><?= $this->session->flashdata('pesan_error') ?></div>
<?php endif; ?>

<?php if (validation_errors()): ?>
    <div class="alert alert-danger">Periksa kembali isian Anda.</div>
<?php endif; ?>

<div class="card card-skanda">
    <div class="card-body">
        <h5 class="text-biru fw-bold mb-1"><i class="bi bi-info-circle-fill"></i> Info Sekolah</h5>
        <p class="text-muted small">Konten ini tampil di halaman Beranda &amp; Profil Sekolah pada website publik.</p>

        <?php echo form_open_multipart('admin/info_sekolah'); ?>

            <h6 class="text-biru fw-bold mt-4">Sambutan Kepala Sekolah</h6>
            <hr style="width:80px;height:3px;background:#d4af37;border:none;margin:0 0 1rem 0;">

            <label class="form-label fw-semibold">Nama / Jabatan Kepala Sekolah</label>
            <input type="text" name="nama_kepsek" class="form-control <?= form_error('nama_kepsek') ? 'is-invalid' : '' ?>"
                   value="<?= set_value('nama_kepsek', $info->nama_kepsek ?? '') ?>">
            <?= form_error('nama_kepsek') ?>

            <label class="form-label fw-semibold mt-3">Foto Kepala Sekolah (kosongkan jika tidak ingin mengganti)</label>
            <input type="file" name="foto_kepsek" class="form-control" accept=".jpg,.jpeg,.png,.webp">
            <?php if (!empty($info->foto_kepsek)): ?>
                <div class="mt-2">
                    <img src="<?= base_url('assets/images/' . $info->foto_kepsek) ?>" alt="Foto Kepala Sekolah"
                         style="width:120px;height:120px;object-fit:cover;border-radius:6px;">
                </div>
            <?php endif; ?>

            <label class="form-label fw-semibold mt-3">Teks Sambutan</label>
            <textarea name="sambutan" rows="6" class="form-control <?= form_error('sambutan') ? 'is-invalid' : '' ?>"><?= set_value('sambutan', $info->sambutan ?? '') ?></textarea>
            <?= form_error('sambutan') ?>

            <h6 class="text-biru fw-bold mt-4">Visi &amp; Misi</h6>
            <hr style="width:80px;height:3px;background:#d4af37;border:none;margin:0 0 1rem 0;">

            <label class="form-label fw-semibold">Visi</label>
            <textarea name="visi" rows="3" class="form-control <?= form_error('visi') ? 'is-invalid' : '' ?>"><?= set_value('visi', $info->visi ?? '') ?></textarea>
            <?= form_error('visi') ?>

            <label class="form-label fw-semibold mt-3">Misi</label>
            <textarea name="misi" rows="6" class="form-control <?= form_error('misi') ? 'is-invalid' : '' ?>"><?= set_value('misi', $info->misi ?? '') ?></textarea>
            <div class="form-text">Tulis satu poin misi per baris. Setiap baris akan tampil sebagai daftar terpisah di halaman Profil Sekolah.</div>
            <?= form_error('misi') ?>

            <h6 class="text-biru fw-bold mt-4">Statistik Singkat (Beranda)</h6>
            <hr style="width:80px;height:3px;background:#d4af37;border:none;margin:0 0 1rem 0;">

            <div class="row g-3">
                <div class="col-md-3 col-6">
                    <label class="form-label fw-semibold">Siswa Aktif</label>
                    <input type="text" name="jumlah_siswa" class="form-control <?= form_error('jumlah_siswa') ? 'is-invalid' : '' ?>"
                           value="<?= set_value('jumlah_siswa', $info->jumlah_siswa ?? '') ?>" placeholder="contoh: 500+">
                    <?= form_error('jumlah_siswa') ?>
                </div>
                <div class="col-md-3 col-6">
                    <label class="form-label fw-semibold">Guru &amp; Staf</label>
                    <input type="text" name="jumlah_guru" class="form-control <?= form_error('jumlah_guru') ? 'is-invalid' : '' ?>"
                           value="<?= set_value('jumlah_guru', $info->jumlah_guru ?? '') ?>" placeholder="contoh: 40+">
                    <?= form_error('jumlah_guru') ?>
                </div>
                <div class="col-md-3 col-6">
                    <label class="form-label fw-semibold">Prestasi Diraih</label>
                    <input type="text" name="jumlah_prestasi" class="form-control <?= form_error('jumlah_prestasi') ? 'is-invalid' : '' ?>"
                           value="<?= set_value('jumlah_prestasi', $info->jumlah_prestasi ?? '') ?>" placeholder="contoh: 50+">
                    <?= form_error('jumlah_prestasi') ?>
                </div>
                <div class="col-md-3 col-6">
                    <label class="form-label fw-semibold">Ruang Fasilitas</label>
                    <input type="text" name="jumlah_fasilitas" class="form-control <?= form_error('jumlah_fasilitas') ? 'is-invalid' : '' ?>"
                           value="<?= set_value('jumlah_fasilitas', $info->jumlah_fasilitas ?? '') ?>" placeholder="contoh: 20+">
                    <?= form_error('jumlah_fasilitas') ?>
                </div>
            </div>

            <button type="submit" class="btn btn-sk-gold w-100 mt-4">
                <i class="bi bi-save"></i> Simpan Perubahan
            </button>

        <?php echo form_close(); ?>
    </div>
</div>

<?php $this->load->view('admin/_layout_bawah'); ?>
