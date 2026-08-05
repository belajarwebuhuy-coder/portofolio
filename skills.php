<?php
/**
 * -----------------------------------------------------
 * Personal Portfolio CMS
 * Module : Frontend Skills
 * Description : Dedicated skills page
 * Author : Wahyu Subuh
 * -----------------------------------------------------
 */

declare(strict_types=1);

require_once __DIR__ . '/includes/functions.php';

$currentPage = 'skills';
$settings = getSettings();
$pdo = db();

// Fetch skills
$skills = $pdo->query('SELECT * FROM skills ORDER BY sort_order ASC, id DESC')->fetchAll();

$siteTitle = $settings['meta_title'] ?? $settings['website_name'] ?? 'My Portfolio';
$siteDesc = $settings['meta_description'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skills - <?= e($siteTitle) ?></title>
    <meta name="description" content="<?= e($siteDesc) ?>">
    <?php if (!empty($settings['google_verification'])): ?>
    <meta name="google-site-verification" content="<?= e($settings['google_verification']) ?>">
    <?php endif; ?>

    <!-- Favicons -->
    <?php if (!empty($settings['favicon'])): ?>
    <link href="<?= url('uploads/settings/' . $settings['favicon']) ?>" rel="icon">
    <?php else: ?>
    <link href="assets/img/favicon.png" rel="icon">
    <?php endif; ?>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Noto+Sans:wght@100;200;300;400;500;600;700;800;900&family=Questrial:wght@400&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="assets/css/main.css" rel="stylesheet">
</head>

<body class="skills-page">

    <?php include __DIR__ . '/includes/navbar.php'; ?>

    <main class="main">

        <!-- Page Title -->
        <div class="page-title">
            <div class="breadcrumbs">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= url('index.php') ?>"><i class="bi bi-house"></i>
                                Home</a></li>
                        <li class="breadcrumb-item active current">Skills</li>
                    </ol>
                </nav>
            </div>
            <div class="title-wrapper">
                <h1>Skills</h1>
                <p>My technical skills and proficiency levels.</p>
            </div>
        </div><!-- End Page Title -->

        <!-- Skills Section -->
        <section id="skills" class="skills section">
            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <?php if ($skills): ?>
                <div class="row g-4 skills-animation">
                    <?php foreach ($skills as $index => $skill): ?>
                    <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="<?= ($index % 4 + 1) * 100 ?>">
                        <div class="skill-box">
                            <h3><?= e($skill['name']) ?></h3>
                            <span class="text-end d-block"><?= (int) $skill['percentage'] ?>%</span>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar"
                                    aria-valuenow="<?= (int) $skill['percentage'] ?>" aria-valuemin="0"
                                    aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php else: ?>
                <div class="text-center py-5">
                    <i class="bi bi-bar-chart" style="font-size:3rem;color:#adb5bd;"></i>
                    <h3 class="mt-3">No skills yet</h3>
                    <p class="text-muted">Skills will appear here once added by the administrator.</p>
                    <a href="<?= url('index.php') ?>" class="btn btn-primary">Back to Home</a>
                </div>
                <?php endif; ?>

            </div>
        </section><!-- /Skills Section -->

    </main>

    <?php include __DIR__ . '/includes/site-footer.php'; ?>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>

    <!-- Main JS File -->
    <script src="assets/js/main.js"></script>
</body>

</html>