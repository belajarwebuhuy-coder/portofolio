<?php
/**
 * -----------------------------------------------------
 * Personal Portfolio CMS
 * Module : Dashboard
 * Description : Admin overview with statistics
 * Author : Wahyu Subuh
 * -----------------------------------------------------
 */

declare(strict_types=1);

require_once __DIR__ . '/../includes/auth.php';
requireLogin();

$pageTitle = 'Dashboard';
$activeMenu = 'dashboard';

// Statistics
$pdo = db();

$projectCount   = (int) $pdo->query('SELECT COUNT(*) FROM projects')->fetchColumn();
$blogCount      = (int) $pdo->query('SELECT COUNT(*) FROM blogs')->fetchColumn();
$certCount      = (int) $pdo->query('SELECT COUNT(*) FROM certificates')->fetchColumn();
$messageCount   = (int) $pdo->query('SELECT COUNT(*) FROM messages')->fetchColumn();
$unreadMessages = (int) $pdo->query('SELECT COUNT(*) FROM messages WHERE is_read = 0')->fetchColumn();

// Recent data
$recentProjects = $pdo->query('SELECT id, title, status, created_at FROM projects ORDER BY id DESC LIMIT 5')->fetchAll();
$recentBlogs    = $pdo->query('SELECT id, title, status, created_at FROM blogs ORDER BY id DESC LIMIT 5')->fetchAll();
$recentMessages = $pdo->query('SELECT id, name, email, subject, is_read, created_at FROM messages ORDER BY id DESC LIMIT 5')->fetchAll();

require_once __DIR__ . '/../includes/header.php';
?>

<!-- Stat Cards -->
<div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
        <div class="card">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="stat-icon bg-primary-subtle text-primary"><i class="bi bi-kanban"></i></div>
                <div>
                    <div class="fs-4 fw-bold"><?= $projectCount ?></div>
                    <div class="text-muted small">Projects</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="stat-icon bg-success-subtle text-success"><i class="bi bi-journal-text"></i></div>
                <div>
                    <div class="fs-4 fw-bold"><?= $blogCount ?></div>
                    <div class="text-muted small">Blog</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="stat-icon bg-warning-subtle text-warning"><i class="bi bi-award"></i></div>
                <div>
                    <div class="fs-4 fw-bold"><?= $certCount ?></div>
                    <div class="text-muted small">Certificates</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <a href="<?= url('admin/messages/index.php') ?>" class="text-decoration-none">
            <div class="card">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="stat-icon bg-danger-subtle text-danger position-relative">
                        <i class="bi bi-envelope"></i>
                        <?php if ($unreadMessages > 0): ?>
                        <span
                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"><?= $unreadMessages ?></span>
                        <?php endif; ?>
                    </div>
                    <div>
                        <div class="fs-4 fw-bold"><?= $messageCount ?></div>
                        <div class="text-muted small">Messages</div>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>

<!-- Recent Tables -->
<div class="row g-3">
    <div class="col-lg-4">
        <div class="card h-100">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <strong>Recent Projects</strong>
                <a href="<?= url('admin/projects/index.php') ?>" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <div class="card-body">
                <?php if ($recentProjects): ?>
                <ul class="list-group list-group-flush">
                    <?php foreach ($recentProjects as $p): ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <div><?= e($p['title']) ?></div>
                            <small class="text-muted"><?= formatDate($p['created_at']) ?></small>
                        </div>
                        <span
                            class="badge bg-<?= $p['status'] === 'published' ? 'success' : 'secondary' ?>"><?= e($p['status']) ?></span>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <?php else: ?>
                <div class="empty-state">
                    <i class="bi bi-kanban"></i>
                    <p class="mt-2 mb-0 text-muted">No projects yet</p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card h-100">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <strong>Recent Blog</strong>
                <a href="<?= url('admin/blog/index.php') ?>" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <div class="card-body">
                <?php if ($recentBlogs): ?>
                <ul class="list-group list-group-flush">
                    <?php foreach ($recentBlogs as $b): ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <div><?= e(truncate($b['title'], 40)) ?></div>
                            <small class="text-muted"><?= formatDate($b['created_at']) ?></small>
                        </div>
                        <span
                            class="badge bg-<?= $b['status'] === 'published' ? 'success' : 'secondary' ?>"><?= e($b['status']) ?></span>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <?php else: ?>
                <div class="empty-state">
                    <i class="bi bi-journal-text"></i>
                    <p class="mt-2 mb-0 text-muted">No blog posts yet</p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card h-100">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <strong>Recent Messages</strong>
                <a href="<?= url('admin/messages/index.php') ?>" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <div class="card-body">
                <?php if ($recentMessages): ?>
                <ul class="list-group list-group-flush">
                    <?php foreach ($recentMessages as $m): ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <div><?= e($m['name']) ?></div>
                            <small class="text-muted"><?= e(truncate($m['subject'] ?: $m['message'], 30)) ?></small>
                        </div>
                        <?php if (!$m['is_read']): ?>
                        <span class="badge bg-danger">Unread</span>
                        <?php endif; ?>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <?php else: ?>
                <div class="empty-state">
                    <i class="bi bi-envelope"></i>
                    <p class="mt-2 mb-0 text-muted">No messages yet</p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>