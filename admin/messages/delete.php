<?php
declare(strict_types=1);

require_once __DIR__ . '/../../includes/auth.php';
requireLogin();

$id = (int) ($_GET['id'] ?? 0);

$stmt = db()->prepare('DELETE FROM messages WHERE id = ?');
$stmt->execute([$id]);

setFlash('success', 'Pesan berhasil dihapus.');
redirect('admin/messages/index.php');