<?php
declare(strict_types=1);

require_once __DIR__ . '/../../includes/auth.php';
requireLogin();

$pageTitle = 'Blog';
$activeMenu = 'blog';

$pdo = db();

// Search
$search = trim($_GET['search'] ?? '');
$where = '';
$params = [];

if ($search !== '') {
    $where = 'WHERE title LIKE ? OR summary LIKE ?';
    $params = ["%$search%", "%$search%"];
}

$stmt = $pdo->prepare("SELECT * FROM blogs $where ORDER BY id DESC");
$stmt->execute($params);
$items = $stmt->fetchAll();

require_once __DIR__ . '/../../includes/header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-0">Blog List</h5>
    <a href="<?= url('admin/blog/create.php') ?>" class="btn btn-primary btn-sm"><i class="bi bi-plus-lg me-1"></i>Add
        New</a>
</div>

<form method="get" action="" class="mb-3">
    <div class="input-group" style="max-width:400px;">
        <input type="text" name="search" class="form-control" placeholder="Search articles..."
            value="<?= e($search) ?>">
        <button class="btn btn-outline-primary" type="submit"><i class="bi bi-search"></i></button>
    </div>
</form>

<?php if ($items): ?>
<div class="card">
    <div class="table-responsive">
        <table class="table table-hover table-striped mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Thumbnail</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Published</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $i => $item): ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td>
                        <?php if ($item['thumbnail']): ?>
                        <img src="<?= url('uploads/blog/' . $item['thumbnail']) ?>" alt="<?= e($item['title']) ?>"
                            style="width:60px;height:40px;object-fit:cover;" class="rounded">
                        <?php else: ?>
                        <span class="text-muted">-</span>
                        <?php endif; ?>
                    </td>
                    <td><?= e($item['title']) ?></td>
                    <td>
                        <span
                            class="badge bg-<?= $item['status'] === 'published' ? 'success' : 'secondary' ?>"><?= e($item['status']) ?></span>
                    </td>
                    <td><?= e(formatDate($item['published_at'])) ?></td>
                    <td class="text-end">
                        <a href="<?= url('blog-detail.php?slug=' . $item['slug']) ?>"
                            class="btn btn-sm btn-outline-primary" target="_blank" title="Preview"><i
                                class="bi bi-eye"></i></a>
                        <a href="<?= url('admin/blog/edit.php?id=' . $item['id']) ?>" class="btn btn-sm btn-warning"
                            title="Edit"><i class="bi bi-pencil"></i></a>
                        <a href="<?= url('admin/blog/delete.php?id=' . $item['id']) ?>" class="btn btn-sm btn-danger"
                            title="Delete" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i
                                class="bi bi-trash"></i></a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php else: ?>
<div class="card">
    <div class="card-body empty-state">
        <i class="bi bi-journal-text"></i>
        <h5 class="mt-3">No Blog Posts Found</h5>
        <p class="text-muted">Write your first article to get started.</p>
        <a href="<?= url('admin/blog/create.php') ?>" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i>Add
            New</a>
    </div>
</div>
<?php endif; ?>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>