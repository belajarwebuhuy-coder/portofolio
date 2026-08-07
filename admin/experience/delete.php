<?php
declare(strict_types=1);

require_once __DIR__ . '/../../includes/auth.php';
requireLogin();

$id = (int) ($_GET['id'] ?? 0);

$stmt = db()->prepare('DELETE FROM experience WHERE id = ?');
$stmt->execute([$id]);

setFlash('success', 'Experience berhasil dihapus.');
redirect('admin/experience/index.php');