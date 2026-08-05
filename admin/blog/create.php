<?php
/**
 * -----------------------------------------------------
 * Personal Portfolio CMS
 * Module : Blog
 * Description : Create blog post
 * Author : Wahyu Subuh
 * -----------------------------------------------------
 */

declare(strict_types=1);

require_once __DIR__ . '/../../includes/auth.php';
requireLogin();

$pageTitle = 'Add Blog';
$activeMenu = 'blog';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    requireCsrf();

    $title    = trim($_POST['title'] ?? '');
    $slug     = trim($_POST['slug'] ?? '');
    $summary  = trim($_POST['summary'] ?? '');
    $content  = $_POST['content'] ?? '';
    $tags     = trim($_POST['tags'] ?? '');
    $status   = ($_POST['status'] ?? 'draft') === 'published' ? 'published' : 'draft';

    if ($title === '') {
        $errors[] = 'Title wajib diisi.';
    }
    if ($slug === '') {
        $slug = slugify($title);
    }

    $pdo = db();

    $check = $pdo->prepare('SELECT id FROM blogs WHERE slug = ? LIMIT 1');
    $check->execute([$slug]);
    if ($check->fetch()) {
        $errors[] = 'Slug sudah digunakan.';
    }

    $thumbnail = null;
    if (!empty($_FILES['thumbnail']['name'])) {
        $thumbnail = uploadImage($_FILES['thumbnail'], 'blog');
        if ($thumbnail === null) {
            $errors[] = 'Upload thumbnail gagal. Gunakan format JPG/PNG/WEBP maksimal 5MB.';
        }
    }

    if (!$errors) {
        $publishedAt = $status === 'published' ? date('Y-m-d H:i:s') : null;
        $stmt = $pdo->prepare('INSERT INTO blogs (title, slug, thumbnail, summary, content, tags, status, published_at) VALUES (?,?,?,?,?,?,?,?)');
        $stmt->execute([$title, $slug, $thumbnail, $summary, $content, $tags, $status, $publishedAt]);
        setFlash('success', 'Blog berhasil disimpan.');
        redirect('admin/blog/index.php');
    }
}

require_once __DIR__ . '/../../includes/header.php';
?>

<div class="row">
    <div class="col-lg-9">
        <div class="card">
            <div class="card-header bg-white"><strong>Add Blog Post</strong></div>
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
                            <label class="form-label">Tags</label>
                            <input type="text" name="tags" class="form-control" value="<?= e($_POST['tags'] ?? '') ?>"
                                placeholder="php, web, tutorial">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Thumbnail</label>
                            <input type="file" name="thumbnail" class="form-control" accept="image/*">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Summary</label>
                            <textarea name="summary" class="form-control"
                                rows="2"><?= e($_POST['summary'] ?? '') ?></textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Content</label>
                            <textarea name="content" class="form-control font-monospace" rows="12"
                                placeholder="Write your article content here..."><?= e($_POST['content'] ?? '') ?></textarea>
                        </div>
                    </div>
                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i>Save</button>
                        <a href="<?= url('admin/blog/index.php') ?>" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
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