<?php
/**
 * -----------------------------------------------------
 * Personal Portfolio CMS
 * Module : Blog Detail
 * Description : Single blog post page
 * Author : Wahyu Subuh
 * -----------------------------------------------------
 */

declare(strict_types=1);

require_once __DIR__ . '/includes/functions.php';

$currentPage = 'blog';
$settings = getSettings();
$pdo = db();

$slug = trim($_GET['slug'] ?? '');
$stmt = $pdo->prepare("SELECT * FROM blogs WHERE slug = ? AND status = 'published' LIMIT 1");
$stmt->execute([$slug]);
$blog = $stmt->fetch();

if (!$blog) {
    http_response_code(404);
    $notFound = true;
} else {
    $tags = array_filter(array_map('trim', explode(',', $blog['tags'] ?? '')));
}

$siteTitle = $settings['meta_title'] ?? $settings['website_name'] ?? 'My Portfolio';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $notFound ? 'Not Found' : e($blog['title']) ?> - <?= e($siteTitle) ?></title>
    <meta name="description" content="<?= $notFound ? '' : e($blog['summary'] ?? '') ?>">

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

<body class="blog-details-page">

    <?php include __DIR__ . '/includes/navbar.php'; ?>

    <main class="main">

        <!-- Page Title -->
        <div class="page-title">
            <div class="breadcrumbs">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= url('index.php') ?>"><i class="bi bi-house"></i>
                                Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= url('blog.php') ?>">Blog</a></li>
                        <li class="breadcrumb-item active current"><?= $notFound ? 'Not Found' : e($blog['title']) ?>
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="title-wrapper">
                <h1><?= $notFound ? 'Article Not Found' : e($blog['title']) ?></h1>
            </div>
        </div>

        <?php if ($notFound): ?>
        <section class="section">
            <div class="container text-center py-5">
                <h2 class="display-4">404</h2>
                <p class="lead">The article you are looking for does not exist.</p>
                <a href="<?= url('blog.php') ?>" class="btn btn-primary">Back to Blog</a>
            </div>
        </section>
        <?php else: ?>
        <section class="blog-details section">
            <div class="container" data-aos="fade-up">
                <div class="row justify-content-center">
                    <div class="col-lg-9">
                        <article class="blog-post">
                            <?php if ($blog['thumbnail']): ?>
                            <img src="<?= url('uploads/blog/' . $blog['thumbnail']) ?>" class="img-fluid mb-4 rounded"
                                alt="<?= e($blog['title']) ?>">
                            <?php endif; ?>

                            <div class="meta d-flex flex-wrap gap-3 mb-4">
                                <span class="text-muted"><i
                                        class="bi bi-calendar me-1"></i><?= e(formatDate($blog['published_at'], 'd M Y')) ?></span>
                                <?php if ($tags): ?>
                                <span class="text-muted"><i
                                        class="bi bi-tags me-1"></i><?= e(implode(', ', $tags)) ?></span>
                                <?php endif; ?>
                            </div>

                            <div class="blog-content">
                                <p><?= nl2br(e($blog['summary'])) ?></p>
                                <hr>
                                <div class="mt-3">
                                    <?= nl2br(e($blog['content'])) ?>
                                </div>
                            </div>

                            <?php if ($tags): ?>
                            <div class="mt-4">
                                <?php foreach ($tags as $tag): ?>
                                <span class="badge bg-secondary me-1">#<?= e($tag) ?></span>
                                <?php endforeach; ?>
                            </div>
                            <?php endif; ?>
                        </article>
                    </div>
                </div>
            </div>
        </section>
        <?php endif; ?>

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