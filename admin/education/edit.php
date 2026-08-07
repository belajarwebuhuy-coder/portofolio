<?php
declare(strict_types=1);

require_once __DIR__ . '/../../includes/auth.php';
requireLogin();

$pageTitle = 'Edit Education';
$activeMenu = 'education';

$id = (int) ($_GET['id'] ?? 0);
$pdo = db();

$stmt = $pdo->prepare('SELECT * FROM education WHERE id = ? LIMIT 1');
$stmt->execute([$id]);
$item = $stmt->fetch();

if (!$item) {
    setFlash('danger', 'Data tidak ditemukan.');
    redirect('admin/education/index.php');
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    requireCsrf();

    $institution = trim($_POST['institution'] ?? '');
    $degree      = trim($_POST['degree'] ?? '');
    $startYear   = trim($_POST['start_year'] ?? '');
    $endYear     = trim($_POST['end_year'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $sortOrder   = (int) ($_POST['sort_order'] ?? 0);

    if ($institution === '' || $degree === '') {
        $errors[] = 'Institution dan Degree wajib diisi.';
    }

    if (!$errors) {
        $stmt = $pdo->prepare('UPDATE education SET institution=?, degree=?, start_year=?, end_year=?, description=?, sort_order=? WHERE id=?');
        $stmt->execute([$institution, $degree, $startYear, $endYear, $description, $sortOrder, $id]);
        setFlash('success', 'Education berhasil diperbarui.');
        redirect('admin/education/index.php');
    }
}

require_once __DIR__ . '/../../includes/header.php';
?>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header bg-white">
                <strong>Edit Education</strong>
            </div>
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
                            <label class="form-label">Institution *</label>
                            <input type="text" name="institution" class="form-control"
                                value="<?= e($item['institution']) ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Degree *</label>
                            <input type="text" name="degree" class="form-control" value="<?= e($item['degree']) ?>"
                                required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Start Year</label>
                            <select name="start_year" class="form-select">
                                <option value="">Select Year</option>
                                <?php for ($y = date('Y'); $y >= 1970; $y--): ?>
                                <option value="<?= $y ?>"
                                    <?= ((int)($item['start_year'] ?? '') === $y) ? 'selected' : '' ?>><?= $y ?>
                                </option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">End Year</label>
                            <select name="end_year" class="form-select">
                                <option value="">Select Year</option>
                                <?php for ($y = date('Y'); $y >= 1970; $y--): ?>
                                <option value="<?= $y ?>"
                                    <?= ((int)($item['end_year'] ?? '') === $y) ? 'selected' : '' ?>><?= $y ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Sort Order</label>
                            <input type="number" name="sort_order" class="form-control"
                                value="<?= (int) $item['sort_order'] ?>">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control"
                                rows="3"><?= e($item['description']) ?></textarea>
                        </div>
                    </div>
                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i>Update</button>
                        <a href="<?= url('admin/education/index.php') ?>" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>