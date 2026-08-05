<?php
/**
 * -----------------------------------------------------
 * Personal Portfolio CMS
 * Module : Skills
 * Description : Create skill record
 * Author : Wahyu Subuh
 * -----------------------------------------------------
 */

declare(strict_types=1);

require_once __DIR__ . '/../../includes/auth.php';
requireLogin();

$pageTitle = 'Add Skill';
$activeMenu = 'skills';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    requireCsrf();

    $name       = trim($_POST['name'] ?? '');
    $percentage = (int) ($_POST['percentage'] ?? 0);
    $sortOrder  = (int) ($_POST['sort_order'] ?? 0);

    if ($name === '') {
        $errors[] = 'Skill name wajib diisi.';
    }
    if ($percentage < 0 || $percentage > 100) {
        $errors[] = 'Progress harus antara 0 dan 100.';
    }

    if (!$errors) {
        $stmt = db()->prepare('INSERT INTO skills (name, percentage, sort_order) VALUES (?,?,?)');
        $stmt->execute([$name, $percentage, $sortOrder]);
        setFlash('success', 'Skill berhasil ditambahkan.');
        redirect('admin/skills/index.php');
    }
}

require_once __DIR__ . '/../../includes/header.php';
?>

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header bg-white"><strong>Add Skill</strong></div>
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
                        <div class="col-12">
                            <label class="form-label">Skill Name *</label>
                            <input type="text" name="name" class="form-control" value="<?= e($_POST['name'] ?? '') ?>"
                                required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Progress (%) *</label>
                            <div class="d-flex align-items-center gap-3">
                                <input type="range" name="percentage" id="percentage" class="form-range flex-grow-1"
                                    value="<?= e($_POST['percentage'] ?? '0') ?>" min="0" max="100" step="5" required>
                                <span class="badge bg-primary fs-6"
                                    id="percentageValue"><?= e($_POST['percentage'] ?? '0') ?>%</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Sort Order</label>
                            <input type="number" name="sort_order" class="form-control"
                                value="<?= e($_POST['sort_order'] ?? '0') ?>">
                        </div>
                    </div>
                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i>Save</button>
                        <a href="<?= url('admin/skills/index.php') ?>" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
const percentageRange = document.getElementById('percentage');
const percentageValue = document.getElementById('percentageValue');
if (percentageRange && percentageValue) {
    percentageRange.addEventListener('input', function() {
        percentageValue.textContent = this.value + '%';
    });
}
</script>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>