<?php
/**
 * -----------------------------------------------------
 * Personal Portfolio CMS
 * Module : Skills
 * Description : Delete skill record
 * Author : Wahyu Subuh
 * -----------------------------------------------------
 */

declare(strict_types=1);

require_once __DIR__ . '/../../includes/auth.php';
requireLogin();

$id = (int) ($_GET['id'] ?? 0);

$stmt = db()->prepare('DELETE FROM skills WHERE id = ?');
$stmt->execute([$id]);

setFlash('success', 'Skill berhasil dihapus.');
redirect('admin/skills/index.php');