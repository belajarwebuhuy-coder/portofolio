<?php
declare(strict_types=1);

require_once __DIR__ . '/../../includes/auth.php';
requireLogin();

$pageTitle = 'View Message';
$activeMenu = 'messages';

$id = (int) ($_GET['id'] ?? 0);
$pdo = db();

// Mark as read
$pdo->prepare('UPDATE messages SET is_read = 1 WHERE id = ?')->execute([$id]);

$stmt = $pdo->prepare('SELECT * FROM messages WHERE id = ? LIMIT 1');
$stmt->execute([$id]);
$item = $stmt->fetch();

if (!$item) {
    setFlash('danger', 'Pesan tidak ditemukan.');
    redirect('admin/messages/index.php');
}

require_once __DIR__ . '/../../includes/header.php';
?>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <strong>Message Detail</strong>
                <a href="<?= url('admin/messages/index.php') ?>" class="btn btn-sm btn-secondary"><i
                        class="bi bi-arrow-left me-1"></i>Back</a>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <strong>From:</strong> <?= e($item['name']) ?> (<?= e($item['email']) ?>)
                </div>
                <div class="mb-3">
                    <strong>Subject:</strong> <?= e($item['subject'] ?: '-') ?>
                </div>
                <div class="mb-3">
                    <strong>Date:</strong> <?= e(formatDate($item['created_at'], 'd M Y H:i')) ?>
                </div>
                <hr>
                <div class="mb-3">
                    <strong>Message:</strong>
                </div>
                <div class="p-3 bg-light rounded">
                    <?= nl2br(e($item['message'])) ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>