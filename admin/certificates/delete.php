<?php
/**
 * -----------------------------------------------------
 * Personal Portfolio CMS
 * Module : Certificates
 * Description : Delete certificate record
 * Author : Wahyu Subuh
 * -----------------------------------------------------
 */

declare(strict_types=1);

require_once __DIR__ . '/../../includes/auth.php';
requireLogin();

$id = (int) ($_GET['id'] ?? 0);
$pdo = db();

$stmt = $pdo->prepare('SELECT image FROM certificates WHERE id = ? LIMIT 1');
$stmt->execute([$id]);
$item = $stmt->fetch();

if ($item) {
    deleteUpload('certificates', $item['image']);
    $stmt = $pdo->prepare('DELETE FROM certificates WHERE id = ?');
    $stmt->execute([$id]);
    setFlash('success', 'Certificate berhasil dihapus.');
}

redirect('admin/certificates/index.php');