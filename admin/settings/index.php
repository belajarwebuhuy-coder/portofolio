<?php
declare(strict_types=1);

require_once __DIR__ . '/../../includes/auth.php';
requireLogin();

$pageTitle = 'Settings';
$activeMenu = 'settings';

$pdo = db();
$settings = getSettings();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    requireCsrf();

    // Website
    $websiteName = trim($_POST['website_name'] ?? '');
    $email       = trim($_POST['email'] ?? '');
    $phone       = trim($_POST['phone'] ?? '');
    $address     = trim($_POST['address'] ?? '');

    // Owner
    $ownerName       = trim($_POST['owner_name'] ?? '');
    $ownerProfession = trim($_POST['owner_profession'] ?? '');

    // Social
    $github    = trim($_POST['github'] ?? '');
    $linkedin  = trim($_POST['linkedin'] ?? '');
    $instagram = trim($_POST['instagram'] ?? '');
    $facebook  = trim($_POST['facebook'] ?? '');
    $x         = trim($_POST['x'] ?? '');
    $youtube   = trim($_POST['youtube'] ?? '');

    // SEO
    $metaTitle       = trim($_POST['meta_title'] ?? '');
    $metaDescription = trim($_POST['meta_description'] ?? '');
    $googleVerification = trim($_POST['google_verification'] ?? '');

    // Theme / System
    $defaultDarkMode  = isset($_POST['default_dark_mode']) ? 1 : 0;
    $maintenanceMode  = isset($_POST['maintenance_mode']) ? 1 : 0;

    // Handle uploads
    $logo    = uploadImage($_FILES['logo'] ?? [], 'settings', $settings['logo'] ?? null);
    $favicon = uploadImage($_FILES['favicon'] ?? [], 'settings', $settings['favicon'] ?? null);
    $ownerPhoto = uploadImage($_FILES['owner_photo'] ?? [], 'profile', $settings['owner_photo'] ?? null);

    if ($logo === null || $favicon === null || $ownerPhoto === null) {
        setFlash('danger', 'Validasi upload gagal. Gunakan format JPG/PNG/WEBP maksimal 5MB.');
        redirect('admin/settings/index.php');
    }

    $sql = 'UPDATE settings SET
        website_name = ?, logo = ?, favicon = ?,
        owner_name = ?, owner_profession = ?, owner_photo = ?,
        email = ?, phone = ?, address = ?,
        github = ?, linkedin = ?, instagram = ?, facebook = ?, x = ?, youtube = ?,
        meta_title = ?, meta_description = ?, google_verification = ?,
        default_dark_mode = ?, maintenance_mode = ?
        WHERE id = 1';

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $websiteName, $logo, $favicon,
        $ownerName, $ownerProfession, $ownerPhoto,
        $email, $phone, $address,
        $github, $linkedin, $instagram, $facebook, $x, $youtube,
        $metaTitle, $metaDescription, $googleVerification,
        $defaultDarkMode, $maintenanceMode,
    ]);

    setFlash('success', 'Pengaturan website berhasil disimpan.');
    redirect('admin/settings/index.php');
}

require_once __DIR__ . '/../../includes/header.php';
?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-white">
                <strong><i class="bi bi-gear me-2"></i>Website Settings</strong>
            </div>
            <div class="card-body">
                <form method="post" action="" enctype="multipart/form-data">
                    <?= csrfField() ?>

                    <!-- Website -->
                    <h6 class="text-primary fw-bold mb-3">Website</h6>
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label">Website Name *</label>
                            <input type="text" name="website_name" class="form-control"
                                value="<?= e($settings['website_name'] ?? '') ?>" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Logo</label>
                            <input type="file" name="logo" class="form-control" accept="image/*">
                            <?php if (!empty($settings['logo'])): ?>
                            <img src="<?= url('uploads/settings/' . $settings['logo']) ?>" class="img-thumbnail mt-2"
                                style="max-height:60px;">
                            <?php endif; ?>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Favicon</label>
                            <input type="file" name="favicon" class="form-control" accept="image/*">
                            <?php if (!empty($settings['favicon'])): ?>
                            <img src="<?= url('uploads/settings/' . $settings['favicon']) ?>" class="img-thumbnail mt-2"
                                style="max-height:60px;">
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Owner -->
                    <h6 class="text-primary fw-bold mb-3">Owner</h6>
                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label class="form-label">Name *</label>
                            <input type="text" name="owner_name" class="form-control"
                                value="<?= e($settings['owner_name'] ?? '') ?>" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Profession</label>
                            <input type="text" name="owner_profession" class="form-control"
                                value="<?= e($settings['owner_profession'] ?? '') ?>">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Owner Photo</label>
                            <input type="file" name="owner_photo" class="form-control" accept="image/*">
                            <?php if (!empty($settings['owner_photo'])): ?>
                            <img src="<?= url('uploads/profile/' . $settings['owner_photo']) ?>"
                                class="img-thumbnail mt-2" style="max-height:60px;">
                            <?php endif; ?>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control"
                                value="<?= e($settings['email'] ?? '') ?>">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Phone</label>
                            <input type="text" name="phone" class="form-control"
                                value="<?= e($settings['phone'] ?? '') ?>">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Address</label>
                            <input type="text" name="address" class="form-control"
                                value="<?= e($settings['address'] ?? '') ?>">
                        </div>
                    </div>

                    <!-- Social Media -->
                    <h6 class="text-primary fw-bold mb-3">Social Media</h6>
                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label class="form-label"><i class="bi bi-github me-1"></i>GitHub</label>
                            <input type="url" name="github" class="form-control"
                                value="<?= e($settings['github'] ?? '') ?>">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label"><i class="bi bi-linkedin me-1"></i>LinkedIn</label>
                            <input type="url" name="linkedin" class="form-control"
                                value="<?= e($settings['linkedin'] ?? '') ?>">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label"><i class="bi bi-instagram me-1"></i>Instagram</label>
                            <input type="url" name="instagram" class="form-control"
                                value="<?= e($settings['instagram'] ?? '') ?>">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label"><i class="bi bi-facebook me-1"></i>Facebook</label>
                            <input type="url" name="facebook" class="form-control"
                                value="<?= e($settings['facebook'] ?? '') ?>">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label"><i class="bi bi-twitter-x me-1"></i>X</label>
                            <input type="url" name="x" class="form-control" value="<?= e($settings['x'] ?? '') ?>">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label"><i class="bi bi-youtube me-1"></i>YouTube</label>
                            <input type="url" name="youtube" class="form-control"
                                value="<?= e($settings['youtube'] ?? '') ?>">
                        </div>
                    </div>

                    <!-- SEO -->
                    <h6 class="text-primary fw-bold mb-3">SEO</h6>
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label">Meta Title</label>
                            <input type="text" name="meta_title" class="form-control"
                                value="<?= e($settings['meta_title'] ?? '') ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Google Verification</label>
                            <input type="text" name="google_verification" class="form-control"
                                value="<?= e($settings['google_verification'] ?? '') ?>">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Meta Description</label>
                            <textarea name="meta_description" class="form-control"
                                rows="2"><?= e($settings['meta_description'] ?? '') ?></textarea>
                        </div>
                    </div>

                    <!-- Theme & System -->
                    <h6 class="text-primary fw-bold mb-3">Theme & System</h6>
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="default_dark_mode" value="1"
                                    id="darkMode" <?= !empty($settings['default_dark_mode']) ? 'checked' : '' ?>>
                                <label class="form-check-label" for="darkMode">Default Dark Mode</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="maintenance_mode" value="1"
                                    id="maintenance" <?= !empty($settings['maintenance_mode']) ? 'checked' : '' ?>>
                                <label class="form-check-label" for="maintenance">Maintenance Mode</label>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i>Save
                            Settings</button>
                        <a href="<?= url('admin/dashboard.php') ?>" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>