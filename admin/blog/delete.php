<?php
declare(strict_types=1);

require_once __DIR__ . '/../../includes/auth.php';
requireLogin();

$id = (int) ($_GET['id'] ?? 0);
$pdo = db();

$stmt = $pdo->prepare('SELECT thumbnail FROM blogs WHERE id = ? LIMIT 1');
$stmt->execute([$id]);
$item = $stmt->fetch();

if ($item) {
    deleteUpload('blog', $item['thumbnail']);
    $del = $pdo->prepare('DELETE FROM blogs WHERE id = ?');
    $del->execute([$id]);
    setFlash('success', 'Blog berhasil dihapus.');
}

redirect('admin/blog/index.php');