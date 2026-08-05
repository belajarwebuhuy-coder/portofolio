<?php
/**
 * -----------------------------------------------------
 * Personal Portfolio CMS
 * Module : Projects
 * Description : Delete project and its gallery
 * Author : Wahyu Subuh
 * -----------------------------------------------------
 */

declare(strict_types=1);

require_once __DIR__ . '/../../includes/auth.php';
requireLogin();

$id = (int) ($_GET['id'] ?? 0);
$pdo = db();

$stmt = $pdo->prepare('SELECT id, thumbnail FROM projects WHERE id = ? LIMIT 1');
$stmt->execute([$id]);
$project = $stmt->fetch();

if ($project) {
    // Delete thumbnail
    deleteUpload('projects', $project['thumbnail']);

    // Delete gallery images
    $galleryStmt = $pdo->prepare('SELECT image FROM project_images WHERE project_id = ?');
    $galleryStmt->execute([$id]);
    foreach ($galleryStmt->fetchAll() as $img) {
        deleteUpload('projects', $img['image']);
    }

    // Delete gallery records (FK cascade would handle it, but explicit for clarity)
    $delGallery = $pdo->prepare('DELETE FROM project_images WHERE project_id = ?');
    $delGallery->execute([$id]);

    // Delete project
    $delProject = $pdo->prepare('DELETE FROM projects WHERE id = ?');
    $delProject->execute([$id]);

    setFlash('success', 'Project beserta galeri berhasil dihapus.');
}

redirect('admin/projects/index.php');