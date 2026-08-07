<?php
declare(strict_types=1);

require_once __DIR__ . '/../../includes/auth.php';
requireLogin();

$id = (int) ($_GET['id'] ?? 0);

$stmt = db()->prepare('DELETE FROM skills WHERE id = ?');
$stmt->execute([$id]);

setFlash('success', 'Skill berhasil dihapus.');
redirect('admin/skills/index.php');