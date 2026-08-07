<?php
declare(strict_types=1);

require_once __DIR__ . '/../../includes/auth.php';
requireLogin();

$pageTitle = 'Skills';
$activeMenu = 'skills';

$pdo = db();
$items = $pdo->query('SELECT * FROM skills ORDER BY sort_order ASC, id DESC')->fetchAll();

require_once __DIR__ . '/../../includes/header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-0">Skills List</h5>
    <a href="<?= url('admin/skills/create.php') ?>" class="btn btn-primary btn-sm"><i class="bi bi-plus-lg me-1"></i>Add
        New</a>
</div>

<?php if ($items): ?>
<div class="card">
    <div class="table-responsive">
        <table class="table table-hover table-striped mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Skill Name</th>
                    <th>Progress</th>
                    <th>Sort</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $i => $item): ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td><?= e($item['name']) ?></td>
                    <td style="min-width:150px;">
                        <div class="d-flex align-items-center gap-2">
                            <div class="progress flex-grow-1" style="height:8px;">
                                <div class="progress-bar" style="width:<?= (int) $item['percentage'] ?>%"></div>
                            </div>
                            <span><?= (int) $item['percentage'] ?>%</span>
                        </div>
                    </td>
                    <td><?= (int) $item['sort_order'] ?></td>
                    <td class="text-end">
                        <a href="<?= url('admin/skills/edit.php?id=' . $item['id']) ?>" class="btn btn-sm btn-warning"
                            title="Edit"><i class="bi bi-pencil"></i></a>
                        <a href="<?= url('admin/skills/delete.php?id=' . $item['id']) ?>" class="btn btn-sm btn-danger"
                            title="Delete" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i
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
        <i class="bi bi-bar-chart"></i>
        <h5 class="mt-3">No Skills Data</h5>
        <p class="text-muted">Add your skills to get started.</p>
        <a href="<?= url('admin/skills/create.php') ?>" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i>Add
            New</a>
    </div>
</div>
<?php endif; ?>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>