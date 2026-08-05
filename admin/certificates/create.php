<?php
/**
 * -----------------------------------------------------
 * Personal Portfolio CMS
 * Module : Certificates
 * Description : Create certificate record
 * Author : Wahyu Subuh
 * -----------------------------------------------------
 */

declare(strict_types=1);

require_once __DIR__ . '/../../includes/auth.php';
requireLogin();

$pageTitle = 'Add Certificate';
$activeMenu = 'certificates';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    requireCsrf();

    $title         = trim($_POST['title'] ?? '');
    $issuer        = trim($_POST['issuer'] ?? '');
    $issueDate     = trim($_POST['issue_date'] ?? '');
    $credentialId  = trim($_POST['credential_id'] ?? '');
    $credentialUrl = trim($_POST['credential_url'] ?? '');
    $sortOrder     = (int) ($_POST['sort_order'] ?? 0);

    if ($title === '') {
        $errors[] = 'Title wajib diisi.';
    }

    $image = null;
    if (!empty($_FILES['image']['name'])) {
        $image = uploadImage($_FILES['image'], 'certificates');
        if ($image === null) {
            $errors[] = 'Upload gambar gagal. Gunakan format JPG/PNG/WEBP maksimal 5MB.';
        }
    }

    if (!$errors) {
        $stmt = db()->prepare('INSERT INTO certificates (title, issuer, issue_date, credential_id, credential_url, image, sort_order) VALUES (?,?,?,?,?,?,?)');
        $stmt->execute([$title, $issuer, $issueDate, $credentialId, $credentialUrl, $image, $sortOrder]);
        setFlash('success', 'Certificate berhasil ditambahkan.');
        redirect('admin/certificates/index.php');
    }
}

require_once __DIR__ . '/../../includes/header.php';
?>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header bg-white"><strong>Add Certificate</strong></div>
            <div class="card-body">
                <?php if ($errors): ?>
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        <?php foreach ($errors as $err): ?><li><?= e($err) ?></li><?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>
                <form method="post" action="" enctype="multipart/form-data">
                    <?= csrfField() ?>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Title *</label>
                            <input type="text" name="title" class="form-control" value="<?= e($_POST['title'] ?? '') ?>"
                                required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Issuer</label>
                            <input type="text" name="issuer" class="form-control"
                                value="<?= e($_POST['issuer'] ?? '') ?>">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Issue Date</label>
                            <input type="date" name="issue_date" class="form-control"
                                value="<?= e($_POST['issue_date'] ?? '') ?>">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Credential ID</label>
                            <input type="text" name="credential_id" class="form-control"
                                value="<?= e($_POST['credential_id'] ?? '') ?>">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Sort Order</label>
                            <input type="number" name="sort_order" class="form-control"
                                value="<?= e($_POST['sort_order'] ?? '0') ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Credential URL</label>
                            <input type="url" name="credential_url" class="form-control"
                                value="<?= e($_POST['credential_url'] ?? '') ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Thumbnail</label>
                            <input type="file" name="image" class="form-control" accept="image/*">
                        </div>
                    </div>
                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i>Save</button>
                        <a href="<?= url('admin/certificates/index.php') ?>" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>