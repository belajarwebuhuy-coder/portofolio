<?php
declare(strict_types=1);

require_once __DIR__ . '/../../includes/auth.php';
requireLogin();

$pageTitle = 'Profile';
$activeMenu = 'profile';

$pdo = db();
$user = currentUser();
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    requireCsrf();

    $name     = trim($_POST['name'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm  = $_POST['password_confirm'] ?? '';

    if ($name === '') {
        $errors[] = 'Name wajib diisi.';
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Email tidak valid.';
    }

    // Check email uniqueness
    $check = $pdo->prepare('SELECT id FROM users WHERE email = ? AND id != ? LIMIT 1');
    $check->execute([$email, $user['id']]);
    if ($check->fetch()) {
        $errors[] = 'Email sudah digunakan.';
    }

    // Password validation
    if ($password !== '') {
        if (strlen($password) < 6) {
            $errors[] = 'Password minimal 6 karakter.';
        }
        if ($password !== $confirm) {
            $errors[] = 'Konfirmasi password tidak cocok.';
        }
    }

    // Photo upload
    $photo = $user['photo'];
    if (!empty($_FILES['photo']['name'])) {
        $photo = uploadImage($_FILES['photo'], 'profile', $user['photo']);
        if ($photo === null) {
            $errors[] = 'Upload foto gagal. Gunakan format JPG/PNG/WEBP maksimal 5MB.';
        }
    }

    if (!$errors) {
        if ($password !== '') {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare('UPDATE users SET name=?, email=?, password=?, photo=? WHERE id=?');
            $stmt->execute([$name, $email, $hash, $photo, $user['id']]);
        } else {
            $stmt = $pdo->prepare('UPDATE users SET name=?, email=?, photo=? WHERE id=?');
            $stmt->execute([$name, $email, $photo, $user['id']]);
        }

        $_SESSION['user_name'] = $name;
        setFlash('success', 'Profile berhasil diperbarui.');
        redirect('admin/profile/index.php');
    }

    $user['name'] = $name;
    $user['email'] = $email;
}

require_once __DIR__ . '/../../includes/header.php';
?>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header bg-white"><strong>Edit Profile</strong></div>
            <div class="card-body">
                <?php if ($errors): ?>
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        <?php foreach ($errors as $err): ?><li><?= e($err) ?></li><?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>
                <form method="post" action="" enctype="multipart/form-data">
                    <?= csrfField() ?>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Name *</label>
                            <input type="text" name="name" class="form-control" value="<?= e($user['name']) ?>"
                                required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email *</label>
                            <input type="email" name="email" class="form-control" value="<?= e($user['email']) ?>"
                                required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">New Password</label>
                            <input type="password" name="password" class="form-control"
                                placeholder="Leave blank to keep">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Confirm Password</label>
                            <input type="password" name="password_confirm" class="form-control"
                                placeholder="Confirm new password">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Profile Photo</label>
                            <input type="file" name="photo" class="form-control" accept="image/*">
                            <?php if ($user['photo']): ?>
                            <img src="<?= url('uploads/profile/' . $user['photo']) ?>" class="img-thumbnail mt-2"
                                style="max-height:100px;">
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i>Update
                            Profile</button>
                        <a href="<?= url('admin/dashboard.php') ?>" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>