<?php
/**
 * -----------------------------------------------------
 * Personal Portfolio CMS
 * Module : Portfolio Details
 * Description : Single project detail page
 * Author : Wahyu Subuh
 * -----------------------------------------------------
 */

declare(strict_types=1);

require_once __DIR__ . '/includes/functions.php';

$currentPage = 'portfolio';
$settings = getSettings();
$pdo = db();

$slug = trim($_GET['slug'] ?? '');
$stmt = $pdo->prepare("SELECT * FROM projects WHERE slug = ? AND status = 'published' LIMIT 1");
$stmt->execute([$slug]);
$project = $stmt->fetch();

$notFound = false;
$gallery = [];
$techStack = [];

if (!$project) {
    http_response_code(404);
    $notFound = true;
} else {
    // Get gallery
    $galleryStmt = $pdo->prepare('SELECT * FROM project_images WHERE project_id = ? ORDER BY sort_order ASC');
    $galleryStmt->execute([$project['id']]);
    $gallery = $galleryStmt->fetchAll();

    $techStack = array_filter(array_map('trim', explode(',', $project['tech_stack'] ?? '')));
}

$siteTitle = $settings['meta_title'] ?? $settings['website_name'] ?? 'My Portfolio';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $notFound ? 'Not Found' : e($project['title']) ?> - <?= e($siteTitle) ?></title>
    <meta name="description" content="<?= $notFound ? '' : e($project['short_description'] ?? '') ?>">

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

<body class="portfolio-details-page">

    <?php include __DIR__ . '/includes/navbar.php'; ?>

    <main class="main">

        <!-- Page Title -->
        <div class="page-title">
            <div class="breadcrumbs">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= url('index.php') ?>"><i class="bi bi-house"></i>
                                Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= url('index.php') ?>#portfolio">Portfolio</a></li>
                        <li class="breadcrumb-item active current"><?= $notFound ? 'Not Found' : e($project['title']) ?>
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="title-wrapper">
                <h1><?= $notFound ? 'Project Not Found' : e($project['title']) ?></h1>
            </div>
        </div>

        <?php if ($notFound): ?>
        <section class="section">
            <div class="container text-center py-5">
                <h2 class="display-4">404</h2>
                <p class="lead">The project you are looking for does not exist.</p>
                <a href="<?= url('index.php') ?>" class="btn btn-primary">Back to Home</a>
            </div>
        </section>
        <?php else: ?>
        <section id="portfolio-details" class="portfolio-details section">
            <div class="container" data-aos="fade-up">
                <div class="row gy-4 g-lg-5">
                    <div class="col-lg-6">
                        <?php if ($project['thumbnail']): ?>
                        <img src="<?= url('uploads/projects/' . $project['thumbnail']) ?>"
                            class="img-fluid mb-4 rounded" alt="<?= e($project['title']) ?>">
                        <?php endif; ?>
                        <?php foreach ($gallery as $img): ?>
                        <img src="<?= url('uploads/projects/' . $img['image']) ?>" class="img-fluid mb-4 rounded"
                            alt="<?= e($project['title']) ?>">
                        <?php endforeach; ?>
                    </div>

                    <div class="col-lg-6">
                        <div class="position-sticky" style="top: 40px">
                            <div class="portfolio-description">
                                <h2><?= e($project['title']) ?></h2>
                                <p><?= nl2br(e($project['description'])) ?></p>
                            </div>

                            <div class="portfolio-info mt-5">
                                <h3>Project information</h3>
                                <ul>
                                    <?php if ($techStack): ?>
                                    <li><strong>Tech Stack</strong> <?= e(implode(', ', $techStack)) ?></li>
                                    <?php endif; ?>
                                    <?php if (!empty($project['github_url'])): ?>
                                    <li><strong>GitHub</strong> <a href="<?= e($project['github_url']) ?>"
                                            target="_blank"><?= e($project['github_url']) ?></a></li>
                                    <?php endif; ?>
                                    <?php if (!empty($project['demo_url'])): ?>
                                    <li><a href="<?= e($project['demo_url']) ?>" class="btn-visit align-self-start"
                                            target="_blank">Visit Website</a></li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>
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