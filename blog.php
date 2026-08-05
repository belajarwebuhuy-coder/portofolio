<?php
/**
 * -----------------------------------------------------
 * Personal Portfolio CMS
 * Module : Blog List
 * Description : List all blog posts with pagination
 * Author : Wahyu Subuh
 * -----------------------------------------------------
 */

declare(strict_types=1);

require_once __DIR__ . '/includes/functions.php';

$currentPage = 'blog';
$settings = getSettings();
$pdo = db();

// Pagination
$page = max(1, (int) ($_GET['page'] ?? 1));
$perPage = PAGE_SIZE;
$offset = ($page - 1) * $perPage;

// Search
$search = trim($_GET['search'] ?? '');
$where = "WHERE status = 'published'";
$params = [];

if ($search !== '') {
    $where .= ' AND (title LIKE ? OR summary LIKE ? OR tags LIKE ?)';
    $params = ["%$search%", "%$search%", "%$search%"];
}

// Count total
$countStmt = $pdo->prepare("SELECT COUNT(*) FROM blogs $where");
$countStmt->execute($params);
$total = (int) $countStmt->fetchColumn();
$totalPages = max(1, (int) ceil($total / $perPage));

// Fetch posts for current page
$stmt = $pdo->prepare("SELECT * FROM blogs $where ORDER BY id DESC LIMIT $perPage OFFSET $offset");
$stmt->execute($params);
$blogs = $stmt->fetchAll();

$siteTitle = $settings['meta_title'] ?? $settings['website_name'] ?? 'My Portfolio';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - <?= e($siteTitle) ?></title>
    <meta name="description" content="Blog articles from <?= e($siteTitle) ?>">

    <?php if (!empty($settings['favicon'])): ?>
    <link href="<?= url('uploads/settings/' . $settings['favicon']) ?>" rel="icon">
    <?php else: ?>
    <link href="assets/img/favicon.png" rel="icon">
    <?php endif; ?>

    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&family=Noto+Sans:wght@100;200;300;400;500;600;700;800;900&family=Questrial:wght@400&display=swap"
        rel="stylesheet">

    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="assets/css/main.css" rel="stylesheet">
</head>

<body class="blog-page">

    <?php include __DIR__ . '/includes/navbar.php'; ?>

    <main class="main">

        <!-- Page Title -->
        <div class="page-title">
            <div class="breadcrumbs">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= url('index.php') ?>"><i class="bi bi-house"></i>
                                Home</a></li>
                        <li class="breadcrumb-item active current">Blog</li>
                    </ol>
                </nav>
            </div>
            <div class="title-wrapper">
                <h1>Blog</h1>
            </div>
        </div>

        <!-- Blog List Section -->
        <section class="blog section">
            <div class="container" data-aos="fade-up">
                <div class="row g-4">
                    <?php foreach ($blogs as $blog): ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100">
                            <?php if ($blog['thumbnail']): ?>
                            <img src="<?= url('uploads/blog/' . $blog['thumbnail']) ?>" class="card-img-top"
                                alt="<?= e($blog['title']) ?>" style="height:200px;object-fit:cover;">
                            <?php endif; ?>
                            <div class="card-body">
                                <h5 class="card-title"><a href="<?= url('blog-detail.php?slug=' . $blog['slug']) ?>"
                                        class="text-decoration-none text-dark"><?= e($blog['title']) ?></a></h5>
                                <p class="card-text text-muted"><?= e(truncate($blog['summary'] ?? '', 110)) ?></p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted"><?= e(formatDate($blog['published_at'])) ?></small>
                                    <a href="<?= url('blog-detail.php?slug=' . $blog['slug']) ?>"
                                        class="btn btn-sm btn-outline-primary">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <?php if (!$blogs): ?>
                <div class="text-center py-5">
                    <i class="bi bi-journal-text" style="font-size:3rem;color:#adb5bd;"></i>
                    <h4 class="mt-3">No articles found</h4>
                    <a href="<?= url('blog.php') ?>" class="btn btn-outline-primary mt-2">View All</a>
                </div>
                <?php endif; ?>

                <!-- Pagination -->
                <?php if ($totalPages > 1): ?>
                <nav class="mt-5">
                    <ul class="pagination justify-content-center">
                        <?php if ($page > 1): ?>
                        <li class="page-item"><a class="page-link"
                                href="<?= url('blog.php?page=' . ($page - 1) . ($search ? '&search=' . urlencode($search) : '')) ?>">&laquo;</a>
                        </li>
                        <?php endif; ?>
                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="page-item <?= $i === $page ? 'active' : '' ?>">
                            <a class="page-link"
                                href="<?= url('blog.php?page=' . $i . ($search ? '&search=' . urlencode($search) : '')) ?>"><?= $i ?></a>
                        </li>
                        <?php endfor; ?>
                        <?php if ($page < $totalPages): ?>
                        <li class="page-item"><a class="page-link"
                                href="<?= url('blog.php?page=' . ($page + 1) . ($search ? '&search=' . urlencode($search) : '')) ?>">&raquo;</a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </nav>
                <?php endif; ?>
            </div>
        </section>

    </main>

    <?php include __DIR__ . '/includes/site-footer.php'; ?>

    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>