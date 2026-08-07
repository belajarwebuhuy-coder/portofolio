<?php
declare(strict_types=1);

require_once __DIR__ . '/../../includes/auth.php';
requireLogin();

$pageTitle = 'Edit Project';
$activeMenu = 'projects';

$id = (int) ($_GET['id'] ?? 0);
$pdo = db();

$stmt = $pdo->prepare('SELECT * FROM projects WHERE id = ? LIMIT 1');
$stmt->execute([$id]);
$item = $stmt->fetch();

if (!$item) {
    setFlash('danger', 'Data tidak ditemukan.');
    redirect('admin/projects/index.php');
}

// Get gallery images
$galleryStmt = $pdo->prepare('SELECT * FROM project_images WHERE project_id = ? ORDER BY sort_order ASC');
$galleryStmt->execute([$id]);
$gallery = $galleryStmt->fetchAll();

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

    // Check unique slug (excluding current)
    $check = $pdo->prepare('SELECT id FROM projects WHERE slug = ? AND id != ? LIMIT 1');
    $check->execute([$slug, $id]);
    if ($check->fetch()) {
        $errors[] = 'Slug sudah digunakan.';
    }

    $thumbnail = $item['thumbnail'];
    if (!empty($_FILES['thumbnail']['name'])) {
        $thumbnail = uploadImage($_FILES['thumbnail'], 'projects', $item['thumbnail']);
        if ($thumbnail === null) {
            $errors[] = 'Upload thumbnail gagal. Gunakan format JPG/PNG/WEBP maksimal 5MB.';
        }
    }

    if (!$errors) {
        $pdo->beginTransaction();

        try {
            $stmt = $pdo->prepare('UPDATE projects SET title=?, slug=?, thumbnail=?, short_description=?, description=?, tech_stack=?, github_url=?, demo_url=?, featured=?, status=? WHERE id=?');
            $stmt->execute([$title, $slug, $thumbnail, $shortDescription, $description, $techStack, $githubUrl, $demoUrl, $featured, $status, $id]);

            // Add new gallery images
            if (!empty($_FILES['gallery']['name'][0])) {
                $galleryStmt = $pdo->prepare('INSERT INTO project_images (project_id, image, sort_order) VALUES (?,?,?)');
                $sort = count($gallery);
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
                        $galleryStmt->execute([$id, $img, $sort++]);
                    }
                }
            }

            // Delete selected gallery images
            if (!empty($_POST['delete_gallery'])) {
                $delStmt = $pdo->prepare('SELECT image FROM project_images WHERE id = ? AND project_id = ? LIMIT 1');
                $delExec = $pdo->prepare('DELETE FROM project_images WHERE id = ? AND project_id = ?');
                foreach ($_POST['delete_gallery'] as $imgId) {
                    $delStmt->execute([(int) $imgId, $id]);
                    $img = $delStmt->fetch();
                    if ($img) {
                        deleteUpload('projects', $img['image']);
                        $delExec->execute([(int) $imgId, $id]);
                    }
                }
            }

            $pdo->commit();
            setFlash('success', 'Project berhasil diperbarui.');
            redirect('admin/projects/edit.php?id=' . $id);
        } catch (Exception $e) {
            $pdo->rollBack();
            $errors[] = 'Terjadi kesalahan saat menyimpan data.';
        }
    }
}

require_once __DIR__ . '/../../includes/header.php';
?>

<div class="row">
    <div class="col-lg-9">
        <div class="card">
            <div class="card-header bg-white"><strong>Edit Project</strong></div>
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
                            <input type="text" name="title" class="form-control" value="<?= e($item['title']) ?>"
                                required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Slug</label>
                            <input type="text" name="slug" class="form-control" value="<?= e($item['slug']) ?>">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="draft" <?= $item['status'] === 'draft' ? 'selected' : '' ?>>Draft
                                </option>
                                <option value="published" <?= $item['status'] === 'published' ? 'selected' : '' ?>>
                                    Published</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Featured</label>
                            <div class="form-check form-switch mt-2">
                                <input class="form-check-input" type="checkbox" name="featured" value="1" id="featured"
                                    <?= $item['featured'] ? 'checked' : '' ?>>
                                <label class="form-check-label" for="featured">Featured Project</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Thumbnail</label>
                            <input type="file" name="thumbnail" class="form-control" accept="image/*">
                            <?php if ($item['thumbnail']): ?>
                            <img src="<?= url('uploads/projects/' . $item['thumbnail']) ?>" class="img-thumbnail mt-2"
                                style="max-height:80px;">
                            <?php endif; ?>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Short Description</label>
                            <textarea name="short_description" class="form-control"
                                rows="2"><?= e($item['short_description']) ?></textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control"
                                rows="5"><?= e($item['description']) ?></textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Tech Stack (comma separated)</label>
                            <input type="text" name="tech_stack" class="form-control"
                                value="<?= e($item['tech_stack']) ?>" placeholder="PHP, MySQL, Bootstrap">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">GitHub URL</label>
                            <input type="url" name="github_url" class="form-control"
                                value="<?= e($item['github_url']) ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Live Demo URL</label>
                            <input type="url" name="demo_url" class="form-control" value="<?= e($item['demo_url']) ?>">
                        </div>

                        <!-- Existing Gallery -->
                        <?php if ($gallery): ?>
                        <div class="col-12">
                            <label class="form-label mb-2">Current Gallery</label>
                            <div class="row g-2">
                                <?php foreach ($gallery as $img): ?>
                                <div class="col-6 col-md-4 col-lg-3">
                                    <div class="border rounded p-2 position-relative">
                                        <img src="<?= url('uploads/projects/' . $img['image']) ?>"
                                            class="img-fluid rounded" alt="Gallery">
                                        <div class="form-check mt-1">
                                            <input class="form-check-input" type="checkbox" name="delete_gallery[]"
                                                value="<?= $img['id'] ?>" id="delg-<?= $img['id'] ?>">
                                            <label class="form-check-label small text-danger"
                                                for="delg-<?= $img['id'] ?>">Delete</label>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <?php endif; ?>

                        <div class="col-12">
                            <label class="form-label">Add Gallery Images (multiple)</label>
                            <input type="file" name="gallery[]" class="form-control" accept="image/*" multiple>
                        </div>
                    </div>
                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i>Update</button>
                        <a href="<?= url('admin/projects/index.php') ?>" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>