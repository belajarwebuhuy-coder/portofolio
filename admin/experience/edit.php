<?php
/**
 * -----------------------------------------------------
 * Personal Portfolio CMS
 * Module : Experience
 * Description : Edit experience record
 * Author : Wahyu Subuh
 * -----------------------------------------------------
 */

declare(strict_types=1);

require_once __DIR__ . '/../../includes/auth.php';
requireLogin();

$pageTitle = 'Edit Experience';
$activeMenu = 'experience';

$id = (int) ($_GET['id'] ?? 0);
$pdo = db();

$stmt = $pdo->prepare('SELECT * FROM experience WHERE id = ? LIMIT 1');
$stmt->execute([$id]);
$item = $stmt->fetch();

if (!$item) {
    setFlash('danger', 'Data tidak ditemukan.');
    redirect('admin/experience/index.php');
}

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
        $stmt = $pdo->prepare('UPDATE experience SET company=?, position=?, start_date=?, end_date=?, description=?, sort_order=? WHERE id=?');
        $stmt->execute([$company, $position, $startDate, $endDate, $description, $sortOrder, $id]);
        setFlash('success', 'Experience berhasil diperbarui.');
        redirect('admin/experience/index.php');
    }
}

require_once __DIR__ . '/../../includes/header.php';
?>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header bg-white"><strong>Edit Experience</strong></div>
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
                            <input type="text" name="company" class="form-control" value="<?= e($item['company']) ?>"
                                required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Position *</label>
                            <input type="text" name="position" class="form-control" value="<?= e($item['position']) ?>"
                                required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Start Date</label>
                            <input type="month" name="start_date" class="form-control"
                                value="<?= e($item['start_date']) ?>">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">End Date</label>
                            <input type="month" name="end_date" class="form-control"
                                value="<?= e($item['end_date']) ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Sort Order</label>
                            <input type="number" name="sort_order" class="form-control"
                                value="<?= (int) $item['sort_order'] ?>">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control"
                                rows="4"><?= e($item['description']) ?></textarea>
                        </div>
                    </div>
                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i>Update</button>
                        <a href="<?= url('admin/experience/index.php') ?>" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>