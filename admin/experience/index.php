<?php
/**
 * -----------------------------------------------------
 * Personal Portfolio CMS
 * Module : Experience
 * Description : Experience list management
 * Author : Wahyu Subuh
 * -----------------------------------------------------
 */

declare(strict_types=1);

require_once __DIR__ . '/../../includes/auth.php';
requireLogin();

$pageTitle = 'Experience';
$activeMenu = 'experience';

$pdo = db();
$items = $pdo->query('SELECT * FROM experience ORDER BY sort_order ASC, id DESC')->fetchAll();

require_once __DIR__ . '/../../includes/header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-0">Experience List</h5>
    <a href="<?= url('admin/experience/create.php') ?>" class="btn btn-primary btn-sm"><i
            class="bi bi-plus-lg me-1"></i>Add New</a>
</div>

<?php if ($items): ?>
<div class="card">
    <div class="table-responsive">
        <table class="table table-hover table-striped mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Company</th>
                    <th>Position</th>
                    <th>Period</th>
                    <th>Sort</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $i => $item): ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td><?= e($item['company']) ?></td>
                    <td><?= e($item['position']) ?></td>
                    <td><?= e($item['start_date']) ?> - <?= e($item['end_date'] ?: 'Present') ?></td>
                    <td><?= (int) $item['sort_order'] ?></td>
                    <td class="text-end">
                        <a href="<?= url('admin/experience/edit.php?id=' . $item['id']) ?>"
                            class="btn btn-sm btn-warning" title="Edit"><i class="bi bi-pencil"></i></a>
                        <a href="<?= url('admin/experience/delete.php?id=' . $item['id']) ?>"
                            class="btn btn-sm btn-danger" title="Delete"
                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i
                                class="bi bi-trash"></i></a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php else: ?>
<div class="card">
    <div class="card-body empty-state">
        <i class="bi bi-briefcase"></i>
        <h5 class="mt-3">No Experience Data</h5>
        <p class="text-muted">Add your work experience to get started.</p>
        <a href="<?= url('admin/experience/create.php') ?>" class="btn btn-primary"><i
                class="bi bi-plus-lg me-1"></i>Add New</a>
    </div>
</div>
<?php endif; ?>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>