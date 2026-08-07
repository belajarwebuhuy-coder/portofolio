<?php
declare(strict_types=1);

require_once __DIR__ . '/../../includes/auth.php';
requireLogin();

$pageTitle = 'Add Experience';
$activeMenu = 'experience';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    requireCsrf();

    $company     = trim($_POST['company'] ?? '');
    $position    = trim($_POST['position'] ?? '');
    $startDate   = trim($_POST['start_date'] ?? '');
    $endDate     = trim($_POST['end_date'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $sortOrder   = (int) ($_POST['sort_order'] ?? 0);

    if ($company === '' || $position === '') {
        $errors[] = 'Company dan Position wajib diisi.';
    }

    if (!$errors) {
        $stmt = db()->prepare('INSERT INTO experience (company, position, start_date, end_date, description, sort_order) VALUES (?,?,?,?,?,?)');
        $stmt->execute([$company, $position, $startDate, $endDate, $description, $sortOrder]);
        setFlash('success', 'Experience berhasil ditambahkan.');
        redirect('admin/experience/index.php');
    }
}

require_once __DIR__ . '/../../includes/header.php';
?>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header bg-white"><strong>Add Experience</strong></div>
            <div class="card-body">
                <?php if ($errors): ?>
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        <?php foreach ($errors as $err): ?><li><?= e($err) ?></li><?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>
                <form method="post" action="">
                    <?= csrfField() ?>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Company *</label>
                            <input type="text" name="company" class="form-control"
                                value="<?= e($_POST['company'] ?? '') ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Position *</label>
                            <input type="text" name="position" class="form-control"
                                value="<?= e($_POST['position'] ?? '') ?>" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Start Date</label>
                            <input type="month" name="start_date" class="form-control"
                                value="<?= e($_POST['start_date'] ?? '') ?>">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">End Date</label>
                            <input type="month" name="end_date" class="form-control"
                                value="<?= e($_POST['end_date'] ?? '') ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Sort Order</label>
                            <input type="number" name="sort_order" class="form-control"
                                value="<?= e($_POST['sort_order'] ?? '0') ?>">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control"
                                rows="4"><?= e($_POST['description'] ?? '') ?></textarea>
                        </div>
                    </div>
                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i>Save</button>
                        <a href="<?= url('admin/experience/index.php') ?>" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>