<?php $this->load->view('admin/_layout_atas'); ?>

<a href="<?= base_url('admin/pendaftar') ?>" class="btn btn-sm btn-outline-dark mb-3">
    <i class="bi bi-arrow-left"></i> Kembali
</a>

<?php if ($this->session->flashdata('pesan_sukses')): ?>
    <div class="alert alert-success"><?= $this->session->flashdata('pesan_sukses') ?></div>
<?php endif; ?>
<?php if ($this->session->flashdata('pesan_error')): ?>
    <div class="alert alert-danger"><?= $this->session->flashdata('pesan_error') ?></div>
<?php endif; ?>
<?php if (validation_errors()): ?>
    <div class="alert alert-danger"><?= validation_errors() ?></div>
<?php endif; ?>

<div class="row g-4">
    <div class="col-md-8">
        <div class="card card-skanda">
            <div class="card-body">
                <h5 class="text-biru fw-bold mb-3">
                    <i class="bi bi-person-badge"></i> <?= htmlspecialchars($pendaftar->nama_lengkap) ?>
                </h5>
                <table class="table table-borderless mb-0">
                    <tr><th width="220">No. Pendaftaran</th><td><?= htmlspecialchars($pendaftar->no_pendaftaran) ?></td></tr>
                    <tr><th>NIS</th><td><?= htmlspecialchars($pendaftar->nis) ?></td></tr>
                    <tr><th>Jenis Kelamin</th><td><?= htmlspecialchars($pendaftar->jenis_kelamin) ?></td></tr>
                    <tr><th>Tempat, Tanggal Lahir</th><td><?= htmlspecialchars($pendaftar->tempat_lahir) ?>, <?= date('d-m-Y', strtotime($pendaftar->tanggal_lahir)) ?></td></tr>
                    <tr><th>Asal Sekolah</th><td><?= htmlspecialchars($pendaftar->asal_sekolah) ?></td></tr>
                    <tr><th>Alamat</th><td><?= nl2br(htmlspecialchars($pendaftar->alamat)) ?></td></tr>
                    <tr><th>No. HP Siswa</th><td><?= htmlspecialchars($pendaftar->no_hp) ?></td></tr>
                    <tr><th>Nama Orang Tua / Wali</th><td><?= htmlspecialchars($pendaftar->nama_orang_tua) ?></td></tr>
                    <tr><th>No. HP Orang Tua / Wali</th><td><?= htmlspecialchars($pendaftar->no_hp_orang_tua) ?></td></tr>
                    <tr><th>Tanggal Daftar</th><td><?= date('d-m-Y H:i', strtotime($pendaftar->created_at)) ?></td></tr>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card card-skanda mb-3">
            <div class="card-body text-center">
                <p class="text-muted small mb-1">Status Saat Ini</p>
                <?php
                    $cls = $pendaftar->status == 'Diterima' ? 'badge-diterima' : ($pendaftar->status == 'Ditolak' ? 'badge-ditolak' : 'badge-menunggu');
                ?>
                <span class="badge <?= $cls ?> fs-6 px-3 py-2"><?= $pendaftar->status ?></span>
            </div>
        </div>

        <div class="card card-skanda">
            <div class="card-body">
                <h6 class="fw-bold text-biru mb-3"><i class="bi bi-check2-square"></i> Verifikasi Status</h6>
                <?php echo form_open('admin/verifikasi/' . $pendaftar->id); ?>
                    <select name="status" class="form-select mb-3">
                        <option value="Menunggu" <?= set_select('status', 'Menunggu', $pendaftar->status == 'Menunggu') ?>>Menunggu</option>
                        <option value="Diterima" <?= set_select('status', 'Diterima', $pendaftar->status == 'Diterima') ?>>Diterima</option>
                        <option value="Ditolak" <?= set_select('status', 'Ditolak', $pendaftar->status == 'Ditolak') ?>>Ditolak</option>
                    </select>
                    <button type="submit" class="btn btn-sk-gold w-100">
                        <i class="bi bi-save"></i> Simpan Status
                    </button>
                <?php echo form_close(); ?>

                <hr>
                <a href="<?= base_url('admin/hapus/' . $pendaftar->id) ?>"
                   class="btn btn-outline-danger w-100"
                   onclick="return confirm('Yakin ingin menghapus data pendaftar ini?')">
                    <i class="bi bi-trash"></i> Hapus Data
                </a>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('admin/_layout_bawah'); ?>
