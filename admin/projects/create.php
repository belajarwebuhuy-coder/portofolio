<?php
declare(strict_types=1);

require_once __DIR__ . '/../../includes/auth.php';
requireLogin();

$pageTitle = 'Add Project';
$activeMenu = 'projects';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    requireCsrf();

    $title            = trim($_POST['title'] ?? '');
    $slug             = trim($_POST['slug'] ?? '');
    $shortDescription = trim($_POST['short_description'] ?? '');
    $description      = trim($_POST['description'] ?? '');
    $techStack        = trim($_POST['tech_stack'] ?? '');
    $githubUrl        = trim($_POST['github_url'] ?? '');
    $demoUrl          = trim($_POST['demo_url'] ?? '');
    $featured         = isset($_POST['featured']) ? 1 : 0;
    $status           = ($_POST['status'] ?? 'draft') === 'published' ? 'published' : 'draft';

    if ($title === '') {
        $errors[] = 'Title wajib diisi.';
    }
    if ($slug === '') {
        $slug = slugify($title);
    }

    $pdo = db();

    // Check unique slug
    $check = $pdo->prepare('SELECT id FROM projects WHERE slug = ? LIMIT 1');
    $check->execute([$slug]);
    if ($check->fetch()) {
        $errors[] = 'Slug sudah digunakan.';
    }

    $thumbnail = null;
    if (!empty($_FILES['thumbnail']['name'])) {
        $thumbnail = uploadImage($_FILES['thumbnail'], 'projects');
        if ($thumbnail === null) {
            $errors[] = 'Upload thumbnail gagal. Gunakan format JPG/PNG/WEBP maksimal 5MB.';
        }
    }

    if (!$errors) {
        $pdo->beginTransaction();


        try {
            $stmt = $pdo->prepare('INSERT INTO projects (title, slug, thumbnail, short_description, description, tech_stack, github_url, demo_url, featured, status) VALUES (?,?,?,?,?,?,?,?,?,?)');
            $stmt->execute([$title, $slug, $thumbnail, $shortDescription, $description, $techStack, $githubUrl, $demoUrl, $featured, $status]);
            $projectId = (int) $pdo->lastInsertId();

            // Upload gallery images
            if (!empty($_FILES['gallery']['name'][0])) {
                $galleryStmt = $pdo->prepare('INSERT INTO project_images (project_id, image, sort_order) VALUES (?,?,?)');
                $sort = 0;
                foreach ($_FILES['gallery']['name'] as $i => $name) {
                    if ($name === '') {
                        continue;
                    }
                    $file = [
                        'name'     => $_FILES['gallery']['name'][$i],
                        'type'     => $_FILES['gallery']['type'][$i],
                        'tmp_name' => $_FILES['gallery']['tmp_name'][$i],
                        'error'    => $_FILES['gallery']['error'][$i],
                        'size'     => $_FILES['gallery']['size'][$i],
                    ];
                    $img = uploadImage($file, 'projects');
                    if ($img) {
                        $galleryStmt->execute([$projectId, $img, $sort++]);
                    }
                }
            }

            $pdo->commit();
            setFlash('success', 'Project berhasil ditambahkan.');
            redirect('admin/projects/index.php');
        } catch (Exception $e) {
            $pdo->rollBack();
            // Clean up uploaded thumbnail if insert failed
            if ($thumbnail) {
                deleteUpload('projects', $thumbnail);
            }
            $errors[] = 'Terjadi kesalahan saat menyimpan data.';
        }
    }
}

require_once __DIR__ . '/../../includes/header.php';
?>

<div class="row">
    <div class="col-lg-9">
        <div class="card">
            <div class="card-header bg-white"><strong>Add Project</strong></div>
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
                        <div class="col-md-8">
                            <label class="form-label">Title *</label>
                            <input type="text" name="title" id="title" class="form-control"
                                value="<?= e($_POST['title'] ?? '') ?>" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Slug</label>
                            <input type="text" name="slug" id="slug" class="form-control"
                                value="<?= e($_POST['slug'] ?? '') ?>" placeholder="Auto from title">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="draft" <?= (($_POST['status'] ?? '') === 'draft') ? 'selected' : '' ?>>
                                    Draft</option>
                                <option value="published"
                                    <?= (($_POST['status'] ?? '') === 'published') ? 'selected' : '' ?>>Published
                                </option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Featured</label>
                            <div class="form-check form-switch mt-2">
                                <input class="form-check-input" type="checkbox" name="featured" value="1" id="featured"
                                    <?= isset($_POST['featured']) ? 'checked' : '' ?>>
                                <label class="form-check-label" for="featured">Featured Project</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Thumbnail</label>
                            <input type="file" name="thumbnail" class="form-control" accept="image/*">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Short Description</label>
                            <textarea name="short_description" class="form-control"
                                rows="2"><?= e($_POST['short_description'] ?? '') ?></textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control"
                                rows="5"><?= e($_POST['description'] ?? '') ?></textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Tech Stack (comma separated)</label>
                            <input type="text" name="tech_stack" class="form-control"
                                value="<?= e($_POST['tech_stack'] ?? '') ?>" placeholder="PHP, MySQL, Bootstrap">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">GitHub URL</label>
                            <input type="url" name="github_url" class="form-control"
                                value="<?= e($_POST['github_url'] ?? '') ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Live Demo URL</label>
                            <input type="url" name="demo_url" class="form-control"
                                value="<?= e($_POST['demo_url'] ?? '') ?>">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Gallery Images (multiple)</label>
                            <input type="file" name="gallery[]" class="form-control" accept="image/*" multiple>
                        </div>
                    </div>
                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i>Save</button>
                        <a href="<?= url('admin/projects/index.php') ?>" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Auto-generate slug from title
const titleInput = document.getElementById('title');
const slugInput = document.getElementById('slug');
titleInput.addEventListener('input', () => {
    if (!slugInput.dataset.manual) {
        slugInput.value = titleInput.value
            .toLowerCase()
            .replace(/[^a-z0-9]+/g, '-')
            .replace(/(^-|-$)/g, '');
    }
});
slugInput.addEventListener('input', () => {
    slugInput.dataset.manual = '1';
});
</script>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>