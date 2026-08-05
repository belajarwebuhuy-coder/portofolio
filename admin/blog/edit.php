<?php
/**
 * -----------------------------------------------------
 * Personal Portfolio CMS
 * Module : Blog
 * Description : Edit blog post
 * Author : Wahyu Subuh
 * -----------------------------------------------------
 */

declare(strict_types=1);

require_once __DIR__ . '/../../includes/auth.php';
requireLogin();

$pageTitle = 'Edit Blog';
$activeMenu = 'blog';

$id = (int) ($_GET['id'] ?? 0);
$pdo = db();

$stmt = $pdo->prepare('SELECT * FROM blogs WHERE id = ? LIMIT 1');
$stmt->execute([$id]);
$item = $stmt->fetch();

if (!$item) {
    setFlash('danger', 'Data tidak ditemukan.');
    redirect('admin/blog/index.php');
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    requireCsrf();

    $title   = trim($_POST['title'] ?? '');
    $slug    = trim($_POST['slug'] ?? '');
    $summary = trim($_POST['summary'] ?? '');
    $content = $_POST['content'] ?? '';
    $tags    = trim($_POST['tags'] ?? '');
    $status  = ($_POST['status'] ?? 'draft') === 'published' ? 'published' : 'draft';

    if ($title === '') {
        $errors[] = 'Title wajib diisi.';
    }
    if ($slug === '') {
        $slug = slugify($title);
    }

    $check = $pdo->prepare('SELECT id FROM blogs WHERE slug = ? AND id != ? LIMIT 1');
    $check->execute([$slug, $id]);
    if ($check->fetch()) {
        $errors[] = 'Slug sudah digunakan.';
    }

    $thumbnail = $item['thumbnail'];
    if (!empty($_FILES['thumbnail']['name'])) {
        $thumbnail = uploadImage($_FILES['thumbnail'], 'blog', $item['thumbnail']);
        if ($thumbnail === null) {
            $errors[] = 'Upload thumbnail gagal. Gunakan format JPG/PNG/WEBP maksimal 5MB.';
        }
    }

    if (!$errors) {
        // Set published_at when transitioning from draft to published
        $publishedAt = $item['published_at'];
        if ($status === 'published' && empty($publishedAt)) {
            $publishedAt = date('Y-m-d H:i:s');
        }
        if ($status === 'draft') {
            $publishedAt = null;
        }

        $stmt = $pdo->prepare('UPDATE blogs SET title=?, slug=?, thumbnail=?, summary=?, content=?, tags=?, status=?, published_at=? WHERE id=?');
        $stmt->execute([$title, $slug, $thumbnail, $summary, $content, $tags, $status, $publishedAt, $id]);
        setFlash('success', 'Blog berhasil diperbarui.');
        redirect('admin/blog/edit.php?id=' . $id);
    }
}

require_once __DIR__ . '/../../includes/header.php';
?>

<div class="row">
    <div class="col-lg-9">
        <div class="card">
            <div class="card-header bg-white"><strong>Edit Blog Post</strong></div>
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
                            <label class="form-label">Tags</label>
                            <input type="text" name="tags" class="form-control" value="<?= e($item['tags']) ?>"
                                placeholder="php, web, tutorial">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Thumbnail</label>
                            <input type="file" name="thumbnail" class="form-control" accept="image/*">
                            <?php if ($item['thumbnail']): ?>
                            <img src="<?= url('uploads/blog/' . $item['thumbnail']) ?>" class="img-thumbnail mt-2"
                                style="max-height:80px;">
                            <?php endif; ?>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Summary</label>
                            <textarea name="summary" class="form-control" rows="2"><?= e($item['summary']) ?></textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Content</label>
                            <textarea name="content" class="form-control font-monospace"
                                rows="12"><?= e($item['content']) ?></textarea>
                        </div>
                    </div>
                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i>Update</button>
                        <a href="<?= url('admin/blog/index.php') ?>" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>