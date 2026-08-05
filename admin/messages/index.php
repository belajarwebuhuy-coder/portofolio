<?php
/**
 * -----------------------------------------------------
 * Personal Portfolio CMS
 * Module : Messages
 * Description : Contact messages management
 * Author : Wahyu Subuh
 * -----------------------------------------------------
 */

declare(strict_types=1);

require_once __DIR__ . '/../../includes/auth.php';
requireLogin();

$pageTitle = 'Messages';
$activeMenu = 'messages';

$pdo = db();
$items = $pdo->query('SELECT * FROM messages ORDER BY is_read ASC, id DESC')->fetchAll();

require_once __DIR__ . '/../../includes/header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-0">Contact Messages</h5>
</div>

<?php if ($items): ?>
<div class="card">
    <div class="table-responsive">
        <table class="table table-hover table-striped mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $i => $item): ?>
                <tr class="<?= $item['is_read'] ? '' : 'table-primary' ?>">
                    <td><?= $i + 1 ?></td>
                    <td><?= e($item['name']) ?></td>
                    <td><?= e($item['email']) ?></td>
                    <td><?= e(truncate($item['subject'] ?: '-', 30)) ?></td>
                    <td>
                        <span
                            class="badge bg-<?= $item['is_read'] ? 'secondary' : 'danger' ?>"><?= $item['is_read'] ? 'Read' : 'Unread' ?></span>
                    </td>
                    <td><?= e(formatDate($item['created_at'])) ?></td>
                    <td class="text-end">
                        <a href="<?= url('admin/messages/view.php?id=' . $item['id']) ?>"
                            class="btn btn-sm btn-outline-primary" title="View"><i class="bi bi-eye"></i></a>
                        <a href="<?= url('admin/messages/delete.php?id=' . $item['id']) ?>"
                            class="btn btn-sm btn-danger" title="Delete"
                            onclick="return confirm('Apakah Anda yakin ingin menghapus pesan ini?')"><i
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
        <i class="bi bi-envelope"></i>
        <h5 class="mt-3">No Messages</h5>
        <p class="text-muted">Messages from contact form will appear here.</p>
    </div>
</div>
<?php endif; ?>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>