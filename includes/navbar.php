<?php
/**
 * -----------------------------------------------------
 * Personal Portfolio CMS
 * Module : Frontend Navbar
 * Description : Dynamic site navigation
 * Author : Wahyu Subuh
 * -----------------------------------------------------
 */

declare(strict_types=1);

require_once __DIR__ . '/functions.php';

$settings = getSettings();
$siteName = $settings['website_name'] ?? 'My Portfolio';
?>
<header id="header" class="header d-flex align-items-center sticky-top">
    <div
        class="header-container container-fluid container-xl position-relative d-flex align-items-center justify-content-between">
        <a href="<?= url('index.php') ?>" class="logo d-flex align-items-center me-auto me-xl-0">
            <?php if (!empty($settings['logo'])): ?>
            <img src="<?= url('uploads/settings/' . $settings['logo']) ?>" alt="<?= e($siteName) ?>">
            <?php else: ?>
            <h1 class="sitename"><?= e($siteName) ?></h1>
            <?php endif; ?>
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="<?= url('index.php') ?>#hero"
                        class="<?= ($currentPage ?? 'home') === 'home' ? 'active' : '' ?>">Home</a></li>
                <li><a href="<?= url('index.php') ?>#about">About</a></li>
                <li><a href="<?= url('index.php') ?>#skills"
                        class="<?= ($currentPage ?? '') === 'skills' ? 'active' : '' ?>">Skills</a></li>
                <li><a href="<?= url('index.php') ?>#resume">Resume</a></li>
                <li><a href="<?= url('index.php') ?>#portfolio">Portfolio</a></li>
                <li><a href="<?= url('blog.php') ?>">Blog</a></li>
                <li><a href="<?= url('index.php') ?>#contact">Contact</a></li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        <div class="header-social-links">
            <?php if (!empty($settings['x'])): ?><a href="<?= e($settings['x']) ?>" target="_blank"><i
                    class="bi bi-twitter-x"></i></a><?php endif; ?>
            <?php if (!empty($settings['facebook'])): ?><a href="<?= e($settings['facebook']) ?>" target="_blank"><i
                    class="bi bi-facebook"></i></a><?php endif; ?>
            <?php if (!empty($settings['instagram'])): ?><a href="<?= e($settings['instagram']) ?>" target="_blank"><i
                    class="bi bi-instagram"></i></a><?php endif; ?>
            <?php if (!empty($settings['linkedin'])): ?><a href="<?= e($settings['linkedin']) ?>" target="_blank"><i
                    class="bi bi-linkedin"></i></a><?php endif; ?>
            <?php if (!empty($settings['github'])): ?><a href="<?= e($settings['github']) ?>" target="_blank"><i
                    class="bi bi-github"></i></a><?php endif; ?>
        </div>
    </div>
</header>