<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $judul ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">
</head>
<body>

<div class="login-skanda">
    <div class="login-box">
        <div class="login-top">
            <h4 class="mt-2 mb-0">Login Admin</h4>
            <p class="small text-white-50 mb-0">SKANDA - SMK Negeri 2 Karanganyar</p>
        </div>
        <div class="login-body">

            <?php if ($this->session->flashdata('pesan')): ?>
                <div class="alert alert-danger py-2 small"><?= $this->session->flashdata('pesan') ?></div>
            <?php endif; ?>

            <?php if (validation_errors()): ?>
                <div class="alert alert-danger py-2 small">Periksa kembali isian Anda.</div>
            <?php endif; ?>

            <?php echo form_open('admin'); ?>

                <label class="form-label fw-semibold">Username</label>
                <input type="text" name="username" class="form-control <?= form_error('username') ? 'is-invalid' : '' ?>" value="<?= set_value('username') ?>" autofocus>
                <?= form_error('username') ?>

                <label class="form-label fw-semibold mt-3">Password</label>
                <input type="password" name="password" class="form-control <?= form_error('password') ? 'is-invalid' : '' ?>">
                <?= form_error('password') ?>

                <button type="submit" class="btn btn-sk-gold w-100 mt-4">
                    <i class="bi bi-box-arrow-in-right"></i> MASUK
                </button>
            <?php echo form_close(); ?>

            <div class="text-center mt-3">
                <a href="<?= base_url('website') ?>" class="small text-muted">
                    <i class="bi bi-arrow-left"></i> Kembali ke Website
                </a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
