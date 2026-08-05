<?php
/**
 * -----------------------------------------------------
 * Personal Portfolio CMS
 * Module : Education
 * Description : Delete education record
 * Author : Wahyu Subuh
 * -----------------------------------------------------
 */

declare(strict_types=1);

require_once __DIR__ . '/../../includes/auth.php';
requireLogin();

$id = (int) ($_GET['id'] ?? 0);

$stmt = db()->prepare('DELETE FROM education WHERE id = ?');
$stmt->execute([$id]);

setFlash('success', 'Education berhasil dihapus.');
redirect('admin/education/index.php');