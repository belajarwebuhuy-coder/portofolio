<?php
/**
 * -----------------------------------------------------
 * Personal Portfolio CMS
 * Module : Hero
 * Description : Homepage hero section management
 * Author : Wahyu Subuh
 * -----------------------------------------------------
 */

declare(strict_types=1);

require_once __DIR__ . '/../../includes/auth.php';
requireLogin();

$pageTitle = 'Hero';
$activeMenu = 'hero';

$pdo = db();

$hero = $pdo->query('SELECT * FROM hero WHERE id = 1 LIMIT 1')->fetch();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    requireCsrf();

    $greeting    = trim($_POST['greeting'] ?? '');
    $title       = trim($_POST['title'] ?? '');
    $profession  = trim($_POST['profession'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $button1Text = trim($_POST['button1_text'] ?? '');
    $button1Link = trim($_POST['button1_link'] ?? '');
    $button2Text = trim($_POST['button2_text'] ?? '');
    $button2Link = trim($_POST['button2_link'] ?? '');

    $heroImage = uploadImage($_FILES['hero_image'] ?? [], 'hero', $hero['hero_image'] ?? null);

    if ($heroImage === null) {
        setFlash('danger', 'Upload gambar gagal. Gunakan format JPG/PNG/WEBP maksimal 5MB.');
        redirect('admin/hero/index.php');
    }

    if ($hero) {
        $stmt = $pdo->prepare('UPDATE hero SET greeting=?, title=?, profession=?, description=?, hero_image=?, button1_text=?, button1_link=?, button2_text=?, button2_link=? WHERE id=1');
        $stmt->execute([$greeting, $title, $profession, $description, $heroImage, $button1Text, $button1Link, $button2Text, $button2Link]);
    } else {
        $stmt = $pdo->prepare('INSERT INTO hero (greeting, title, profession, description, hero_image, button1_text, button1_link, button2_text, button2_link) VALUES (?,?,?,?,?,?,?,?,?)');
        $stmt->execute([$greeting, $title, $profession, $description, $heroImage, $button1Text, $button1Link, $button2Text, $button2Link]);
    }

    setFlash('success', 'Hero berhasil disimpan.');
    redirect('admin/hero/index.php');
}

require_once __DIR__ . '/../../includes/header.php';
?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-white">
                <strong><i class="bi bi-house-heart me-2"></i>Hero Section</strong>
            </div>
            <div class="card-body">
                <form method="post" action="" enctype="multipart/form-data">
                    <?= csrfField() ?>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Greeting *</label>
                            <input type="text" name="greeting" class="form-control"
                                value="<?= e($hero['greeting'] ?? '') ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Title (Name) *</label>
                            <input type="text" name="title" class="form-control" value="<?= e($hero['title'] ?? '') ?>"
                                required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Profession *</label>
                            <input type="text" name="profession" class="form-control"
                                value="<?= e($hero['profession'] ?? '') ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Hero Image</label>
                            <input type="file" name="hero_image" class="form-control" accept="image/*">
                            <?php if (!empty($hero['hero_image'])): ?>
                            <img src="<?= url('uploads/hero/' . $hero['hero_image']) ?>" class="img-thumbnail mt-2"
                                style="max-height:80px;">
                            <?php endif; ?>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Description *</label>
                            <textarea name="description" class="form-control" rows="3"
                                required><?= e($hero['description'] ?? '') ?></textarea>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Button 1 Text</label>
                            <input type="text" name="button1_text" class="form-control"
                                value="<?= e($hero['button1_text'] ?? '') ?>">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Button 1 Link</label>
                            <input type="url" name="button1_link" class="form-control"
                                value="<?= e($hero['button1_link'] ?? '') ?>">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Button 2 Text</label>
                            <input type="text" name="button2_text" class="form-control"
                                value="<?= e($hero['button2_text'] ?? '') ?>">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Button 2 Link</label>
                            <input type="url" name="button2_link" class="form-control"
                                value="<?= e($hero['button2_link'] ?? '') ?>">
                        </div>
                    </div>
                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i>Save
                            Hero</button>
                        <a href="<?= url('admin/dashboard.php') ?>" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>