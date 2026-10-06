<div class="jurusan-detail-header text-center jurusan-<?= htmlspecialchars($jurusan->warna) ?>">
    <div class="container">
        <i class="bi <?= htmlspecialchars($jurusan->icon) ?>" style="font-size:3rem;"></i>
        <h1 class="fw-bold mt-3 mb-0"><?= htmlspecialchars($jurusan->nama) ?></h1>
        <p class="mb-0 mt-2 opacity-75">SKANDA - SMK Negeri 2 Karanganyar</p>
    </div>
</div>

<div class="container my-5">
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card card-skanda h-100 p-4">
                <div class="card-body">
                    <h4 class="fw-bold mb-3 text-jurusan-<?= htmlspecialchars($jurusan->warna) ?>">Tentang Jurusan</h4>
                    <p class="lh-lg" style="white-space: pre-line;"><?= htmlspecialchars($jurusan->deskripsi) ?></p>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card card-skanda h-100 p-4">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">Ringkasan</h5>
                    <p class="mb-2"><i class="bi bi-tag-fill me-2"></i> <?= htmlspecialchars($jurusan->nama) ?></p>
                    <span class="badge-jurusan jurusan-<?= htmlspecialchars($jurusan->warna) ?>">
                        Warna Identitas: <?= ucfirst(htmlspecialchars($jurusan->warna)) ?>
                    </span>
                    <hr>
                    <a href="<?= base_url('pendaftaran') ?>" class="btn btn-sk-gold w-100">
                        <i class="bi bi-pencil-square"></i> Daftar Sekarang
                    </a>
                    <a href="<?= base_url('jurusan') ?>" class="btn btn-outline-dark w-100 mt-2">
                        <i class="bi bi-arrow-left"></i> Semua Jurusan
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
