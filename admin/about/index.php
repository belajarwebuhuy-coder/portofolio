<?php
declare(strict_types=1);

require_once __DIR__ . '/../../includes/auth.php';
requireLogin();

$pageTitle = 'About';
$activeMenu = 'about';

$pdo = db();

$about = $pdo->query('SELECT * FROM about WHERE id = 1 LIMIT 1')->fetch();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    requireCsrf();

    $title       = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $birthDate   = trim($_POST['birth_date'] ?? '');
    $location    = trim($_POST['location'] ?? '');
    $email       = trim($_POST['email'] ?? '');
    $phone       = trim($_POST['phone'] ?? '');

    $photo = uploadImage($_FILES['photo'] ?? [], 'about', $about['photo'] ?? null);

    if ($photo === null) {
        setFlash('danger', 'Upload foto gagal. Gunakan format JPG/PNG/WEBP maksimal 5MB.');
        redirect('admin/about/index.php');
    }

    if ($about) {
        $stmt = $pdo->prepare('UPDATE about SET photo=?, title=?, description=?, birth_date=?, location=?, email=?, phone=? WHERE id=1');
        $stmt->execute([$photo, $title, $description, $birthDate, $location, $email, $phone]);
    } else {
        $stmt = $pdo->prepare('INSERT INTO about (photo, title, description, birth_date, location, email, phone) VALUES (?,?,?,?,?,?,?)');
        $stmt->execute([$photo, $title, $description, $birthDate, $location, $email, $phone]);
    }

    setFlash('success', 'About berhasil disimpan.');
    redirect('admin/about/index.php');
}

require_once __DIR__ . '/../../includes/header.php';
?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-white">
                <strong><i class="bi bi-person-badge me-2"></i>About Section</strong>
            </div>
            <div class="card-body">
                <form method="post" action="" enctype="multipart/form-data">
                    <?= csrfField() ?>
                    <div class="row g-3">
                        <div class="col-md-5">
                            <label class="form-label">Photo</label>
                            <input type="file" name="photo" class="form-control" accept="image/*">
                            <?php if (!empty($about['photo'])): ?>
                            <img src="<?= url('uploads/about/' . $about['photo']) ?>" class="img-thumbnail mt-2"
                                style="max-height:120px;">
                            <?php endif; ?>
                        </div>
                        <div class="col-md-7">
                            <label class="form-label">Title *</label>
                            <input type="text" name="title" class="form-control" value="<?= e($about['title'] ?? '') ?>"
                                required>
                            <div class="mt-3">
                                <label class="form-label">Description *</label>
                                <textarea name="description" class="form-control" rows="4"
                                    required><?= e($about['description'] ?? '') ?></textarea>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Birth Date</label>
                            <input type="date" name="birth_date" class="form-control"
                                value="<?= e($about['birth_date'] ?? '') ?>">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Location</label>
                            <input type="text" name="location" class="form-control"
                                value="<?= e($about['location'] ?? '') ?>">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control"
                                value="<?= e($about['email'] ?? '') ?>">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Phone</label>
                            <input type="text" name="phone" class="form-control"
                                value="<?= e($about['phone'] ?? '') ?>">
                        </div>
                    </div>
                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i>Save
                            About</button>
                        <a href="<?= url('admin/dashboard.php') ?>" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>