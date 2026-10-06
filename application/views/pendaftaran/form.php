<div class="container">
    <div class="form-skanda">
        <div class="form-header">
            <h3 class="mb-1"><i class="bi bi-pencil-square"></i> Formulir Pendaftaran Siswa Baru</h3>
            <p class="mb-0 small">SKANDA - SMK Negeri 2 Karanganyar</p>
        </div>

        <div class="form-body">

            <?php if (validation_errors()): ?>
                <div class="alert alert-danger">
                    <strong>Periksa kembali isian Anda.</strong> Beberapa data belum sesuai.
                </div>
            <?php endif; ?>

            <?php echo form_open('pendaftaran'); ?>

                <div class="row">
                    <div class="col-md-8">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" class="form-control <?= form_error('nama_lengkap') ? 'is-invalid' : '' ?>" value="<?= set_value('nama_lengkap') ?>">
                        <?= form_error('nama_lengkap') ?>
                    </div>
                    <div class="col-md-4">
                        <label>NIS</label>
                        <input type="text" name="nis" class="form-control <?= form_error('nis') ? 'is-invalid' : '' ?>" value="<?= set_value('nis') ?>">
                        <?= form_error('nis') ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label>Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-select <?= form_error('jenis_kelamin') ? 'is-invalid' : '' ?>">
                            <option value="">-- Pilih --</option>
                            <option value="Laki-laki" <?= set_select('jenis_kelamin', 'Laki-laki') ?>>Laki-laki</option>
                            <option value="Perempuan" <?= set_select('jenis_kelamin', 'Perempuan') ?>>Perempuan</option>
                        </select>
                        <?= form_error('jenis_kelamin') ?>
                    </div>
                    <div class="col-md-6">
                        <label>Asal Sekolah (SMP/MTS)</label>
                        <input type="text" name="asal_sekolah" class="form-control <?= form_error('asal_sekolah') ? 'is-invalid' : '' ?>" value="<?= set_value('asal_sekolah') ?>">
                        <?= form_error('asal_sekolah') ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label>Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" class="form-control <?= form_error('tempat_lahir') ? 'is-invalid' : '' ?>" value="<?= set_value('tempat_lahir') ?>">
                        <?= form_error('tempat_lahir') ?>
                    </div>
                    <div class="col-md-6">
                        <label>Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-control <?= form_error('tanggal_lahir') ? 'is-invalid' : '' ?>" value="<?= set_value('tanggal_lahir') ?>">
                        <?= form_error('tanggal_lahir') ?>
                    </div>
                </div>

                <label>Alamat Lengkap</label>
                <textarea name="alamat" rows="3" class="form-control <?= form_error('alamat') ? 'is-invalid' : '' ?>"><?= set_value('alamat') ?></textarea>
                <?= form_error('alamat') ?>

                <div class="row">
                    <div class="col-md-6">
                        <label>Nomor HP / WA Siswa</label>
                        <input type="text" name="no_hp" class="form-control <?= form_error('no_hp') ? 'is-invalid' : '' ?>" value="<?= set_value('no_hp') ?>" placeholder="08xxxxxxxxxx">
                        <?= form_error('no_hp') ?>
                    </div>
                    <div class="col-md-6">
                        <label>Nomor HP Orang Tua / Wali</label>
                        <input type="text" name="no_hp_orang_tua" class="form-control <?= form_error('no_hp_orang_tua') ? 'is-invalid' : '' ?>" value="<?= set_value('no_hp_orang_tua') ?>" placeholder="08xxxxxxxxxx">
                        <?= form_error('no_hp_orang_tua') ?>
                    </div>
                </div>

                <label>Nama Orang Tua / Wali</label>
                <input type="text" name="nama_orang_tua" class="form-control <?= form_error('nama_orang_tua') ? 'is-invalid' : '' ?>" value="<?= set_value('nama_orang_tua') ?>">
                <?= form_error('nama_orang_tua') ?>

                <button type="submit" class="btn btn-sk-gold w-100 mt-4">
                    <i class="bi bi-send-check"></i> DAFTARKAN SEKARANG
                </button>

            <?php echo form_close(); ?>
        </div>
    </div>
</div>
